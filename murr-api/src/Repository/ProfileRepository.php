<?php


namespace App\Repository;


use App\Entity\Profile;
use App\Entity\Resident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class ProfileRepository extends ServiceEntityRepository
{
    /**
     * @method Profile|null find($id, $lockMode = null, $lockVersion = null)
     * @method Profile|null findOneBy(array $criteria, array $orderBy = null)
     * @method Profile[]    findAll()
     * @method Profile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profile::class);
    }
}