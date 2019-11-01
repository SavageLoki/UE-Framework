<?php


namespace App\Controller;

use App\Service\FormInscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


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
    public function inscription()
    {
        return $this->render('form/inscription.html.twig', ['leForm' => $this->formInscription->createView()]);
    }
}