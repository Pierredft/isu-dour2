<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('logo', ImageFileType::class, [
                'allow_delete' => true,
            ])
            ->add('coursCategories', CollectionType::class, [
                'entry_type' => CoursCategorieType::class,
                'by_reference' => false,
                'allow_delete' => true,
                'allow_add' => true,
                'prototype_name' => 'CoursCategorie',
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageFileType::class,
                'by_reference' => false,
                'allow_delete' => true,
                'allow_add' => true,
                'prototype_name' => 'Image',
            ])
            ->add('horraires', PdfFileType::class, [
                'label' => 'Grille horraire (facultatif)',
                'allow_delete' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
