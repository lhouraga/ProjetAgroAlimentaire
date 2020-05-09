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

use App\Form\FournisseurType;
use App\Form\RecetteType;
use App\Form\DetailLotType;
use App\Form\IngredientType;
use App\Form\LotType;

use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use App\Repository\DetailLotRecuRepository;
use Symfony\Component\HttpFoundation\Request;

class PreparationController extends AbstractController
{
    /**
     * @Route("/preparation", name="preparation")
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
       
       $i=1;
       $j=1;
       $ingreManque=array();
       $ingreInsuff=array();
       $ingreSuff=array();


       $sessionToutIngre = new Session();
       $session2 = new Session();
       $id= $session2->get('nombre');
       $ingredients= $repoI->findIngre($id);

      
       dump( $ingredients);
        
        $nombre=$_POST['nombrePlat'];
        $repoL= $this->getDoctrine()->getRepository(DetailLotRecu::class);
        $aliments=$repoL->afficher();
       
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
            if($test3== $nombre * $ingre->getQteNecessaire())
            {
                $ingreCritique[]=$test2;
            }

            if($test3 > $nombre * $ingre->getQteNecessaire())
            {
                $ingreSuff[]=$test2;
            }
            else{
                $ingreInsuffN[]=($nombre *$ingre->getQteNecessaire())- $test3;
                $ingreInsuff[]=$ingre;
            } 
        }
        }


        dump($ingreTout);
        dump($ingreManque);
        
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
    public function ListePlats()
    {
        return $this->render('preparation/ListePlat.html.twig');
    }
}
