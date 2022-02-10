<?php

namespace App\Repository;

use App\Entity\VideoCommentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VideoCommentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoCommentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoCommentaire[]    findAll()
 * @method VideoCommentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoCommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoCommentaire::class);
    }

    // /**
    //  * @return VideoCommentaire[] Returns an array of VideoCommentaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VideoCommentaire
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
