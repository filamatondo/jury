<?php

namespace App\Controller;

use App\Entity\User;
use App\Search\SearchUser;
use App\Form\SearchUserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(UserRepository $userRepository, Request $request): Response
    {
         // là j'ai une instance de ma classe Searchuser, Elle me permet a remplir de filté mes recherche.
      $search = new SearchUser(); 

      $form = $this->createForm(SearchUserType::class, $search); 
      $form->handleRequest($request); 
       
       
         
            $users = $userRepository->findAllUserByFilter($search); 



        return $this->render('home/index.html.twig', [
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
     

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
    */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
