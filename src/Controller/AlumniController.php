<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AlumniController extends AbstractController
{
    /**
     * @Route("/alumni/{id}/{slug}", name="alumni.index")
     */

    public function index(User $user, $slug)
    {
//        dd($user);
        return $this -> render('alumni/index.html.twig', [
            'user' => $user
        ]);
    }

//    Ancienne version, à titre d'exemple pour illustrer
//    public function index($id, $slug, UserRepository $userRepository)
//    {
//        dd($userRepository ->find($id));
//    }

}
