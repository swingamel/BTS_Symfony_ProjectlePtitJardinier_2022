<?php

namespace App\Controller;

use App\Entity\Tailler;
use App\Form\TaillerAjoutType;
use App\Form\TaillerModifType;
use App\Entity\Devis;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class TaillerController extends AbstractController
{
    /**
     * @Route("/tailler", name="app_tailler", methods={"GET", "POST"})
     */
    public function newTailler(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tailler = new Tailler();
        $form = $this->createForm(TaillerAjoutType::class, $tailler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = new Session();
            $idDevis = $session->get("idDevis");
            $devis = $this->getDoctrine()
                ->getRepository(Devis::class)
                ->find($idDevis);
            $tailler->setDevis($devis);
            $entityManager->persist($tailler);
            $entityManager->flush();

            $newPageUrl = $this->generateUrl('app_consultation_devis');
            $this->addFlash(
                'success',
                sprintf('Si vous voulez finir votre devis, <a href="%s">cliquer ici ! </a> </br> </br>Vous pouvez également poursuivre votre sélection ci-dessous', $newPageUrl)
            );
            return $this->redirectToRoute('app_tailler', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tailler/index.html.twig', [
            'tailler' => $tailler,
            'form' => $form
        ]);
    }

    /**
     * @Route("/modif/tailler/{id}", name="app_modif_devis_tailler")
     */
    public function modif(Tailler $tailler, Request $request, EntityManagerInterface $em)
    {

        $forms = $this->createForm(TaillerModifType::class, $tailler);
        $forms->handleRequest($request);

        if ($forms->isSubmitted() && $forms->isValid()) {
            $em->persist($tailler);
            $em->flush();
            $this->addFlash('success', 'Le devis a bien été modifié !');
            return $this->redirectToRoute('app_consultation_devis', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render(
            'tailler/modif.html.twig',
            array('forms' => $forms->createView())
        );
    }

    /**
     * @Route("/delete/tailler/{id}", name="tailler_devis_delete", methods={"POST"})
     */
    public function deleteTailler(Request $request, Tailler $tailler, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tailler->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tailler);
            $entityManager->flush();
        }

        $this->addFlash('delete', 'Le devis a bien été supprimé !');
        return $this->redirectToRoute('app_consultation_devis', [], Response::HTTP_SEE_OTHER);
    }
}
