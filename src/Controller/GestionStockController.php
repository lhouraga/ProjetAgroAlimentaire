<?php

namespace App\Controller;

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
}
