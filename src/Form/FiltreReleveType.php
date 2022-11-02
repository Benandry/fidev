<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreReleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Codeclient',SearchType::class,[
                'attr'=>[
                    'placeholder'=>'Code client . . .'
                ],
                'label'=>'Code Client'
            ])
            ->add('NomClient',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Code client . . .'
                ],
                'label'=>'Nom Client',
                'disabled'=>true,
                ])
                ->add('PrenomClient',TextType::class,[
                    'attr'=>[
                        'placeholder'=>'Code client . . .'
                    ],
                    'label'=>'Prenom Client',
                    'disabled'=>true,
                        ])
            ->add('Du',DateType::class,[
                'widget'=>'single_text'
                ])
                ->add('Au',DateType::class,[
                    'widget'=>'single_text'
                ])
            ->add('Filtre',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
