<?php

namespace App\Controller;

use App\Entity\Mention;
use App\Form\MentionType;
use App\Repository\MentionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mention")
 */
class MentionController extends AbstractController
{
    /**
     * @Route("/", name="mention_index", methods={"GET"})
     */
    public function index(MentionRepository $mentionRepository): Response
    {
        return $this->render('mention/index.html.twig', [
            'mentions' => $mentionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mention_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('mention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mention/new.html.twig', [
            'mention' => $mention,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="mention_show", methods={"GET"})
     */
    public function show(Mention $mention): Response
    {
        return $this->render('mention/show.html.twig', [
            'mention' => $mention,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mention_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mention $mention): Response
    {
        $form = $this->createForm(MentionType::class, $mention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mention/edit.html.twig', [
            'mention' => $mention,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="mention_delete", methods={"POST"})
     */
    public function delete(Request $request, Mention $mention): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mention->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mention_index', [], Response::HTTP_SEE_OTHER);
    }
}
