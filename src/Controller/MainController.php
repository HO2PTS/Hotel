<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\ChambreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(SliderRepository $repo): Response
    {   
        
        $sliders = $repo->findAll();

        return $this->render('main/index.html.twig', [
            
            'sliders' => $sliders
        ]);
    }
    #[Route('/chambre', name:'chambre')]
    public function chambres(ChambreRepository $repo): Response
    {
        $chambres = $repo->findAll();
        return $this->render('main/chambre.html.twig', [
            'chambres' => $chambres
        ]);
    }

}
