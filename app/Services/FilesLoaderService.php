<?php 

namespace App\Services;

use App\Services\Base\EmailQueueObserver;
use App\Services\Base\EmailQueueSubject;
use App\Core\DatabaseConnection;

class FilesLoaderService extends EmailQueueSubject {
    
    public function updateUserByFile(): void
    {
        $observer = new EmailQueueObserver();

        // Подписываем обзервера на субъект
        $this->attach($observer);

        $path = PUBLIC_PATH . '/loader/' . 'users.csv';

        $file = fopen($path, 'r');

        while (($row = fgetcsv($file)) !== false) {
            $userName = $row[1] ?? null;

            if ($userName) {
                $this->setEmail(str_replace(' ', '', $userName) . '@email.com');

                $item = DatabaseConnection::query("SELECT name from users where name like '$userName'") ?? null;

                if(! count($item)) {
                    // В идеале нужно через привязывание параметров к значениям bindValue
                    DatabaseConnection::query("INSERT INTO users (email, name) VALUES ('$this->email', '$userName')");

                    // Добавляем в очередь на отправку
                    $this->notify();
                }
            }
        }

        fclose($file);
    }
}