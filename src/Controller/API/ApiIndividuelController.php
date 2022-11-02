<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitEpargneRepository;
use App\Repository\TransactionRepository;
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


}