<?php

namespace App\Controller\Module_epargne\new_account;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AccountController extends AbstractController
{
    #[Route('/new/account', name: 'app_new_account_ep')]
    public function index(Request $request): Response
    {
       // dd("nouveau controller ");

       //Formulaire pour les client
       $form = $this->createFormBuilder()
       ->add('code', TextType::class,[
                'label' => 'code du client :',
                'required' => true,
            ])
        ->add('nom', TextType::class,[
                'label' => 'Nom du client :',
                'required' => true,
            ])
        ->add('prenom', TextType::class,[
                'label' => 'prenom du client :',
                'required' => true,
            ])

       ->add('valider', SubmitType::class,[
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-primary btn-sm'
            ]
       ])
       ->getForm();
       $form->handleRequest($request);

       /********Fiin de formulaire */
       if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $compte_epargne = $data['code'];
            $nom = $data['nom'];
            $prenom = $data['prenom'];

        return $this->redirectToRoute('app_compte_epargne_new', [
            'code' => $compte_epargne,
            'nom' => $nom,
            'prenom' => $prenom
        ], Response::HTTP_SEE_OTHER);
       }


        return $this->render('Module_epargne/compte_epargne/account/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/new/depot', name: 'app_new_depot')]
    public function depot(Request $request): Response
    {
       // dd("nouveau controller ");

       //Formulaire pour les client
       $form = $this->createFormBuilder()
       ->add('compte', TextType::class,[
                'label' => 'compte epargne :',
                'required' => true,
            ])
        ->add('nom', TextType::class,[
                'label' => 'Nom du client :',
                'required' => true,
            ])
        ->add('prenom', TextType::class,[
                'label' => 'prenom du client :',
                'required' => true,
            ])

       ->add('valider', SubmitType::class,[
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-primary btn-sm'
            ]
       ])
       ->getForm();
       $form->handleRequest($request);

       /********Fiin de formulaire */
       if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $compte_epargne = $data['code'];
            $nom = $data['nom'];
            $prenom = $data['prenom'];

        return $this->redirectToRoute('app_transaction_new', [
            'code' => $compte_epargne,
            'nom' => $nom,
            'prenom' => $prenom
        ], Response::HTTP_SEE_OTHER);
       }


        return $this->render('Module_epargne/compte_epargne/account/depot.html.twig',[
            'form' => $form->createView()
        ]);
    }

    
    #[Route('/new/retrait', name: 'app_new_retrait')]
    public function retrait(Request $request): Response
    {
       // dd("nouveau controller ");

       //Formulaire pour les client
       $form = $this->createFormBuilder()
       ->add('code', TextType::class,[
                'label' => 'code du client :',
                'required' => true,
            ])
        ->add('nom', TextType::class,[
                'label' => 'Nom du client :',
                'required' => true,
            ])
        ->add('prenom', TextType::class,[
                'label' => 'prenom du client :',
                'required' => true,
            ])

       ->add('valider', SubmitType::class,[
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-primary btn-sm'
            ]
       ])
       ->getForm();
       $form->handleRequest($request);

       /********Fiin de formulaire */
       if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $compte_epargne = $data['code'];
            $nom = $data['nom'];
            $prenom = $data['prenom'];

        return $this->redirectToRoute('app_transaction_retrait', [
            'code' => $compte_epargne,
            'nom' => $nom,
            'prenom' => $prenom
        ], Response::HTTP_SEE_OTHER);
       }


        return $this->render('Module_epargne/compte_epargne/account/retrait.html.twig',[
            'form' => $form->createView()
        ]);
    }

}