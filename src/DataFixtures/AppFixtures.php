<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const NB_JOBS = 50;
    private const CATEGORIES = ['Developpement(web, mobile, logiciel)', 'Réseaux et sécurité', 'Bases de données', 'Intelligence artificielle et data science', 'Support technique'];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $categories = [];
        foreach (self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $categories[] = $category;
        }

        
        for ($i = 0; $i < self::NB_JOBS; $i++) {
            $job = new Job();
            $job->setTitle($faker->jobTitle)
                ->setDescription($faker->realText(200))
                ->setLocation($faker->city)
                ->setCreatedAt($faker->dateTimeThisYear)
                ->setCompany($faker->company)
                ->setCategory($faker->randomElement($categories)); // setCategory($faker->)

            $manager->persist($job);
        }

        $manager->flush();
    }
}
