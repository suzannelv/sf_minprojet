<?php

namespace App\DataFixtures;

use App\Entity\Courses;
use App\Entity\Languages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const NB_COURSE = 20;
    private const NB_LANG =6 ;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $langs=[];
        for($i=0; $i<self::NB_LANG; $i++){
            $lang = new Languages();

            $lang->setName($faker->word());
            $manager->persist($lang);
            $langs[] = $lang;
        }

        for($i=0; $i<self::NB_COURSE; $i++){
            $course = new Courses();
            $course->setName($faker->words(3, true))
                   ->setDescription($faker->paragraphs(3, true))
                   ->setCoverImage($faker->imageUrl(360, 300, 'abstract', true, 'cats'))
                   ->setCreatedAt($faker->dateTimeBetween('-2 years'))
                   ->setLang($faker->randomElement($langs))
                   ->setIsFree($faker->boolean(80));
            $manager->persist($course);
        }

     
    

        $manager->flush();
    }
}
