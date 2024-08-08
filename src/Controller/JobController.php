<?php
namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class JobController extends AbstractController
{
    #[Route('/jobs', name: 'job_list')]
    public function list(JobRepository $jobRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $jobs = $jobRepository->findByTitleOrDescription($search);

        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/job/{id}', name: 'job_item')]
    public function item(Job $job): Response
    {
        return $this->render('job/item.html.twig', [
            'job' => $job,
        ]);
    }

}
