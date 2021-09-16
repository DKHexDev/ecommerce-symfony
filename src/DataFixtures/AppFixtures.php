<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        for ( $i = 0; $i <= 5; $i++)
        {
            $color = new Color;
            $color->setName($faker->colorName());
            $this->addReference('color-'.$i, $color);
            $manager->persist($color);
        }

        for ($i = 0; $i < 10; $i++)
        {
            $category = new Category();
            $category->setName($faker->sentence(3));
            $category->setSlug($faker->slug());
            $this->addReference('category-'.$i, $category);
            $manager->persist($category);
        }

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
            $product->setCategory($this->getReference('category-'.rand(0, 9)));
            $product->addColor($this->getReference('color-'.rand(0, 5)))
                    ->addColor($this->getReference('color-'.rand(0, 5)))
                    ->addColor($this->getReference('color-'.rand(0, 5)));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
