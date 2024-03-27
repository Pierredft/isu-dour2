<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisiteController extends AbstractController
{
    #[Route('/visite', name: 'app_visite')]
    public function index(VisiteRepository $visiteRepository, ImageRepository $imageRepository): Response
    {
        $visites = $visiteRepository->findAll();
        $images = $imageRepository->findAll();
        return $this->render('pages/visite/visite.html.twig', [
            'visites' => $visites,
            'images' => $images,
        ]);
    }
}
