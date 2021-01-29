<?php

namespace App\Repository;

use App\Entity\Point;
use App\Entity\Resident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\UnexpectedResultException;
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
        $result = null;

        if($resID >= 0) {
            $qb = $this->getEntityManager()->createQueryBuilder()
                ->select('p.numPoints')
                ->from('App\Entity\Point', 'p')
                ->innerJoin('p.resident', 'r', 'WITH', 'r.id = :indexID')
                ->setParameter('indexID', $resID);

            $result = $qb->getQuery()->getResult();
        }
        return $result;

    }
}
