<?php

namespace App\Controller;

use App\Entity\Diaporama;
use App\Form\DiaporamaType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles_alea = $articleRepository->DonnéeesAleatoires();
        return $this->render('home/accueil.html.twig', compact('articles_alea'));
    }

    #[Route('/expositions', name: 'expositions')]
    public function exposition(): Response
    {
        return $this->render('home/exposition.html.twig');
    }

    #[Route('/liens', name: 'liens')]
    public function liens(): Response
    {
        return $this->render('home/liens.html.twig');
    }

    #[Route('/diaporama', name: 'diaporama')]
    public function diaporama(Request $request, EntityManagerInterface $em): Response
    {
        $sliders = new Diaporama;
        $form = $this->createForm(DiaporamaType::class, $sliders);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sliders);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('home/diaporama.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
