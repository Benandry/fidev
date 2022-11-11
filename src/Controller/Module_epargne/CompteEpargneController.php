<?php

namespace App\Controller\Module_epargne;

use App\Entity\Agence;
use App\Entity\CompteEpargne;
use App\Entity\Individuelclient;
use App\Entity\ProduitEpargne;
use App\Form\CompteEpargneType;
use App\Form\CompteGroupeEpType;
use App\Form\FiltreCompteEpargneIndividuelType;
use App\Form\FiltreGroupeEpargneType;
use App\Repository\AgenceRepository;
use App\Repository\CompteEpargneRepository;
use App\Repository\IndividuelclientRepository;
use App\Repository\IndividuelRepository;
use App\Repository\ProduitEpargneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

        

#[Route('/compte/epargne')]
class CompteEpargneController extends AbstractController
{
    // choix

    #[Route('/Choix', name: 'app_choix_compte', methods: ['GET'])]
    public function Choix(): Response
    {

        return $this->render('Module_epargne/compte_epargne/choix_compte.html.twig');

    }

    // Liste individuel

    #[Route('/', name: 'app_compte_epargne_index', methods: ['GET','POST'])]
    public function index(Request $request,CompteEpargneRepository $compteEpargneRepository,ProduitEpargneRepository $produitEpargneRepository,AgenceRepository $agence,IndividuelclientRepository $codecompteepargne,ManagerRegistry $doctrine): Response
    {
        // Agence 
        $agenceRepo=$agence->findAll();
        $rapportdoc=$compteEpargneRepository->findAll();
        //    $trierGroupe=$groupeRepository->FiltreGroupe($date1,$date2);
       $trierEp=$this->createForm(FiltreCompteEpargneIndividuelType::class);
       $filtrerapportdate=$trierEp->handleRequest($request);
        
       $afiche_tab = false;
       if($trierEp->isSubmitted() && $trierEp->isValid()){
        $afiche_tab = true;
        $groupeRapport=$compteEpargneRepository->CompteEpargne(
            $filtrerapportdate->getData(),
            $filtrerapportdate->getData()
        );
       }

        // Appel des fonction CompteEpargne qui recupere tous les info sur le compte epargnes
        
       // $compteepargne=$compteEpargneRepository->CompteEpargne();
        
        // Solde

        return $this->renderForm('Module_epargne/compte_epargne/index.html.twig', [
            'agenceRepos' =>$agenceRepo,
            'compteepargne'=>$groupeRapport,
            'trierEp'=>$trierEp,
            'afficher' =>$afiche_tab
        ]);
    }

    
    // Liste Groupe
    
    #[Route('/ShowGroupe',name:'app_liste_groupe')]
    public function ListeGroupe(Request $request,CompteEpargneRepository $compteEpargneRepository,AgenceRepository $agenceRepository) : Response
    {
        $compteGroupe=$compteEpargneRepository->ListeGroupe();

       $trierGroupeEp=$this->createForm(FiltreGroupeEpargneType::class);
       $filtrerapportdate=$trierGroupeEp->handleRequest($request);

       if($trierGroupeEp->isSubmitted() && $trierGroupeEp->isValid()){
        
        $date1 = $filtrerapportdate->getData()['Date1'];
        $date2 = $filtrerapportdate->getData()['Date2'];

        $compteGroupe=$compteEpargneRepository->FiltreGroupeEpargne($date1,$date2);
       }

        return $this->renderForm('Module_epargne/compte_epargne/groupe.html.twig',[
            'compteGroupes'=>$compteGroupe,
            'agence'=>$agenceRepository->findAll(),
            'trierGroupeEp'=>$trierGroupeEp
        ]);
    }

