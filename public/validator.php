<?php

require_once "../vendor/autoload.php";

$validateur = \Symfony\Component\Validator\Validation::createValidator();


$contrainte = new \Symfony\Component\Validator\Constraints\NotBlank();

$resultat = $validateur->validate('r', $contrainte);

if (count($resultat) > 0) {
    /** @var Symfony\Component\Validator\ConstraintViolation $erreur */
    foreach ($resultat as $erreur) {
        echo $erreur->getMessage();
    }
} else "Test passé avec succés";


