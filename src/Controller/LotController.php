<?php

namespace App\Controller;

use App\Controller\LotController;
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
use App\Repository\FournisseurRepository;
use App\Repository\LotRepository;
use App\Repository\IngredientRepository;
use App\Repository\DetailLotRecuRepository;
use Symfony\Component\HttpFoundation\Request;

class LotController extends AbstractController
{
    /**
     * @Route("/lotsociete", name="lotsociete")
     */
    public function index()
    {
        return $this->render('lot/index.html.twig', [
            'controller_name' => 'LotController',
        ]);
    }


    /**
     * @Route("/listeLot", name="ListeLot")
     */
    public function ListeLot(LotRepository $repoR)
    {
        $lots= $repoR->findAll();
        return $this->render('lot/listeLot.html.twig',[
                 'lots' =>$lots
        ]);
    }


    /**
     * @Route("/afficherDetailLot/{id}", name="AfficherDetailLot")
     * @param Lot $lot
     */
    public function afficherDetLot(Lot $lot)
    {
        $repoF= $this->getDoctrine()->getRepository(Fournisseur::class);
        $repoD= $this->getDoctrine()->getRepository(DetailLotRecu::class);


        $id= $lot->getId();
        $idFour=$lot->getFournisseur();
        $fournisseur= $repoF->findFournisseurLot($id);

        $four= $repoF->findOneBy(['id'=>$idFour]);

        $detail= $repoD->findDetailLot($id);
        
      //  $nomFour=$fournisseur->getSociete();
        dump($four);
        
        return $this->render('affichage/AffichageDetailLot.html.twig', [
           // 'fournisseur' => $fournisseur,
            'details'=>$detail,
            'idLot'=>$id,
            'fournisseur'=>$four
            
        ]);
    }

     /**
     * @Route("/listeFournisseur", name="ListeFournisseur")
     */
    public function ListeFournisseur(FournisseurRepository $repoF)
    {
        $fournisseurs= $repoF->findAll();
        return $this->render('lot/listeFournisseur.html.twig',[
                 'fournisseurs' =>$fournisseurs
        ]);
    }


     /**
     * @Route("/infosFournisseur/{id}", name="infosFournisseur")
     * @param Fournisseur $fournisseur
     */
    public function infosFour(Fournisseur $fournisseur)
    {
        $repoF= $this->getDoctrine()->getRepository(Fournisseur::class);
        $repoD= $this->getDoctrine()->getRepository(DetailLotRecu::class);


        $id= $fournisseur->getId();
       // $fournisseur= $repoF->findFournisseurLot($id);
        $four= $repoF->findOneBy(['id'=>$id]);

        dump($four);
        
        return $this->render('lot/infosFournisseur.html.twig', [
            'fournisseur'=>$four
            
        ]);
    }

}
