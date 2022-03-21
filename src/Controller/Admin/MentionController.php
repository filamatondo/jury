<?php

namespace App\Controller\Admin;

use App\Entity\Mention;
use App\Form\MentionType;
use App\Repository\MentionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/mention")
 */
class MentionController extends AbstractController
{
    /**
<<<<<<< HEAD
     * @Route("/", name="mention_index", methods={"GET"})
=======
     * @Route("/", name="admin_mention_index", methods={"GET"})
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
     */
    public function index(MentionRepository $mentionRepository): Response
    {
        return $this->render('admin/admin_mention/index.html.twig', [
            'mentions' => $mentionRepository->findAll(),
        ]);
    }

    /**
<<<<<<< HEAD
     * @Route("/new", name="mention_new", methods={"GET","POST"})
=======
     * @Route("/new", name="admin_mention_new", methods={"GET","POST"})
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
     */
    public function new(Request $request): Response
    {
        $mention = new Mention();
        $form = $this->createForm(MentionType::class, $mention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mention);
            $entityManager->flush();

            return $this->redirectToRoute('admin_mention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_mention/new.html.twig', [
            'mention' => $mention,
            'form' => $form,
        ]);
    }

    /**
<<<<<<< HEAD
     * @Route("/{id}", name="mention_show", methods={"GET"})
=======
     * @Route("/{id}", name="admin_mention_show", methods={"GET"})
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
     */
    public function show(Mention $mention): Response
    {
        return $this->render('admin/admin_mention/show.html.twig', [
            'mention' => $mention,
        ]);
    }

    /**
<<<<<<< HEAD
     * @Route("/{id}/edit", name="mention_edit", methods={"GET","POST"})
=======
     * @Route("/{id}/edit", name="admin_mention_edit", methods={"GET","POST"})
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
     */
    public function edit(Request $request, Mention $mention): Response
    {
        $form = $this->createForm(MentionType::class, $mention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_mention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_mention/edit.html.twig', [
            'mention' => $mention,
            'form' => $form,
        ]);
    }

    /**
<<<<<<< HEAD
     * @Route("/{id}", name="mention_delete", methods={"POST"})
=======
     * @Route("/{id}", name="admin_mention_delete", methods={"POST"})
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
     */
    public function delete(Request $request, Mention $mention): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mention->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_mention_index', [], Response::HTTP_SEE_OTHER);
    }
}
