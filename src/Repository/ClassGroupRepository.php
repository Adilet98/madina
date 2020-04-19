<?php

namespace App\Repository;

use App\Entity\ClassGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClassGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassGroup[]    findAll()
 * @method ClassGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassGroup::class);
    }

    // /**
    //  * @return Group[] Returns an array of Group objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Group
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
