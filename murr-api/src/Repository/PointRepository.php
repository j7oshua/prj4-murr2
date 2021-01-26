<?php

namespace App\Repository;

use App\Entity\Point;
use App\Entity\Resident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Point|null find($id, $lockMode = null, $lockVersion = null)
 * @method Point|null findOneBy(array $criteria, array $orderBy = null)
 * @method Point[]    findAll()
 * @method Point[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Point::class);
    }

    public function getPointByResident(int $resID)
    {

        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('p.numPoints')
            ->from('App\Entity\Point', 'p')
            ->innerJoin('p.resident', 'r', 'WITH', 'r.id = :indexID')  //need to index the many to many table
            ->setParameter('indexID', $resID);

        //$pointArray = $qb->getQuery()->getArrayResult(); //may mess up formating
        //return array_sum((array)$pointArray);
        //we will need to make it cleaner and to work with sum

        return $qb->getQuery()->getResult();

       //$response2 = $qb->getQuery()->getResult();

       //return $response2['content']; //we will need to index the 'content' field

    }

    // /**
    //  * @return Point[] Returns an array of Point objects
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
    public function findOneBySomeField($value): ?Point
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
