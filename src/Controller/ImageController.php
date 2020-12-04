<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route ("/img", name="img")
 */
class ImageController extends AbstractController
{



    /**
     * @Route ("/home", name="img_home")
     * @return Response
     */
    function home()
    {
       return $this->render('home.html.twig');
    }

    /**
     * @Route ("/data/{animal}", name="img_data")
     */
    function affiche($animal)
    {

        if (!file_exists(__DIR__ ."/../../images/${animal}")) {
            return $this->render('erreur.html.twig');
        } else {
            return $this->file(__DIR__ . "/../../images/${animal}");
        }
    }

    /**
     * @Route("/photo/liste", name="img_liste")
     */
    public function menu()
    {
        $listElement = scandir(__DIR__."/../../images/");
        $listImages = [];

        foreach ($listElement as $element) {
            if ((is_dir($element)) == false) {
                array_push($listImages, $element);
            }
        }
        return $this->render('_menu.html.twig', ['menuListe'=>$listImages]);



    }




}