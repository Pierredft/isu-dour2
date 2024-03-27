<?php

namespace App\Form;

use App\Entity\Personnel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pronom', ChoiceType::class, [
                'choices'  => [
                    'M.' => 'M.',
                    'Mme' => 'Mme',
                    'Aucun' => '',
                ],
            ])
            ->add('nom')
            ->add('prenom')
            ->add('fonction')
            ->add('email')
            ->add('priorite', options: ['label' => 'Ordre de priorité']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
