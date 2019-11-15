<?php


namespace App\Controller;


use App\Repository\DegreeRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home.index")
     */
    public function index(DegreeRepository $degreeRepository,
                            YearRepository $yearRepository,
                            Request $request)
    {
        // Affichage du formulaire de recherche
        $templateData = [];

        // Traitement de la recherche si le formulaire est soumis
        if ($request -> request -> count()) {
            $degree = $request -> request -> get('degree');
            $year = $request -> request -> get('year');

        }

        $templateData['degrees'] = $degreeRepository -> findBy([], ['name' => 'ASC']);
        $templateData['years'] = $yearRepository -> findBy([], ['title' => 'DESC']);

        return $this -> render('home.html.twig', $templateData);
    }
}