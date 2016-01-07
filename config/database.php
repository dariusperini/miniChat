<?php


$databaseOptions = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET sql_mode='TRADITIONAL,ANSI'",
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC

];

try {

$database = new \PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_DBNAME . ';charset=utf8',
    DATABASE_USER, DATABASE_PASS, $databaseOptions);
} catch (\PDOException $error) {
     echo $error->getMessage();
}

