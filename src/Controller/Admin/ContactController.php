<?php

namespace App\Controller\Admin;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/contact")
 */
class ContactController extends AbstractController
{

    /**
     * @Route("/", name="admin_contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()  && $form->isValid()) {
            $email = $form->get('email')->getData();
            $sujet = $form->get('sujet')->getData();
            $message = $form->get('message')->getData();

            $contactEmail = (new TemplatedEmail())
                ->from('contact@monsite.fr')
                ->to('contact@monsite.fr')
                ->subject($sujet)
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    'email_contact' => $email,
                    'sujet' => $sujet,
                    'message' => $message
                ]);


            $mailer->send($contactEmail);

            return $this->redirectToRoute('contact');
        }


        return $this->render('admin/admin_contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
