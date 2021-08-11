<?php

namespace App\DataFixtures;


use App\Entity\Property;
use App\Entity\User;
use App\Entity\News;
use ContainerUp8Lk0m\getTranslation_Dumper_ResService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $user100 = new User();
        $property100 = new Property();
        $firstName = 'property';
        $lastName = 'property';
        $email = strtolower($firstName . '.' . $lastName . '@test.lt');
        $property100->setObject($faker->company);
        $property100->setContactName($firstName);
        $property100->setContactSurname($lastName);
        $property100->setContactEmail($email);
        $property100->setContactPhone($faker->phoneNumber);
        $user100->setProperty($property100);
        $user100->setEmail($email);
        $user100->setPassword($this->passwordHasher->hashPassword($user100, 'property'));
        $user100->setRoles(['ROLE_PROPERTY']);
        $manager->persist($property100);
        $manager->persist($user100);


        for ($i = 0; $i < 10; ++$i) {
            $user = new User();
            $property[$i] = new Property();
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $email = strtolower($firstName . '.' . $lastName . '@' . $faker->domainName);
            $property[$i]->setObject($faker->company);
            $property[$i]->setContactName($firstName);
            $property[$i]->setContactSurname($lastName);
            $property[$i]->setContactEmail($email);
            $property[$i]->setContactPhone($faker->phoneNumber);
            $user->setProperty($property[$i]);
            $user->setEmail($email);
            $user->setPassword($this->passwordHasher->hashPassword($user, $faker->password));
            $user->setRoles(['ROLE_PROPERTY']);
            $manager->persist($property[$i]);
            $manager->persist($user);
        }

        for ($y = 0; $y < 30; ++$y) {
            $randomNr = rand(0, $i - 1);
            $news = new News();
            $title = $faker->realText(40);
            $news->setDate($faker->dateTimeThisYear($max = 'now', $timezone = null));
            $news->setImage('https://source.unsplash.com/random/800x600');
            $news->setTitle($title);
            $news->setText($faker->realText(3000));
            $news->setProperty($property[$randomNr]);
            $manager->persist($news);


            $manager->flush();
        }
    }
}
