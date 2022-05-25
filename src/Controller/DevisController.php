<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Form\DevisType;
use App\Entity\ClientSearch;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevisController extends AbstractController
{
    /**
     * @Route("/devis", name="app_devis", methods={"GET", "POST"})
     */
    public function newDevis(Request $request, EntityManagerInterface $entityManager): Response
    {
        $devi = new Devis();
        $devi ->setDate(new \DateTime('now'));
        $forms = $this->createForm(DevisType::class, $devi);
        $forms->handleRequest($request);

        if ($forms->isSubmitted() && $forms->isValid()) {
            $entityManager->persist($devi);
            $entityManager->flush();
            $session = new Session();
            $session->set("idDevis", $devi->getId());

            return $this->redirectToRoute('app_tailler', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis/index.html.twig', [
            'devi' => $devi,
            'forms' => $forms
        ]);
    }
}
