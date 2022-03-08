<<<<<<< HEAD
<?php

namespace App\Controller;

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

}
=======
<?php

namespace App\Controller;

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

}
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
