<?php

// echo $_GET['id'];
require_once('config.php');
require_once('functions.php');

    session_start();
    $post_id = $_GET['post_id'];// メッセージのid 
    $user_id = $_GET['user_id'];// メッセージが持つ user_id
    $id = $_SESSION['id'];      // ログインユーザのID 
    var_dump($post_id);
    var_dump($user_id);
    var_dump($id);
    // exit;

    // if(ログインユーザのID != メッセージが持つuser_id) {
    //   header('Location : index.php');
    //   exit;
    // }
    if($id != $user_id) {
      header('Location: index.php');
      exit;
    }

    $dbh = connectDatabase();
    $sql = "select * from posts where id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $post_id);
    $stmt->execute();
    
    $row = $stmt->fetch();

    if (!$row) {
      //indexに戻る
    header('Location: index.php');
    exit;
    }


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $message = $_POST['message'];
  $errors = array();

  // バリデーション
  if ($message == '')
  {
    $errors['message'] = 'メッセージが未入力です';
  }

  // バリデーション突破後
  if (empty($errors))
  {
    $dbh = connectDatabase();
    $sql = "update posts set message = :message, updated_at = now() where id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $post_id);
    $stmt->bindParam(":message", $message);
    $stmt->execute();
    
    //indexに戻る
    header('Location: index.php');
    exit;

  }


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
      <input type="submit" value="編集する">
    </form>
    
  </body>
</html>
