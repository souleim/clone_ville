<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    // #[Route('/admin/article', name: 'admin_article')]
    // public function index(): Response
    // {
    //     return $this->render('admin/article/index.html.twig', [
    //         'controller_name' => 'ArticleController',
    //     ]);
    // }


    #[Route('/admin/article', name: 'admin_article')]
    public function article(ArticleRepository $articleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article;

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setCreatedat(new \DateTime());

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('admin/article/ajouter_article.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
