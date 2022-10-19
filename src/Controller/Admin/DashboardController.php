<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Entity\Membre;
use App\Entity\Slider;
use App\Entity\Chambre;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ChambreCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{

    private $routeBuilder;

    public function __construct(AdminUrlGenerator $routebuilder)
    {
        $this->routeBuilder = $routebuilder;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->redirect($this->routeBuilder->setController(ChambreCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hotel');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('Redirection to website'),
            MenuItem::linkToRoute('Redirection', 'fa fa-home', 'app_main'),
            MenuItem::section('Chambre'), 
            MenuItem::linkToCrud('Chambre', 'fa fa-bed', Chambre::class),
            MenuItem::section('Membre'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', Membre::class),
            MenuItem::section('Commande'), 
            MenuItem::linkToCrud('Commande', 'fa fa-truck', Commande::class),
            MenuItem::section('Slider'), 
            MenuItem::linkToCrud('Slider', 'fa fa-image', Slider::class),
            MenuItem::section('Avis'), 
            MenuItem::linkToCrud('Avis', 'fa fa-pen', Avis::class)
        ]; 
    }
}
