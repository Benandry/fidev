<?php

namespace App\Controller\Module_client;

use App\Form\FiltreRapportGroupeType;
use App\Form\TrierRapportClientType;
use App\Repository\AgenceRepository;
use App\Repository\GroupeRepository;
use App\Repository\IndividuelclientRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\FiltreRapportMembreType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RapportclientController extends AbstractController
{
    #[Route('/rapportclient', name: 'app_rapportclient')]
    public function index(Request $request,IndividuelclientRepository $individuelclients,AgenceRepository $agence): Response
    {
       $clientRapport=$individuelclients->findAll();

       $trier=$this->createForm(TrierRapportClientType::class);
       $filtrerapportdate=$trier->handleRequest($request);

       $affiche_tab = false ;

       if($trier->isSubmitted() && $trier->isValid()){
            $affiche_tab = true;
            $data = $filtrerapportdate->getData();

            $one_date = $data['search_one_date'];

            if ($one_date != null) {
                $clientRapport = $individuelclients->trierRapportClientPar_une_date($one_date);
               # dd($clientRapport);
            }else {
                $date_debut = $data['date1'];
                $date_fin = $data['date2'];
                $clientRapport=$individuelclients->trierRapportClient($date_debut,$date_fin);
                
            }

        }
        #dd($affiche_tab);
        return $this->renderForm('Module_client/rapportclient/index.html.twig', [
            'individuel' => $clientRapport,
            'agences'=>$agence->findAll(),
            'trier'=>$trier,
            'affiche_tab' => $affiche_tab
        ]);
    }

     // Rapport membre groupe
     #[Route('/RapportMembre', name: 'app_rapport_membre_groupe_index', methods: ['GET','POST'])]
     public function RapportMembre(Request $request,AgenceRepository $agenceRepository,GroupeRepository $groupeRepository)
     {
         $rapportMembre=$groupeRepository->RapportMembre();
 
         $form=$this->createForm(FiltreRapportMembreType::class);
         $rapportmembregroupe=$form->handleRequest($request);
         $affiche_tab = false;
         if($form->isSubmitted() && $form->isValid()){
             $data = $rapportmembregroupe->getData();
             $affiche_tab = true;
             $one_date = $data['search_on_date'];
             if ($one_date != null) {
                $rapportMembre = $groupeRepository->filtreByOneDate($one_date);
                #dd($rappport_groupe_par_un_date);
             } else {
                $rapportMembre=$groupeRepository->FiltreMembre(
                    $rapportmembregroupe->get('Du')->getData(),
                    $rapportmembregroupe->get('Du')->getData()
                );
             }
             
         }
 
         return $this->renderForm('Module_client/rapport_groupe/RapportMembre.html.twig',[
         'rapportMembre'=>$rapportMembre,
         'agence'=>$agenceRepository->findAll(),
         'form'=>$form,
         'affiche_tab' => $affiche_tab,
         ]
     );
     }


    //Cette fonctin permet de faire des trie en groupe
    #[Route('/rapportgroupe', name: 'app_rapportgroupe')]
    public function RapportGroupeTrier(Request $request,GroupeRepository $groupeRepository,AgenceRepository $agence): Response
    {
       #$groupeRapport=$groupeRepository->findAll();
       $groupeRapport = $groupeRepository->findByNumberClienByGroupe();

       $affiche_tab = false ;
    //    $trierGroupe=$groupeRepository->FiltreGroupe($date1,$date2);
       $trierGroupe=$this->createForm(FiltreRapportGroupeType::class);
       $filtrerapportdate=$trierGroupe->handleRequest($request); 

       if($trierGroupe->isSubmitted() && $trierGroupe->isValid()){
            $affiche_tab = true ;
            $data = $filtrerapportdate->getData();

            $one_date = $data['one_date_search'];
            if ($one_date != null) {
                $groupeRapport = $groupeRepository->filtre_groupe_one_date($one_date);
                #dd($groupeRapport);
            }
            else {
                $date_debut = $data['Date1'];
                $date_fin = $data['Date2'];
    
                $groupeRapport = $groupeRepository->FiltreGroupe($date_debut,$date_fin);    
            }
        #$nombre_client = $groupeRepository->FindByNumberClient($date_debut,$date_fin)
        #dd($groupeRapport);
        
       }
      # dd($affiche_tab);
        return $this->renderForm('Module_client/rapport_groupe/index.html.twig', [
            'groupe' => $groupeRapport,
            'agences'=>$agence->findAll(),
            'trierGroupe'=>$trierGroupe,
            'affiche_tab' => $affiche_tab,
        ]);
    }
}
