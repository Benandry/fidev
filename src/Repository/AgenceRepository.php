<?php

namespace App\Repository;

use App\Entity\Agence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Agence>
 *
 * @method Agence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agence[]    findAll()
 * @method Agence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agence::class);
    }

    public function add(Agence $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Agence $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

        public function ListeAgence()
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT
                p.id,
                p.NomAgence,
                p.AdressAgence,
                p.commune,
                c.CodeCommune AS codec
                FROM 
                App\Entity\Agence p
                INNER JOIN
                App\Entity\Commune c
                WITH
                p.commune = c.NomCommune
                '
            );

            return $query->getResult();
        }

//    /**
//     * @return Agence[] Returns an array of Agence objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Agence
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
