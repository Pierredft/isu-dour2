<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NotreEcoleController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @return Response
     */
    #[Route('/notre-ecole', name: 'notre_ecole')]
    public function index(): Response
    {
        return $this->render('pages/notreEcole/notreEcole.html.twig');
    }
}
?>