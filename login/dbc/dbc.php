<?php

$dsn = 'mysql:host=localhost;dbname=blog_app;charset=utf8';
$user = 'blog_user';
$pass = 'blog_user120';

try {
  $dbh = new PDO($dsn, $user, $pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);
  // echo '接続成功';
  // ①SQLの準備
  $sql = 'SELECT * FROM blog';
  // ②SQLの実行
  $stmt = $dbh->query($sql);
  // ③SQLを受け取る
  $result = $stmt->fetchall(PDO::FETCH_ASSOC);
  $dbh = null;
} catch(PDOException $e) {
    echo '接続失敗'. $e->getMessage();
    exit();
};

?>