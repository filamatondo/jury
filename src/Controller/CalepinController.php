<?php

namespace App\Controller;

use App\Entity\Calepin;
use App\Form\CalepinType;
use App\Repository\CalepinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calepin")
 */
class CalepinController extends AbstractController
{
    /**
     * @Route("/", name="calepin_index", methods={"GET"})
     */
    public function index(CalepinRepository $calepinRepository): Response
    {
        return $this->render('calepin/index.html.twig', [
            'calepins' => $calepinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="calepin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $calepin = new Calepin();
        $form = $this->createForm(CalepinType::class, $calepin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($calepin);
            $entityManager->flush();

            return $this->redirectToRoute('calepin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calepin/new.html.twig', [
            'calepin' => $calepin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="calepin_show", methods={"GET"})
     */
    public function show(Calepin $calepin): Response
    {
        return $this->render('calepin/show.html.twig', [
            'calepin' => $calepin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="calepin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Calepin $calepin): Response
    {
        $form = $this->createForm(CalepinType::class, $calepin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calepin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calepin/edit.html.twig', [
            'calepin' => $calepin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="calepin_delete", methods={"POST"})
     */
    public function delete(Request $request, Calepin $calepin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calepin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($calepin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('calepin_index', [], Response::HTTP_SEE_OTHER);
    }
}
