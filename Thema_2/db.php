<?php

require_once __DIR__ . '/vendor/autoload.php';

$connectionParams = [
    'dbname' => 'm151',
    'user' => 'root',
    'password' => '',
    'host' => '127.0.0.1:3306',
    'driver' => 'mysqli',
];
try {
    $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
} catch (\Doctrine\DBAL\Exception $e) {
}