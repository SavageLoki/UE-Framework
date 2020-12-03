<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="auth_login")
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $builder = $this->createFormBuilder();
        $contrainte = new NotBlank();


        $builder->add('nom', TextType::class,[
            'constraints'=>[$contrainte, new Length(['min'=>2,'minMessage'=>'Too Short only {{ value }} chars instead of {{ limit }}'])]
        ])
            ->add('btSubmit', SubmitType::class);

        $form = $builder->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->forward('App\Controller\AuthController::welcome');
        } else {
            $infoRendu = $form->createView();
            return $this->render("login.html.twig", ["infoForm" => $infoRendu]);
        }
    }

    /**
     * @Route("/welcome", Name="auth_welcome")
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function welcome( TranslatorInterface $translator)
    {
        return new Response($translator->trans("Welcome"));
    }
}