<?php


namespace App\Controller;


use App\Repository\DegreeRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home.index")
     */
    public function index(DegreeRepository $degreeRepository,
                            YearRepository $yearRepository)
    {
        $templateData = [];

        $templateData['degrees'] = $degreeRepository -> findBy([], ['name' => 'ASC']);
        $templateData['years'] = $yearRepository -> findBy([], ['title' => 'DESC']);

        return $this->render('home.html.twig', $templateData);
    }
}