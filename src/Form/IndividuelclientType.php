<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Commune;
use App\Entity\Etatcivile;
use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Entity\Langue;
use App\Entity\Titre;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class IndividuelclientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo',FileType::class,[
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('nom_client',TextType::class,[
                'row_attr'=>[
                    'class'=>'text-editor',
                    'class'=>'md-1',
                    'width'=>'5',
                ],
                'label'=>'Nom',
            ])
            ->add('prenom_client',TextType::class,[
                'label'=>'Prenom',
            ])
            ->add('cin')
            ->add('nom_conjoint')
            ->add('date_inscription',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date Inscription',
            ])
            ->add('sexe',ChoiceType::class,[
                'choices'=>[
                    'Masculin'=>'Masculin',
                    'Feminin'=>'Feminin',
                ],
                'attr'=>['class'=>'form-control']
            ])
            ->add('date_naissance',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date de naissance',
            ])
            ->add('lieu_naissance')
            ->add('numero_mobile',TextType::class,[
                'label'=>'Numero telephone',
            ])
            ->add('profession')
            ->add('adressephysique',TextType::class,[
                'label'=>'Adresse physique',
            ])
            ->add('Idadresse',EntityType::class,[
                'class'=>Commune::class,
                'mapped'=>true,
                'label'=>'Commune',
                'multiple'=>false,
                'choice_label'=>'NomCommune',
                'by_reference'=>true,
                'attr'=>['class'=>'form-control']
            ])
            ->add('etatcivile',EntityType::class,[
                'class'=>Etatcivile::class,
                'choice_label'=>'etatcivile',
                'by_reference'=>true,
                'label'=>'Etat civile',
                'mapped' => true,
                'attr'=>['class'=>'form-control']
            ])
            ->add('etude',EntityType::class,[
                'class'=>Etude::class,
                'choice_label'=>'niveau',
                'by_reference'=>true,
                'mapped' => true,
                'attr'=>['class'=>'form-control']
            ])
            ->add('titre',EntityType::class,[
                'class'=>Titre::class,
                'choice_label'=>'titre',
                'by_reference'=>true,
                'mapped' => true,
                'attr'=>['class'=>'form-control']
            ])
            ->add('nb_enfant',IntegerType::class,[
                'label'=>'Nombre enfant',
            ])
            ->add('nb_personne_charge',IntegerType::class,[
                'label'=>'Nombre de personne en charge',
            ])
            ->add('parent_nom',TextType::class,[
                'label'=>'Nom parent',
            ])
            ->add('parent_adresse',TextType::class,[
                'label'=>'Parent adresse',
            ])
            ->add('MembreGroupe',EntityType::class,[
                'class'=>Groupe::class,
                'choice_label'=>'nomGroupe',
                'required'=>false,
                'by_reference'=>true,
                'mapped'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Membre du groupe'
            ])
            ->add('TitreGroupe',ChoiceType::class,[
                'label'=>'Titre Groupe',
                'required'=>false,
                'choices'=>[
                    ''=>'',
                    'President'=>'President',
                    'Secretaire'=>'Secretaire',
                    'Membre'=>'Membre'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('dateadhesion',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Au',
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('lieudelivrance',TextType::class,[
                'label'=>'Lieu'
            ])
            ->add('datecin',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date de delivrance'
            ])
            ->add('dateexpiration',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date expiration'
            ])
            ->add('TypeIdentite',ChoiceType::class,[
                'choices'=>[
                    'CIN'=>'CIN',
                    'Passeport'=>'Passeport'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('codeclient',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('Agence',EntityType::class,[
                'class'=>Agence::class,
                'choice_label'=>'NomAgence',
                'by_reference'=>true,
                'mapped'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => "Nom Agence"
            ])  
            
            ->add('Sauvegarder',SubmitType::class,[
                'attr'=>[
                    'length'=>'500px',
                    'class'=>'btn btn-success',
                ]
            ])        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Individuelclient::class,
        ]);
    }
}
