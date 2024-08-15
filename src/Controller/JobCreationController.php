<?php
// src/Controller/JobCreationController.php
namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobCreationController extends AbstractController
{
    #[Route('/job/new', name: 'job_new')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job_list');
        }

        return $this->render('job_creation/new.html.twig', [
            'jobForm' => $form->createView(),
        ]);
    }

    #[Route('/job/{id}/edit', name: 'job_edit')]
    public function edit(Job $job, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('job_list');
        }

        return $this->render('job_creation/edit.html.twig', [
            'jobForm' => $form->createView(),
        ]);
    }

    #[Route('/job/{id}/delete', name: 'job_delete', methods: ['POST'])]
    public function delete(Job $job, EntityManagerInterface $em): Response
    {
        $em->remove($job);
        $em->flush();

        return $this->redirectToRoute('job_list');
    }
}
