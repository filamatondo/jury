<?php

namespace App\Repository;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }


    public function findAllQuery(): QueryBuilder 
    {
        return $this->createQueryBuilder('u'); 
    }
    
    public function findAllUserByFilter($search)
    {
       $query = $this->findAllQuery(); 
        
       if ($search->getFiltrerParNom()){
           $query = $query->andWhere('u.nom = :nom'); 
           $query->setParameter('nom', $search->getFiltrerParNom()); 
       }
           // Si la valeur à été envoyer per get prenom, il va me filtre le getFiltreParPrenom,
       if ($search->getFiltrerParPrenom()){
           $query = $query->andWhere('u.prenom = :prenom'); 
           $query->setParameter('prenom', $search->getFiltrerParPrenom()); 
          
       }
            // si non tu me retourne toute la liste. 
          
       return $query->getQuery()->getResult(); 
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}