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
        $faker = Factory::create();
        $user1 = new User();
        $agency1 = new Agency();
        $firstName = 'Abra';
        $lastName = 'Kebabra';
        $email = strtolower($firstName . '.' . $lastName . '@' . $faker->domainName);
        $agency1->setName($firstName);
        $agency1->setSurname($lastName);
        $agency1->setCountry($faker->country);
        $agency1->setAgency($faker->company);
        $agency1->setWebsite($faker->url);
        $user1->setAgency($agency1);
        $user1->setEmail($email);
        $user1->setRoles(['ROLE_AGENCY']);
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'kebabas'));
        $manager->persist($agency1);
        $manager->persist($user1);

        for ($i = 0; $i < 35; ++$i) {
            $user = new User();
            $agency = new Agency();
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $email = strtolower($firstName . '.' . $lastName . '@' . $faker->domainName);
            $agency->setName($firstName);
            $agency->setSurname($lastName);
            $agency->setCountry($faker->country);
            $agency->setAgency($faker->company);
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
