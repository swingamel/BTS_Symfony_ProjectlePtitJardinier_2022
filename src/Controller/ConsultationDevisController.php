<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DevisRepository;
use App\Repository\TaillerRepository;

class ConsultationDevisController extends AbstractController
{
    /**
     * @Route("/consultation/devis", name="app_consultation_devis")
     */
    public function index(TaillerRepository $taillerRepository): Response
    {
        $tailler = $taillerRepository->findAll();

        return $this->render('consultation_devis/index.html.twig', [
            'controller_name' => 'ConsultationDevisController',
            'tailler' => $tailler
        ]);
    }
}
