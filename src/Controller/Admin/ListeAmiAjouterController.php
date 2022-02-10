<?php

namespace App\Controller;

use App\Entity\ListeAmiAjouter;
use App\Form\ListeAmiAjouterType;
use App\Repository\ListeAmiAjouterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/liste/ami/ajouter")
 */
class ListeAmiAjouterController extends AbstractController
{
    /**
     * @Route("/", name="liste_ami_ajouter_index", methods={"GET"})
     */
    public function index(ListeAmiAjouterRepository $listeAmiAjouterRepository): Response
    {
        return $this->render('liste_ami_ajouter/index.html.twig', [
            'liste_ami_ajouters' => $listeAmiAjouterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="liste_ami_ajouter_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $listeAmiAjouter = new ListeAmiAjouter();
        $form = $this->createForm(ListeAmiAjouterType::class, $listeAmiAjouter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($listeAmiAjouter);
            $entityManager->flush();

            return $this->redirectToRoute('liste_ami_ajouter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liste_ami_ajouter/new.html.twig', [
            'liste_ami_ajouter' => $listeAmiAjouter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="liste_ami_ajouter_show", methods={"GET"})
     */
    public function show(ListeAmiAjouter $listeAmiAjouter): Response
    {
        return $this->render('liste_ami_ajouter/show.html.twig', [
            'liste_ami_ajouter' => $listeAmiAjouter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="liste_ami_ajouter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ListeAmiAjouter $listeAmiAjouter): Response
    {
        $form = $this->createForm(ListeAmiAjouterType::class, $listeAmiAjouter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_ami_ajouter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liste_ami_ajouter/edit.html.twig', [
            'liste_ami_ajouter' => $listeAmiAjouter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="liste_ami_ajouter_delete", methods={"POST"})
     */
    public function delete(Request $request, ListeAmiAjouter $listeAmiAjouter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listeAmiAjouter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($listeAmiAjouter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('liste_ami_ajouter_index', [], Response::HTTP_SEE_OTHER);
    }
}
