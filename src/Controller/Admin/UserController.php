<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\MesPhotos\Photo;
use App\Form\EditProfileType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/user"))
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="admin_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {


        return $this->render('admin/admin_user/index.html.twig', [
            // juste une return de User pour pouvoir modifier le mot de passe. 
            // voilà la raison de mon commentaire de la ligne
            // 'users' => $userRepository->findAll(),
        ]);
    }



    /** 
     * @Route("/profil/modifier", name="admin_user_profil_modifier")
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
            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/admin_user/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    /** 
     * @Route("pass/modifier", name="admin_user_pass_modifier")
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


        return $this->render('admin/admin_user/editpass.html.twig');
    }





    /**

     * @Route("/{id}", name="admin_user_delete", methods={"GET", "POST"})

     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }


        return $this->redirectToRoute('admin_home', [], Response::HTTP_SEE_OTHER);

        // return $this->render('registration/register.html.twig');     
    }




    /**
     * @Route("/photo/profil", name="admin_photo_profil", methods={"GET","POST"})
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

            return $this->redirectToRoute('admin_photo_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_user/photo_profil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/home/{id}", name="admin_home_profil")
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

            return $this->redirectToRoute('admin_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_user/profil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
