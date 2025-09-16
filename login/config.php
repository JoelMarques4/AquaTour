<?php

$host = 'sql112.infinityfree.com';
$username = 'if0_39315634';
$password = 'xR8HQYgpR4Qu6f';
$dbname = 'bd_aquatour';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, # permite que trate erros da conexão
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, # define o modo de busca padrão
    PDO::ATTR_EMULATE_PREPARES   => false, # desativa a emulação de prepared statements
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>