<?php

namespace App\Manager;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;


class NewsManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function store(News $news): void
    {
        $this->em->persist($news);
        $this->em->flush();
    }

    public function delete(News $news)
    {
        $this->em->remove($news);
        $this->em->flush();
    }

    public function save(News $news): void
    {
        $this->em->persist($news);
    }

    public function getOneByName(string $name): News
    {
        $entityManager = $this->em;
        $repository = $entityManager->getRepository(News::class);
        $news = $repository->findOneBy(['name' => $name]);

        return $news;
    }
}