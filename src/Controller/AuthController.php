<?php


namespace App\Controller;


use App\Constraints\PasswordConstraint;
use App\Entity\Login;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class AuthController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/login", name="auth_login")
     * @return Response
     */
    public function login(Request $request)
    {

        $builder = $this->createFormBuilder();
        $contrainte = new NotBlank();
        $pwdConstraint = new PasswordConstraint();
        $isEmail = new Email();

        $user = new Login();

        $builder->add('mail', TextType::class, [
            'constraints' => [$contrainte, $isEmail]
        ])
            ->add('password', RepeatedType::class, [
                'constraints' => [$pwdConstraint],
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ]);

        $form = $builder->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return new Response("Le formulaire est valide");
        } else {
            $infoRendu = $form->createView();
            return $this->render("login.html.twig", ["infoForm" => $infoRendu, "errors" => $form->getErrors()]);
        }
    }
}