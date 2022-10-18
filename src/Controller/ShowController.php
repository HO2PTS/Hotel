<?php

namespace App\Controller;

use DateTime;
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
    public function chambre($id, ChambreRepository $repo, Request $rq, EntityManagerInterface $manager, Commande $commande = null): Response
    {
        $chambre = $repo->find($id);
        $chambres = $repo->findAll();
        $commande = new Commande;
            
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($rq);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $commande->setDateEnregistrement(new DateTime);
            $commande->setIdChambre($chambre);
            $depart = $commande->getDateArrivee();
            
            if ($depart->diff($commande->getDateDepart())->invert == 1) {
                $this->addFlash('danger', 'Une période de temps ne peut pas être négative.');
                return $this->redirectToRoute('app_show', [
                    'id' => $chambre->getId()
                ]);
            }
            $jours = $depart->diff($commande->getDateDepart())->days;
            $prixTotal = ($commande->getIdChambre()->getPrixJournalier() * $jours) + $commande->getIdChambre()->getPrixJournalier();
            // récupère le prix total (sans la dernière addition, il manque un jour à payer)
            
            $commande->setPrixTotal($prixTotal);
            
            
            $manager->persist($commande);
            $manager->flush();
            $this->addFlash('success', 'Votre commande a bien été enregistrée !');
            return $this->redirectToRoute('app_main');
            }
            
        return $this->renderForm('show/index.html.twig', [
            'form' => $form,
            'chambre' => $chambre
        ]);
    }
}
       
