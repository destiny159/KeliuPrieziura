<?php

namespace App\Controller;

use App\Entity\CompletedJobs;
use App\Form\CompletedJobsType;
use App\Repository\CompletedJobsRepository;
use App\Repository\JobCypherRepository;
use App\Repository\RoadSectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/completed/jobs")
 */
class CompletedJobsController extends AbstractController
{
    /**
     * @Route("/", name="completed_jobs_index", methods={"GET"})
     */
    public function index(CompletedJobsRepository $completedJobsRepository): Response
    {
        return $this->render('completed_jobs/index.html.twig', [
            'completed_jobs' => $completedJobsRepository->findAll(),
        ]);
    }

//    /**
//     * @Route("/new", name="completed_jobs_new", methods={"GET","POST"})
//     */
//    public function new(Request $request, RoadSectionRepository $roadSectionRepository): Response
//    {
//        $completedJob = new CompletedJobs();
//        $form = $this->createForm(CompletedJobsType::class, $completedJob);
//        $form->handleRequest($request);
//
//
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $job = $form->get('job')->getData();
//            $jobcypher = explode('; ', $job)[0];
//            $jobname = explode('; ', $job)[1];
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $completedJob->setJobCypher($jobcypher);
//            $completedJob->setJobName($jobname);
//            $entityManager->persist($completedJob);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('completed_jobs_index');
//        }
//
//        return $this->render('completed_jobs/new.html.twig', [
//            'completed_job' => $completedJob,
//            'form' => $form->createView(),
//        ]);
//    }


    /**
     * @Route("/new", name="completed_jobs_new", methods={"GET","POST"})
     */
    public function new(Request $request, RoadSectionRepository $roadSectionRepository, JobCypherRepository $jobCypherRepository): Response
    {
        $completedJob = new CompletedJobs();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(CompletedJobsType::class, $completedJob);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $job = $form->get('job')->getData();
            $jobcypher = explode('; ', $job)[0];
            $jobname = explode('; ', $job)[1];
            $quantity = $form->get('quantity')->getData();
            $start = $form->get('start')->getData();
            $finish = $form->get('finish')->getData();
            $roadNumber = explode(' ',$form->get('roadName')->getData())[0];
            $jobas = $jobCypherRepository->findOneBy(['cypher' => $jobcypher]);
            //$measurement = $form->get('measurement')->getData();

            $measurement = $jobas->getMeasurement();

            $roads = $roadSectionRepository->findBy(['roadNumber' => $roadNumber], array('roadStart' => 'ASC'));
            $jobLength = $finish - $start;
            foreach ($roads as $road){
                //patenka tik i kazkurio virudi
                if(($start >= $road->getRoadStart()) && ($finish <= $road->getRoadFinish()) ){
                    $completedJob = new CompletedJobs();
                    $completedJob->setStart($start);
                    $completedJob->setFinish($finish);
                    $completedJob->setJobName($jobname);
                    $completedJob->setJobCypher($jobcypher);
                    $completedJob->setMeasurement($measurement);
                    $completedJob->setQuantity($quantity);
                    $completedJob->setRoadName($form->get('roadName')->getData());
                    $entityManager->persist($completedJob);
                    break;

                }
                //pirmoji atkarpa
                elseif ( ($start >= $road->getRoadStart()) && ($finish >= $road->getRoadFinish()) && ($road->getRoadFinish() > $start) ){
                    $completedJob = new CompletedJobs();
                    $completedJob->setStart($start);
                    $completedJob->setFinish($road->getRoadFinish());
                    $completedJob->setJobName($jobname);
                    $completedJob->setJobCypher($jobcypher);
                    $completedJob->setMeasurement($measurement);
                    $q = (($completedJob->getFinish() - $completedJob->getStart()) / $jobLength)*$quantity;
                    $completedJob->setQuantity($q);
                    $completedJob->setRoadName($form->get('roadName')->getData());
                    $entityManager->persist($completedJob);
                    continue;

                }
                //viduryje
                elseif ( ($start < $road->getRoadStart()) && ($finish > $road->getRoadFinish()) ){
                    $completedJob = new CompletedJobs();
                    $completedJob->setStart($road->getRoadStart());
                    $completedJob->setFinish($road->getRoadFinish());
                    $completedJob->setJobName($jobname);
                    $completedJob->setJobCypher($jobcypher);
                    $completedJob->setMeasurement($measurement);
                    $q = (($completedJob->getFinish() - $completedJob->getStart()) / $jobLength)*$quantity;
                    $completedJob->setQuantity($q);
                    $completedJob->setRoadName($form->get('roadName')->getData());
                    $entityManager->persist($completedJob);
                    continue;

                }
                //pabaigoje
                elseif ( ($start <= $road->getRoadStart()) && ($finish <= $road->getRoadFinish()) ){
                    $completedJob = new CompletedJobs();
                    $completedJob->setStart($road->getRoadStart());
                    $completedJob->setFinish($finish);
                    $completedJob->setJobName($jobname);
                    $completedJob->setJobCypher($jobcypher);
                    $completedJob->setMeasurement($measurement);
                    $q = (($completedJob->getFinish() - $completedJob->getStart()) / $jobLength)*$quantity;
                    $completedJob->setQuantity($q);
                    $completedJob->setRoadName($form->get('roadName')->getData());
                    $entityManager->persist($completedJob);
                    break;
                }
            }


            $entityManager->flush();

            return $this->redirectToRoute('completed_jobs_index');
        }

        return $this->render('completed_jobs/new.html.twig', [
            'completed_job' => $completedJob,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="completed_jobs_show", methods={"GET"})
     */
    public function show(CompletedJobs $completedJob): Response
    {
        return $this->render('completed_jobs/show.html.twig', [
            'completed_job' => $completedJob,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="completed_jobs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CompletedJobs $completedJob): Response
    {
        $form = $this->createForm(CompletedJobsType::class, $completedJob);
        $form->get('job')->setData($completedJob->getJobCypher().'; '.$completedJob->getJobName());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('completed_jobs_index');
        }

        return $this->render('completed_jobs/edit.html.twig', [
            'completed_job' => $completedJob,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="completed_jobs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CompletedJobs $completedJob): Response
    {
        if ($this->isCsrfTokenValid('delete'.$completedJob->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($completedJob);
            $entityManager->flush();
        }

        return $this->redirectToRoute('completed_jobs_index');
    }
}
