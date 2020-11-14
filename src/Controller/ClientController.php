<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RequestContext;

/**
 * @Route("/client")
 * Class Client
 * @package App\Controller
 */
class ClientController extends AbstractController
{
    private $request;
    function __construct( RequestContext $req )
    {
        $this->request = $req;
    }
    /**
     * @Route("/info/{nom}", name="client_info")
     * @param $nom
     * @return Response
     */
    function info( $nom )
    {
        $host = $this->request->getHost();
        return $this->render('monTemplate.html.twig',['nom'=>$nom, 'host'=>$host]);
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

    /**
     * @Route("/affiche/{nom}", name="client_affiche_photo")
     * @param $nom
     * @return Response
     */
    function affichePhoto( $nom )
    {
        return $this->render('_affiche_photo.html.twig', ['nom'=>$nom]);
    }
}