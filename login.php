<?php

session_start();

if (!empty($_SESSION['id']))
{
  header('Location: index.php');
  exit;
}

require_once('config.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $count = $_POST['count'];
  $errors = array();

  // バリデーション
  if ($name == '')
  {
    $errors['name'] = 'ユーザーネームが未入力です';
  }

  if ($email == '')
  {
    $errors['email'] = 'メールアドレスが未入力です';
  }

  // バリデーション突破後
  if (empty($errors))
  {
    $dbh = connectDatabase();//dbhは一度呼び出せば大丈夫。
    $sql = "select * from users where name = :name and email = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $row = $stmt->fetch();
    // var_dump($row);

    if ($row)
    {
      // ログイン成功時の処理
      $login_count = $row['login_count'] + 1;
     

      $sql_update = "update users set login_count = :login_count where id = :id";
      $stmt = $dbh->prepare($sql_update);
      $stmt->bindParam(":id", $row['id']);
      $stmt->bindParam(":login_count", $login_count);
      $stmt->execute();
      
      
    
    


      
      // セッションに login_count をもたせる。
      
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['login_count'] = $login_count;
      header('Location: index.php');
      exit;
    }
    else
    {
      echo 'ユーザーネームかメールアドレスが間違っています';
    }
  }
}
?>


<!DOCTYPE html>
<html>
  <head>
   <meta charset="utf-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="index.css">
  </head>
  <body>
    <h1>ログイン</h1>
    <form action="" method="post">
    <p>
        ユーザーネーム: <input type="text" name="name">
        <?php if ($errors['name']) : ?>
          <?php echo h($errors['name']) ?>
        <?php endif ?>
      </p>
      <p>
        メールアドレス: <input type="password" name="email">
        <?php if ($errors['email']) : ?>
          <?php echo h($errors['email']) ?>
        <?php endif ?>
      </p>
    <input class="btn" type="submit" value="ログイン">
    </form>
    <a href="signup.php">新規登録はこちら!</a>
  </body>
</html>