<?php

namespace App\Controller;

use App\Form\HaieType;
use App\Entity\Haie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ModifierHaieController extends AbstractController
{
    /**
     * @Route("/modifier/haie/{code}", name="modifier_haie")
     */
    public function index(Haie $haie, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(HaieType::class, $haie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($haie);
            $em->flush();
            $this->addFlash('success', 'La haie a bien été modifiée !');
            return $this->redirectToRoute('rechercher', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render(
            'modifier_haie/index.html.twig',
            array('form' => $form->createView())
        );
    }
}
