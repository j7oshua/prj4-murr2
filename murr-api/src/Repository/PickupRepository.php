<?php

namespace App\Repository;

use App\Entity\Pickup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pickup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pickup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pickup[]    findAll()
 * @method Pickup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PickupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pickup::class);
    }

    public function findPickupById($value): ?Pickup
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
