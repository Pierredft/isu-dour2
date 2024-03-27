<?php

namespace App\Controller;

use App\Repository\PdfRepository;
use App\Repository\ReglementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReglementController extends AbstractController
{
    #[Route('/reglement', name: 'app_reglement', methods: ['GET'])]
    public function index(ReglementRepository $reglementRepository): Response
    {
        $reglements = $reglementRepository->findAll();
        return $this->render('pages/reglement/reglement.html.twig', [
            'reglements' => $reglements,
        ]);
    }
}