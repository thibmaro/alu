<?php

namespace App\Controller\Admin;

use App\Repository\DegreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin.index")
     */
    public function index(DegreeRepository $degreeRepository)
    {
        $templateData = [];
        $templateData['degrees'] = $degreeRepository -> findAll();
        return $this -> render('admin/index.html.twig', $templateData);
    }
}