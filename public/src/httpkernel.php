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
    public function helloToto()
    {
        return new Response('<html><body>Hello Toto</body></html>');
    }
}

// définition de la collection de routes
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

$fileLocator = new FileLocator([__DIR__]);
$loader = new YamlFileLoader($fileLocator);
$routes = $loader->load('route.yaml');


// Ajout du listener pour l'évenement kernel.request
// Son rôle est d'initialiser le paramêtre _controller
use Symfony\Component\EventDispatcher\EventDispatcher;
use \Symfony\Component\HttpKernel\Event\RequestEvent;
use \Symfony\Component\Routing\Matcher\UrlMatcher;
use \Symfony\Component\Routing\RequestContext;

$dispatcher = new EventDispatcher();

$listener = function( RequestEvent $event ){
    global $routes;
    $uri = $event->getRequest()->getRequestUri();
    $matcher = new UrlMatcher($routes, new RequestContext('/'));
    $rep = $matcher->match($uri);
    $event->getRequest()->attributes->add($rep);
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