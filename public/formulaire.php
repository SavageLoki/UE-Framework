<?php
require_once '../vendor/autoload.php';

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

$validateur = Validation::createValidator();
$formFactory = Forms::createFormFactoryBuilder()->addExtension( new ValidatorExtension($validateur))->getFormFactory();
//$formFactory = Forms::createFormFactory();
$builder = $formFactory->createBuilder();

$contrainte = new NotBlank();

$builder->add('nom', TextType::class,[
        'constraints'=>$contrainte
])
->add('btSubmit', SubmitType::class);

$form = $builder->getForm();

$form->handleRequest();
if ( $form->isSubmitted() )
    if ($form->isValid())
        var_dump($form->getData());
    else {
        $views = $form->createView();
        $iterator = $views->getIterator();
        while($iterator->valid()) {
            /** @var Symfony\Component\Form\FormView $formView */
            $formView = $iterator->current();
            /** @var Symfony\Component\Form\FormErrorIterator $iterErrors */
            $iterErrors = $formView->vars['errors'];
            if ( $iterErrors !== null ) {
                while ($iterErrors->valid()) {
                    echo $iterErrors->current()->getMessage();
                    $iterErrors->next();
                }
            }
            $iterator->next();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form name="form" action="formulaire.php" method="post">
    <input name="form[nom]" type="text">
    <input name="form[btSubmit]" type="submit">
</form>
</body>
</html>