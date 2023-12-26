<?php

namespace App\EventDispatcher;

use App\Event\TestEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class LoggingEventDispatcher implements EventDispatcherInterface
{

    public function __construct(
         private readonly EventDispatcherInterface $dispatcher,
         private readonly LoggerInterface $logger
    )
    {
    }

    public function dispatch(object $event): void
    {
        /** @var TestEvent $event */
        $this->logger->info('Event dispatched: ' . get_class($event) . ' Message - ' . $event->getMessage());
        $this->dispatcher->dispatch($event);
    }
}