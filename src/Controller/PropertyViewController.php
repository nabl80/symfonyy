<?php

namespace App\Controller;

use App\Entity\Agency;
use App\Entity\News;
use App\Entity\User;
use App\Form\NewsType;
use App\Repository\AgencyRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pview')]
class PropertyViewController extends AbstractController
{
    #[Route('/', name: 'property_view_news_index', methods: ['GET'])]
    public function list(NewsRepository $newsRepository): Response
    {
        return $this->render('propertyView/property.view.index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    #[Route('/news/create', name: 'property_news_create', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->store($news);

            return $this->redirectToRoute('property_view_news_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('propertyView/property.create.news.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/news/{id}', name: 'property_view_news_show', methods: ['GET'])]
    public function show(News $news): Response
    {
        return $this->render('propertyView/property.view.news.show.html.twig', [
            'news' => $news,
        ]);
    }


    #[Route('/agencies', name: 'property_view_agencies', methods: ['GET'])]
    public function index(AgencyRepository $agencyRepository): Response
    {
        return $this->render('propertyView/property.view.agency.index.html.twig', [
            'agencies' => $agencyRepository->findAll(),
        ]);
    }

    #[Route('/agencies/{id}', name: 'property_view_agency_id', methods: ['GET'])]
    public function show1(Agency $agency): Response
    {
        return $this->render('propertyView/property.view.agency.show.html.twig', [
            'agency' => $agency,

        ]);
    }

}
