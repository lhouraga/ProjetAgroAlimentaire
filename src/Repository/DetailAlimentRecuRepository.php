<?php

namespace App\Repository;

use App\Entity\DetailAlimentRecu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DetailAlimentRecu|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailAlimentRecu|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailAlimentRecu[]    findAll()
 * @method DetailAlimentRecu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailAlimentRecuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailAlimentRecu::class);
    }

    // /**
    //  * @return DetailAlimentRecu[] Returns an array of DetailAlimentRecu objects
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
    public function findOneBySomeField($value): ?DetailAlimentRecu
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
