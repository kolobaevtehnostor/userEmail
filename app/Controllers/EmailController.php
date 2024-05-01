<?php 

namespace App\Controllers;

use App\Services\EmailService;

class EmailController {
    
    public function exec(): void
    {
        (new EmailService)->sendAllEmails();
    }
}