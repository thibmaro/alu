<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PromotionFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
          DegreeFixtures::class,
          YearFixtures::class
        ];
    }

    public function load(ObjectManager $manager)
    {
        $degrees = $this ->getReferences('Degree');
        $years   = $this -> getReferences('Year');
//        $compteur = 0;
        foreach ($degrees as $degree) {
            foreach ($years as $year) {
                $promotion = new Promotion();
                $promotion -> setDegree($degree);
                $promotion -> setYear($year);
//                $this -> addReference('Promotion_' . $compteur, $promotion );
                $manager -> persist($promotion);
//                $compteur ++;
            }

        }

        $manager->flush();
    }
}
