<?php

namespace App\Controller;

use App\Entity\Enseignement;
use Symfony\UX\Turbo\TurboBundle;
use App\Repository\EnseignementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EnseignementsController extends AbstractController
{
    #[Route('/enseignements', name: 'app_enseignements')]
    public function index(Request $request, EnseignementRepository $enseignementRepository): Response
    {
        $enseignement = $enseignementRepository->findOneBy([]);
        return $this->show($request, $enseignement, $enseignementRepository);
    }

    #[Route('/enseignements/{id}', name: 'app_enseignements_show')]
    public function show(Request $request, ?Enseignement $enseignement, EnseignementRepository $enseignementRepository): Response
    {
        if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
            // If the request comes from Turbo, set the content type as text/vnd.turbo-stream.html and only send the HTML to update
            $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
            return $this->render('pages/enseignements/enseignement_stream.html.twig', ['enseignement' => $enseignement]);
        }
        return $this->render('pages/enseignements/index.html.twig', [
            'enseignement' => $enseignement,
            'enseignements' => $enseignementRepository->findAll(),
        ]);
    }
}
