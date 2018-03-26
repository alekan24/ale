<!DOCTYPE html>
<html lang="ja">
<head>
<!-- タイトルタグでWEBページのタイトルをつける -->
  <title>今日のファイターズ</title>
</head>
<body>
<?php
 $filename="kadai2-5.text";
 
 //投稿ボタン押された時のブロック
 if(empty($_POST["del_num"]) and isset($_POST["name"]) and isset($_POST["comment"]) and empty($_POST["edit_number"])) {
   	$fp=fopen($filename,'a+'); //a+で残す
   	$name=$_POST["name"]; //name入力フォームから受け取る
   	$comment=$_POST["comment"]; //commentフォームから受け取る
   	$date=date('Y/m/d H:i:s');
   	$cnt=count(file($filename)); //file関数を利用して行数をカウント
   	$cnt++; //$countを一つ増やして1から始まるようにする
   	$str=$cnt. "<>" . $name. "<>" . $comment. "<>" . $date. "<>" . "\n"; //一つの文字列にまとめる
   	fwrite($fp, $str);
   	fclose($fp);
 }
 //削除ボタンのブロック
 elseif(isset($_POST["del_num"]) and empty($_POST["name"]) and empty($_POST["comment"])) {
   	$del=$_POST["del_num"];
   	$delCon=file("kadai2-5.text");
   	$fp=fopen($filename,'w+'); //一度消すことで更新する
   foreach($delCon as $piece) {
     	$pieces=explode("<>",$piece); //要素で区切って配列に
     if($pieces[0]!=$del) {
       	fwrite($fp, $piece); //ここではクローズしない
     }else {
        fwrite($fp, "このコメントは削除されました\n");
      }
   }
 }
 
 //編集ボタンのブロック
 elseif(isset($_POST["edit_num"]) and empty($_POST["name"]) and empty($_POST["comment"]) and empty($_POST["del_num"]) and empty($_POST["edit_number"])) {
   	$edit_num=$_POST["edit_num"];
   	$editCon=file("kadai2-5.text");
   	$fp=fopen($filename,'w+');
   foreach($editCon as $line) {
       	$data1=explode("<>",$line); //要素で区切って配列に落とし込む
     if($data1[0]!=$edit_num) { //入力された数字と違う行の文字列ならそのまま書き込む
       	fwrite($fp, $line);
     }else {                   //入力された数字と同じ行の文字列なら
        $edit_num=$data1[0];   //番号が一致した行の内容を変数に入れる
        $user=$data1[1];
        $edit_comment=$data1[2];
        fwrite($fp, $line); //とりあえずそのまま入れておく
      }
   }
 }
//再投稿ボタンのブロック
 elseif(isset($_POST["edit_number"]) and isset($_POST["name"]) and isset($_POST["comment"])) { //再投稿画面で入力された値を受け取るブロック
	$edit_number=$_POST["edit_number"];
        $editCon2=file("kadai2-5.text");
	$fp=fopen($filename,'w+'); //削除同様書き直すスタイル
    foreach($editCon2 as $line2) {
       	$data2=explode("<>",$line2); //一行づつ配列に
     if($data2[0]!=$edit_number) { //番号が違えばそのまま書き込む
       	fwrite($fp, $line2);
     }else {                       //番号が同じなら内容を編集後に差し替える（差し替えたい！！！できない！！）
	$data2[1]=$_POST["name"];
       	$data2[2]=$_POST["comment"];
	$str2=$data2[0]. "<>" . $data2[1]. "<>" . $data2[2]. "<>" . $data2[3]. "\n";
        fwrite($fp, $str2);
      }
    }
 }
?>

  <form action="mission_2-5.php" method="POST">
<!--見出しをつける -->
  <h1>今日のファイターズ！！</h1>
  あなたの名前：<br />
<!-- 名前の入力フォーム -->
  <input type="text" name="name" size="30" value="<?php echo $user; ?>"><br />
  コメント：<br />
<!-- コメントの入力フォーム -->
  <textarea name="comment" cols="30" rows="5"><?php echo $edit_comment; ?></textarea>
  <input type="hidden" name="edit_number" value="<?php echo $_POST["edit_num"]; ?>" /><br />
  <input type="submit" value="送信"><br />
  </form><br />
  
<!-- 削除番号入力フォーム -->
  <form action="mission_2-5.php" method="POST">
  削除対象番号: <br />
  <input type="text" name="del_num" size="30" value="" /><br />
  <input type="submit" value="削除する"><br />
  </form>

<!-- 編集フォーム -->
<!-- 別のphpファイルを作りそこに値を送る -->
  <form action="mission_2-5.php" method="POST">
  編集対象番号: <br />
  <input type="text" name="edit_num" size="30" value="" /><br />
  <input type="submit" value="編集する">
  </form>
  
<?php
//ウェブ表示のブロック
 if(isset($name) and isset($comment) and empty($edit_number) or isset($del) or isset($edit_number)) {
   	$file=file($filename); //行ごとに配列の要素に格納
   foreach($file as $value) {
     	$data=explode("<>",$value); //exolodeで配列にする
     	echo $data[0]."\n";  //番号
     	echo $data[1].'<br />'; //名前
     	echo $data[2].'<br />'; //コメント
     	echo $data[3].'<br />'; //日付
     	echo '<hr />';
   }
 }
?>

</body> 
</html>
