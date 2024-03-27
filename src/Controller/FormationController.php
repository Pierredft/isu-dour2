<?php

namespace App\Controller;

use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    #[Route('/formation/{id}', name: 'app_formation_show')]
    public function show(Formation $formation): Response
    {
        return $this->render('pages/formation/index.html.twig', [
            'formation' => $formation,
        ]);
    }
}
