<?php

namespace App\Repository;

use App\Entity\DepartementEnt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DepartementEnt|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepartementEnt|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepartementEnt[]    findAll()
 * @method DepartementEnt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartementEntRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepartementEnt::class);
    }

    // /**
    //  * @return DepartementEnt[] Returns an array of DepartementEnt objects
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
    public function findOneBySomeField($value): ?DepartementEnt
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
