<?php

namespace App\Repository;

use App\Entity\LessonTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LessonTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method LessonTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method LessonTime[]    findAll()
 * @method LessonTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LessonTime::class);
    }

    // /**
    //  * @return LessonTime[] Returns an array of LessonTime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LessonTime
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
