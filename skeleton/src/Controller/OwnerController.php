<?php

namespace App\Controller;

use App\Entity\Owner;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class OwnerController extends AbstractController
{

    #[Route('/owner', name: 'app_owner', methods: 'POST')]
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {

        $entityManager = $doctrine->getManager();

        $project = new Owner();

        $project->setFirstName($request->request->get('firstname'));
        $project->setLastName($request->request->get('lastname'));
        $project->setEmail($request->request->get('email'));
        $project->setPhone($request->request->get('phone'));

        $entityManager->persist($project);

        $entityManager->flush();

        return $this->json('Created new owner successfully with id ' . $project->getId());
    }
}
