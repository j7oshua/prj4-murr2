<?php
//php -S 127.0.0.1:8000 -t public

namespace App\Controller;


use App\Entity\Point;
//require_once '../Entity/Point.php';

class PointController extends point
{

    /**
     * @param $value
     * @return mixed
     */
    public function findSumPointsByRes($value)
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

    //need to sum or count the point in the array.
    public static function getPoints(EntityManager $em, array $reqData)
    {

        $qb = $em->createQueryBuilder();
        $validFieldList = ["id", "num_points", "resident_id"];
        $qb->select('p')
        //$qb->select('count(p)')

            ->from('Point',  'p')
            ->where("p.resident_id = '" . $reqData['resident_id'] . "'");
        $pointArray = $qb->getQuery()->getArrayResult();
        //$pointArray = $qb->getQuery()->getSingleScalarResult();

        //try to count
        for($i=0;$i<$pointArray;$i++){
            //may access the numPoint to add those to count
            //$count += $qb->getQuery()->select('numPoint')
            // ->from('Point');
            $count = +1;

        }

        if(empty($pointArray))
        {
            return 0;
            //http_response_code(404); //not found
        }

        return $count; //return point amount
    }




}