<?php

namespace App\Controller\Admin;

use App\Form\NiveauType;
use App\Entity\Enseignement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EnseignementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enseignement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Enseignement')
            ->setEntityLabelInPlural('Enseignements');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            CollectionField::new('niveaux')
                // ->useEntryCrudForm()
                ->setEntryType(NiveauType::class)
                ->setEntryIsComplex(),
        ];
    }
}
