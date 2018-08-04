<?php
$host = '127.0.0.1';
$db   = 'lesson_9';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

//1) Используя *PDO::quote* и *PDO::prepare + PDO::execute* выбрать всех студентов и вывести их на экран. *В чем разница?*
$sqlSelect = "SELECT * FROM student";
//используем метод quote
$columnName = $pdo->quote('name');
$columnAge = $pdo->quote('age');
$columnUniversityId = $pdo->quote('university_id');
$sqlQuote =  "SELECT $columnName, $columnAge, $columnUniversityId FROM student";
$resultQuote = $pdo->query($sqlQuote);
print_r($resultQuote->fetchAll());

//используем prepare и execute
$resultSelect = $pdo->prepare($sqlSelect);
$resultSelect->execute(array());
print_r($resultSelect->fetchAll());

//2) Используя *PDO* обновить первых двух студентов. Например: измените им возраст
$sqlUpdate = $pdo->query("UPDATE `student` SET `age` = '27' WHERE `id` = '1' OR `id` = '2'");

//3) Используя *PDO* удалите одного из студентов
$sqlDelete = $pdo->query("DELETE  FROM `student` WHERE `id` = '11'");

?>