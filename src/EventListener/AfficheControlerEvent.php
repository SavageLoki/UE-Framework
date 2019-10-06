<?php


namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class AfficheControlerEvent
{
    public function infoType( RequestEvent $e ){
        print $e->getRequest();
    }
}