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
$id = 1;
$resultQuote = $pdo->query('SELECT * FROM student WHERE id = ' . $pdo->quote($id));
print_r($resultQuote->fetchAll());

//используем prepare и execute
$resultSelect = $pdo->prepare($sqlSelect);
$resultSelect->execute(array());
print_r($resultSelect->fetchAll());

//2) Используя *PDO* обновить первых двух студентов. Например: измените им возраст
$sqlUpdate = $pdo->prepare("UPDATE student SET age = :age WHERE id = :idFirst OR id = :idSecond");
$sqlUpdate->bindParam(':idFirst', $idFirst);
$sqlUpdate->bindParam(':idSecond', $idSecond);
$sqlUpdate->bindParam(':age', $age);
$idFirst = 1;
$idSecond = 2;
$age = '26';
$sqlUpdate->execute();

//3) Используя *PDO* удалите одного из студентов
$pdo->exec("DELETE  FROM `student` WHERE `id` = '11'");

?>