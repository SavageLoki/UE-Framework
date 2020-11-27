<?php


namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonPremierController
{
    /**
     * @Route("/index")
     *
     * @return Response
     */
    public function maPremiereReponse()
    {
        $maReponse = new Response();

        $maReponse->setStatusCode(\Symfony\Component\HttpFoundation\Response::HTTP_OK);
        $maReponse->headers->set('Content-Type', 'text/html');
        $maReponse->setContent('<html><title>Reponse</title><body>Resultat dun objet reponse</body></html>');
        return $maReponse;
    }
}