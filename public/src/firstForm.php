<?php
require_once __DIR__.'/../../vendor/autoload.php';


use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

$validator = Validation::createValidator();

$translator = new Translator('fr');
$translator->addLoader('xlf', new XliffFileLoader());
$translator->addResource(
    'xlf',
    __DIR__.'/../../vendor/symfony/validator/Resources/translations/validators.fr.xlf',
    'fr'
);

$formFactory = Forms::createFormFactoryBuilder()
    ->addExtension(new ValidatorExtension($validator))
    ->getFormFactory();

$builder = $formFactory->createBuilder();

$builder->add( 'login', TextType::class, [
    'constraints' => new NotBlank()
]);

$builder->add('ok', SubmitType::class);

$form = $builder->getForm();

$form->handleRequest();

if ($form->isSubmitted() && $form->isValid()) {
    $data = $form->getData();
    print_r( $data );
} else {
    $views = $form->createView();
    $iterator = $views->getIterator();
    while($iterator->valid()) {
        /** @var Symfony\Component\Form\FormView $formView */
        $formView = $iterator->current();
        /** @var Symfony\Component\Form\FormErrorIterator $iterErrors */
        $iterErrors = $formView->vars['errors'];
        if ( $iterErrors !== null ) {
            while ($iterErrors->valid()) {
                echo $translator->trans( $iterErrors->current()->getMessage() );
                $iterErrors->next();
            }
        }
        $iterator->next();
    }
}