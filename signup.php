<?php
  require_once('config.php');
  require_once('functions.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $errors = array();
   
   //バリデーション 未入力かの判定
   if($name == '')
   {  
      $errors['name'] = 'ユーザーネームが未入力です';
   } 
   if($email == '')
   {  
      $errors['email'] = 'アドレスが未入力です';
   }    

   //バリデーション突破後
   if (empty($errors))
  {
    $dbh = connectDatabase();
    $sql = "insert into users (name, email, created_at) values
           (:name, :email, now())";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    // ログイン画面へ飛ばす
   header('Location: login.php');
    exit; 
   }
  }
?>

<!DOCTYPE html>
<html>
  <head>
   <meta charset="utf-8">
    <title>新規登録画面</title>
  </head>
  <body>
    <h1>新規登録</h1>
    <form action="" method="post">
    <p>
        ユーザーネーム: <input type="text" name="name">
        <?php if ($errors['name']) : ?>
          <?php echo h($errors['name']) ?>
        <?php endif ?>
    </p>
    <p>
        メールアドレス: <input type="text" name="email">
        <?php if ($errors['email']) : ?>
          <?php echo h($errors['email']) ?>
        <?php endif ?>
    </p>
    <input type="submit" value="登録する">
    </form>
    <a href="login.php">ログイン画面へ</a>
  </body>
</html>