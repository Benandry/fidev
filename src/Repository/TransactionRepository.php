<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transaction>
 *
 * @method Transaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaction[]    findAll()
 * @method Transaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function add(Transaction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Transaction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function solde(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT SUM(t.Montant) FROM App\Entity\Transaction t GROUP BY t.codeepargneclient');
             return $query->getResult();
    }
    
   public function RapportTransaction()
   {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
            -- Compte epargne
             c,
                tr.Montant,
            --  individuel
            (i.id) as codeindividuel,
            i.nom_client as nomclient,
            i.prenom_client as prenomclient,
            -- produit epargne
            p.id as codeproduit,
            p.nomproduit as nomproduit,
            -- type epargne
            te.id as codetype,
            --  transaction
             tr.id,
             tr.Description,
             tr.PieceComptable,
             tr.DateTransaction,
             tr.Montant,
             tr.papeterie,
             tr.commission,
             tr.codetransaction,
             tr.codeepargneclient,
             tr.solde
            --  solde
            -- SUM(tr.Montant)-SUM(tr.montantRetrait) as solde
             FROM
             App\Entity\CompteEpargne c
             INNER JOIN
             App\Entity\Transaction tr
             INNER JOIN
             App\Entity\Individuelclient i
             INNER JOIN
             App\Entity\ProduitEpargne p
             INNER JOIN
             App\Entity\TypeEpargne te
             WHERE
             c.codeepargne = tr.codeepargneclient AND
             c.produit = p.id AND
             p.typeEpargne = te.id
            ')
            ->setMaxResults(0);

             return $query->getResult();
   }


    // Cette fonction permet d'avoir les releve a chaque client

    public function ReleveTransaction()
    {
         $entityManager=$this->getEntityManager();
         $query=$entityManager->createQuery(
             'SELECT 
             -- transaction 
             tr.id,
             tr.Description,
             tr.PieceComptable,
             tr.DateTransaction,
             tr.Montant,
             tr.codetransaction,
             tr.codeepargneclient,
             tr.solde,
             -- compte epargne
             ce.codeep,
             ce.codeepargne,
             -- individuel
             i.codeclient,
             i.nom_client,
             i.prenom_client
             FROM
             App\Entity\Transaction tr
             INNER JOIN
             App\Entity\CompteEpargne ce
             INNER JOIN 
             App\Entity\Individuelclient i
             WITH
             tr.codeepargneclient = ce.codeepargne
             AND
             ce.codeep = i.codeclient
             '
         );
 
 
              return $query->getResult();
    }

    // Cette fonction permet de filtrer les rapports soldes

    public function FiltreRapportSolde($Du,$Au){
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
            -- Compte epargne
             c,
                tr.Montant,
            --  individuel
            (i.id) as codeindividuel,
            i.nom_client as nomclient,
            i.prenom_client as prenomclient,
            -- produit epargne
            p.id as codeproduit,
            p.nomproduit as nomproduit,
            -- type epargne
            te.id as codetype,
            --  transaction
             tr.id,
             tr.Description,
             tr.PieceComptable,
             tr.DateTransaction,
             tr.Montant,
             tr.papeterie,
             tr.commission,
             tr.codetransaction,
             tr.codeepargneclient,
             tr.solde
            --  solde
            -- SUM(tr.Montant)-SUM(tr.montantRetrait) as solde
             FROM
             App\Entity\CompteEpargne c
             INNER JOIN
             App\Entity\Transaction tr
             INNER JOIN
             App\Entity\Individuelclient i
             INNER JOIN
             App\Entity\ProduitEpargne p
             INNER JOIN
             App\Entity\TypeEpargne te
             WHERE
             c.codeepargne = tr.codeepargneclient AND
             c.produit = p.id AND
             p.typeEpargne = te.id AND
             tr.DateTransaction BETWEEN :Du AND :Au
            ')
            ->setParameter(':Du',$Du)
            ->setParameter(':Au',$Au)
            ;

             return $query->getResult();
    }

    // Filtre date arrete transaction
    public function FiltreDateArreteTransac($Du){
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
            -- Compte epargne
             c,
                tr.Montant,
            --  individuel
            (i.id) as codeindividuel,
            i.nom_client as nomclient,
            i.prenom_client as prenomclient,
            -- produit epargne
            p.id as codeproduit,
            p.nomproduit as nomproduit,
            -- type epargne
            te.id as codetype,
            --  transaction
             tr.id,
             tr.Description,
             tr.PieceComptable,
             tr.DateTransaction,
             tr.Montant,
             tr.papeterie,
             tr.commission,
             tr.codetransaction,
             tr.codeepargneclient,
             tr.solde
            --  solde
            -- SUM(tr.Montant)-SUM(tr.montantRetrait) as solde
             FROM
             App\Entity\CompteEpargne c
             INNER JOIN
             App\Entity\Transaction tr
             INNER JOIN
             App\Entity\Individuelclient i
             INNER JOIN
             App\Entity\ProduitEpargne p
             INNER JOIN
             App\Entity\TypeEpargne te
             WHERE
             c.codeepargne = tr.codeepargneclient AND
             c.produit = p.id AND
             p.typeEpargne = te.id AND
             tr.DateTransaction <= :Du
            ')
            ->setParameter(':Du',$Du)
            ;

             return $query->getResult();
    }

    
    // Cette fonction permet de filtrer les rapports soldes

    public function FiltreRapportSuJourSolde($Du){
        return $this->createQueryBuilder('t')   
                ->innerJoin('t.codeepargneclient','c')
                ->where('t.codeepargneclient = c.id')
                ->andWhere('t.DateTransaction = :Du')
                ->setParameter(':Du',$Du)
                ->getQuery()
                ->getResult()
                ;
    }
 // Cette fonction permet de filtre entre deux date

        public function filtreReleve($Du,$Au,$codeepargne){

            $entityManager=$this->getEntityManager();
            $query=$entityManager->createQuery(
                'SELECT
                -- transaction 
                tr.id,
                tr.Description,
                tr.PieceComptable,
                tr.DateTransaction,
                tr.Montant,
                tr.codetransaction,
                tr.codeepargneclient,
                tr.solde,
                -- compte epargne
                ce.codeep,
                ce.codeepargne,
                -- individuel
                i.codeclient,
                i.nom_client,
                i.prenom_client
                FROM
                App\Entity\Transaction tr
                INNER JOIN
                App\Entity\CompteEpargne ce
                INNER JOIN 
                App\Entity\Individuelclient i
                WITH
                tr.codeepargneclient = ce.codeepargne
                AND
                ce.codeep = i.codeclient
                WHERE
                tr.DateTransaction BETWEEN :Du AND :Au
                AND tr.codeepargneclient =:codeepargne
                ORDER BY tr.id
                '
            )
            ->setParameter(':Du',$Du)
            ->setParameter(':Au',$Au)
            ->setParameter(':codeepargne',$codeepargne)
            ;


                return $query->getResult();
        }

    // cette fonction est pour l'api
    
   public function api_transaction($code)
   {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT 
            --nom client --
            client.nom_client nom,
            client.prenom_client prenom,
            ------------code -----
            tr.codeepargneclient code,

            ---Compte epargne -----
            ce,
            MAX(tr.id),
            tr.codeepargneclient AS codeep,
            tr.solde AS solde_transac,
            SUM(tr.Montant) AS somme_solde
            FROM
            App\Entity\Transaction tr
            INNER JOIN
            App\Entity\CompteEpargne ce
            WITH tr.codeepargneclient = ce.codeepargne
            LEFT JOIN
            App\Entity\Individuelclient client
            WITH client.codeclient = ce.codeep

            WHERE tr.codeepargneclient = :code
            GROUP BY tr.codeepargneclient
            '

        )
        ->setParameter(':code',$code);
             return $query->getResult();
   }



   // cette fonction permet de recupere le nom
        public function api_releve_transac($codeepargne)
        {
            $entityManager=$this->getEntityManager();

            $query=$entityManager->createQuery(
                'SELECT
                -- transation
                tr.codeepargneclient,
                -- compte epargne
                ce.codeepargne,
                ce.codeep,
                -- individuel client
                i.codeclient,
                i.nom_client,
                i.prenom_client
                FROM
                App\Entity\Transaction tr
                INNER JOIN
                App\Entity\CompteEpargne ce
                INNER JOIN
                App\Entity\Individuelclient i
                WITH
                tr.codeepargneclient=ce.codeepargne
                AND
                i.codeclient = ce.codeep
                WHERE tr.codeepargneclient =:codeepargne 
                ')
                ->setParameter(':codeepargne',$codeepargne);
                return $query->getResult();
        }

    // api pour les transferts
    public function api_transfert($codeepargne){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
           'SELECT
            --    transaction
            MAX(tr.id) AS id,
            tr.codeepargneclient AS codedestinateur,
         --   tr.codeenvoyeur AS codeenv,
            tr.codetransaction AS codetransac,
            SUM(tr.Montant) AS soldedestinateur,
            -- compte epargne
            ce.codeep,
            ce.codeepargne,
            -- individuel client
            i.nom_client,
            i.prenom_client,
            i.codeclient
             FROM 
             App\Entity\Transaction tr
             INNER JOIN
             App\Entity\CompteEpargne ce
            INNER JOIN
             App\Entity\Individuelclient i
             WITH
             tr.codeepargneclient = ce.codeepargne
            --  AND
            --  tr.codeenvoyeur=ce.codeepargne
             AND
             ce.codeep=i.codeclient
             WHERE
             tr.codeepargneclient =:codeepargne
            --  OR
            --  tr.codeenvoyeur =:codeepargne
            ')
            ->setParameter(':codeepargne',$codeepargne);
             return $query->getResult();   
    }


//    public function findOneBySomeField($value): ?Transaction
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

