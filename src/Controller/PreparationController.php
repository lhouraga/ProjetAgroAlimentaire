<?php

namespace App\Controller;

use App\Controller\PreparationController;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Fournisseur;
use App\Entity\Lot;
use App\Entity\DetailAlimentRecu;
use App\Entity\Recette;
use App\Entity\Ingredient;
use App\Entity\DetailLotRecu;
use App\Entity\PlatPrepare;

use App\Form\FournisseurType;
use App\Form\RecetteType;
use App\Form\DetailLotType;
use App\Form\IngredientType;
use App\Form\LotType;

use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use App\Repository\DetailLotRecuRepository;
use App\Repository\PlatPrepareRepository;
use Symfony\Component\HttpFoundation\Request;

class PreparationController extends AbstractController
{
    /**
     * @Route("/prepa", name="preparationIndex")
     */
    public function index()
    {

        $recette=new Recette();
        
        $form=$this->createForm(RecetteType::class, $recette);
        return $this->render('preparation/fab.html.twig',[
            'formulaireRecette'=> $form->createView()
        ]);
    }

    /**
     * @Route("/DispoIngredient", name="DisponibiliteAliment")
     * 
     * 
     */
    public function DispoIngredient()
    {
        $repoI= $this->getDoctrine()->getRepository(Ingredient::class);
        $repoR= $this->getDoctrine()->getRepository(Recette::class);
       
       $i=1;
       $j=1;
       $ingreManque=null;
       $ingreInsuff=null;
       $ingreInsuffN=null;
       $ingreSuff=null;

      //declaration des variables session dont on a besoin
       $sessionToutIngre = new Session();
       $session2 = new Session();
       $idrec= $session2->get('idRecetteP');
       $ingredients= $repoI->findIngre($idrec);

       //recuperer le nom de la recette pour renseigner le plat
       $nomR=$repoR->findOneBy(['id'=>$idrec]);
       dump( $ingredients);
       $sessionNomPlat = new Session(new NativeSessionStorage(), new AttributeBag());
       $sessionNomPlat->set('NomPlat', $nomR->getNomRecette());


       //recuperer le nombre de plat pour renseigner le plat
       $sessionNbPlat = new Session(new NativeSessionStorage(), new AttributeBag());
       $sessionNbPlat->set('NbPlat', $_POST['nombrePlat']);
        $nombre=$_POST['nombrePlat'];

        $repoL= $this->getDoctrine()->getRepository(DetailLotRecu::class);
        $aliments=$repoL->afficher();
       
        // Recherche des ingredients dans la base de données
        foreach($ingredients as $ingre ){
            $test=$repoL->afficherTout($ingre->getAliment());
        if($test != null){
            $ingreTout[]=$test;
            
            } 
            else{
                $ingreManque[$j]=$ingre;
                $j++;
            }
        }

        foreach($ingredients as $ingre ){
            $test2=$repoL->afficherTout($ingre->getAliment());
        if($test2 != null){
            $test3=$test2->getQteDispo();
            if($test3 < $nombre * $ingre->getQteNecessaire())
            {
                $ingreInsuffN[]=($nombre *$ingre->getQteNecessaire())- $test3;
                $ingreInsuff[]=$ingre;
                
            }

            if($test3 > $nombre * $ingre->getQteNecessaire())
            {
                $ingreSuff[]=$test2;
            }
            else{
                $ingreCritique[]=$test2;
            } 
        }
        }

        //test 
        $sessiontest = new Session(new NativeSessionStorage(), new AttributeBag());
        $sessiontest->set('test', $ingreSuff);

        $sessiontestNec = new Session(new NativeSessionStorage(), new AttributeBag());
        $sessiontestNec->set('testNec', $ingredients);

        dump($ingreTout);
        dump($ingreManque);
        dump($sessiontest);
        
        return $this->render('gestion_stock/disponibilitéAliment.html.twig',[
            'aliments'=> $aliments,
            'nb' => $nombre,
            'IngreNecessaire' =>$ingreTout,
            'ingredients'=>$ingredients,
            'Manque'=>$ingreManque,
            'IngreInsuffisant' =>$ingreInsuff,
            'IngreInsuffisantNombre' =>$ingreInsuffN,
            'Ingresuffisant'=>$ingreSuff
           
        ]);
    }




    /**
     * @Route("/listePlats", name="platsPrepares")
     */
    public function ListePlats(PlatPrepareRepository $repoR)
    {

        $plats= $repoR->findAll();
        return $this->render('preparation/ListePlat.html.twig', [
            'plats' => $plats
            
        ]);
        
    }


    /**
     * @Route("/preparation", name="preparation")
     */
    public function preparationP(EntityManagerInterface $manager)
    {
        $repoL= $this->getDoctrine()->getRepository(DetailLotRecu::class);
        
        $platPrep=new PlatPrepare();
        $detAliment=new DetailLotRecu();
        $prix=0;

        $sessiontest = new Session();
        $sessiontestNec = new Session();
        $sessionNbPlat = new Session();
        $sessionNomPlat= new Session();
        $alis= $sessiontest->get('test');
        $alisNec= $sessiontestNec->get('testNec');
        $nomPlat=$sessionNomPlat->get('NomPlat');
        $nb=$sessionNbPlat->get('NbPlat');
        dump($alis);
        dump($alisNec);

        $platPrep->setNomPlat($nomPlat)
                 ->setNbrePlat($nb)
                 ->setDatePrepare(new \DateTime());
        
            $manager->persist($platPrep);
            $manager->flush();
                 
        foreach($alis as $ingre ){
               
               $id=$ingre->getId();
               $detAliment=$repoL->findOneBy(['id'=>$id]);
               $QteUtilise=$detAliment->getQteUtilise();
               $QteDispo=$detAliment->getQteDispo();
               foreach($alisNec as $necessaire) {
                   $test=$ingre->getNomAliment();
                   if($test === $necessaire->getAliment()){
                       $QteUtilise=$QteUtilise + ($necessaire->getQteNecessaire() * $nb);
                       $QteDispo=$QteDispo - ($necessaire->getQteNecessaire() * $nb);
                      // $rec=$ingre->getQteDispo();
                      //$detAliment->setQteDispo($rec - ($necessaire->getQteNecessaire() * $nb));
                     // $detAliment=$ingre;
                      //$platPrep->addAlimentUtilise($detAliment);
                      //$detAliment->addPlatPrepare($platPrep);
                   }
                   $platPrep->addAlimentsUtilise($detAliment);
                   $detAliment->setQteDispo($QteDispo);
                   $detAliment->setQteUtilise($QteUtilise);  
                   $detAliment->addPlatPrepare($platPrep);
                   $manager->flush();
               }
               $prix=$prix * ($ingre->getPrixUnitaire() * $nb);
            }
            $platPrep->setPrixTotal($prix);
            $manager->flush();
            
            return $this->redirectToRoute('chargement');
        }

    /**
     * @Route("/afficherPlat{id}", name="afficherPlat")
     *  @param PlatPrepare $plat
     */
    public function AfficherPlat(PlatPrepareRepository $repoR, PlatPrepare $plat)
    {

        $repoI= $this->getDoctrine()->getRepository(DetailLotRecu::class);

        $id= $plat->getId();
        $detailLot= $repoI->findAlimentUtilise($id);
        
        return $this->render('affichage/afficherPlat.html.twig', [
            'plat' => $plat,
            'aliments'=>$detailLot
            
        ]);
        
    }
}
