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

    public static function getPointSum(EntityManager $em, array $reqData)
{
    return $qb = $em->createQueryBuilder('pr')
        //need to go into selected point tables.
        ->select('SUM(pr.numPoint)')
        ->andWhere("pr.resident_id = '" . $reqData['resident_id'] . "'")
        ->groupBy('pr.resident_id')
        ->getQuery()
        ->getSingleScalarResult();
}

//https://gist.github.com/roukmoute/d8b7473da78fc9d8b867
    public static function getPointSum2(EntityManager $em, array $reqData)
    {
        //return $qb = $em->createQueryBuilder('pr')
            //->where(
               // $queryBuilder->expr()->in( //may work?
                    //'pr.pointid',
                 //   $this
                   //     ->createQueryBuilder('subquery_repository')
                     //   ->select('SUM(point.num_point)')
                       // ->from('EntityBundle:Point', 'point')
                        //->where('Point.id = :pointid')
                        //->getDQL()
                //)
            //)
            //->setParameter(':user', $user);

    }

}