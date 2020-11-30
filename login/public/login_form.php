<?php
session_start();

ini_set( 'display_errors', 1);
ini_set( 'error_reporting', E_ALL );

require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}

$err = $_SESSION;

// $_SESSION = array();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン画面</title> 
</head>
<body>
    <div>
      <img src="../img00/travel.jpg">
      <h2>ログインフォーム</h2>
          <?php if (isset($err['msg'])) : ?>
              <p><?php echo $err['msg']; ?></p>
          <?php endif; ?>
        <form action="../upload/upload_form.php" method="POST">
          <div class="email">
            <p>
            <label for="email">メールアドレス:</label>
            <input type="email" name ="email">
            <?php if (isset($err['email'])) : ?>
                <p><?php echo $err['email']; ?></p>
            <?php endif; ?>
            </p>
          </div>
        <p>
          <label for="username">パスワード:</label>
          <input type="text" name ="password">
          <?php if (isset($err['password'])) : ?>
              <p><?php echo $err['password']; ?></p>
          <?php endif; ?>
        </p>
        <p>
          <input type="submit" value="ログイン">
        </p>
        </form>
        <a href="signup_form.php">新規登録はこちら</a>
        <p></p>
    </div>
  <style>
      img {margin-top: 10px;}
      div {text-align: center;}
      .email {margin-right: 37px;}
      body {background-color: #CCFFFF;}
      h2, label, input {margin-top: 20px;}
  </style>
</body>
</html>