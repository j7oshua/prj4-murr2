<?php

namespace App\Repository;

use App\Entity\Resident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resident|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resident|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resident[]    findAll()
 * @method Resident[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResidentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resident::class);
    }


}
