<?php

namespace App\DataFixtures;
use App\Entity\TypeRecette;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeRecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $type1 = new TypeRecette();
         $type1 ->setLibelle("Entrée");
         $manager->persist($type1);

         $type2 = new TypeRecette();
         $type2 ->setLibelle("Plat");
         $manager->persist($type2);

         $type3 = new TypeRecette();
         $type3 ->setLibelle("Dessert");
         $manager->persist($type3);

        $manager->flush();
    }
}
