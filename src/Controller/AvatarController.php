<?php


namespace App\Controller;


use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController extends AbstractController
{
    /**
     * @var SvgAvatarFactory
     */
    private $svgAvatarFactory;

    public function __construct(SvgAvatarFactory $svgAvatarFactory)
    {
        $this->svgAvatarFactory = $svgAvatarFactory;
    }

    /**
     * @Route("/avatar", name="avatar.index")
     */
    function getAvatar($uploadDir, FileSystemHelper $fileSystemHelper)
    {
        //Génération de l'avatar
        $svg = $this->svgAvatarFactory->getAvatar(2, 5);

        //génère un nom unique
        $filename = sha1(uniqid(rand(), true)).'.svg';
        $fileSystemHelper ->write($uploadDir.'/avatars/'.$filename, $svg);
        return $this->render('avatar.html.twig', [
            "filename"=> $filename
        ]);
    //  dd($svg);
    }
}