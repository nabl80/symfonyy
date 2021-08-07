<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Property;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\NewsRepository;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/everyone')]
class AdminVewController extends AbstractController
{
    #[Route('/', name: 'admin_view_users', methods: ['GET'])]
    public function list(UserRepository $userRepository): Response
    {
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

}

?>