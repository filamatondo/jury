<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\MesPhotos\Photo;
use App\Form\EditProfileType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user"))
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {


        return $this->render('user/index.html.twig', [
            // juste une return de User pour pouvoir modifier le mot de passe. 
            // voilà la raison de mon commentaire de la ligne
            // 'users' => $userRepository->findAll(),
        ]);
    }



    /** 
     * @Route("/profil/modifier", name="user_profil_modifier")
     */

    public function editProfile(Request $request)

    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    /** 
     * @Route("pass/modifier", name="user_pass_modifier")
     */

    public function editPass(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)

    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();


            //  on vérifie si les deux Mots de passe sont identiques pour cela, j'ai un if, ou un else.

            if ($request->request->get('pass') == $request->request->get('pass2')) {
                $user->setPassword($userPasswordEncoder->encodePassword($user, $request->get('pass')));
                //  un flush pour faire la mis ajour dans la base de donnée. 
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');
            } else {
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
            }
        }


        return $this->render('user/editpass.html.twig');
    }





    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_register', [], Response::HTTP_SEE_OTHER);
        // return $this->render('registration/register.html.twig');     
    }




    /**
     * @Route("/photo/profil", name="photo_profil", methods={"GET","POST"})
     */
    public function photoprofil(Request $request, Photo $photo): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('photoProfil_upload')->getData();

            $photo->sauvegarderphotoProfil($user, $file);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('photo_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/photo_profil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/home/{id}", name="home_profil")
     */
    public function photo(Request $request, Photo $photo, UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('photoProfil_upload')->getData();

            $photo->sauvegarderphotoProfil($user, $file);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/profil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/", name="supprimer_user_admin")
     */
    public function deleteUser(int $id, ManagerRegistry $managerRegistry, UserRepository $userRepository)
    {
        // récupérer l'utilisateur et les commentaires liés
        $user = $userRepository->find($id);
        $comments = $user->getComments();

        // récupération du gestionnaire
        $manager = $managerRegistry->getManager();

        // préparation de la suppression des commentaires
        foreach ($comments as $comment) {
            $manager->remove($content);
        }

        // préparation de la suppression de l'utilisateur
        $manager->remove($user);

        // suppression effective en base de données
        $manager->flush();

        // redirection
        $this->redirecToRoute('nom_de_la_route');
    }
}
