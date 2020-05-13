<?php

namespace App\Repository;

use App\Entity\PlatPrepare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlatPrepare|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatPrepare|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatPrepare[]    findAll()
 * @method PlatPrepare[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatPrepareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatPrepare::class);
    }

    // /**
    //  * @return PlatPrepare[] Returns an array of PlatPrepare objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlatPrepare
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    // /**
    //  * @return PlatPrepare[] Returns an array of PlatPrepare objects
    //  */
    public function findplat($value)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.AlimentsUtilise','d')
            ->Where('d.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
}
