<?php 

namespace App\Controller;

use App\Repository\AccueilRepository;
use App\Repository\ActualiteRepository;
use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @return Response
     */
    #[Route('/','home.index', methods: ['GET'])]
    public function index(ImageRepository $imageRepository, VideoRepository $videoRepository,AccueilRepository $accueilRepository): Response
    {
        $images = $imageRepository->findAll();
        $videos = $videoRepository->findAll();
        $accueil = $accueilRepository->findOneBy([]);
        
        return $this->render("home.html.twig",[
            'images' => $images,
            'videos' => $videos,
            'accueil' => $accueil,
        ]);
    }
}
?>