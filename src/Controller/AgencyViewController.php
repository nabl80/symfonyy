<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Property;
use App\Repository\NewsRepository;
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

    #[Route('/{id}', name: 'agency_view_show', methods: ['GET'])]
    public function show(News $news): Response
    {
        return $this->render('agencyView/agency.view.news.show.html.twig', [
            'news' => $news,
        ]);
    }

    #[Route('/properties', name: 'property_list', methods: ['GET'])]
    public function index(Property $property): Response
    {
        return $this->render('agencyView/agency.view.property.index.html.twig', [
            'property' => $property,
        ]);
    }

    public function indexAction(){
        $em = $this->get('doctrine')->getManager();
        $sections = $sections = $this->getDoctrine() ->getRepository('AppBundle:ForumSection') ->findAll();

        return $this->render('AppBundle:Default:index.html.twig', array('sections'=>$sections));
    }
}
