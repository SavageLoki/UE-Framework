<?php


namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $contrainte = new NotBlank();

        $builder->add('nom', TextType::class,[
            'constraints'=>[$contrainte, new Length(['min'=>2,'minMessage'=>'Too Short only {{ value }} chars instead of {{ limit }}'])]
        ])
            ->add('btSubmit', SubmitType::class);
    }
}