<?php

namespace App\Controller\Admin;

use App\Form\PdfFileType;
use App\Entity\Inscription;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InscriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inscription::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Information inscriptions')
            ->setEntityLabelInPlural('Informations inscriptions');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextEditorField::new('texte')
                ->setTemplatePath('admin/text_editor.html.twig')
                ->setTrixEditorConfig([
                    'blockAttributes' => [
                        'default' => ['tagName' => 'p'],
                        'heading1' => ['tagName' => 'h2'],
                    ],
                ]),
            CollectionField::new('pdfs')->setEntryType(PdfFileType::class),
        ];
    }
}
