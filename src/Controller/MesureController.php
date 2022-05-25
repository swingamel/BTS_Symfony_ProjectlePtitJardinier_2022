<?php

namespace App\Controller;

use App\Repository\HaieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class MesureController extends AbstractController
{
    /**
     * @Route("/mesure", name="mesure")
     */
    public function index(HaieRepository $haieRepository): Response
    {
        $session = new Session();
        $request = Request::createFromGlobals();

        $choix = $request->get('choix');

        $session->set('choix', $choix);

        $haies = $haieRepository->findAll();

        return $this->render('mesure/index.html.twig', [
            'controller_name' => 'MesureController',
            'haies' => $haies
        ]);
    }
}