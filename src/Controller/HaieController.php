<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Entity\Haie;

class HaieController extends AbstractController
{
    /**
     * @Route("/haie/creer", name="creer_haie")
     */
    public function creer_haie(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $haie = new Haie();
        $haie->setCode('TH');
        $haie->setNom('Thuya');
        $haie->setPrix(35);


        $entityManager->persist($haie);
        $entityManager->flush();
        return new Response('Type de haie créé avec le code ' . $haie->getCode());
    }

    /**
     * @Route("/haie/{code}", name="voir_haie")
     */
    public function voir_haie(string $code): Response
    {
        $haie = $this->getDoctrine()
            ->getRepository(Haie::class)
            ->find($code);

        if (!$haie) {
            return new Response('Ce type de haie n\'existe pas : ' . $code);
        } else {
            return new Response('Type de haie : ' . $haie->getNom() . ' à ' . $haie->getPrix() . '€');
        }
    }

    /**
     * @Route("/haie/modifier/{code}", name="modifier_haie")
     */
    public function modifier_haie(string $code): Response
    {
        $haie = $this->getDoctrine()
            ->getRepository(Haie::class)
            ->find($code);
        $entityManager = $this->getDoctrine()->getManager();

        $haie->setPrix(42);
        $entityManager->flush();

        return $this->redirectToRoute('voir_haie', ['code' => $haie->getCode()]);
    }

    /**
     * @Route("/haie/supprimer/{code}", name="supprimer_haie")
     */
    public function supprimer_haie(string $code): Response
    {
        $haie = $this->getDoctrine()
            ->getRepository(Haie::class)
            ->find($code);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($haie);
        $entityManager->flush();

        return $this->redirectToRoute('voir_haie', ['code' => $haie->getCode()]);
    }

    /**
     * @Route("/haie", name="haie")
     */
    public function index(): Response
    {
        $categorie= new Categorie();
        $categorie->setLibelle('Caduque');
 
        $haie = new Haie();
        $haie ->setCode('TR');
        $haie ->setNom('Troène');
        $haie ->setPrix(25);
 
        // relates this product to the category
        $haie->setCategorie($categorie);
 
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($categorie);
        $entityManager->persist($haie);
        $entityManager->flush();
 
        return new Response(
            'Ajout haie avec code : '.$haie->getCode()
            .' et nouvelle catégorie avec id: '.$categorie->getId()
        );
    }
}
