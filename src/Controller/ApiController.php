<?php

namespace App\Controller;

use App\Repository\JobCypherRepository;
use App\Repository\RoadSectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/roads", name="get_roads", methods={"GET"})
     */
    public function getAllRoads(RoadSectionRepository $roadSectionRepository): Response
    {
        $response = new JsonResponse();
        $roads = $roadSectionRepository->findAll();

        $data = [];
        foreach ($roads as $road) {
            if(isset($_GET["term"]))
            {
                if(str_contains(strtolower($road->getRoadName()), strtolower($_GET['term'])) || str_contains(strtolower($road->getRoadNumber()), strtolower($_GET['term']))){
                    array_push($data,$road->getRoadNumber() . ' ' . $road->getRoadName());
                }
            }
            else{
                array_push($data,$road->getRoadNumber() . ' ' . $road->getRoadName());
            }
        }
        return $response->setData(array_unique($data));
    }

    /**
     * @Route("/api/jobcyphers", name="get_jobcyphers", methods={"GET"})
     */
    public function getJobCyphers(JobCypherRepository $jobCypherRepository): Response
    {
        $response = new JsonResponse();
        $jobCyphers = $jobCypherRepository->findAll();

        $data = [];
        foreach ($jobCyphers as $jobCypher) {
            if(isset($_GET["term"]))
            {
                if(str_contains(strtolower($jobCypher->getCypher()), strtolower($_GET['term'])) || str_contains(strtolower($jobCypher->getName()), strtolower($_GET['term']))){
                    array_push($data,$jobCypher->getCypher() . '; ' . $jobCypher->getName());
                }
            }
            else{
                array_push($data,$jobCypher->getCypher() . '; ' . $jobCypher->getName());
            }
        }
        return $response->setData(array_unique($data));
    }

    /**
     * @Route("/api/jobMeasurement", name="get_job_measurement", methods={"GET"})
     */
    public function getJobMeasurement(JobCypherRepository $jobCypherRepository): Response
    {
        $cypher = $_GET["cph"];

        $response = new JsonResponse();
        $jobCypher = $jobCypherRepository->findOneBy(['cypher' => $cypher]);

        $data = [];
        array_push($data, $jobCypher->getMeasurement());

        return $response->setData($data);
    }

    /**
     * @Route("/api/roadLength", name="get_road_length", methods={"GET"})
     */
    public function getRoadLength(RoadSectionRepository $roadSectionRepository): Response
    {
        $number = $_GET["number"];

        $response = new JsonResponse();
        $roadSection = $roadSectionRepository->findBy(['roadNumber' => $number]);

        $data = [];
        array_push($data, $roadSection[0]->getRoadStart());
        array_push($data, end($roadSection)->getRoadFinish());

        return $response->setData($data);
    }
}
