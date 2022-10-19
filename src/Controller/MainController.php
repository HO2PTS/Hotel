<?php

namespace App\Controller;

use DateTime;
use App\Entity\Avis;
use App\Form\AvisType;
use App\Form\ContactType;
use App\Repository\AvisRepository;
use App\Repository\SliderRepository;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/carte', name:'carte')]
    public function carte()
    {
        return $this->render('main/cartes.html.twig') ;
    }
    #[Route('/spa', name:'spa')]
    public function spa()
    {
        return $this->render('main/spa.html.twig') ;
    }

    #[Route('/avis/filtre', name: 'avis_filtre')]
    #[Route('/avis', name: 'avis')]
    public function avis(AvisRepository $repo, Request $globals, EntityManagerInterface $manager, $categorie = null)
    {
        
        if($globals->request->get('categorie') != null){
            $categorie = $globals->request->get('categorie');
        };
        $filtre = $repo->findBy(["categorie" => $categorie]);

        $avis = $repo->findAll();

        $comment = new Avis();
        $form=$this->createForm(AvisType::class, $comment);
        $form->handleRequest($globals);

        if($form->isSubmitted() && $form->isValid())
        {
            $comment->setCreatedAt(new DateTime);
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute("avis",[
                'avis' => $avis,
                'form' => $form,
            ]);
        }
        return $this->renderForm('main/avis.html.twig',[
            'avis' => $avis,
            'form' => $form,
            'categorie' => $categorie,
            'filtre' => $filtre
        ]);
    }
    #[Route('/contact', name: 'contact')]
    public function contact(Request $globals, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ContactType::class);
        $form->handleRequest($globals);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->flush();
            $this->addFlash('success', "Le véhicule a bien été enregistré !");
            
            return $this->redirectToRoute('app_main');
        }
     return $this->renderForm('main/contact.html.twig', [

        'contact' => $form,
     ]);
    }

}
