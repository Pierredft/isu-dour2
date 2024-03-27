<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoireController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @return Response
     */
    #[Route('/histoire', name: 'histoire')]
    public function index(): Response
    {
        return $this->render('pages/histoire/histoire.html.twig');
    }
}
?>