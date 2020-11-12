<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 * Class Client
 * @package App\Controller
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/info/{nom}", name="client_info")
     * @param $nom
     * @return Response
     */
    function info( $nom )
    {
        $urlPhoto = $this->generateUrl('client_photo', ['nom'=>$nom]);
        return new Response("Le prénom de $nom est Tintin <img src=\"$urlPhoto\"\>");
    }

    /**
     * @Route("/photo/{nom}", name="client_photo")
     * @param $nom
     * @return BinaryFileResponse
     */
    function photo( $nom )
    {
        return new BinaryFileResponse(__DIR__."/../../data/tintin.png");
    }
}