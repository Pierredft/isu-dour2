<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use App\Form\PdfFileType;
use App\Form\ImageFileType;
use App\Form\CoursCategorieType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Formation')
            ->setEntityLabelInPlural('Formations');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextareaField::new('description'),
            TextField::new('logo')->setFormType(ImageFileType::class)->setFormTypeOption('allow_delete', true),
            AssociationField::new('niveau'),
            CollectionField::new('coursCategories')
                ->setEntryType(CoursCategorieType::class)
                ->setEntryIsComplex(),
            CollectionField::new('images')
                ->setEntryType(ImageFileType::class)
                ->setEntryIsComplex(),
            TextField::new('horraires')->setFormType(PdfFileType::class)->setFormTypeOptions([
                'allow_delete' => true,
                'label' => 'Grille horraire (facultatif)'
            ]),
        ];
    }
}
