<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function findFilteredItems($format)
    {
        $qb = $this->createQueryBuilder('i');
        $qb->select('i');
        if($format) {
            return
            $qb->where('i.format = :format')
            ->setParameter('format', $format)
            ->getQuery()
            ->getResult();
        }
        return $qb->getQuery()->getResult();
    }

    public function findAllBundleItems($id)
    {
        $qb = $this->createQueryBuilder('i');
        
        $qb->innerJoin('i.bundle', 'b', 'WITH', 'b.id = :id')
            ->setParameter('id', $id);

            return $qb->getQuery()->getResult();
    }

    public function findAllItemsByUser($user)
    {
        $qb = $this->createQueryBuilder('i');

        $qb->innerJoin('i.user', 'u', 'WITH', 'u = :user')
            ->setParameter('user', $user);

            return $qb->getQuery()->getResult();
    }

    public function findAllItemsByUserAndBundle($user, $bundle)
    {
        $qb = $this->createQueryBuilder('i');

        $qb->select('i')
            ->where('i.user = :user')
            ->setParameter('user', $user)
            ->andWhere('i.bundle = :bundle')
            ->setParameter('bundle', $bundle);

            return $qb->getQuery()->getResult();
    }


    // /**
    //  * @return Item[] Returns an array of Item objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Item
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
