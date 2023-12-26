<?php

namespace App\Controller;

use App\Event\TestEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher
    )
    {
    }

    #[Route(path: 'api/test/event', methods: 'GET')]
    public function testEvent(Request $request): Response
    {
        /** @var string $message */
        $message = $request->query->get('message', 'Сообщение не передано');

        $testEvent = new TestEvent($message);
        $this->eventDispatcher->dispatch($testEvent);

        return new Response('Event dispatched with message: ' . $message);
    }
}