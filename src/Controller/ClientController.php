<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 * Class ClientController
 * @package App\Controller
 */
class ClientController
{
    /**
     * @Route("/prenom/{nom}", name="client_info")
     * @param $nom
     * @return Response
     */
    function info ($nom)
    {
        return new Response("Le prenom de $nom est Tintin");
    }


}