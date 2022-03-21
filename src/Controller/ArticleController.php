<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\MesServices\ImageService;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET", "POST"})
     */
    public function index(ArticleRepository $articleRepository,  UserRepository $userRepository, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'user' => $user,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request, ImageService $imageService): Response

    {

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article->setAuteur($this->getUser());
            $file = $form->get('image_upload')->getData();

            $imageService->sauvegarderImage($article, $file);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($article);

            $entityManager->flush();





            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET", "POST"})
     */
    public function show(Article $article, Request $request, EntityManagerInterface $em, int $id): Response
    {

        $commentaire = new Commentaire();


        $form = $this->createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setArticle($article);
            $commentaire->setAuteur($this->getUser());

            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('article_show', ['id' => $id]);
        }



        return $this->render('article/show.html.twig', [
            'article' => $article,
            'form' => $form->createView()

        ]);
    }





    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article, ImageService $imageService): Response
    {
        $form = $this->createForm(ArticleType::class, $article);

        $ancienneImage = $article->getImage();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image_upload')->getData();


            if ($file) {
                $imageService->sauvegarderImage($article, $file);
            }



            $imageService->supprimerImage($ancienneImage);


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/article/{id}", name="article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article, ImageService $imageService): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {

            $imageService->supprimerImage($article->getImage());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/delete/commentaire/{id}", name="commentaire_delete", methods={"POST", "GET"})
     */
    public function delet(Request $request, Commentaire $commentaire): Response
    {
        if ($this->isCsrfTokenValid('delete' . $commentaire->getId(), $request->request->get('_token'))) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article/show.html.twig', [], Response::HTTP_SEE_OTHER);
    }
}
