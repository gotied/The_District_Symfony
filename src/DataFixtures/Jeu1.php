<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\Detail;
use App\Entity\Plat;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Jeu1 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Catégorie //
        $cat1 = new Categorie();
        $cat1->setLibelle("Pizza");
        $cat1->setImage("pizza_cat.jpg");
        $cat1->setActive(true);
        $manager->persist($cat1);


        $cat2 = new Categorie();
        $cat2->setLibelle("Burger");
        $cat2->setImage("burger_cat.jpg");
        $cat2->setActive(true);
        $manager->persist($cat2);

        $cat3 = new Categorie();
        $cat3->setLibelle("Pasta");
        $cat3->setImage("pasta_cat.jpg");
        $cat3->setActive(true);

        $manager->persist($cat3);

        $cat4 = new Categorie();
        $cat4->setLibelle("Wraps");
        $cat4->setImage("wrap_cat.jpg");
        $cat4->setActive(true);
        $manager->persist($cat4);

        $cat5 = new Categorie();
        $cat5->setLibelle("Sandwich");
        $cat5->setImage("sandwich_cat.jpg");
        $cat5->setActive(false);
        $manager->persist($cat5);

        $cat6 = new Categorie();
        $cat6->setLibelle("Asian Food");
        $cat6->setImage("asian_food_cat.jpg");
        $cat6->setActive(false);
        $manager->persist($cat6);

        $cat7 = new Categorie();
        $cat7->setLibelle("Salade");
        $cat7->setImage("salade_cat.jpg");
        $cat7->setActive(true);
        $manager->persist($cat7);

        $cat8 = new Categorie();
        $cat8->setLibelle("Veggie");
        $cat8->setImage("veggie_cat.jpg");
        $cat8->setActive(true);
        $manager->persist($cat8);

        // Plat //
        $plat1 = new Plat();
        $plat1->setLibelle("Pizza Bianca");
        $plat1->setDescription("Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.");
        $plat1->setPrix(14.00);
        $plat1->setImage("pizza-salmon.png");
        $plat1->setActive(true);
        $manager->persist($plat1);


        $plat2 = new Plat();
        $plat2->setLibelle("District Burger");
        $plat2->setDescription("Burger composé d’un bun’s du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits.");
        $plat2->setPrix(8.00);
        $plat2->setImage("hamburger.jpg");
        $plat2->setActive(true);
        $manager->persist($plat2);


        $plat3 = new Plat();
        $plat3->setLibelle("Cheeseburger");
        $plat3->setDescription("Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.");
        $plat3->setPrix(8.00);
        $plat3->setImage("cheesburger.jpg");
        $plat3->setActive(true);
        $manager->persist($plat3);


        $plat4 = new Plat();
        $plat4->setLibelle("Lasagnes");
        $plat4->setDescription("Découvrez notre recette des lasagnes, l'une des spécialités italiennes que tout le monde aime avec sa viande hachée et gratinée à l'emmental. Et bien sûr, une inoubliable béchamel à la noix de muscade.");
        $plat4->setPrix(12.00);
        $plat4->setImage("lasagnes_viande.jpg");
        $plat4->setActive(true);
        $manager->persist($plat4);


        $plat5 = new Plat();
        $plat5->setLibelle("Tagliatelles au saumon");
        $plat5->setDescription("Découvrez notre recette délicieuse de tagliatelles au saumon frais et à la crème qui qui vous assure un véritable régal !");
        $plat5->setPrix(12.00);
        $plat5->setImage("tagliatelles-saumon.jpg");
        $plat5->setActive(true);
        $manager->persist($plat5);


        $plat6 = new Plat();
        $plat6->setLibelle("Buffalo Chicken Wrap");
        $plat6->setDescription("Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.");
        $plat6->setPrix(5.00);
        $plat6->setImage("buffalo-chicken.jpg");
        $plat6->setActive(true);
        $manager->persist($plat6);


        $plat8 = new Plat();
        $plat8->setLibelle("Spaghetti aux légumes");
        $plat8->setDescription("Un plat de spaghetti au pesto de basilic et légumes poêlés, très parfumé et rapide");
        $plat8->setPrix(10.00);
        $plat8->setImage("spaghetti-legumes.jpg");
        $plat8->setActive(true);
        $manager->persist($plat8);


        $plat9 = new Plat();
        $plat9->setLibelle("Salade César");
        $plat9->setDescription("Une délicieuse salade Caesar (César) composée de filets de poulet grillés, de feuilles croquantes de salade romaine, de croutons à l'ail, de tomates cerise et surtout de sa fameuse sauce Caesar. Le tout agrémenté de copeaux de parmesan.");
        $plat9->setPrix(7.00);
        $plat9->setImage("cesar_salad.jpg");
        $plat9->setActive(true);
        $manager->persist($plat9);


        $plat10 = new Plat();
        $plat10->setLibelle("Pizza Margherita");
        $plat10->setDescription("Une authentique pizza margarita, un classique de la cuisine italienne! Une pâte faite maison, une sauce tomate fraîche, de la mozzarella Fior di latte, du basilic, origan, ail, sucre, sel & poivre...");
        $plat10->setPrix(14.00);
        $plat10->setImage("pizza-margherita.jpg");
        $plat10->setActive(true);
        $manager->persist($plat10);


        $plat11 = new Plat();
        $plat11->setLibelle("Courgettes farcies au quinoa et duxelles de champignons");
        $plat11->setDescription("Voici une recette équilibrée à base de courgettes, quinoa et champignons, 100% vegan et sans gluten!");
        $plat11->setPrix(8.00);
        $plat11->setImage("courgettes_farcies.jpg");
        $plat11->setActive(true);
        $manager->persist($plat11);


        $cat1->addPlat($plat1);
        $cat1->addPlat($plat10);

        $cat2->addPlat($plat2);
        $cat2->addPlat($plat3);

        $cat3->addPlat($plat4);
        $cat3->addPlat($plat5);
        $cat3->addPlat($plat8);

        $cat4->addPlat($plat6);

        $cat7->addPlat($plat9);

        $cat8->addPlat($plat11);

        // Commande //
        $commande1 = new Commande();
        $commande1->setDateCommande(new \DateTime('2020-11-30'));
        $commande1->setTotal(32.00);
        $commande1->setEtat(3);
        $manager->persist($commande1);


        $commande2 = new Commande();
        $commande2->setDateCommande(new \DateTime('2020-11-30'));
        $commande2->setTotal(28.00);
        $commande2->setEtat(3);
        $manager->persist($commande2);


        $commande3 = new Commande();
        $commande3->setDateCommande(new \DateTime('2021-05-04'));
        $commande3->setTotal(14.00);
        $commande3->setEtat(3);
        $manager->persist($commande3);

        $commande4 = new Commande();
        $commande4->setDateCommande(new \DateTime('2021-07-20'));
        $commande4->setTotal(5.00);
        $commande4->setEtat(3);
        $manager->persist($commande4);

        $commande5 = new Commande();
        $commande5->setDateCommande(new \DateTime('2021-07-20'));
        $commande5->setTotal(16.00);
        $commande5->setEtat(2);
        $manager->persist($commande5);

        $commande6 = new Commande();
        $commande6->setDateCommande(new \DateTime('2021-07-20'));
        $commande6->setTotal(14.00);
        $commande6->setEtat(1);
        $manager->persist($commande6);

        $commande7 = new Commande();
        $commande7->setDateCommande(new \DateTime('2021-07-20'));
        $commande7->setTotal(20.00);
        $commande7->setEtat(4);
        $manager->persist($commande7);

        $commande8 = new Commande();
        $commande8->setDateCommande(new \DateTime('2021-07-20'));
        $commande8->setTotal(48.00);
        $commande8->setEtat(3);
        $manager->persist($commande8);

        $commande9 = new Commande();
        $commande9->setDateCommande(new \DateTime('2022-06-15'));
        $commande9->setTotal(13);
        $commande9->setEtat(3);
        $manager->persist($commande9);

        $commande10 = new Commande();
        $commande10->setDateCommande(new \DateTime('2022-06-15'));
        $commande10->setTotal(7.00);
        $commande10->setEtat(3);
        $manager->persist($commande10);

        $commande11 = new Commande();
        $commande11->setDateCommande(New \DateTime('2022-05-11'));
        $commande11->setTotal(8.00);
        $commande11->setEtat(3);
        $manager->persist($commande11);

        // Détail //
        $detail1 = new Detail();
        $detail1->setQuantite(4);
        $detail1->setPlat($plat1);
        $manager->persist($detail1);

        $detail2 = new Detail();
        $detail2->setQuantite(2);
        $detail2->setPlat($plat2);
        $manager->persist($detail2);

        $detail3 = new Detail();
        $detail3->setQuantite(1);
        $detail3->setPlat($plat1);
        $manager->persist($detail3);

        $detail4 = new Detail();
        $detail4->setQuantite(1);
        $detail4->setPlat($plat6);
        $manager->persist($detail4);

        $detail5 = new Detail();
        $detail5->setQuantite(2);
        $detail5->setPlat($plat3);
        $manager->persist($detail5);

        $detail6 = new Detail();
        $detail6->setQuantite(1);
        $detail6->setPlat($plat10);
        $manager->persist($detail6);

        $detail7 = new Detail();
        $detail7->setQuantite(4);
        $detail7->setPlat($plat6);
        $manager->persist($detail7);

        $detail8 = new Detail();
        $detail8->setQuantite(4);
        $detail8->setPlat($plat4);
        $manager->persist($detail8);

        $detail9 = new Detail();
        $detail9->setQuantite(1);
        $detail9->setPlat($plat6);
        $manager->persist($detail9);

        $detail10 = new Detail();
        $detail10->setQuantite(1);
        $detail10->setPlat($plat2);
        $manager->persist($detail10);

        $detail11 = new Detail();
        $detail11->setQuantite(1);
        $detail11->setPlat($plat9);
        $manager->persist($detail11);

        $detail12 = new Detail();
        $detail12->setQuantite(1);
        $detail12->setPlat($plat11);
        $manager->persist($detail12);

        // Utilisateur //
        $user1 = new Utilisateur();
        $user1->setEmail("thom@gmail.com'");
        $user1->setPassword('$2y$10$TWHYciyjkxNSLb0HlHQ.d.TJc1DQfud4DRkD0Uiib5vPgzcwpdm4C');
        $user1->setNom("Gilchrist");
        $user1->setPrenom("Thomas");
        $user1->setTelephone("7410001450");
        $user1->setAdresse("1277 Sunburst Drive");
        $user1->setCp("60002");
        $user1->setVille("New-York");
        $user1->setRoles("ROLE_CLIENT");
        $manager->persist($user1);


        $user2 = new Utilisateur();
        $user2->setEmail("kelly@gmail.com");
        $user2->setPassword('$2y$10$mRSaaZD2csvdgepVJrmHeez8e8DKWnmtOUN1/0VPn5EkJpBvfTg5.');
        $user2->setNom("Dillard");
        $user2->setPrenom("Kelly");
        $user2->setTelephone("7896547800");
        $user2->setAdresse("308 Post Avenue");
        $user2->setCp("56000");
        $user2->setVille("Dallas");
        $user2->setRoles("ROLE_CLIENT");
        $manager->persist($user2);

        $user2 = new Utilisateur();
        $user2->setEmail("martha@gmail.com");
        $user2->setPassword('$2y$10$526gTtiiTb2Zq5yuLopWleWf/G4fdmqHRQrcO1t1EZChv44MqIXIe');
        $user2->setNom("Woods");
        $user2->setPrenom("Martha");
        $user2->setTelephone("78540001200");
        $user2->setAdresse("478 Avenue Street");
        $user2->setCp("696969");
        $user2->setVille("Mont-Cuq");
        $user2->setRoles("ROLE_CLIENT");
        $manager->persist($user2);

        $user3 = new Utilisateur();
        $user3->setEmail("charlie@gmail.com");
        $user3->setPassword('$2y$10$hZzBoXLkiK4LKQr8gdFeLuw7Ta/M/RH8jqtZqfsE5kR8RhBqBY.eW');
        $user3->setNom("Danger");
        $user3->setPrenom("Charlie");
        $user3->setTelephone("7458965550");
        $user3->setAdresse("3140 Bartlett Avenue");
        $user3->setCp("93000");
        $user3->setVille("Paris");
        $user3->setRoles("ROLE_CLIENT");
        $manager->persist($user3);

        $user4 = new Utilisateur();
        $user4->setEmail("hedley@gmail.com");
        $user4->setPassword('$2y$10$Vj6TfRvxTauSJ.8Rslqneu15AP0iIXe9jnPeOzyJdJUTl33bRkVu6');
        $user4->setNom("Hedley");
        $user4->setPrenom("Claudia");
        $user4->setTelephone("7451114400");
        $user4->setAdresse("1119 Kinney Street");
        $user4->setCp("76600");
        $user4->setVille("No-Where");
        $user4->setRoles("ROLE_CLIENT");
        $manager->persist($user4);

        $user5 = new Utilisateur();
        $user5->setEmail("venno@gmail.com");
        $user5->setPassword('$2y$10$AbRbj2qFxrW887rEAJMWAuggGdOPlq5IrsebxgyyZ6EknDvKRXPaq');
        $user5->setNom("Vargas");
        $user5->setPrenom("Vernon");
        $user5->setTelephone("7414744440");
        $user5->setAdresse("1234 Hazelwood Avenue");
        $user5->setCp("90100");
        $user5->setVille("HazelCity");
        $user5->setRoles("ROLE_CLIENT");
        $manager->persist($user5);

        $user6 = new Utilisateur();
        $user6->setEmail("carlos@gmail.com");
        $user6->setPassword('$2y$10$/u.8rJ/pO4piyujXqzEX6uDzs6awS9N0NqPnZuJ3GfUG8fFRQVaR.');
        $user6->setNom("Grayson");
        $user6->setPrenom("Carlos");
        $user6->setTelephone("7401456980");
        $user6->setAdresse("2969 Hartland Avenue");
        $user6->setCp("000000");
        $user6->setVille("ZombieLand");
        $user6->setRoles("ROLE_CLIENT");
        $manager->persist($user6);

        $user7 = new Utilisateur();
        $user7->setEmail("jonathan@gmail.com");
        $user7->setPassword('$2y$10$GA/.tL0ZbHf7qPOgMGcN3uGbUXtjp.UpWF8.XXc2aaxmp5bqYkf3e');
        $user7->setNom("Caudill");
        $user7->setPrenom("Jonathan");
        $user7->setTelephone("7410256996");
        $user7->setAdresse("1959 Limer Street");
        $user7->setCp("9591");
        $user7->setVille("Remil");
        $user7->setRoles("ROLE_CLIENT");
        $manager->persist($user7);

        /*$user8 = new Utilisateur();
        $user8->setEmail("");
        $user8->setPassword('');
        $user8->setNom("");
        $user8->setPrenom("");
        $user8->setTelephone("");
        $user8->setAdresse("");
        $user8->setCp("");
        $user8->setVille("");
        $user8->setRoles("");
        $manager->persist($user8);*/

        $commande1->addDetail($detail1);
        $commande2->addDetail($detail2);
        $commande3->addDetail($detail3);
        $commande4->addDetail($detail4);
        $commande5->addDetail($detail5);
        $commande6->addDetail($detail6);
        $commande7->addDetail($detail7);
        $commande8->addDetail($detail8);
        $commande9->addDetail($detail9);
        $commande9->addDetail($detail10);
        $commande10->addDetail($detail11);
        $commande11->addDetail($detail12);

        $user1->addCommande($commande2);
        $user2->addCommande($commande1);
        $user2->addCommande($commande9);
        $user3->addCommande($commande3);
        $user4->addCommande($commande4);
        $user4->addCommande($commande11);
        $user5->addCommande($commande5);
        $user5->addCommande($commande10);
        $user6->addCommande($commande6);
        $user6->addCommande($commande8);
        $user7->addCommande($commande7);
        

        $manager->flush();
    }
}
