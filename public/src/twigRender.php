<?php
require_once __DIR__.'/../../vendor/autoload.php';

try {
    $load = new Twig\Loader\FilesystemLoader( __DIR__.'/../views/');
    $env = new Twig\Environment($load);

    echo $env->render(
        'firstTemplate.html.twig',
        array('msg' => 'Mise en place d\'un mécanisme de template')
    );
} catch (\Twig\Error\Error $error ) {
    echo $error->getMessage();
}