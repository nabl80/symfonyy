<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Agency;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AgencyFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < 5; ++$i) {
            $user = new User();
            $agency = new Agency();
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $email = strtolower($firstName . '.' . $lastName . '@' . $faker->domainName);
            $agency->setName($firstName);
            $agency->setSurname($lastName);
            $agency->setCountry($faker->country);
            $agency->setAgency($faker->company);
//            $agency->setWebsite($faker->url);
            $agency->setWebsite($faker->url);
            $user->setAgency($agency);
            $user->setEmail($email);
            $user->setRoles(['ROLE_AGENCY']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $faker->password));
            $manager->persist($agency);
            $manager->persist($user);

            $manager->flush();

        }
    }
}
