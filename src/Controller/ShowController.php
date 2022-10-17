<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\ChambreRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowController extends AbstractController
{
    #[Route('/show/{id}', name: 'app_show')]
    public function chambre($id, ChambreRepository $repo, Request $globals, EntityManagerInterface $manager): Response
    {
        $chambre = $repo->find($id);
        return $this->render('show/index.html.twig', [
            'chambre' => $chambre
        ]);
    }
    // public function show($id, CommandeRepository $repo, Request $globals, EntityManagerInterface $manager, Chambre $chambre)  
    // {
    //     $vehicules = $repo->find($id);

    //     $commande = new Commande;
    //     $form = $this->createForm(CommandeType::class, $commande);

    //     $form->handleRequest($globals);
    //     if($form->isSubmitted() && $form->isValid())
    //     {
    //         $table = $globals->request->get("commande_post");
    //         $tableOrigin = $table["date_heure_depart"]['date'];
    //         $origin = $tableOrigin["year"] . "-" . $tableOrigin["month"] . "-" . $tableOrigin["day"];
    //         $origin = date_create($origin);
    //         $tableTarget = $table["date_heure_fin"]['date'];
    //         $target = $tableTarget["year"] . "-" . $tableTarget["month"] . "-" . $tableTarget["day"];
    //         $target = date_create($target);
    //         $commande->setDateEnregistrement(new \DateTime);
    //         $interval = date_diff($origin, $target);;
    //         $prix = $chambre->getPrixJournalier();
    //         $interval = ($interval->d) + ($interval->m) *30 + ($interval->y) *364 ;
    //         $prix = $prix * $interval;
    //         $commande->setPrixTotal($prix);
    //         // $commande->setIdVehicule($vehicule);
    //         // $commande->setIdMembre($this->getUser());
    //         $manager->persist($commande);
    //         $manager->flush();
    //         $this->addFlash("success", "Opération réalisé avec succès"); 

    //         return $this->redirectToRoute('app_agence', [
    //             'id' => $commande->getId(),
    //         ]);
    //     } 

    //     // find() permet de récupérer un article en fonction de son id

    //     return $this->renderForm('agence/show.html.twig', [
    //         'item' => $vehicules,
    //         'form' => $form
    //     ]);
    // }
    
}




// find() permet de récupérer un article en fonction de son id
