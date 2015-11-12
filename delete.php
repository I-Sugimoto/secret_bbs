<?php

// echo $_GET['id'];
require_once('config.php');
require_once('functions.php');
    
    session_start();
    $post_id = $_GET['post_id'];
    $user_id = $_GET['user_id'];
    $id = $_SESSION['id'];
    var_dump($post_id);
    var_dump($user_id);
    var_dump($id);
    

    if($id != $user_id){
        header('Location: index.php');
        exit;
    }

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
    //deleteをわかりやすくするためにdeleteをつける。
    $sql_delete = "delete from posts where id = :id";
    $stmt_delete = $dbh->prepare($sql_delete);
    $stmt_delete->bindParam(":id", $id);
    $stmt_delete->execute();
    
    header('Location: index.php');
    exit;