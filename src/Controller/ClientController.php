<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 * Class ClientController
 * @package App\Controller
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/prenom/{nom}", name="client_info")
     * @param $nom
     * @return Response
     */
    function info ($nom)
    {
        return $this->render('monTemplate.html.twig', ['nom'=>$nom]);
    }

    /**
     * @Route ("/photo/{nom}", name="client_photo")
     */
    function photo($nom) {
        return new BinaryFileResponse(__DIR__."/../../data/tintin.png");
    }

    /**
     * @Route ("/affiche/{nom}", name="client_affiche_photo")
     * @param $nom
     * @return Response
     */
    function affichePhoto ($nom) {
        return $this->render('_affiche_photo.html.twig', ['nom'=>$nom]);
    }


}