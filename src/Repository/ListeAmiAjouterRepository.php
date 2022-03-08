<?php

namespace App\Repository;

use App\Entity\ListeAmiAjouter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListeAmiAjouter|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeAmiAjouter|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeAmiAjouter[]    findAll()
 * @method ListeAmiAjouter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeAmiAjouterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeAmiAjouter::class);
    }

    // /**
    //  * @return ListeAmiAjouter[] Returns an array of ListeAmiAjouter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListeAmiAjouter
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
