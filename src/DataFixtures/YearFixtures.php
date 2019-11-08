<?php

namespace App\DataFixtures;

use App\Entity\Year;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class YearFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($year = date('Y') - 10 ; $year < date('Y') + 1 ; $year++) {
            $entity = new Year();
            $entity -> setTitle($year . '/' . ($year+1));
            $manager -> persist($entity);
        }

        $manager->flush();
    }
}
