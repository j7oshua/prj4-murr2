<?php

namespace App\Repository;

use App\Entity\ResidentProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResidentProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResidentProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResidentProfile[]    findAll()
 * @method ResidentProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResidentProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResidentProfile::class);
    }

    // /**
    //  * @return ResidentProfile[] Returns an array of ResidentProfile objects
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
    public function findOneBySomeField($value): ?ResidentProfile
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
