<?php
require_once "../vendor/autoload.php";


$loader = new \Twig\Loader\FilesystemLoader( __DIR__.'/views/');
$envTwig = new \Twig\Environment($loader);

echo $envTwig->render(
    'monTemplate.html.twig',
    ['msg'=>'Bonjour']
);