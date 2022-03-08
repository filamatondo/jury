<?php

namespace App\Controller\Admin;

use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */

class MessagesController extends AbstractController
{
    /**
     * @Route("/messages", name="admin_messages")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }

    /**
     * @Route("/send/{id}", name="admin_send",  methods={"GET", "POST"})
     */

    public function send(Request $request, UserRepository $userRepository, $id): Response
    {
        $message = new Messages;
        $form = $this->createForm(MessagesType::class, $message);

        // traitement du formulaire, il permet de recupere le formulaire et de le traiter, le " handleRequest".
        $form->handleRequest($request);


        // voir si le formulaire est envoyer avec  " un   if form"
        if ($form->isSubmitted() && $form->isValid()) {
            $message->setRecipient($userRepository->find($id));

            // l'expéditeur du message, je le rajouter dans le formulaire
            $message->setSender($this->getUser());

            // là je vais chercher le getManager pour pouvoir faire un persist, et envoyer dans la base de donneer
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            // une fois le message est envoyer et retourne à la page
            // d'accueil direct. et dire à sender que le message à bien été envoyer 

            $this->addFlash("message", "Message envoyer avec succès");
            return $this->redirectToRoute("admin_send", ["id" => $id]);
        }

        return $this->render("admin/admin_messages/send.html.twig", [
            "form" => $form->createView()

        ]);
    }

    // la route received me permet de voir les messages reçu.
    /**
     * @Route("/received", name="admin_received")
     */
    public function received(MessagesRepository $messagesRepository): Response
    {
        $messages = $messagesRepository->findBy([
            "recipient" => $this->getUser()
        ]);

        return $this->render('admin/admin_messages/received.html.twig', [
            "messages" => $messages
        ]);
    }




    // pour pouvoir lire les messages.
    /**
     * @Route("/read/{id}", name="admin_read")
     */
    public function read(Messages $message): Response
    {
        $message->setIsRead(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();

        return $this->render('admin/admin_messages/read.html.twig', compact("message"));
    }





    // la route de dellet.
    /**
     * @Route("/delete/{id}", name="admin_dellet")
     */
    public function delette(Messages $message): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();

        return $this->redirectToRoute("received");
    }


    // c'est une route qui me permet de consulter mes boite de messagerie
    /**
     * @Route("/sent", name="admin_sent")
     */
    public function sent(): Response
    {

        return $this->render('admin/admin_messages/sent.html.twig');
    }
}
