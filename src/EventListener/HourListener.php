<?php

namespace App\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Routing\RouterInterface;

class HourListener
{
    private $router;
    private $container;

    /**
     * HourListener constructor.
     * @param RouterInterface $router
     * @param $container
     */
    public function __construct(RouterInterface $router, ContainerInterface $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function onKernelController(ControllerEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $route = $request->get("_route");

        $option = $this->router->getRouteCollection()->get($route)->getOption("ouverture");

        $controller = $this->container->get('App\Controller\ClosedController');
        $heure = explode("-", $option);

        //$heure1 = (int)$heure[0];
        //$heure2 = (int)$heure[1];


        //if (date('G') < $heure1|| date('G') > $heure2) {
        //   $event->setController([$controller, 'fermeture']);
       //}


    }
}