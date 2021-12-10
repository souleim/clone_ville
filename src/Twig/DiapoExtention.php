<?php

namespace App\Twig;

use App\Entity\Diaporama;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DiapoExtention extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('diapos', [$this, 'getDiapos'])
        ];
    }

    public function getDiapos()
    {
        return $this->em->getRepository(Diaporama::class)->findAll();
    }
}
