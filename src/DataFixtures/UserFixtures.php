<?php

namespace App\DataFixtures;


use App\Entity\Promotion;
use App\Entity\User;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;



class UserFixtures extends BaseFixture implements DependentFixtureInterface
{
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            PromotionFixtures::class
        ];
    }

    private $svgAvatarFactory;

    /**
     * @var FileSystemHelper
     */
    private $fileSystemHelper;
    private $uploadPath;

    function __construct(SvgAvatarFactory $svgAvatarFactory, FileSystemHelper $fileSystemHelper, $uploadPath)
    {
        parent::__construct();

        $this -> svgAvatarFactory = $svgAvatarFactory;
        $this -> fileSystemHelper = $fileSystemHelper;
        $this -> uploadPath = $uploadPath;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i ++) {
            $user = new User();
            $manager -> persist($user);

            /* firstname : */ $user -> setFirstname($faker -> firstName);
            /* lastname  : */ $user -> setLastname($faker -> lastName);
            /* email     : */ $user -> setEmail($faker -> email);
            /* city      : */ $user -> setCity($faker -> city);
            /* password  : */ $user -> setPassword(password_hash($faker -> password, PASSWORD_DEFAULT));
            /* birthdate : */ $date = rand(1950, 2000).'-'.$faker ->month.'-'.$faker -> dayOfMonth;
                             $user -> setBirthdate(new \DateTime($date));


            $svg = $this -> svgAvatarFactory -> getAvatar(2, 5);
            $filename = sha1(uniqid(rand())) . '.svg';
            $filePath = $this -> uploadPath . '/' . SvgAvatarFactory::AVATAR_DIR . '/' . $filename;
            $this -> fileSystemHelper -> write($filePath, $svg);
            $user -> setAvatar($filename);



                    $promotions = $this -> getReferences('Promotion');
                    $promotions = $faker -> randomElements($promotions, rand(1, 2));

                    foreach ($promotions as $promotion) {
                        $user -> addPromotion($promotion);
                    }
        }
        $manager->flush();
    }
}
