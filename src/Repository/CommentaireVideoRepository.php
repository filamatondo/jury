<?php

namespace App\Repository;

use App\Entity\CommentaireVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentaireVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireVideo[]    findAll()
 * @method CommentaireVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireVideo::class);
    }

    // /**
    //  * @return CommentaireVideo[] Returns an array of CommentaireVideo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommentaireVideo
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
