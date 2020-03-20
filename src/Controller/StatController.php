<?php

namespace App\Controller;

use App\Entity\Stat;
use App\Form\StatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    /**
     * @Route("/stat", name="stat")
     */
    public function index()
    {
        return $this->render('stat/index.html.twig', [
            'controller_name' => 'StatController',
        ]);
    }

    /**
     * @Route("/stat/new", name="stat_new", methods={"GET", "POST"})
     */
    public function new(Request $request)
    {
        $stat = new Stat();
        $form = $this->createForm(StatType::class, $stat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stat = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stat);
            $entityManager->flush();

            return $this->redirectToRoute('country_index');
        }

        return $this->render('country/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
