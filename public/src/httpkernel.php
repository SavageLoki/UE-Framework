<?php
require_once __DIR__ . '/../../vendor/autoload.php';

// Un controler pour faire fonctionner l'exemple
use Symfony\Component\HttpFoundation\Response;
class MonController
{
    public function yop()
    {
        return new Response('<html><body>Good</body></html>');
    }
}

// Ajout du listener pour l'évenement kernel.request
// Son rôle est d'initialiser le paramêtre _controller
use Symfony\Component\EventDispatcher\EventDispatcher;
use \Symfony\Component\HttpKernel\Event\RequestEvent;

$dispatcher = new EventDispatcher();

$listener = function( RequestEvent $e ){
    $e->getRequest()->attributes->add(['_controller'=>[new MonController(), 'yop']]);
};

$dispatcher->addListener('kernel.request', $listener );



// Déclanchement de la pile d'événement pour une application web
//
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

$kernel = new HttpKernel($dispatcher, new ControllerResolver() , new RequestStack(), null);

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);