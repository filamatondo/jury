<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EditProfileType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
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
      * @Route("user/profil/modifier", name="user_profil_modifier")
    */

       public function editProfile(Request $request)

    {         
             $user = $this->getUser(); 
             $form = $this->createForm(EditProfileType::class, $user); 

             $form->handleRequest($request); 

             if($form->isSubmitted() && $form->isValid()){
             $em = $this->getDoctrine()->getManager(); 
             $em->persist($user); 
             $em->flush(); 


             $this->addFlash('message', 'Profil mis à jour'); 
             return $this->redirectToRoute('user_index'); 
             
        }

            return $this->render('user/editprofile.html.twig' , [
                'form' => $form->createView(), 
            ]); 
    }




     /** 
      * @Route("user/pass/modifier", name="user_pass_modifier")
    */

    public function editPass(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)

    {     
         if($request->isMethod('POST')){
                 $em = $this->getDoctrine()->getManager(); 

                 $user = $this->getUser(); 


                //  on vérifie si les deux Mots de passe sont identiques pour cela, j'ai un if, ou un else.

                if($request->request->get('pass') == $request->request->get('pass2')){
                   $user->setPassword($userPasswordEncoder->encodePassword($user, $request->get('pass'))); 
                    //  un flush pour faire la mis ajour dans la base de donnée. 
                    $em->flush(); 
                    $this->addFlash('message' , 'Mot de passe mis à jour avec succès'); 

                } else{
                          $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques'); 
                }
        }


        return $this->render('user/editpass.html.twig');     
        
    }
       

    public function __toString() {
        return $this->nom;
      }

}
