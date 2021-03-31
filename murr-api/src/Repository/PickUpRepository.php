<?php

namespace App\Repository;

use App\Entity\PickUp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PickUp|null find($id, $lockMode = null, $lockVersion = null)
 * @method PickUp|null findOneBy(array $criteria, array $orderBy = null)
 * @method PickUp[]    findAll()
 * @method PickUp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PickUpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PickUp::class);
    }


    public function findPickupById($value): ?PickUp
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /**
     * this is for if we need to setup the id manually in the conrtoller
     * @return int|null
     */
    public function getMaxId(): ?int
    {
        return $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('s.id')
            ->from('App\Entity\Site', 's')
            ->getMaxResults();
    }

    /***
     * @param $entity
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($entity) : PickUp
    {
        $this->_em->persist($entity);
            $this->_em->flush();
        return  $entity;
    }

}
