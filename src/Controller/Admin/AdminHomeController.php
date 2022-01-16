<?php

namespace App\Controller\Admin;

use App\Search\SearchUser;
use App\Form\SearchUserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin/home", name="admin_home", methods={"GET", "POST"})
     */
    public function index(UserRepository $userRepository, Request $request): Response
    {
        // là j'ai une instance de ma classe Searchuser, Elle me permet a remplir de filté mes recherche.
        $search = new SearchUser();

        $form = $this->createForm(SearchUserType::class, $search);
        $form->handleRequest($request);

        $users = $userRepository->findAllUserByFilter($search);


        return $this->render('admin/admin_home/index.html.twig', [
            'users' => $users,
            'form' => $form->createView()



        ]);
    }
}
