<?php


namespace App\Controller;


use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController
{
    /**
     * @Route("/avatar", name="avatar.index")
     */
    function getAvatar(FileSystemHelper $fileSystemHelper)
    {
        $svgRenderer = new SvgAvatarFactory('../templates/avatar.svg.tpl');
        //Génération de l'avatar
        $svg = SvgAvatarFactory::getAvatar(2, 5);

        dd($svg);
    }
}