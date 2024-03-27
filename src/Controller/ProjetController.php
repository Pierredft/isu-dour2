<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'app_projet', methods: ['GET'])]
    public function index(ProjetRepository $projetRepository, ImageRepository $imageRepository): Response
    {
        $projets = $projetRepository->findAll();
        $images = $imageRepository->findAll();
        return $this->render('pages/projet/projet.html.twig', [
            'projets' => $projets,
            'images' => $images
        ]);
    }
}
