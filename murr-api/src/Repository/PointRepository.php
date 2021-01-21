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

    public function getPointByResident(int $id)
    {
        $qb = $this->createQueryBuilder();

        $qb->select('p.numPoint')
            ->from(Resident::class, 'r')
            ->innerJoin(Point::class, 'p', Join::WITH, 'r.id = p.resident.id')
            //Join is not identified
            ->where( 'r.id == $id'); //not sure if this works
        $qb->getArrayResult(); //this may or may not exist
        $numpoint = array_sum((array)$qb);
        return $numpoint;

        //below is a SQL statement

//SELECT points.ID, points.NumPoints, resident.ID
//  FROM points
//LEFT OUTER JOIN point_resident (many to many table)
//  ON points.ID = point_resident.pointID
//    AND point_resident.residentID =  residentID{index}     (this will input the index)

//below may not be needed
//LEFT OUTER JOIN resident
//  ON point_resident.residentID = resident.ID

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