<?php

namespace App\Repository;

use App\Entity\DetailLotRecu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DetailLotRecu|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailLotRecu|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailLotRecu[]    findAll()
 * @method DetailLotRecu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailLotRecuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailLotRecu::class);
    }

    // /**
    //  * @return DetailLotRecu[] Returns an array of DetailLotRecu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailLotRecu
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
 // /**
    //  * @return DetailLotRecu[] Returns an array of DetailLotRecu objects
    //  */
    public function afficher()
    {
        return $this->createQueryBuilder('d')
            //->Where('d.NomAliment = :val')
            ->Where('d.QteDispo > :val')
            ->setParameter('val', 0)
            ->orderBy('d.DatePeremption', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
   

    // /**
    //  * @return DetailLotRecu[] Returns an array of DetailLotRecu objects
    //  */
    public function afficherTout($value)
    {
        return $this->createQueryBuilder('d')
            ->Where('d.NomAliment = :val1')
            ->andWhere('d.QteDispo > :val')
            ->setParameter('val', 0)
            ->setParameter('val1', $value)
            ->orderBy('d.DatePeremption', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
   
     // /**
    //  * @return DetailLotRecu[] Returns an array of DetailLotRecu objects
    //  */
    public function findDetailLot($value)
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.lot','l')
            ->Where('l.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }


}
