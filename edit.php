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
    


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>編集画面</title>
  </head>
  <body>
    <h1>投稿内容を編集する</h1>
    <p><a href="index.php">戻る</a></p>
    <p>一言どうぞ！</p>
    <form action="" method="post">
      <textarea name="message" cols="30" rows="5"><?php echo h($row['message']) ?></textarea>
        <?php if ($errors['message']) : ?>
          <?php echo h($errors['message']) ?>
        <?php endif ?>
      <input type="submit" value="投稿する">
    </form>
    
  </body>
</html>
