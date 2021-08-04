<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Agency;
use App\Entity\Property;
use App\Entity\News;
use App\Entity\Users;
use App\Entity\Person;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

      $fake1=$faker->company;
      $fake2=$faker->company;
      $fake3=$faker->company;
      $fake4=$faker->company;
      $fake5=$faker->company;

      $customFake=[$fake1, $fake2, $fake3, $fake4, $fake5];



        for ($i = 0; $i < 50; ++$i) {
//            $random_keys=array_rand($customFake);
            $hashed = hash('sha512', $faker->password);
            $contact = $faker->name;
            $property = new Property();
            $property->setObject($customFake[rand(0,4)]);
            $email = $faker->email;
            $property->setEmail($email);
            $property->setPassword($hashed);
            $property->setContactname($contact);
            $property->setContactemail(strtolower($contact . '@' . $faker->domainName));
            $property->setPhone($faker->phoneNumber);
            $property->setRole('Property');
            $manager->persist($property);
        }

        for ($i = 0; $i < 150; ++$i) {
            $agency = new Agency();
            $hashed = hash('sha512', $faker->password);
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $email = strtolower($firstName . '.' . $lastName . '@' . $faker->domainName);
            $agency->setName($firstName);
            $agency->setSurname($lastName);
            $agency->setEmail($email);
            $agency->setCountry($faker->country);
            $agency->setAgency($faker->company);
            $agency->setWebsite($faker->url);
            $agency->setPassword($hashed);
            $manager->persist($agency);

            $news = new News();
            $news->setDate($faker->dateTimeThisYear($max = 'now', $timezone = null));
            $news->setImage('https://source.unsplash.com/random/800x600');
            $news->setTitle($faker->domainWord);
            $news->setText($faker->realText(2000));
            $news->setProperty($property);
            $manager->persist($news);
            $manager->flush();
        }
    }

}
