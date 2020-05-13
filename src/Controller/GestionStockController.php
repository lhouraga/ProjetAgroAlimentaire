<?php

namespace App\Controller;
use App\Entity\DetailLotRecu;
use App\Entity\Lot;
use App\Entity\PlatPrepare;
use App\Entity\Fournisseur;
use App\Repository\DetailLotRecuRepository;
use App\Repository\PlatPrepareRepository;
use App\Repository\FournisseurRepository;
use App\Repository\LotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GestionStockController extends AbstractController
{
    /**
     * @Route("/gestion/stock", name="gestion_stock")
     */
    public function index()
    {
        return $this->render('gestion_stock/index.html.twig', [
            'controller_name' => 'GestionStockController',
        ]);
    }

    /**
     * @Route("/disponibilite", name="DisponibiliteAliment")
     */
    public function dispoAliment()
    {
        return $this->render('gestion_stock/disponibilitéAliment.html.twig', [
            'controller_name' => 'GestionStockController',
        ]);
    }

    /**
     * @Route("/stock", name="stockAliment")
     */
    public function stockAliment()
    {
        $repoD=$this->getDoctrine()->getRepository(DetailLotRecu::class);
        $aliment=$repoD->findAll();
        return $this->render('gestion_stock/stock.html.twig', [
            'aliments'=>$aliment
        ]);
    }

    /**
     * @Route("/chargement", name="chargement")
     */
    public function chargement()
    {
    
        return $this->render('affichage/chargement.html.twig');
    }

    /**
     * @Route("/tracaLot/{id}", name="tracabilitéLot")
     * @param Lot $lot;
     */
    public function tracaLot(LotRepository $repoR, Lot $lot)
    {
         $repoD= $this->getDoctrine()->getRepository(DetailLotRecu::class);
         $repoP= $this->getDoctrine()->getRepository(PlatPrepare::class);
         $repoF= $this->getDoctrine()->getRepository(Fournisseur::class);


        $id= $lot->getId();
        $idFour=$lot->getFournisseur();
        $fournisseur= $repoF->findFournisseurLot($id);

        $four= $repoF->findOneBy(['id'=>$idFour]);

        $lots= $repoR->findAll();
        $details= $repoD->findDetailLot($id);
        foreach($details as $det ){
           $nb=$repoP->findplat($det->getId());
         //$test=$repoP->findplat($det->getId());
          
        }

        
        dump($nb);
        return $this->render('gestion_stock/tracaLot.html.twig',[
                 'lot' =>$id,
                 'plats'=>$nb,
                 'fourni'=>$four
        ]);
    }


    }

