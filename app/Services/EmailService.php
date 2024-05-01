<?php 

namespace App\Services;

use App\Services\Base\EmailQueueObserver;
use App\Services\Base\EmailQueueSubject;
use App\Core\DatabaseConnection;

class EmailService extends EmailQueueSubject {

    /**
     * Отправляем все письма
     *
     * @return void
     */
    public function sendAllEmails(): void
    {
        foreach ($this->getEmailQueue() as $email) {
            $this->sendEmail($email['email']);
        }
    }

    /**
     * Отправляем письмо
     *
     * @param string $email
     * @return void
     */
    private function sendEmail(string $email)
    {
        // Логика отправки email (может быть реализована с использованием PHPMailer или другой библиотеки)

        DatabaseConnection::query("UPDATE email_queue SET status = 1 WHERE email = '$email'");
        echo "Отправка email на адрес: " . $email . "\n";
        
    }
    
    private function getEmailQueue(): array
    {
        return DatabaseConnection::query('SELECT email, status from email_queue where status = 3') ?? [];
    }
}