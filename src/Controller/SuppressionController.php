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
    public function supprimerRec(Recette $recette, IngredientRepository $repoR,Request $request, EntityManagerInterface $manager)
    {
        
            $id=$recette->getId();
            $ingredients= $repoR->findIngre($id);

            foreach($ingredients as $ingredient)
            {
              $manager->remove($ingredient);
              $manager->flush();
            }

            $manager->remove($recette);
          
            $manager->flush();
            return $this->redirectToRoute('ListeRecette');

    }

    /**
     * @Route("/SupprimerIngreRecette/{id}", name="SupprimerIngreRecette")
     * @param Ingredient $ingredient
     */
    public function supprimerIngreRec(Ingredient $ingredient, RecetteRepository $repoR, Request $request, EntityManagerInterface $manager)
    {
        
            /*$id=$ingredient->getId();
            $recette= $repoR->findRecette($id);
            
            $recette->removeIngredient($ingredient);*/
            $manager->remove($ingredient);
          
            $manager->flush();
            return $this->redirectToRoute('ListeIngredientRecette');

    }


}
