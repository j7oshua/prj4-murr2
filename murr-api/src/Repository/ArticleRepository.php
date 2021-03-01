<?php


namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository
{
    /**
     This method will create the database and the look up functions for the get requests
     */
    public function __construct(ManagerRegistry $registry)
    {

    }
}