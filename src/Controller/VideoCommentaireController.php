<?php

namespace App\Controller;

use App\Entity\VideoCommentaire;
use App\Form\VideoCommentaireType;
use App\Repository\VideoCommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/video/commentaire")
 */
class VideoCommentaireController extends AbstractController
{
    /**
     * @Route("/", name="video_commentaire_index", methods={"GET"})
     */
    public function index(VideoCommentaireRepository $videoCommentaireRepository): Response
    {
        return $this->render('video_commentaire/index.html.twig', [
            'video_commentaires' => $videoCommentaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="video_commentaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $videoCommentaire = new VideoCommentaire();
        $form = $this->createForm(VideoCommentaireType::class, $videoCommentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($videoCommentaire);
            $entityManager->flush();

            return $this->redirectToRoute('video_commentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('video_commentaire/new.html.twig', [
            'video_commentaire' => $videoCommentaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="video_commentaire_show", methods={"GET"})
     */
    public function show(VideoCommentaire $videoCommentaire): Response
    {
        return $this->render('video_commentaire/show.html.twig', [
            'video_commentaire' => $videoCommentaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="video_commentaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, VideoCommentaire $videoCommentaire): Response
    {
        $form = $this->createForm(VideoCommentaireType::class, $videoCommentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('video_commentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('video_commentaire/edit.html.twig', [
            'video_commentaire' => $videoCommentaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="video_commentaire_delete", methods={"POST"})
     */
    public function delete(Request $request, VideoCommentaire $videoCommentaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$videoCommentaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($videoCommentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('video_commentaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
