<?php

namespace App\Controller;

use App\Entity\Haie;
use App\Form\HaieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CreerHaieController extends AbstractController
{
    /**
     * @Route("/creer/haie", name="creerHaie")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $haie = new Haie();
        $form = $this->createForm(HaieType::class, $haie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($haie);
            $entityManager->flush();

            $this->addFlash('success', 'La haie a bien été créé !');
            return $this->redirectToRoute('rechercher', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('creerHaie/index.html.twig', [
            'haie' => $haie,
            'form' => $form,
        ]);
    }
}
