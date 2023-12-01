<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Language;
use App\Entity\Level;
use App\Entity\Teacher;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const NB_COURSE = 30;
    private const NB_LANG =6 ;
    private const NB_TEACHER = 10;
    private const NB_LEVEL = 3;
    public function __construct(
        private string $adminEmail
    ) {
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        $regularUser = new User();
        $regularUser
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setPseudo('Robot')
            ->setProfileUser('https://img.freepik.com/vecteurs-libre/portrait-chat-cravate-lunettes-hipster-regard-isole-illustration-vectorielle_1284-1931.jpg?w=1060&t=st=1701436610~exp=1701437210~hmac=ff1bfcdd72dfa77462889badfcf974e35b07f61641ef6f5069cc0ab7ad6b3f01')
            ->setEmail('regular@lol.com')
            ->setPassword('test')
            ->setIsVerified(true);

        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setPseudo('Lucas')
            ->setProfileUser('https://img.freepik.com/vecteurs-libre/portrait-chat-cravate-lunettes-hipster-regard-isole-illustration-vectorielle_1284-1931.jpg?w=1060&t=st=1701436610~exp=1701437210~hmac=ff1bfcdd72dfa77462889badfcf974e35b07f61641ef6f5069cc0ab7ad6b3f01')
            ->setEmail($this->adminEmail)
            ->setIsVerified(true)
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword('admin');

        $manager->persist($adminUser);

        
        $langs=[];
        for($i=0; $i<self::NB_LANG; $i++){
            $lang = new Language();

            $lang->setName($faker->word());
            $manager->persist($lang);
            $langs[] = $lang;
        }

        $teachers=[];
        for($i=0; $i<self::NB_TEACHER; $i++){
            $teacher= new Teacher();
            $teacher->setFirstname($faker->firstName())
                    ->setLastname($faker->lastName())
                    ->setProfile($faker->imageUrl(250,250));
            $manager->persist($teacher);
            $teachers[] = $teacher;
        }

        $levels=[];
        for($i=0; $i<self::NB_LEVEL; $i++) {
            $level = new Level();
            $level->setName($faker->word());
            $manager->persist($level);
            $levels[] = $level;
        }

        for($i=0; $i<self::NB_COURSE; $i++){
            $course = new Course();
            $course->setName($faker->words(3, true))
                   ->setDescription($faker->paragraphs(3, true))
                   ->setCoverImage($faker->imageUrl(360, 300, 'abstract', true, 'cats'))
                   ->setCreatedAt($faker->dateTimeBetween('-2 years'))
                   ->setLang($faker->randomElement($langs))
                   ->setTeacher($faker->randomElement($teachers))
                   ->setLevel($faker->randomElement($levels))
                   ->setIsFree($faker->boolean(80));
            $manager->persist($course);
        }

        $manager->flush();
    }
}
