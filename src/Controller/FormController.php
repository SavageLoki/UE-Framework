<?php


namespace App\Controller;

use App\Entity\Inscription;
use App\Service\FormInscription;
use App\Form\Type\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;


/**
 * @Route("/form", name = "form_")
 *
 * Class FormController
 * @package App\Controller
 */
class FormController extends AbstractController
{
    /**
     * @Route("/inscription", name = "affiche")
     *
     * @return Response
     */
    public function inscription( Request $request)
    {
        $inscription = new Inscription();
        $inscription->setLogin("");
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $session = $request->getSession();
            $session->set('App\Entity\Inscription', $form->getData());
            return $this->redirectToRoute('form_confirme');
        } else {
            return $this->render('form/inscription.html.twig', ['leForm' => $form->createView()]);
        }
    }

    /**
     * @Route("/confirmation", name = "confirme")
     */
    public function confirmation( Request $request )
    {
        $session = $request->getSession();
        if ( ! $session->has('App\Entity\Inscription') )
            throw new NotFoundResourceException( "Pas de données d'inscription !");
        return $this->render( 'form/confirmation.html.twig', ['inscription' => $session->get('App\Entity\Inscription')]);
    }
}