<?php


namespace App\Controller;

use App\Service\FormInscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/form", name = "form_")
 *
 * Class FormController
 * @package App\Controller
 */
class FormController extends AbstractController
{
    private $formInscription;

    public function __construct( FormInscription $form )
    {
        $this->formInscription = $form->getForm();
    }

    /**
     * @Route("/inscription", name = "affiche")
     *
     * @return Response
     */
    public function inscription( Request $request)
    {
        $this->formInscription->handleRequest($request);
        if ($this->formInscription->isSubmitted() && $this->formInscription->isValid())
        {
            return $this->render( 'form/confirmation.html.twig', ['valeursSaisies' => $this->formInscription->getData()]);
        } else {
            return $this->render('form/inscription.html.twig', ['leForm' => $this->formInscription->createView()]);
        }
    }
}