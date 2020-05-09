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
         $type4 ->setType("Produit Laitier");
         $manager->persist($type4);

         $type5 = new TypeAliment();
         $type5 ->setType("Poissonnerie");
         $manager->persist($type5);

         $type6 = new TypeAliment();
         $type6 ->setType("Boucherie");
         $manager->persist($type6);

         $type7 = new TypeAliment();
         $type7 ->setType("Soda");
         $manager->persist($type7);

         $type8 = new TypeAliment();
         $type8 ->setType("fruits");
         $manager->persist($type8);

         $type9 = new TypeAliment();
         $type9 ->setType("Friut sec");
         $manager->persist($type9);

        $manager->flush();
    }
}
