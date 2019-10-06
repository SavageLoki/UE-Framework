<?php


namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class AfficheControlerEvent
{
    private $logger;

    public function __construct( LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function infoType( RequestEvent $e )
    {
        $this->logger->info( $e->getRequest());
    }
}