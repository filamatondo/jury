<?php

namespace App\Controller;

use App\Entity\Img;
use App\Form\ImgType;
use App\MesPhotos\Album;
use App\Repository\ImgRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\MesServicesProfil\ImageServiceProfil as MesServicesProfilImageServiceProfil;

/**
 * @Route("/img")
 */
class ImgController extends AbstractController
{
    /**
     * @Route("/", name="img_index", methods={"GET"})
     */
    public function index(ImgRepository $imgRepository): Response
    {
        return $this->render('img/index.html.twig', [
            'imgs' => $imgRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="img_new", methods={"GET","POST"})
     */
    public function new(Request $request, Album $album): Response
    {
        $img = new Img();
        $form = $this->createForm(ImgType::class, $img);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $img->setImga($this->getUser());
            $file = $form->get('vu_upload')->getData();

            $album->sauvegarderImage($img, $file);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($img);

            $entityManager->flush();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($img);
            $entityManager->flush();

            return $this->redirectToRoute('img_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('img/new.html.twig', [
            'img' => $img,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="img_show", methods={"GET"})
     */
    public function show(Img $img): Response
    {
        return $this->render('img/show.html.twig', [
            'img' => $img,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="img_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Img $img): Response
    {
        $form = $this->createForm(ImgType::class, $img);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('img_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('img/edit.html.twig', [
            'img' => $img,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="img_delete", methods={"POST"})
     */
    public function delete(Request $request, Img $img): Response
    {
        if ($this->isCsrfTokenValid('delete'.$img->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($img);
            $entityManager->flush();
        }

        return $this->redirectToRoute('img_index', [], Response::HTTP_SEE_OTHER);
    }
}
