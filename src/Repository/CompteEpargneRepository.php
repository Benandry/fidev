<?php

namespace App\Repository;

use App\Entity\CompteEpargne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteEpargne>
 *
 * @method CompteEpargne|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteEpargne|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteEpargne[]    findAll()
 * @method CompteEpargne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteEpargneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteEpargne::class);
    }

    public function add(CompteEpargne $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompteEpargne $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Filtre entre deux date des comptes epargnes pour les individuels

   public function FiltreDateIndividuelClient($date1,$date2): array
   {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
            c
            FROM
            App\Entity\CompteEpargne c
            WHERE
            c.datedebut
            BETWEEN :date1 AND :date2 AND c.typeClient=\'INDIVIDUEL\'
            '
        )
        ->setParameter('date1',$date1)
        ->setParameter('date1',$date2)
        ;
        return $query->getResult();
   }

//    solde
   public function Solde($id)
   {
      $entityManager=$this->getEntityManager();
      $query=$entityManager->createQuery(
        'SELECT
         c.id,
         c.DateTransaction,
         c.solde,
         t.Description,
         t.Montant
         FROM 
         App\Entity\CompteEpargne c
         INNER JOIN
         App\Entity\Transaction t
         WHERE
         t.NumeroCompteEpargne = c.id AND
         c.id = :id '
        )->setParameter('id',$id);
        return $query->getResult();
   }

    public function CompteEpargne()
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT 
                c.datedebut,
                c.id as idepc,
                c.typeClient,
                c.codeepargne,
                i.id AS codecl,
                i.nom_client as nom,
                i.prenom_client as prenom,
                (pe.id) AS codeprod,
                (pe.nomproduit) AS nomprod,
                (te.id) as codeep
            FROM App\Entity\CompteEpargne c 
            INNER JOIN
            App\Entity\Individuelclient i,
            App\Entity\ProduitEpargne pe,
            App\Entity\TypeEpargne te
            WHERE
             c.codeep = i.codeclient
             AND c.produit = pe.id
             AND pe.typeEpargne = te.id');

            return $query->getResult();
    }
