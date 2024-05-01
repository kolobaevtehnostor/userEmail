<?php

namespace App\Services\Base;

use SplObserver;
use SplSubject;
use App\Services\Base\EmailQueueSubject;
use App\Core\DatabaseConnection;

class EmailQueueObserver implements SplObserver
{
    private $emailQueue = [];

    /**
     * @see SplObserver
     *
     * @param SplSubject $subject
     * @return void
     */
    public function update(SplSubject $subject): void
    {

        if (! $subject instanceof EmailQueueSubject) {
            return;
        }
        
        $email = $subject->getEmail();

        DatabaseConnection::query("INSERT INTO email_queue (email, status) VALUES ('$email', 3)");
        
       // DatabaseConnection::query("UPDATE email_queue SET status = 1 WHERE email = '$email'");

        
     //   


        // // Получаем очередь email из субъекта
        // $emailQueue = $this->getEmailQueue();

        // // Отправляем каждое письмо из очереди
        // foreach ($emailQueue as $email) {
        //     $this->sendEmail($email);
        // }

        // // Очищаем очередь после отправки
        // $this->clearEmailQueue();
    }



    // Метод для получения очереди email
    private function getEmailQueue()
    {
        return $this->emailQueue;
    }

    // Метод для добавления email в очередь
    private function addEmailToQueue($email)
    {
        $this->emailQueue[] = $email;
    }

    // Метод для очистки очереди
    private function clearEmailQueue()
    {
        $this->emailQueue = [];
    }
}
