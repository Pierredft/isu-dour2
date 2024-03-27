<?php

namespace App\Controller;

use App\Repository\InscriptionRepository;
use App\Repository\PdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(InscriptionRepository $inscriptionRepository): Response
    {
        $inscriptions = $inscriptionRepository->findAll();
        return $this->render('pages/inscription/inscription.html.twig', [
            'inscriptions' => $inscriptions,
        ]);
    }
}
