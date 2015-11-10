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
      <textarea name="message" cols="30" rows="5"></textarea>
        <?php if ($errors['message']) : ?>
          <?php echo h($errors['message']) ?>
        <?php endif ?>
      <input type="submit" value="投稿する">
    </form>
    
  </body>
</html>
