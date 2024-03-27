<?php

namespace App\Form;

use App\Entity\Pdf;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Validator\Constraints as Assert;

class PdfFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', VichFileType::class, [
                'label' => 'Fichier',
                'download_label' => 'Télécharger le fichier',
                'allow_delete' => $options['allow_delete'],
                'attr' => [
                    'accept' => 'application/pdf'
                ],
                'constraints' => [
                    new Assert\File(mimeTypes: 'application/pdf', mimeTypesMessage: "Ce fichier n'est pas un pdf valide."),
                ],
            ])
            ->add('titre', options:[
                'label' => 'Titre du pdf (facultatif)'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pdf::class,
            'allow_delete' => false,
        ]);
    }
}
