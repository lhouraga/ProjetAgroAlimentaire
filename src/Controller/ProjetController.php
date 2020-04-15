<?php

namespace App\Controller;

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
use Symfony\Component\HttpFoundation\Request;

class ProjetController extends AbstractController
{
    /**
     * @Route("/projet", name="projet")
     */
    public function index()
    {
        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }

    /**
     * @Route("/", name="accueil")
     */
    public function home()
    {
        return $this->render('projet/accueil.html.twig');
    }

    /**
     * @Route("/fournisseur", name="fournisseur")
     */
    public function fournisseur(Request $request, EntityManagerInterface $manager)
    {
        $fourni=new Fournisseur(); 
        $form= $this->createForm(FournisseurType::class,$fourni) ;  
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($fourni);
            $manager->flush();

            return $this->redirectToRoute('fournisseur');
        }

        return $this->render('projet/fournisseur.html.twig', [
            'formulaire' =>$form->createView()
        ]);
    }

    /**
     * @Route("/recette", name="recette")
     */
    public function recet(Request $request, EntityManagerInterface $manager)
    {
        $recette=new Recette();
        
        $form=$this->createForm(RecetteType::class, $recette);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           

            $manager->persist($recette);
            $manager->flush();

            $sessionRec = new Session(new NativeSessionStorage(), new AttributeBag());
            $sessionRec->set('Recette', $recette->getId());
            
            return $this->redirectToRoute('IngredientRec',['recette'=>$sessionRec->get('Recette')]);
        }
        return $this->render('projet/recette.html.twig',[
            'formulaireRecette'=> $form->createView()
        ]);
    }

    /**
     * @Route("/lot", name="lot")
     */
    public function lot(Request $request, EntityManagerInterface $manager)
    {
        
        $lot= new Lot();
         
        $form= $this->createForm(LotType::class, $lot);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $lot-> setDateReception(new \DateTime());
            $manager->persist($lot);
            $manager->flush();
           
            $session = new Session(new NativeSessionStorage(), new AttributeBag());
            $session->set('idLot', $lot->getId());
            return $this->redirectToRoute('detailLot',['idLo'=>$session->get('idLot')]);
        }
        return $this->render('projet/lot.html.twig',[
            'formulaireLot' =>$form->createView(),
            
        ]);
    }


    /**
     * @Route("/detail", name="detailLot")
     */
    public function Detail(Request $request, EntityManagerInterface $manager)
    
    {
        $detail=new DetailLotRecu(); 
        $form= $this->createForm(DetailLotType::class,$detail) ;
        $form->handleRequest($request);

        

        if($form->isSubmitted() && $form->isValid()){
        $session = new Session();
        $lot=new Lot();
        $repoL= $this->getDoctrine()->getRepository(Lot::class);
        $id= $session->get('idLot');
        $lot= $repoL->find($id);

            $detail-> setQteUtilise(0);
            $detail-> setLot($lot);
            $detail-> setQteDispo($detail->getQteRecu());
            $manager->persist($detail);
            $manager->flush();
            
            return $this->redirectToRoute('detailLot');
        }
        return $this->render('projet/detailLot.html.twig', [
            'formulaireDet' =>$form->createView(),
            //'id' => $session->get('idLot')

        ]);
    }

     /**
     * @Route("/ingredient", name="IngredientRec")
     */
    public function Ingre(Request $request, EntityManagerInterface $manager)
    {
  
        $ingredient=new Ingredient(); 
        $form= $this->createForm(IngredientType::class,$ingredient) ;  
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $sessionRec = new Session();
            $recette=new Recette();
            $repoL= $this->getDoctrine()->getRepository(Recette::class);
            $id= $sessionRec->get('Recette');
            $recette= $repoL->find($id);

            $recette->addIngredient($ingredient);
            $ingredient->addRecette($recette);


            $manager->persist($ingredient);
            $manager->flush();
            
            
            return $this->redirectToRoute('IngredientRec');
        }

             
        return $this->render('projet/ingredient.html.twig', [
            'formulaireIngredient' =>$form->createView()
        ]);
    }
}