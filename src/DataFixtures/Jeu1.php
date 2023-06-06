<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Jeu1 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $categorie1 = new Categorie();
         $categorie1->setLibelle("Pizza");
         $categorie1->setImage("pizza_cat.jpg");
         $categorie1->setActive(true);

         $manager->persist($categorie1);

         $manager->flush();
    }
}
