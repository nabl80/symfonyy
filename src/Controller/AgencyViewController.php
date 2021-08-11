<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Property;
use App\Repository\NewsRepository;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/aview')]
class AgencyViewController extends AbstractController
{

    #[IsGranted('ROLE_AGENCY')]
    #[Route('/', name: 'agency_view_index', methods: ['GET'])]
    public function list(NewsRepository $newsRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_AGENCY');
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

    #[Route('/properties/{id}', name: 'agency_view_property_news_read', methods: ['GET'])]
    public function show(Request $request, NewsRepository $newsRepository): Response
    {
        $url = $request->getPathInfo();
        $id = substr($url, -3);
        $news = $newsRepository->findBy(
            ['property' => $id]
        );
        return $this->render('agencyView/agency.view.property.show.news.html.twig', [
            'news' => $news
        ]);
    }

    #[
        Route('/news/{id}', name: 'agency_view_news_show', methods: ['GET'])]
    public function show2(News $news): Response
    {
        return $this->render('agencyView/agency.view.news.show.html.twig', [
            'news' => $news,
        ]);
    }

}
