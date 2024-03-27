<?php

namespace App\Controller;

use App\Repository\AccesRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccesController extends AbstractController
{
    #[Route('/acces', name: 'app_acces', methods: ['GET'])]
    public function index(AccesRepository $accesRepository, ImageRepository $imageRepository): Response
    {
        $access = $accesRepository->findAll();
        $image = $imageRepository->findAll();
        return $this->render('pages/acces/acces.html.twig', [
            'access' => $access,
            'image' => $image
        ]);
    }
}
