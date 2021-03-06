<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Liens;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $categorie = new Category();
        $categorie->setName("Catégorie 1");
        $manager->persist($categorie);

        $categorie = new Category();
        $categorie->setName("Catégorie TEST");
        $manager->persist($categorie);

        $article = new Article();
        $article->setTitle("Article 1");
        $article->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut viverra urna in nunc dapibus tincidunt et eu magna. Pellentesque venenatis varius orci sit amet condimentum. Quisque sit amet enim id nisl consectetur gravida. Curabitur efficitur felis rutrum ligula convallis convallis. Vestibulum eget dictum lorem. Vestibulum est justo, fermentum eu eleifend vestibulum, lacinia efficitur erat. Proin a ligula lorem. In iaculis dignissim sodales.");
        $article->setCategory($categorie);
        $manager->persist($article);

        $article = new Article();
        $article->setTitle("Article 2");
        $article->setContent("Morbi viverra facilisis aliquet. Phasellus suscipit arcu id felis tempor, in fringilla turpis dictum. Fusce porta finibus diam, vitae lacinia nibh finibus id. Donec facilisis nisl quis egestas sollicitudin. Aenean quis nulla est. Aliquam volutpat dolor eget ultricies maximus. Maecenas felis turpis, lacinia et purus in, viverra sagittis ex. Ut laoreet est sit amet ligula auctor, in venenatis magna interdum. Maecenas suscipit accumsan libero, auctor ullamcorper lectus porta semper.");
        $article->setCategory($categorie);
        $manager->persist($article);

        $article = new Article();
        $article->setTitle("Article 3 - TEST");
        $article->setContent("Ceci est un test.");
        $article->setCategory($categorie);
        $manager->persist($article);

        $liens = new Liens();
        $liens->setName("article");
        $liens->setPath("article_index");
        $liens->setSubLink(false);
        $manager->persist($liens);

        $liens = new Liens();
        $liens->setName("créer un article");
        $liens->setPath("article_new");
        $liens->setSubLink(true);
        $manager->persist($liens);

        $liens = new Liens();
        $liens->setName("catégorie");
        $liens->setPath("category_index");
        $liens->setSubLink(false);
        $manager->persist($liens);

        $liens = new Liens();
        $liens->setName("créer une catégorie");
        $liens->setPath("category_new");
        $liens->setSubLink(true);
        $manager->persist($liens);

        $liens = new Liens();
        $liens->setName("liste des liens");
        $liens->setPath("liens");
        $liens->setSubLink(false);
        $manager->persist($liens);

        $manager->flush();
    }
}
