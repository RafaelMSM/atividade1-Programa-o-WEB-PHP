<?php

    $host = "localhost";
    $bd = "banco_php";
    $user = "root";
    $senha = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$bd", $user, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }
