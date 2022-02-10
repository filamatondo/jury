<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Search\SearchUser;
use App\Entity\PhotoProfil;
use App\Form\SearchUserType;
use App\MesProfil\ProfilService;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin")
 */

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="admin_home")
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




    // public function delette(User $user): Response
    // {

    //     $em = $this->getDoctrine()->getUser();
    //     $em->remove($user);
    //     $em->flush();

    //     return $this->redirectToRoute("register");
    // }

}
