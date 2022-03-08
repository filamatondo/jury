<?php

namespace App\Repository;

use App\Entity\ListeAjouterAmi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListeAjouterAmi|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeAjouterAmi|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeAjouterAmi[]    findAll()
 * @method ListeAjouterAmi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeAjouterAmiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeAjouterAmi::class);
    }

    // /**
    //  * @return ListeAjouterAmi[] Returns an array of ListeAjouterAmi objects
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
    public function findOneBySomeField($value): ?ListeAjouterAmi
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
