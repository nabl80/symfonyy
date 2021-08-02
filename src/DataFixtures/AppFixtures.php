<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Agency;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; ++$i) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; ++$i) {
            $hashed = hash('sha512', $faker->password);
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $agency = new Agency();
            $agency->setName($firstName);
            $agency->setSurname($lastName);
            $agency->setEmail($firstName.'.'.$lastName.'@'.$faker->domainName);
            $agency->setCountry($faker->country);
            $agency->setAgency($faker->company);
            $agency->setWebsite($faker->url);
            $agency->setPassword($hashed);
            $agency->setRole('ROLE_AGENCY');
            $manager->persist($agency);
        }

        for ($i = 0; $i < 5; ++$i) {
            $hashed = hash('sha512', $faker->password);
            $contact = $faker->name;
            $property = new Property();
            $property->setName($faker->company);
            $property->setRole('ROLE_PROPERTY');
            $property->setEmail($faker->email);
            $property->setPassword($hashed);
            $property->setContactname($contact);
            $property->setContactemail($contact.'@'.$faker->domainName);
            $property->setPhone($faker->phoneNumber);
            $manager->persist($property);
        }

        $manager->flush();
    }
}
