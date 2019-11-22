<?php


namespace App\Controller\Admin;


use App\Form\DegreeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminDegreeController extends AbstractController
{
    /**
     * @Route("/admin/degree/new", name="admin.degree.new")
     */
    public function new(Request $request)
    {
        $form = $this -> createForm(DegreeFormType::class);
        $form -> handleRequest($request);

        $entityManager = $this -> getDoctrine() -> getManager();

        if ($form -> isSubmitted() && $form -> isValid()) {

            $degree = $form ->getData();

            $manager = $this ->getDoctrine() -> getManager();
            $manager ->persist($degree);
            $manager -> flush();

        return $this -> redirectToRoute('admin.index');
        }

        return $this -> render('admin/degree/new.html.twig', [
            'form' => $form -> createView()
        ]);
    }

}