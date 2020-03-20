<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Stat;
use App\Form\CountryType;
use App\Repository\StatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    /**
     * @Route("", name="country_index")
     */
    public function index(StatRepository $stats)
    {

        $countries = $this->getDoctrine()->getRepository(Country::class)->findAll();
        $stats = $this->getDoctrine()->getRepository(Stat::class)->findAll();

        return $this->render('country/index.html.twig', [
            'countries' => $countries,
            'stats' => $stats
        ]);
    }

    /**
     * @Route("/country/new", name="country_new", methods={"GET", "POST"})
     */
    public function new(Request $request)
    {

        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $country = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($country);
            $entityManager->flush();

            return $this->redirectToRoute('country_index');
        }

        return $this->render('country/new.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
