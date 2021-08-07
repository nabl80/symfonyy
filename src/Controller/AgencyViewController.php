<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Property;
use App\Repository\NewsRepository;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/aview')]
class AgencyViewController extends AbstractController
{


    #[Route('/', name: 'agency_view_index', methods: ['GET'])]
    public function list(NewsRepository $newsRepository): Response
    {
        return $this->render('agencyView/agency.view.news.index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    #[Route('/properties', name: 'agency_view_property_list', methods: ['GET'])]
    public function index(PropertyRepository $propertyRepository): Response
    {
        return $this->render('agencyView/agency.view.property.list.html.twig', [
            'properties' => $propertyRepository->findAll(),
        ]);
    }

    #[Route('/properties/{id}', name: 'agency_view_property_show', methods: ['GET'])]
    public function show1(Property $property): Response
    {
        return $this->render('agencyView/agency.view.property.show.html.twig', [
            'property' => $property,
        ]);
    }

    #[Route('/news/{id}', name: 'agency_view_news_show', methods: ['GET'])]
    public function show(News $news): Response
    {
        return $this->render('agencyView/agency.view.news.show.html.twig', [
            'news' => $news,
        ]);
    }

}
