<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Stat;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    /**
     * @Route("/", name="country_index")
     */
    public function index()
    {
        $countries = $this->getDoctrine()->getRepository(Country::class)->findBy([], ['name' => "ASC"]);

        return $this->render('country/index.html.twig', [
            'countries' => $countries,
        ]);
    }

    /**
     * @Route("/country/{country}", name="country_show", methods={"GET"}, requirements={"country"="\d+"})
     * @param Country $country
     */
    public function show(Country $country)
    {
        $date = $this->getDoctrine()->getRepository(Stat::class)->findBy([], ['statDate' => "ASC"]);

        dd($date);

        return $this->render('country/show.html.twig', [
            'date' => $date,
            'country' => $country,
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

            return $this->render('country/new.html.twig', [
                'form' => $form->createView()
            ]);
        }

        return $this->render('country/new.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
