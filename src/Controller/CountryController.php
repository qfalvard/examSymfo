<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    /**
     * @Route("", name="country_index")
     */
    public function index()
    {
        $countries = $this->getDoctrine()->getRepository(Country::class)->findAll();

        return $this->render('country/index.html.twig', [
            'countries' => $countries,
        ]);
    }

    /**
     * @Route("/country/new", name="country_new", methods={"GET"})
     */
    public function new()
    {

        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);

        return $this->render('country/new.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
