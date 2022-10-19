<?php

namespace App\Controller\Admin;

use App\Entity\Slider;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slider::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('photo'),
            IntegerField::new('ordre'),
            DateTimeField::new('dateEnregistrement')->setFormat('d/M/Y  à H:m:s')->hideOnForm(),
            AssociationField::new('chambre')->renderAsNativeWidget()
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        //createEntity() est éxécutée lorsque je clique sur "add article"
        //elle permet d'éxécuter du code avant d'afficher la page du formulaire de création 
        // ici je vais définir une date de création 

        $slider = new $entityFqcn; 
     
        return $slider ;
    }
}
