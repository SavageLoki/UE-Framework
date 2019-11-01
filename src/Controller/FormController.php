<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;
use Twig\Environment;

class FormController extends AbstractController
{
    /**
     * @Route("/form/inscription", name = "form_affiche")
     *
     * @return Response
     */
    public function inscription()
    {
        $builder = $this->createFormBuilder();
        $builder->add( 'login', TextType::class, [
            'constraints' => new NotBlank()
        ]);
        $builder->add('ok', SubmitType::class);
        $form = $builder->getForm();

        return $this->render('form.html.twig', ['leForm' => $form->createView()]);
    }
}