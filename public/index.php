<?php

define('ROOT_PATH', __DIR__ . '/../');
define('PUBLIC_PATH', __DIR__);

require_once 'autoload.php';
require_once 'functions.php';



use App\Core\MainClass;
use App\Core\DatabaseConnection;

$core = new MainClass();
$db = DatabaseConnection::getInstance(
    'db',
    'test',
    'test',
    'test'
);

$db->connect();
$core->execute(
    $_GET['action'] ?? null
);

