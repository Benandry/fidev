<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitEpargneRepository;
use App\Repository\TransactionRepository;
use App\Repository\CommuneRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiIndividuelController extends AbstractController
{
    #[Route('/api/individuel/{id}', name: 'app_api_individuel')]

    public function index(ProduitEpargneRepository $produitRepo,$id): Response
    {

        $api = $produitRepo->findByApiProduit($id); 

        return new JsonResponse($api);
    }

    #[Route('/api/transaction/{code}', name: 'app_api_transaction')]

    public function api_transaction(TransactionRepository $transactionRepository,$code): Response
    {

        $api = $transactionRepository->api_transaction($code); 

        return new JsonResponse($api);
    }

    #[Route('/api/releve/', name: 'app_api_releve')]

    public function api_releve(TransactionRepository $transactionRepository): Response
    {

        $api = $transactionRepository->api_releve_transac(); 

        return new JsonResponse($api);
    }


    #[Route('/api/transfert/{codeclient}', name: 'app_api_transfert')]

    public function api_transfert(TransactionRepository $transactionRepository,$code): Response
    {

        $api = $transactionRepository->api_transaction($code); 

        return new JsonResponse($api);
    }

    #[Route('/api/commune-madagascar', name: 'api_commune')]

    public function api_commune(CommuneRepository $transactionRepository): Response
    {

        $api = $transactionRepository->api_commune(); 

        return new JsonResponse($api);
    }


    #[Route('/api/code-client/{code}', name: 'app_api_code_client')]

    public function api_code_client(ProduitEpargneRepository $repo,$code): Response
    {

        $api = $repo->code_client_api($code); 

        return new JsonResponse($api);
    }

    #[Route('/api/code-client', name: 'app_code_client')]

    public function code_client(ProduitEpargneRepository $repo): Response
    {

        $api = $repo->code_client(); 

        return new JsonResponse($api);
    }


    #[Route('/api/code-epargne', name: 'app_code_epargne')]

    public function code_epargne(ProduitEpargneRepository $repo): Response
    {

        $api = $repo->code_epargne(); 

        return new JsonResponse($api);
    }

}