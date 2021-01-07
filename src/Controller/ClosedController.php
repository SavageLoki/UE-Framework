<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/closed")
 * Class ClosedController
 * @package App\Controller
 */
class ClosedController extends AbstractController
{
    public function fermeture ( ): Response {
        return new Response("Le site n'est pas accessible");
    }
}