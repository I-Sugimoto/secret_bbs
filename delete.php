<?php

// echo $_GET['id'];
require_once('config.php');
require_once('functions.php');

    $id = $_GET['id'];

    $dbh = connectDatabase();
    $sql = "select * from posts where id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    $row = $stmt->fetch();

    if (!$row) {
      //indexに戻る
    header('Location: index.php');
    exit;
    }

    echo 'delete.php';