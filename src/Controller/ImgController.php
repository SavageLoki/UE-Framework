<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImgController extends AbstractController
{
    const PATH_IMG = __DIR__."/../../images";
    /**
     * @Route("/img/home", name="img_home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home() {
        return $this->render('img/home.html.twig',[]);
    }

    /**
     * @Route("/img/data/{nom}", name="img_affiche")
     *
     * @param $num
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function affiche( $nom )
    {
        $filename = self::PATH_IMG."/$nom.jpg";
        if ( ! file_exists($filename) )
            throw $this->createNotFoundException('Image non trouvée');
        return $this->file($filename);
    }
}