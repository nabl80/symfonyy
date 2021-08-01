<?php

namespace App\Controller;

use App\Entity\Agency;
use App\Form\AgencyType;
use App\Repository\AgencyRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Manager\AgencyManager;

#[Route('/agency')]
class AgencyController extends AbstractController
{


    /**
     * AgencyController constructor.
     */
    public function __construct(private AgencyManager $manager)
    {
    }

    #[Route('/', name: 'agency_index', methods: ['GET'])]
    public function index(AgencyRepository $agencyRepository): Response
    {
        return $this->render('agency/index.html.twig', [
                        'agencies' => $agencyRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'agency_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $agency = new Agency();
        $form = $this->createForm(AgencyType::class, $agency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->store($agency);

            return $this->redirectToRoute('agency_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agency/new.html.twig', [
            'agency' => $agency,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'agency_show', methods: ['GET'])]
    public function show(Agency $agency): Response
    {
        return $this->render('agency/show.html.twig', [
            'agency' => $agency,
        ]);
    }

    #[Route('/{id}/edit', name: 'agency_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agency $agency): Response
    {
        $form = $this->createForm(AgencyType::class, $agency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agency_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agency/edit.html.twig', [
            'agency' => $agency,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'agency_delete', methods: ['POST'])]
    public function delete(Request $request, Agency $agency): Response
    {
        if ($this->isCsrfTokenValid('delete' . $agency->getId(), $request->request->get('_token'))) {
            $this->manager->delete($agency);
        }

        return $this->redirectToRoute('agency_index', [], Response::HTTP_SEE_OTHER);
    }

}
