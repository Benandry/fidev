<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Entity\ProduitEpargne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteGroupeEpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datedebut',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date inscription',
            ])
            ->add('typeClient',ChoiceType::class,[
                'choices'=>[
                    'GROUPE'=>'GROUPE',
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('codeclient',EntityType::class,[
                'class'=>Individuelclient::class,
                'choice_label'=>'nomClient',
                'by_reference'=>false,
                'label'=>false,
                'attr'=>[
                    'class'=>'hidden'
                ],
                'required'=>false,
            ])
            ->add('produit',EntityType::class,[
                'class'=>ProduitEpargne::class,
                'choice_label'=>'nomproduit',
                'by_reference'=>true,
                'placeholder'=>'Choisir produit . . .',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('codegroupe',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('codegroupeepargne',TextType::class,[
                'label'=>false
            ])
            
            ->add('Valider',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompteEpargne::class,
        ]);
    }
}
