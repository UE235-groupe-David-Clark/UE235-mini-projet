<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Liens;
use App\Repository\LiensRepository;

// On appel la requête pour obtenir le numéro de page
use Symfony\Component\HttpFoundation\Request;

// On appel le bundle KNP Paginator
use Knp\Component\Pager\PaginatorInterface;



#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'article_index', methods: ['GET'])]
    public function index(
        LiensRepository $liensRepository, 
        // On ajoute en paramètre Request et PaginatorInterface
        Request $request,
        PaginatorInterface $paginatorInterface): Response
    {
        // On récupère les données en les triant en fonction de leur ID dans un odre ascendant
        $donnees = $this->getDoctrine()->getRepository(Article::class)->findBy([],['id' => 'asc']);

        /* 
            variable que l'on enverra sur la page des articles contenant toutes les informations utiles au bundle KNP Paginator :
              - les articles
              - le numéro de page à l'ouverture
              - le nb d'articles par page
        */
        $articles = $paginatorInterface->paginate(
            $donnees, // variable contenant les données à paginer
            $request->query->getInt('page', 1), // numéro de la page à l'ouverture de la page des articles
            2 // on définit le nombre d'articles par page
        );

        // 
        return $this->render('article/index.html.twig', [
            'articles' => $articles, // envoi de la variable $articles sur la page destinatrice
            'liens' => $liensRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, LiensRepository $liensRepository): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
            'liens' => $liensRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'article_show', methods: ['GET'])]
    public function show(Article $article, LiensRepository $liensRepository): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'liens' => $liensRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager, LiensRepository $liensRepository): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
            'liens' => $liensRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
    }

}

