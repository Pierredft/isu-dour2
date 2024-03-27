<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use App\Repository\PdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController extends AbstractController
{
    #[Route('/calendrier', name: 'app_calendrier', methods: ['GET'])]
    public function index(CalendrierRepository $calendrierRepository): Response
    {
        $calendriers = $calendrierRepository->findAll();
        return $this->render('pages/calendrier/calendrier.html.twig', [
            'calendriers' => $calendriers,
        ]);
    }
}
