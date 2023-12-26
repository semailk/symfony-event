<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    public function testEvent(): void
    {
        $client = static::createClient();

        // Отправляем GET-запрос с параметром message
        $client->request('GET', '/api/test/event', ['message' => 'Hello, world!']);

        // Проверяем успешность запроса
        $this->assertResponseIsSuccessful();

        // Проверяем, что ответ содержит ожидаемый текст
        $this->assertStringContainsString('Event dispatched with message: Hello, world!', $client->getResponse()->getContent());
    }

    public function testEventWithoutMessage(): void
    {
        $client = static::createClient();

        // Отправляем GET-запрос без параметра message
        $client->request('GET', '/api/test/event');

        // Проверяем успешность запроса
        $this->assertResponseIsSuccessful();

        // Проверяем, что ответ содержит текст "Event dispatched with message: Сообщение не передано"
        $this->assertStringContainsString('Event dispatched with message: Сообщение не передано', $client->getResponse()->getContent());
    }
}