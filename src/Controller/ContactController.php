<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Repository\PersonnelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Entity\Personnel;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ['GET'])]
    public function index(ContactRepository $contactRepository, PersonnelRepository $personnelRepository): Response
    {
        $contacts = $contactRepository->findAll();
        $personnels = $personnelRepository->findBy([], ['priorite' => 'ASC']);

        return $this->render('pages/contact/contact.html.twig', [
            'contacts' => $contacts,
            'personnels' => $personnels,
        ]);
    }
}
