<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextareaField::new('descriptionCourte'),
            TextareaField::new('descriptionLongue')->setMaxLength(20),
            TextField::new('photo'),
            MoneyField::new('prixJournalier')->setCurrency('EUR'),
            DateTimeField::new('dateEnregistrement')->setFormat('d/M/Y  à H:m:s')->hideOnForm()
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        //createEntity() est éxécutée lorsque je clique sur "add article"
        //elle permet d'éxécuter du code avant d'afficher la page du formulaire de création 
        // ici je vais définir une date de création 

        $chambre = new $entityFqcn; // ici, équivaut à new Article
     
        return $chambre ;
    }
    
}
