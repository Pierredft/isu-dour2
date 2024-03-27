<?php

namespace App\Controller\Admin;

use App\Entity\Niveau;
use App\Form\FormationType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NiveauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Niveau::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Niveau')
            ->setEntityLabelInPlural('Niveaux');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            AssociationField::new('enseignement'),
            CollectionField::new('formations')
                ->setEntryType(FormationType::class)
                ->setEntryIsComplex(),
        ];
    }
}
