<?php

namespace App\Controller;

use App\Entity\Resident;
use App\Repository\PointRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResidentPointController extends AbstractController
{
    /**
     * @Route("/resident/point/{id}", name="resident_point")
     * @param int $id
     * @param PointRepository $pr
     * @return Response
     */
    public function index(int $id, PointRepository $pr): Response
    {
//        return $this->render('resident_point/index.html.twig', [
//            'controller_name' => 'ResidentPointController',
//        ]);

        //$response = $pr->getPointByResident($id);
        $response = $this->json($pr->getPointByResident($id));
        return $this -> json($response);
    }

    /**
     * @param EntityManager $em
     * @param array $reqData
     * @return int|mixed|string
     */
    public static function getResidentPoint()
    {


        //I think querybuilder is only for building databases so i think i got it mixed up with an actual query.





        //https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/dql-doctrine-query-language.html#array-hydration
        //$query = $em->createQuery('SELECT u FROM CmsUser u');
        //$users = $query->getResult(Query::HYDRATE_ARRAY);


        //$qb->select('p')
        //    ->from('Point', 'p')
        //    ->innerJoin('p.Resident r ON r.resident_id = p.points_id')
        //    ->where('p.resident.id = :pointResidentID')
        //    ->setParameter('pointResidentID', '$pointResidentID')
        //    ->getQuery();

//        $rsm = new ResultSetMapping();
//
//        $query = $em->createNativeQuery('SELECT points.ID, points.NumPoints, resident.ID FROM points LEFT OUTER JOIN point_resident
//                                             ON points.ID = point_resident.pointID AND point_resident.residentID = ?', $rsm);
//        $query->setParameter(1, 'resident.ID');

        //$qb->select('p.numPoint')
        //->from(Resident::class, 'r')
        //->innerJoin(Point::class, 'p', Join::WITH, 'r.id = p.resident.id')
        ////Join is not identified
        //->where( 'r.id == $id'); //not sure if this works
        //$qb->getArrayResult(); //this may or may not exist

        //$numpoint = array_sum((array)$qb);
        //return $numpoint;

        ////below is a SQL statement
        //SELECT points.ID, points.NumPoints, resident.ID
        //  FROM points
        //LEFT OUTER JOIN point_resident (many to many table)
        //  ON points.ID = point_resident.pointID
        //    AND point_resident.residentID =  residentID{index}     (this will input the index)
        //below may not be needed
        //LEFT OUTER JOIN resident
        //  ON point_resident.residentID = resident.ID

        //return $query->getResult();
    }

}
