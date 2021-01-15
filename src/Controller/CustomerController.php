<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customer", name="customer")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $user = new Customer();
        $form = $this->createForm(CustomerType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

        }


        return $this->render('customer/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/donnees/{id}", name="donnees")
     */
    public function data (Customer $customer):Response {


        return $this->render('customer/data.html.twig', [
            'data' => $customer,
        ]);
    }
}
