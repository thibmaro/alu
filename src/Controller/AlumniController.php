<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;

class AlumniController
{
    /**
     * @Route("/alumni/{id}/{slug}", name="alumni.index")
     */
    public function index($id, $slug, UserRepository $userRepository)
    {
        dd($userRepository ->find($id));
    }
}