// Cette fonction permet d'avoir les rapports de tous les solde du clients
   public function rapportsolde()
   {
    $entityManager=$this->getEntityManager();
    $query=$entityManager->createQuery(
        'SELECT DISTINCT
        -- compte epargne
        c.id,
        c.codeepargne,
        c.codeep,
        -- individuel client
        (i.id) as codeclient,
        (i.nom_client) AS nomclient,
        (i.prenom_client) AS prenomclient,
        -- produit
        (p.id) as codeproduit,
        (p.nomproduit) as nomproduit,
        -- type
        (te.id) as codetypeepargne,
        -- solde
        (tr.solde) as soldes,
        tr.DateTransaction
        FROM 
        App\Entity\CompteEpargne c
        INNER JOIN
        App\Entity\Individuelclient i,
        App\Entity\ProduitEpargne p,
        App\Entity\TypeEpargne te,
        App\Entity\Transaction tr
        WHERE c.codeep = i.codeclient AND
        c.produit = p.id AND
        p.typeEpargne = te.id AND
        tr.codeepargneclient = c.codeepargne
        GROUP BY tr.id
        '
        )
        ->setMaxResults(0);

         return $query->getResult();
  }
   
    // Liste des groupes existants
    public function ListeGroupe(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT 
            -- compte epargne
            c.datedebut,
            c.id as codeep,
            c.codegroupeepargne,
            -- compte groupe
            g.nomGroupe,
            g.id as codegrp,
            -- produit epargne
            p.id as codeproduit,
            p.nomproduit as nomprod,
            -- type epargne
            te.id as typeepargne,
            te.NomTypeEp as typeEpargne
            FROM
                App\Entity\CompteEpargne c
            INNER JOIN
                App\Entity\Groupe g
            INNER JOIN
                App\Entity\ProduitEpargne p
            INNER JOIN
                App\Entity\TypeEpargne te
            WITH
                c.codegroupe = g.codegroupe AND
                c.produit = p.id AND
                p.typeEpargne = te.id
            '
        );

        return $query->getResult();
    }

    // Filtre entre deux date pour les compte epargne groupe

    public function FiltreGroupeEpargne($date1,$date2):array
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT 
            -- compte epargne
            c.datedebut,
            c.id as codeep,
            c.codegroupeepargne,
            -- compte groupe
            g.nomGroupe,
            g.id as codegrp,
            -- produit epargne
            p.id as codeproduit,
            p.nomproduit as nomprod,
            -- type epargne
            te.id as typeepargne,
            te.NomTypeEp as typeEpargne
            FROM
                App\Entity\CompteEpargne c
            INNER JOIN
                App\Entity\Groupe g
            INNER JOIN
                App\Entity\ProduitEpargne p
            INNER JOIN
                App\Entity\TypeEpargne te
            WITH
                c.codegroupe = g.codegroupe AND
                c.produit = p.id AND
                p.typeEpargne = te.id
            WHERE c.datedebut BETWEEN :date1 AND :date2
            GROUP BY c.codegroupeepargne
            '
        )
        ->setParameter('date1',$date1)
        ->setParameter('date2',$date2)
        ;

        return $query->getResult();
    }

    // Filtre entre deux date transaction
    public function FiltreRapportSolde($Du,$Au=null){
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT DISTINCT
            -- compte epargne
            c.id,
            tr.Description,
            c.codeepargne,
            c.codeep,
            -- individuel client
            (i.id) as codeclient,
            (i.nom_client) AS nomclient,
            (i.prenom_client) AS prenomclient,
            -- produit
            (p.id) as codeproduit,
            (p.nomproduit) as nomproduit,
            -- type
            (te.id) as codetypeepargne,
            -- solde
            (tr.solde) as soldes,
            tr.DateTransaction
            FROM 
            App\Entity\CompteEpargne c
            INNER JOIN
            App\Entity\Individuelclient i,
            App\Entity\ProduitEpargne p,
            App\Entity\TypeEpargne te,
            App\Entity\Transaction tr
            WHERE c.codeep = i.codeclient AND
            c.produit = p.id AND
            p.typeEpargne = te.id AND
            tr.codeepargneclient = c.codeepargne
            AND tr.DateTransaction BETWEEN :Du AND :Au
            GROUP BY tr.id
            ')
            ->setParameter(':Du',$Du)
            ->setParameter(':Au',$Au)
            ;
    
             return $query->getResult();
    }

    // Filtre date arrete
        // Filtre entre deux date transaction
        public function FiltreSoldeArrete($Du){
            $entityManager=$this->getEntityManager();
            $query=$entityManager->createQuery(
                'SELECT DISTINCT
                -- compte epargne
                c.id,
                --Description --
                tr.Description,

                c.codeepargne,
                c.codeep,
                -- individuel client
                (i.id) as codeclient,
                (i.nom_client) AS nomclient,
                (i.prenom_client) AS prenomclient,
                -- produit
                (p.id) as codeproduit,
                (p.nomproduit) as nomproduit,
                -- type
                (te.id) as codetypeepargne,
                -- solde
                (tr.solde) as soldes,
                tr.DateTransaction
                FROM 
                App\Entity\CompteEpargne c
                INNER JOIN
                App\Entity\Individuelclient i,
                App\Entity\ProduitEpargne p,
                App\Entity\TypeEpargne te,
                App\Entity\Transaction tr
                WHERE c.codeep = i.codeclient AND
                c.produit = p.id AND
                p.typeEpargne = te.id AND
                tr.codeepargneclient = c.codeepargne
                AND tr.DateTransaction <= :Du
                GROUP BY tr.id
                ')
                ->setParameter(':Du',$Du)
                ;
        
                 return $query->getResult();
        }
    

     // Filtre rapport transaction du jour
     
     public function RapportTransactionDuJour($Du){
        return $this->createQueryBuilder('c')
                    ->innerJoin('c.transactions','t')
                    ->where('c.transactions = t.NumeroCompteEpargne')
                    ->andWhere('t.DateTransaction = :Du')
                    ->setParameter(':Du',$Du)
                    ->getQuery()
                    ->getResult()
                    ;
    }

    // Cette fonction est pour les client epargne d'aujjourd'hui
    public function ClientNow(){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT
        -- Compte epargne 
        ce.datedebut,
        ---Code client -----
        i.codeclient,
        ---code epargne
        ce.codeepargne,
        -- produit
        p.nomproduit,
        -- individuel client
        i.nom_client,

        i.prenom_client
        FROM
        App\Entity\CompteEpargne ce
        INNER JOIN 
        App\Entity\ProduitEpargne p
        INNER JOIN
        App\Entity\Individuelclient i
        WITH ce.produit=p.id
        AND ce.codeep = i.codeclient
        ORDER BY ce.id DESC');
        return $query->getResult();

    }
    // **********************************************
    // **********************************************
    // **********************************************

    public function Allcompteep(){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT
            ce.datedebut,
            ce.codegroupe,
            ce.codegroupeepargne
        FROM
        App\Entity\CompteEpargne ce
        ');

        return  $query->getResult();
    }

    public function filtre($date1,$date2){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT
            ce.datedebut,
            ce.codegroupe,
            ce.codegroupeepargne
        FROM
        App\Entity\CompteEpargne ce
        WHERE ce.datedebut BETWEEN :date1 AND :date2
        ')
        ->setParameter(':date1',$date1)
        ->setParameter(':date2',$date2)
        ;

        return  $query->getResult();
    }
}
