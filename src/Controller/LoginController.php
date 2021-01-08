<?php


namespace App\Controller;


use App\Entity\Login;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route("/auth", name="auth")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {

        $dataEntity = new Login();

        $form = $this->createForm(LoginType::class, $dataEntity, ['action' => $this->generateUrl('auth'),
            'method' => 'POST'
        ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get("email")->getData();
            $password = $form->get("password")->getData();

            if ($email == "insset@insset.fr" && $password == "mdp") {
                return $this->render("connecte.html.twig");
            } else {
                return $this->render("notconnect.html.twig");
            }
        } else {
            $rendu = $form->createView();
            return $this->render("auth.html.twig", ["loginForm" => $rendu]);

        }
    }
}

