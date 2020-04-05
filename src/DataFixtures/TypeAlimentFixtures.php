<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\TypeAliment;

class TypeAlimentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $type1 = new TypeAliment();
         $type1 ->setType("Agrumes");
         $manager->persist($type1);

         $type2 = new TypeAliment();
         $type2 ->setType("Légumes");
         $manager->persist($type2);

         $type3 = new TypeAliment();
         $type3 ->setType("Feculents");
         $manager->persist($type3);

         $type4 = new TypeAliment();
         $type4 ->setType("Fruits secs");
         $manager->persist($type4);

         $type5 = new TypeAliment();
         $type5 ->setType("Fruits frais");
         $manager->persist($type5);

        $manager->flush();
    }
}
