<?php
ini_set( 'display_errors', 1);
ini_set( 'error_reporting', E_ALL );

session_start();

require_once '../classes/UserLogic.php';


//①ファイルの保存
//②DB接続
//③DBへの保存
require_once "dbc.php";

// ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir. $save_filename;

// キャプションを取得
$caption = filter_input(INPUT_POST, 'caption',
FILTER_SANITIZE_SPECIAL_CHARS);

//キャプションのバリデーション
//未入力
if(empty($caption)) {
  array_push($err_msgs, 'キャプションを入力してください。');
  echo '<br>';
}
//140文字か
if(strlen($caption) > 140) {
  echo 'キャプションは１４０文字以内にしてください。';
  echo '<br>';
}

//ファイルのバリデーション
// ファイルサイズが１MB未満か
if($filesize > 1048576 || $file_err == 2) {
  echo 'ファイルサイズは１MB未満にしてください。';
  echo '<br>';
}

//拡張は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext), $allow_ext)) {
  array_push($err_msgs, '画像ファイルを添付してください。');
  echo '<br>';
}

if (count($err_msgs) === 0) {
//ファイルはあるかどうか？
if (is_uploaded_file($tmp_path)) {
  if (move_uploaded_file($tmp_path, $save_path)) {
    echo $filename . 'を'. $upload_dir. 'アップしました。';
    // DBに保存（ファイル名、ファイルパス、キャプション）
    $result = fileSave($filename, $save_path, $caption);

    if ($result) {
      echo'データベースに保存しました！';
    } else {
      echo 'データベースへの保存に失敗しました！';
    }
  } else {
    echo 'ファイルが保存できませんでした。';
  }
} else {
  echo 'ファイルが選択されていません。';
  echo '<br>';
}
} else {
  foreach($err_msgs as $msg) {
    echo $msg;
    echo '<br>';
  }
 
/// 更新日時順で並び替える関数
$sort_by_lastmod = function($a, $b) {
  return filemtime($b) - filemtime($a);
};
 
/// 並び替えして出力
$files = glob( 'path/to/files/*.*' );
usort( $files, $sort_by_lastmod );
foreach( $files as $file ) {
	$timestamp = date('Y-m-d H:i:s', filemtime( $file ) );
  echo basename( $file ) . ' : ' . $timestamp . '<br>'; 
}

}
?>
<a href= "upload_form.php">戻る</a>


<style>
  body {
          background-color: #CCFFFF;
          }
</style>