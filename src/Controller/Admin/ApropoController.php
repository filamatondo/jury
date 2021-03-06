<?php

namespace App\Controller\Admin;

use App\Entity\Apropo;
use App\Form\ApropoType;
use App\MesApropos\AproposVideo;
use App\Repository\ApropoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/apropo")
 */
class ApropoController extends AbstractController
{
    /**

     * @Route("/", name="admin_apropo_index", methods={"GET"})
     * 
     */
    public function index(ApropoRepository $apropoRepository): Response
    {
        return $this->render('admin/admin_apropo/index.html.twig', [
            'apropos' => $apropoRepository->findAll(),
        ]);
    }

    /**

     * @Route("/new", name="admin_apropo_new", methods={"GET","POST"})

     */
    public function new(Request $request, AproposVideo $aproposVideo): Response
    {
        $apropo = new Apropo();
        $form = $this->createForm(ApropoType::class, $apropo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apropo->setVideos($this->getUser());
            $file = $form->get('paragraphe_upload')->getData();

            $aproposVideo->sauvegarderParagraphe($apropo, $file);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($apropo);
            $entityManager->flush();

            return $this->redirectToRoute('admin_apropo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_apropo/new.html.twig', [
            'apropo' => $apropo,
            'form' => $form,
        ]);
    }

    /**

     * @Route("/{id}", name="admin_apropo_show", methods={"GET"})

     */
    public function show(Apropo $apropo): Response
    {
        return $this->render('admin/admin_apropo/show.html.twig', [
            'apropo' => $apropo,
        ]);
    }

    /**

     * @Route("/{id}/edit", name="admin_apropo_edit", methods={"GET","POST"})

     */
    public function edit(Request $request, Apropo $apropo): Response
    {
        $form = $this->createForm(ApropoType::class, $apropo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_apropo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_apropo/edit.html.twig', [
            'apropo' => $apropo,
            'form' => $form,
        ]);
    }

    /**

     * @Route("/{id}", name="admin_apropo_delete", methods={"POST"})

     */
    public function delete(Request $request, Apropo $apropo): Response
    {
        if ($this->isCsrfTokenValid('delete' . $apropo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($apropo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_apropo_index', [], Response::HTTP_SEE_OTHER);
    }
}
