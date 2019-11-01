<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Validator\Constraints\NotBlank;

class FormInscription
{
    private $services;
    private $form;

    public function __construct( ContainerInterface $configurator )
    {
        $this->services = $configurator;
        /** @var FormFactory $formFactory */
        $formFactory = $this->services->get('form.factory');
        $builder = $formFactory->createBuilder();
        $builder->add( 'login', TextType::class, [
            'constraints' => new NotBlank()
        ]);
        $builder->add('ok', SubmitType::class);
        $this->form = $builder->getForm();
    }

    public function getForm()
    {
        return $this->form;
    }

}