<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Fournisseur;

class FournisseurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i<10;$i++){
         $fournisseur = new Fournisseur();
         $fournisseur ->setSociete("GRAND FRAIS $i");
         $fournisseur ->setTelephone("07 88 25 92 0$i");
         $fournisseur ->setAdresse("PARIS $i");
         $fournisseur ->setCodePostal($i);
         $fournisseur ->setVille(" TURIN $i");
           
        
        
        $manager->persist($fournisseur);
        }

        $manager->flush();
    }
}
