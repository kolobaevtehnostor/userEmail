<?php 

namespace App\Core;

use App\Controllers\FilesLoaderController;
use App\Controllers\EmailController;

class MainClass {

    public function execute(?string $action): string
    {
        $this->{$action}();

        // $emailService->exec();

        return '12';
    }

    protected function loadFile()
    {
        $controller = new FilesLoaderController;
        $controller->exec();
    }
    
    protected function sendEmail()
    {
        $controller = new EmailController;
        $controller->exec();
    }

}