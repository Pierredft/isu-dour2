<?php

namespace App\Controller\Admin;

use App\Form\PdfFileType;
use App\Entity\Calendrier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CalendrierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Calendrier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Calendrier')
            ->setEntityLabelInPlural('Calendriers');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('pdf')->setFormType(PdfFileType::class)->setFormTypeOption('allow_delete', true),
        ];
    }
}
