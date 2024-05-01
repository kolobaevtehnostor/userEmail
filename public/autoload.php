<?php 
    spl_autoload_register(function ($class) {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        $file = ROOT_PATH . str_replace('App', 'app', $file);
     //   $file = ROOT_PATH . str_replace('\\', '/', $file);

        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    });
