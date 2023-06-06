<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Plat;
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

         $plat1 = new Plat();
         $plat1->setLibelle("Pizza Bianca");
         $plat1->setDescription("Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.");
         $plat1->setPrix(14.00);
         $plat1->setImage("pizza-salmon.png");
         $plat1->setActive(true);
        
         $categorie1->addPlat($plat1);
    }
}
