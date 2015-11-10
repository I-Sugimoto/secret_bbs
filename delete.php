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

    $sql_delete = "delete from posts where id = :id";
    $stmt_delete = $dbh->prepare($sql_delete);
    $stmt_delete->bindParam(":id", $id);
    $stmt_delete->execute();
    header('Location: index.php');
    exit;