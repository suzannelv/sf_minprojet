<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Language;
use App\Entity\Level;
use App\Entity\Tag;
use App\Entity\Teacher;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const NB_COURSE = 30;
    private const NB_LANG =6;
    private const NB_TEACHER = 10;
    private const NB_LEVEL = 3;
    private const NB_TAG = 6;

    public function __construct(   
        private string $adminEmail,
        private UserPasswordHasherInterface $hasher
    ) {
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        // user fixtures
        $regularUser = new User();
        $regularUser
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setPseudo('Robot')
            ->setProfileUser('/assets/img/user.png')
            ->setEmail('regular@lol.com')
            ->setPassword($this->hasher->hashPassword($regularUser, 'test'))
            ->setIsVerified(true);

        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setPseudo('Lucas')
            ->setProfileUser('/assets/img/admin.png')
            ->setEmail($this->adminEmail)
            ->setIsVerified(true)
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->hasher->hashPassword($adminUser,'admin'));

        $manager->persist($adminUser);

        // langue fixtures
        $langs=[];
        for($i=0; $i<self::NB_LANG; $i++){
            $lang = new Language();

            $lang->setName($faker->word());
            $manager->persist($lang);
            $langs[] = $lang;
        }
       // teacher fixture
        $teachers=[];
        for($i=0; $i<self::NB_TEACHER; $i++){
            $teacher= new Teacher();
            $teacher->setFirstname($faker->firstName())
                    ->setLastname($faker->lastName())
                    ->setProfile('https://img.freepik.com/photos-gratuite/heureuse-femme-francaise-satisfaite-apparence-attrayante-leve-pouce-lui-montre-son-appreciation-son-accord_273609-17132.jpg?w=1380&t=st=1702137927~exp=1702138527~hmac=b8b2e2bc304556fc76c30729ca6f7ae895a7830528f26f52f2dcddbaa30a97d0');
            $manager->persist($teacher);
            $teachers[] = $teacher;
        }

        // level fixture
        $levels=[];
        for($i=0; $i<self::NB_LEVEL; $i++) {
            $level = new Level();
            $level->setName($faker->word());
            $manager->persist($level);
            $levels[] = $level;
        }
        // tag fixtures
        $textColors = ['text-white', 'text-dark'];
        $bgColors = ['bg-warning', 'bg-secondary', 'bg-primary', 'bg-success'];
        $tags=[];
        for($i=0; $i<self::NB_TAG; $i++){
            $tag=new Tag();
            $tag->setName($faker->word())
                ->setBgColor($faker->randomElement($bgColors))
                ->setTextColor($faker->randomElement($textColors));

            $manager->persist($tag);
            $tags[] = $tag;

        }

 
        // course fixture
        for($i=0; $i<self::NB_COURSE; $i++){
            $course = new Course();
            $course->setName($faker->words(3, true))
                   ->setDescription($faker->paragraphs(3, true))
                   ->setCoverImage("https://img.freepik.com/photos-gratuite/portrait-femme-au-travail-ayant-appel-video_23-2148902316.jpg?w=1380&t=st=1702137630~exp=1702138230~hmac=a5d06d4681435f78353dc85a5952e40c67e7862e2705e90226b519c1896e49b3")
                   ->setCreatedAt($faker->dateTimeBetween('-2 years'))
                   ->setLang($faker->randomElement($langs))
                   ->setTeacher($faker->randomElement($teachers))
                   ->setLevel($faker->randomElement($levels))
                   ->setIsFree($faker->boolean(80));
                   
            $nbTags = $faker->numberBetween(0, 4);
            
            for ($j = 0; $j < $nbTags; $j++){
                $course->addTag($faker->randomElement($tags));
            }
            $manager->persist($course);
        }

        $manager->flush();
    }


}
