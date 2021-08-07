<?php

namespace App\DataFixtures;

use App\Entity\Administrator;
use App\Entity\Property;
use App\Entity\User;
use ContainerUp8Lk0m\getTranslation_Dumper_ResService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();


        $administrator = new Administrator();
        $administrator->setName('Administrator');
        $administrator->setSurname('The First');

        $manager->persist($administrator);

        $user = new User();
        $user->setAdm($administrator);
        $user->setEmail('admin@admin.lt');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'slaptazodis'));
        $manager->persist($user);

        $administrator1 = new Administrator();
        $administrator1->setName($faker->firstName);
        $administrator1->setSurname($faker->lastName);
        $manager->persist($administrator1);

        $user1 = new User();
        $user1->setAdm($administrator1);
        $user1->setEmail(strtolower($faker->email));
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'slaptazodis1'));
        $manager->persist($user1);

        $manager->flush();


    }
}
