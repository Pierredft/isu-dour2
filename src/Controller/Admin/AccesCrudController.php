<?php

namespace App\Controller\Admin;

use App\Entity\Acces;
use App\Form\ImageFileType;
use App\Form\PdfFileType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AccesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Acces::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('logo')->setFormType(ImageFileType::class)->setFormTypeOption('allow_delete', true),
            TextField::new('pdf')->setFormType(PdfFileType::class)->setFormTypeOption('allow_delete', true),
        ];
    }
}
