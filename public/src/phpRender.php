<?php
require_once __DIR__.'/../../vendor/autoload.php';

use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

$filesystemLoader = new FilesystemLoader(__DIR__.'/../views/%name%');
$templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);
echo $templating->render(
    'firstTemplate.html.php',
    array('msg' => 'Mise en place d\'un mécanisme de template')
);