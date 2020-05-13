<?php

namespace App\Controller;

use App\Controller\RecetteController;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Recette;
use App\Entity\Ingredient;
use App\Entity\RechercheRecetteNom;

use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Request;

use App\Form\RecetteType;
use App\Form\DetailLotType;
use App\Form\IngredientType;
use App\Form\RechercheRecetteNomType;


class RecetteController extends AbstractController
{
    /**
     * @Route("/rec", name="rec")
     */
    public function index()
    {
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }

/**
     * @Route("/afficherRecette/{id}", name="AfficherRecette")
     * @param Recette $recette
     */
    public function afficherRec(Recette $recette)
    {
        $repoI= $this->getDoctrine()->getRepository(Ingredient::class);

        $id= $recette->getId();
        $ingredients= $repoI->findIngre($id);
        
        return $this->render('affichage/afficherRecette.html.twig', [
            'recette' => $recette,
            'ingredients'=>$ingredients
            
        ]);
    }

    /**
     * @Route("/RechercheRecette", name="RechercheRecette")
     */
    public function RechercheRecette(RecetteRepository $repoR,Request $request, EntityManagerInterface $manager)
    {

            $session = new Session(new NativeSessionStorage(), new AttributeBag());
            $session->set('NomRec', $_POST['nomRec']);
            return $this->redirectToRoute('ResultatRechercheRecette');
        
     } 


     /**
     * @Route("/resultatRcherche", name="ResultatRechercheRecette")
     */
    public function ResultatRechercheRecette(RecetteRepository $repoR,Request $request, EntityManagerInterface $manager)
    {

        //$repoL= $this->getDoctrine()->getRepository(Recette::class);

            $session = new Session();
        //$id= $sessionIngreRec->get('Recette');
            $nom=$session->get('NomRec');
            $recette= $repoR->findOneBy(['NomRecette'=>$nom]);
            return $this->render('affichage/afficherResultatRecherche.html.twig', [
                'recette' => $recette
                
            ]);
        
     } 

    /**
     * @Route("/afficherRechercheRecette/{id}", name="AfficherRechercheRecette")
     * @param Recette $recette
     */
    public function afficherRechercheRec(Recette $recette)
    {
        $repoI= $this->getDoctrine()->getRepository(Ingredient::class);
        $repoL= $this->getDoctrine()->getRepository(Recette::class);

       // $sessionIngreRec = new Session();
        //$sessionRecNom = new Session();
        //$id= $sessionIngreRec->get('Recette');
       // $nom=$sessionRecNom->get('NomRec');
        $id= $recette->getId();
        $ingredients= $repoI->findIngre($id);
        //$recette= $repoL->findOneBy(['NomRecette'=>$nom]);
        //dump($nom);
        $session2 = new Session(new NativeSessionStorage(), new AttributeBag());
        $session2->set('idRecetteP', $id);
        return $this->render('affichage/afficherRechercheRecette.html.twig', [
            'recette' => $recette,
            'ingredients'=>$ingredients
            
        ]);
    }

/**
     * @Route("/recettePrep/{id}", name="prepaRecette")
     * @param Recette $recette
     */
    public function prepaRec(Recette $recette)
    {
        $repoI= $this->getDoctrine()->getRepository(Ingredient::class);

        $id= $recette->getId();
        $ingredients= $repoI->findIngre($id);
        return $this->render('affichage/afficherRechercheRecette.html.twig', [
            'recette' => $recette,
            'ingredients'=>$ingredients
            
        ]);
    }



}
