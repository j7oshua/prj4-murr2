<?php


namespace App\Controller;


use Doctrine\ORM\EntityManager;

class PointController
{
    public static function getPoint(EntityManager $em, array $reqData)
    {
		$qb = $em->createQueryBuilder();
//        $validFieldList = ["point_id","resident_id"];
        $result = [];
        $qb->select('pr.point_id')
            ->from('point_resident', 'pr')
            ->where("pr.resident_id = '" . $reqData['resident_id'] . "'");

        $result = $qb->getQuery()->getArrayResult();

        //If points are not unique
        return count($result);
    }


}