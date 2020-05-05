<?php

namespace App\Repository;

use App\Entity\RechercheRecetteNom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RechercheRecetteNom|null find($id, $lockMode = null, $lockVersion = null)
 * @method RechercheRecetteNom|null findOneBy(array $criteria, array $orderBy = null)
 * @method RechercheRecetteNom[]    findAll()
 * @method RechercheRecetteNom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercheRecetteNomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RechercheRecetteNom::class);
    }

    // /**
    //  * @return RechercheRecetteNom[] Returns an array of RechercheRecetteNom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RechercheRecetteNom
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
