<?php

namespace App\Controller;

use App\Repository\HaieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class RechercherController extends AbstractController
{
    /**
     * @Route("/rechercher", name="rechercher")
     */
    public function index(HaieRepository $haieRepository): Response
    {
        $haies = $haieRepository->findAll();

        return $this->render('rechercher/index.html.twig', [
            'controller_name' => 'RechercherController',
            'haies' => $haies
        ]);
    }
}
