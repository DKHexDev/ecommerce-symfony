<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        for ($i = 0; $i < 100; $i++)
        {
            $product = new Product();
            $product->setName($faker->sentence(3));
            $product->setSlug($faker->slug());
            $product->setDescription($faker->text());
            $product->setPrice($faker->numberBetween(100, 2000));
            $product->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 days')));
            $product->setLiked($faker->boolean(25));
            $product->setImage(null);
            $product->setPromotion($faker->numberBetween(1, 70));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
