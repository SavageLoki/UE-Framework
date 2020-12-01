<?php
require_once '../vendor/autoload.php';

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Forms;

$formFactory = Forms::createFormFactory();
$builder = $formFactory->createBuilder();

$builder->add('nom', TextType::class)
    ->add('btSubmit', SubmitType::class);

$form = $builder->getForm();

$form->handleRequest();

if ($form->isSubmitted() ) {
    var_dump($form->getData());
}
