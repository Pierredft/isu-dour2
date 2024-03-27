<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Validator\Constraints as Assert;

class VideoFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', VichFileType::class, [
                'label' => false,
                'download_label' => 'Télécharger le fichier ',
                'allow_delete' => $options['allow_delete'],
                'attr' => [
                    'accept' => 'video/*'
                ],
                'constraints' => [
                    new Assert\File(mimeTypes: 'video/*', mimeTypesMessage: "Ce fichier n'est pas une vidéo valide."),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
            'allow_delete' => false,
        ]);
    }
}
