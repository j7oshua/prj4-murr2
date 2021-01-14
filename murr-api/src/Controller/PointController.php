<?php


namespace App\Controller;


use Doctrine\ORM\EntityManager;

class PointController
{
    public static function getPointSum(EntityManager $em, int $residentID)
    {

        $qb = $em->createQueryBuilder();

                $validFieldList = ["id", "numPoints"];
               $qb->select('p')
                //$qb->select('count(p)')

                ->from('point',  'p')
                ->where("p.resident = '" . $residentID . "'");


               //or Point.getResident().find("p.resident_id = '" . $residentID . "'")

                //or $PointArray = Resident.getPoints()
                //$PointSum = $PointArray->select('numPoint')->sum()

        // Example - $qb->expr()->sum('u.id', '2') => u.id + 2

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