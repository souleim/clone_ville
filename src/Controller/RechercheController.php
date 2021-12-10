<?php

namespace App\Controller;

use App\Form\SearchArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'recherche')]
    public function index(ArticleRepository $articleRepository, Request $request): Response
    {
        $articles = $articleRepository->findAll();
        $form = $this->createForm(SearchArticleType::class);
        $search = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // on recherche les articles correspondant aux mots clés
            $articles = $articleRepository->search($search->get('mots')
                ->getData());
        }

        return $this->render('recherche/recherche.html.twig', [
            'articles' => $articles,
            'form' => $form->createView()
        ]);
    }
}
