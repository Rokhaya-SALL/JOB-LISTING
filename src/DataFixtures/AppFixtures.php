<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const NB_JOBS = 50; 

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        
        for ($i = 0; $i < self::NB_JOBS; $i++) {
            $job = new Job();
            $job->setTitle($faker->jobTitle)
                ->setDescription($faker->realText(200))
                ->setLocation($faker->city)
                ->setCreatedAt($faker->dateTimeThisYear)
                ->setCompany($faker->company);

            $manager->persist($job);
        }

        $manager->flush();
    }
}
