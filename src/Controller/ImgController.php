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

    /**
     * @Route("/img/menu", name="img_menu")
     *
     * @return Response
     */
    public function menu()
    {
        $listeImages = scandir(self::PATH_IMG);
        foreach ( $listeImages as $key => $pathName ) {
            if ( is_dir( $pathName ) )
                unset( $listeImages[$key]); // on retire les . et .. de la liste
            else
                $listeImages[$key] = substr($pathName, 0, -4 ); // on retire l'extension .jpg
        }
        return $this->render('img/menu.html.twig', [
            'url' => '/img/data/',
            'items'=> $listeImages
        ]);
    }
}