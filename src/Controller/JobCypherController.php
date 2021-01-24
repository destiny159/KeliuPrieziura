<?php

namespace App\Controller;

use App\Entity\JobCypher;
use App\Form\JobCypherType;
use App\Repository\JobCypherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job/cypher")
 */
class JobCypherController extends AbstractController
{
    /**
     * @Route("/", name="job_cypher_index", methods={"GET"})
     */
    public function index(JobCypherRepository $jobCypherRepository): Response
    {
        return $this->render('job_cypher/index.html.twig', [
            'job_cyphers' => $jobCypherRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="job_cypher_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobCypher = new JobCypher();
        $form = $this->createForm(JobCypherType::class, $jobCypher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobCypher);
            $entityManager->flush();

            return $this->redirectToRoute('job_cypher_index');
        }

        return $this->render('job_cypher/new.html.twig', [
            'job_cypher' => $jobCypher,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_cypher_show", methods={"GET"})
     */
    public function show(JobCypher $jobCypher): Response
    {
        return $this->render('job_cypher/show.html.twig', [
            'job_cypher' => $jobCypher,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_cypher_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobCypher $jobCypher): Response
    {
        $form = $this->createForm(JobCypherType::class, $jobCypher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_cypher_index');
        }

        return $this->render('job_cypher/edit.html.twig', [
            'job_cypher' => $jobCypher,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_cypher_delete", methods={"DELETE"})
     */
    public function delete(Request $request, JobCypher $jobCypher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobCypher->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobCypher);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_cypher_index');
    }
}
