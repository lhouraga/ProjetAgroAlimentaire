<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Fournisseur;
use App\Entity\Lot;
use App\Entity\DetailAlimentRecu;
use App\Entity\Recette;
use App\Entity\Ingredient;

use App\Form\FournisseurType;
use App\Form\RecetteType;
use App\Form\DetailAlimentType;
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

            return $this->redirectToRoute('IngredientRec');
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
       // $session = new Session(new PhpBridgeSessionStorage());
       // $session = new Session();
       // $session->start();
        $lot= new Lot();
        //$repoF= $this->getDoctrine()->getRepository(Fournisseur::class);
        //$fournisseurs= $repoF->findAll();
        $form= $this->createForm(LotType::class, $lot);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $lot-> setDateReception(new \DateTime());
            //$task = $form->getData()->$lot->getId();

            $manager->persist($lot);
            $manager->flush();
           // $session->set('idLot', $lot);
            
            return $this->redirectToRoute('detailAliment', ['idDetail'=>$lot->getId()]);
        }
        return $this->render('projet/lot.html.twig',[
            'formulaireLot' =>$form->createView(),
            
        ]);
    }


    /**
     * @Route("/detail", name="detailAliment")
     */
    public function Detail(Request $request)
    {
        $detail=new DetailAlimentRecu(); 
        $form= $this->createForm(DetailAlimentType::class,$detail) ;        
        return $this->render('projet/detailAliment.html.twig', [
            'formulaireDetail' =>$form->createView(),
            //'id' => $session->get('idLot')

        ]);
    }

     /**
     * @Route("/ingredient", name="IngredientRec")
     */
    public function Ingre(Request $request)
    {
        $ingredient=new Ingredient(); 
        $form= $this->createForm(IngredientType::class,$ingredient) ;        
        return $this->render('projet/ingredient.html.twig', [
            'formulaireIngredient' =>$form->createView()
        ]);
    }
}
