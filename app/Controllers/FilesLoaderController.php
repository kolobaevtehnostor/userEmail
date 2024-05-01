<?php 

namespace App\Controllers;

use App\Services\FilesLoaderService;

class FilesLoaderController {
    
    public function exec(): void
    {
        (new FilesLoaderService)->updateUserByFile();
    }
}