<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\LienRepository;
use App\Repository\PdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LiensUtilesController extends AbstractController
{
    #[Route('/liens-utiles', name: 'app_liens_utiles')]
    public function index(LienRepository $lienRepository, ImageRepository $imageRepository): Response
    {
        $liensUtiles = $lienRepository->findAll();
        $images = $imageRepository->findAll();
        return $this->render('pages/liens_utiles/liens.html.twig', [
            'liensUtiles' => $liensUtiles,
            'images' => $images
        ]);
    }
}
