<?php

namespace App\Manager;

use App\Entity\Agency;
use Doctrine\ORM\EntityManagerInterface;


class AgencyManager
{
    public function __construct(private EntityManagerInterface $em)
    {

    }

    public function store(Agency $agency): void
    {
        $this->em->persist($agency);
        $this->em->flush();
    }

    public function delete(Agency $agency)
    {
        $this->em->remove($agency);
        $this->em->flush();
    }

    public function save(Agency $agency):void
    {
        $this->em->persist($agency);
    }

    public function getOneByName(string $name):Agency
    {
        $entityManager = $this->em;
        $repository = $entityManager->getRepository(Agency::class);
        $agency= $repository->findOneBy(['name' => $name]);

        return $agency;
    }
}