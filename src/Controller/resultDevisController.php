<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class resultDevisController extends AbstractController
{
    /**
     * @Route("/resultDevis", name="resultDevis")
     */
    public function index(): Response
    {
        $session = new Session();
        $choix = $session->get('choix');

        $request = Request::createFromGlobals();
        $mesure = $request->get('mesure');
        $longueur = $request->get('longueur');
        $hauteur = $request->get('hauteur');

        $prixHaie = 0;
        switch ($mesure) {
            case "Laurier":
                $prixHaie = 30;
                break;
            case "Thuya":
                $prixHaie = 35;
                break;
            case "Troène":
                $prixHaie = 28;
                break;
            case "Abélia":
                $prixHaie = 25;
                break;
        }
        
        $total = $prixHaie * $longueur;
        if ($hauteur > 1.5) {
            $total = $total * 1.5;
        }
        $montantRemise = 0;
        $remise = 0;
        if ($choix == "Entreprise") {
            $remise = 10;
            $montantRemise = $total / 10;
            $total = $total - $montantRemise;
        }
        return $this->render(
            'resultDevis/index.html.twig',
            array(
                'choix' => $choix, 'longueur' => $longueur, 'hauteur' => $hauteur, 'mesure' => $mesure, 'remise' => $remise, 'montantRemise' => $montantRemise, 'total' => $total
            )

        );
    }
}
