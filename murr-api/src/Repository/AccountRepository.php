<?php


namespace App\Repository;


use App\Entity\Account;
use App\Entity\Resident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class AccountRepository extends ServiceEntityRepository
{
    /**
     * @method Account|null find($id, $lockMode = null, $lockVersion = null)
     * @method Account|null findOneBy(array $criteria, array $orderBy = null)
     * @method Account[]    findAll()
     * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    /**
     * @param int $residentID
     * @return int|mixed|string|null
     * This function will grab the num_points property based on the resID
     */
    public function GetAccountByResidentID(int $residentID)
    {
        $result = null;

        if($residentID)
        {
            $qb = $this->getEntityManager()->createQueryBuilder()
                ->from('Account', 'a')
                ->innerJoin(Resident::class, 'r', Join::WITH, 'r.id = a.residentID')
                ->setParameter('a.residentID', $residentID);

            $result = $qb->getQuery()->getResult();
        }

        return $result;
    }
}