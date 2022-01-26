<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$dotenv->required(['DB_HOST', 'FORWARD_DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};port={$_ENV['FORWARD_DB_PORT']}",
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8',
];
