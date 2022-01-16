<?php

namespace App\Repository;

use App\Entity\Apropo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apropo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apropo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apropo[]    findAll()
 * @method Apropo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApropoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apropo::class);
    }

    // /**
    //  * @return Apropo[] Returns an array of Apropo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Apropo
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
