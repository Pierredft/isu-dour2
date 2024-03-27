<?php

namespace App\Controller\Admin;

use App\Entity\Lien;
use App\Form\ImageFileType;
use App\Form\PdfFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LienCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lien::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Lien utile')
            ->setEntityLabelInPlural('Liens utiles');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('lien'),
            TextField::new('logo')->setFormType(ImageFileType::class)->setFormTypeOption('allow_delete', true),
            TextEditorField::new('description')
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
