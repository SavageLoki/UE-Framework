<?php
require_once "../vendor/autoload.php";


$validateur = \Symfony\Component\Validator\Validation::createValidator();

$contrainte = new \Symfony\Component\Validator\Constraints\NotBlank();

$resultat = $validateur->validate('', $contrainte);

if ( count($resultat) > 0 ) {
    /** @var Symfony\Component\Validator\ConstraintViolation $error */
    foreach ($resultat as $error) {
        echo $error->getMessage();
    }
} else {
    echo "Test passé avec succes";
}