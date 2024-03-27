<?php

namespace App\Controller\Admin;

use App\Entity\Visite;
use App\Form\ImageFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VisiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Visite::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Galerie d'image")
            ->setEntityLabelInPlural("Galeries d'image");
        }
        
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            CollectionField::new('images')
                ->setEntryType(ImageFileType::class)
        ];
    }
}
