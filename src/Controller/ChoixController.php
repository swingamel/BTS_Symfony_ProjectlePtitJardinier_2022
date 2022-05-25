<?php

namespace App\Controller;

use App\Repository\TypeClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoixController extends AbstractController
{
    /**
     * @Route("/choix", name="choix")
     */
    public function index(TypeClientRepository $TypeClientRepository): Response
    {
        $typeClient = $TypeClientRepository->findAll();

        return $this->render('choix/index.html.twig', [
            'controller_name' => 'ChoixController',
            'typeClient' => $typeClient
        ]);
    }
}
