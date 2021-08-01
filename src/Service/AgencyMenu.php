<?php

namespace App\Service;

use App\Repository\AgencyMenuRepository;

class Meniu
{
    public function __construct(private AgencyMenuRepository $agencyMenuRepository)
    {
    }

    public function getMeniuList()
    {
        return $this->agencyMenuRepository->findAll();
    }
}
