<?php

namespace App\Controller;

use App\Entity\CommentaireVideo;
use App\Form\CommentaireVideoType;
use App\Repository\CommentaireVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire/video")
 */
class CommentaireVideoController extends AbstractController
{
    /**
     * @Route("/", name="commentaire_video_index", methods={"GET"})
     */
    public function index(CommentaireVideoRepository $commentaireVideoRepository): Response
    {
        return $this->render('commentaire_video/index.html.twig', [
            'commentaire_videos' => $commentaireVideoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commentaire_video_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentaireVideo = new CommentaireVideo();
        $form = $this->createForm(CommentaireVideoType::class, $commentaireVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaireVideo);
            $entityManager->flush();

            return $this->redirectToRoute('commentaire_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire_video/new.html.twig', [
            'commentaire_video' => $commentaireVideo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_video_show", methods={"GET"})
     */
    public function show(CommentaireVideo $commentaireVideo): Response
    {
        return $this->render('commentaire_video/show.html.twig', [
            'commentaire_video' => $commentaireVideo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commentaire_video_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommentaireVideo $commentaireVideo): Response
    {
        $form = $this->createForm(CommentaireVideoType::class, $commentaireVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentaire_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire_video/edit.html.twig', [
            'commentaire_video' => $commentaireVideo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_video_delete", methods={"POST"})
     */
    public function delete(Request $request, CommentaireVideo $commentaireVideo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaireVideo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaireVideo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentaire_video_index', [], Response::HTTP_SEE_OTHER);
    }
}