    #[Route('/new', name: 'app_compte_epargne_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompteEpargneRepository $compteEpargneRepository): Response
    {
        // affichage du client du jour
        $comptedujour=$compteEpargneRepository->ClientNow();

        //dd($comptedujour);

        $compteEpargne = new CompteEpargne();
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
           # dd($data);
            $compteEpargneRepository->add($compteEpargne, true);

            $this->addFlash('success', "Ajout de nouveau compte epargne '".$compteEpargne->getCodeepargne()."' reussite!!");
            //return $this->redirectToRoute('app_compte_epargne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/compte_epargne/new.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
            'comptedujours'=>$comptedujour
        ]);
    }

    // Compte epargne pour groupe
    #[Route('/new/groupe', name: 'app_compte_epargne_new_groupe', methods: ['GET', 'POST'])]
    public function newgroupe(Request $request, CompteEpargneRepository $compteEpargneRepository): Response
    {
        $compteEpargne = new CompteEpargne();
        $form = $this->createForm(CompteGroupeEpType::class, $compteEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteEpargneRepository->add($compteEpargne, true);

            return $this->redirectToRoute('app_liste_groupe', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/compte_epargne/newcomptegroupe.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
        ]);
    }

    // Show individuel
    #[Route('/{id}', name: 'app_compte_epargne_show', methods: ['GET'])]
    public function show(CompteEpargneRepository $compteEpargneRepository,ManagerRegistry $doctrine,$id,AgenceRepository $agence): Response
    {
        $epargne=$doctrine->getRepository(CompteEpargne::class)->find($id);
        $client=$epargne->getCodeclient();
        $produit=$epargne->getProduit();

        // Agence
            $agenceRepos=$agence->findAll();
        // type produit
        $produits=$doctrine->getRepository(ProduitEpargne::class)->find($id);
        $type=$produit->getTypeEpargne();
        $config=$produits->getConfigProduit();
        // Solde
        $soldes=$compteEpargneRepository->Solde($id);
        return $this->render('Module_epargne/compte_epargne/show.html.twig', [
            'clients' => $client,
            'epargnes' => $epargne,
            'agences'=>$agenceRepos,
            'produits'=>$produit,
            'types'=>$type,
            'configs'=>$config,
            'solde'=>$soldes
        ]);
    }

    // Details groupe
    #[Route('/DetailesGroupe/{id}', name: 'app_compte_epargne_details_groupe', methods: ['GET'])]
    public function DetailsGroupe(CompteEpargneRepository $compteEpargneRepository,ManagerRegistry $doctrine,$id,AgenceRepository $agence): Response
    {
        $epargne=$doctrine->getRepository(CompteEpargne::class)->find($id);
        $Groupe=$epargne->getCodeGroupe();
        $produit=$epargne->getProduit();

        // Agence
            $agenceRepos=$agence->findAll();
        // type produit
        $produits=$doctrine->getRepository(ProduitEpargne::class)->find($id);
        $type=$produit->getTypeEpargne();
        // Solde
        $soldes=$compteEpargneRepository->Solde($id);
        return $this->render('Module_epargne/compte_epargne/showgroupe.html.twig', [
            'Groupes' => $Groupe,
            'epargnes' => $epargne,
            'agences'=>$agenceRepos,
            'produits'=>$produit,
            'types'=>$type,
            'solde'=>$soldes
        ]);
    }


    #[Route('/{id}/edit', name: 'app_compte_epargne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompteEpargne $compteEpargne, CompteEpargneRepository $compteEpargneRepository): Response
    {
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteEpargneRepository->add($compteEpargne, true);

            $this->addFlash('success', "Modification compte epargne '".$compteEpargne->getCodeepargne()."' reussite!!");
            //return $this->redirectToRoute('app_compte_epargne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/compte_epargne/edit.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_epargne_delete', methods: ['POST'])]
    public function delete(Request $request, CompteEpargne $compteEpargne, CompteEpargneRepository $compteEpargneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteEpargne->getId(), $request->request->get('_token'))) {
            $compteEpargneRepository->remove($compteEpargne, true);
        }

        return $this->redirectToRoute('app_compte_epargne_index', [], Response::HTTP_SEE_OTHER);
    }

              // Solde
              #[Route('/solde/{id}', name: 'app_solde')]
              public function Solde(ManagerRegistry $doctrine,$id,AgenceRepository $agence): Response
              { 
                  $compte=$doctrine->getRepository(CompteEpargne::class)->find($id);
                  $client=$compte->getCodeclient();
                  $produit=$compte->getProduit();
          
                          // Agence
                          $agenceRepos=$agence->findAll();
          
                          // type produit
                          $produits=$doctrine->getRepository(ProduitEpargne::class)->find($id);
                          $type=$produit->getTypeEpargne();        
          
                  return $this->render('Module_epargne/compte_epargne/solde.html.twig',[
                      'comptes'=>$compte,
                      'clients'=>$client,
                      'produits'=>$produit,
                      'types'=>$type,
                      'agences'=>$agenceRepos
                      ]
                      );
          
              }

        // // Cette fonction est pour le rapport
        
        // #[Route('/rapportsolde',name:'app_rapport_solde')]
        
        // public function soldeEp(CompteEpargneRepository $compteEpargneRepository):Response
        //     {
        //             $solderapport=$compteEpargneRepository->Solde();

        //             return $this->render('rapport/index.html.twig',[    
        //                 'rapportsolde'=>$solderapport,
        //             ]
        //         );
        //     }       
}
