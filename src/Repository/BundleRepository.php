<?php

namespace App\Repository;

use App\Entity\Bundle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bundle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bundle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bundle[]    findAll()
 * @method Bundle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BundleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bundle::class);
    }

    public function findListedBundles()
    {
        $qb = $this->createQueryBuilder('b');

        $qb->andWhere('b.listed = true');

        return $qb->getQuery()->getResult();
    }

    public function findNewBundle($user)
    {   
        $qb = $this->createQueryBuilder('b');
        
        $qb->innerJoin('b.user', 'u', 'WITH', 'u = :user')
            ->setParameter('user', $user)
            ->setMaxResults(1)
            ->orderBy('b.dateModified', 'desc');

            return $qb->getQuery()->getSingleResult();
    }

    public function findAllBundlesByUser($user)
    {
        $qb = $this->createQueryBuilder('b');

        $qb->innerJoin('b.user', 'u', 'WITH', 'u = :user')
            ->setParameter('user', $user);

            return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return Bundle[] Returns an array of Bundle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bundle
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
