<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;


use App\Entity\Recette;
use App\Entity\Ingredient;

use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Request;

use App\Form\RecetteType;
use App\Form\DetailLotType;
use App\Form\IngredientType;

class SuppressionController extends AbstractController
{
    /**
     * @Route("/suppression", name="suppression")
     */
    public function index()
    {
        return $this->render('suppression/index.html.twig', [
            'controller_name' => 'SuppressionController',
        ]);
    }

    /**
     * @Route("/SupprimerRecette/{id}", name="SupprimerRecette")
     * @param Recette $recette
     */
    public function supprimerRec(Recette $recette,Request $request, EntityManagerInterface $manager)
    {
        
        $form=$this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->flush();
           // $ingredients= $recette ->getIngredient();
            $sessionIngreRec = new Session(new NativeSessionStorage(), new AttributeBag());
            $sessionRecNom = new Session(new NativeSessionStorage(), new AttributeBag());
            $sessionIngreRec->set('Recette', $recette->getId());
            $sessionRecNom->set('NomRecette', $recette->getNomRecette());

            return $this->redirectToRoute('ListeIngredientRecette');

        }

        return $this->render('suppression/supprimerRecette.html.twig', [
            'recette' => $recette,
            'formulaire'=> $form->createView()
        ]);
    }


}
