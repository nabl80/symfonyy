<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Property;
use App\Entity\User;
use App\Entity\Agency;
use App\Form\AgencyType;
use App\Form\UserType;
use App\Manager\AgencyManager;
use App\Repository\NewsRepository;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/admview')]
class AdminVewController extends AbstractController
{


    /**
     * AdminVewController constructor.
     */
    public function __construct(private AgencyManager $manager)
    {
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'admin_view_users', methods: ['GET'])]
    public function list(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('adminView/admin.view.user.index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/show/{id}', name: 'admin_view_user_show', methods: ['GET'])]
    public function show1(User $user): Response
    {
        return $this->render('adminView/admin.view.user.show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/show/{id}/edit', name: 'admin_view_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_view_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adminView/admin.view.user.edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/newuser', name: 'admin_add_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_view_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adminView/admin.view.user.new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/newagency', name: 'admin_add_new_agency', methods: ['GET', 'POST'])]
    public function addAgency(Request $request)
    {
        $agency = new Agency();
        $form = $this->createForm(AgencyType::class, $agency);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->store($agency);

            return $this->redirectToRoute('admin_view_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adminView/admin.add.agency.html.twig', [
            'agency' => $agency,
            'form' => $form,
        ]);
    }

    #[Route('/allnews', name: 'admin_view_all_news', methods: ['GET'])]
    public function list1(NewsRepository $newsRepository): Response
    {
        return $this->render('adminView/admin.view.news.index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    #[Route('/allnews/{id}', name: 'admin_news_delete', methods: ['POST'])]
    public function delete(Request $request, News $news): Response
    {
        if ($this->isCsrfTokenValid('delete' . $news->getId(), $request->request->get('_token'))) {
            $this->manager->delete($news);
        }

        return $this->redirectToRoute('admin_view_all_news', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/allnews/{id}/edit', name: 'admin_news_edit', methods: ['GET', 'POST'])]
    public function editNews(Request $request, News $news): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('property_view_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('propertyView/property.edit.news.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

}


?>