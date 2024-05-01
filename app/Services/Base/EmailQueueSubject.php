<?php

namespace App\Services\Base;

use SplObserver;
use SplSubject;

// Создаем класс субъекта для управления очередью email
class EmailQueueSubject implements SplSubject
{
    private $observers = [];

    protected $email = null;

    // Метод для подписки на обзервера
    public function attach(SplObserver $observer): void
    {
        $this->observers[] = $observer;
    }

    // Метод для отписки от обзервера
    public function detach(SplObserver $observer): void
    {
        $key = array_search($observer, $this->observers, true);

        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    // Метод для оповещения обзерверов
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}