<?php
session_start();

require_once '../functions.php';
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録画面</title>
</head>
<body>
<div>
<h2>ユーザー登録フォーム</h2>
<?php if (isset($login_err)) : ?>
        <p><?php echo $login_err; ?></p>
    <?php endif; ?>
  <form action="register.php" method="POST">
  <p>ユーザー登録をしてあなたの写真を投稿しましょう！！！！</p>
  <p>
    <label for="username">ユーザー名:</label>
    <input type="text" name ="username">
  </p>
  <p>
    <label for="username">メールアドレス:</label>
    <input type="text" name ="email">
  </p>
  <p>
    <label for="username">パスワード:</label>
    <input type="password" name ="password">
  </p>
  <p>
    <label for="username">パスワード確認:</label>
    <input type="password" name ="password_conf">
  </p>
      <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
  <p>
    <input type="submit" value="新規登録">
  </form>
  <a href="login_form.php">ログインする</a>
  </div>
  <style>
    div { width: 80%; 
          max-width: 500px; 
          margin: 0 auto;
        }
    body {
          background-color: #CCFFFF;
          }
        p {
          white-space: nowrap;
          }
  </style>
</body>
</html>