<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $country = new Country();
        $country->setName('France');
        $manager->persist($country);

        $country = new Country();
        $country->setName('Italie');
        $manager->persist($country);

        $country = new Country();
        $country->setName('Allemagne');
        $manager->persist($country);

        $country = new Country();
        $country->setName('Espagne');
        $manager->persist($country);

        $country = new Country();
        $country->setName('Royaume-Uni');
        $manager->persist($country);

        $manager->flush();
    }
}
