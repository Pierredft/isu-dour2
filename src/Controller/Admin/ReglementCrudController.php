<?php

namespace App\Controller\Admin;

use App\Entity\Reglement;
use App\Form\PdfFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReglementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reglement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Règlement')
            ->setEntityLabelInPlural('Règlements');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            CollectionField::new('pdfs')->setEntryType(PdfFileType::class),
        ];
    }
}
