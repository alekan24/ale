<!DOCTYPE html>
<html lang="ja">
<head>
<!-- �^�C�g���^�O��WEB�y�[�W�̃^�C�g�������� -->
  <title>�����̃t�@�C�^�[�Y</title>
</head>
<body>
<?php
 $filename="kadai2-5.text";
 
 //���e�{�^�������ꂽ���̃u���b�N
 if(empty($_POST["del_num"]) and isset($_POST["name"]) and isset($_POST["comment"]) and empty($_POST["edit_number"])) {
   	$fp=fopen($filename,'a+'); //a+�Ŏc��
   	$name=$_POST["name"]; //name���̓t�H�[������󂯎��
   	$comment=$_POST["comment"]; //comment�t�H�[������󂯎��
   	$date=date('Y/m/d H:i:s');
   	$cnt=count(file($filename)); //file�֐��𗘗p���čs�����J�E���g
   	$cnt++; //$count������₵��1����n�܂�悤�ɂ���
   	$str=$cnt. "<>" . $name. "<>" . $comment. "<>" . $date. "<>" . "\n"; //��̕�����ɂ܂Ƃ߂�
   	fwrite($fp, $str);
   	fclose($fp);
 }
 //�폜�{�^���̃u���b�N
 elseif(isset($_POST["del_num"]) and empty($_POST["name"]) and empty($_POST["comment"])) {
   	$del=$_POST["del_num"];
   	$delCon=file("kadai2-5.text");
   	$fp=fopen($filename,'w+'); //��x�������ƂōX�V����
   foreach($delCon as $piece) {
     	$pieces=explode("<>",$piece); //�v�f�ŋ�؂��Ĕz���
     if($pieces[0]!=$del) {
       	fwrite($fp, $piece); //�����ł̓N���[�Y���Ȃ�
     }else {
        fwrite($fp, "���̃R�����g�͍폜����܂���\n");
      }
   }
 }
 
 //�ҏW�{�^���̃u���b�N
 elseif(isset($_POST["edit_num"]) and empty($_POST["name"]) and empty($_POST["comment"]) and empty($_POST["del_num"]) and empty($_POST["edit_number"])) {
   	$edit_num=$_POST["edit_num"];
   	$editCon=file("kadai2-5.text");
   	$fp=fopen($filename,'w+');
   foreach($editCon as $line) {
       	$data1=explode("<>",$line); //�v�f�ŋ�؂��Ĕz��ɗ��Ƃ�����
     if($data1[0]!=$edit_num) { //���͂��ꂽ�����ƈႤ�s�̕�����Ȃ炻�̂܂܏�������
       	fwrite($fp, $line);
     }else {                   //���͂��ꂽ�����Ɠ����s�̕�����Ȃ�
        $edit_num=$data1[0];   //�ԍ�����v�����s�̓��e��ϐ��ɓ����
        $user=$data1[1];
        $edit_comment=$data1[2];
        fwrite($fp, $line); //�Ƃ肠�������̂܂ܓ���Ă���
      }
   }
 }
//�ē��e�{�^���̃u���b�N
 elseif(isset($_POST["edit_number"]) and isset($_POST["name"]) and isset($_POST["comment"])) { //�ē��e��ʂœ��͂��ꂽ�l���󂯎��u���b�N
	$edit_number=$_POST["edit_number"];
        $editCon2=file("kadai2-5.text");
	$fp=fopen($filename,'w+'); //�폜���l���������X�^�C��
    foreach($editCon2 as $line2) {
       	$data2=explode("<>",$line2); //��s�Âz���
     if($data2[0]!=$edit_number) { //�ԍ����Ⴆ�΂��̂܂܏�������
       	fwrite($fp, $line2);
     }else {                       //�ԍ��������Ȃ���e��ҏW��ɍ����ւ���i�����ւ������I�I�I�ł��Ȃ��I�I�j
	$data2[1]=$_POST["name"];
       	$data2[2]=$_POST["comment"];
	$str2=$data2[0]. "<>" . $data2[1]. "<>" . $data2[2]. "<>" . $data2[3]. "\n";
        fwrite($fp, $str2);
      }
    }
 }
?>

  <form action="mission_2-5.php" method="POST">
<!--���o�������� -->
  <h1>�����̃t�@�C�^�[�Y�I�I</h1>
  ���Ȃ��̖��O�F<br />
<!-- ���O�̓��̓t�H�[�� -->
  <input type="text" name="name" size="30" value="<?php echo $user; ?>"><br />
  �R�����g�F<br />
<!-- �R�����g�̓��̓t�H�[�� -->
  <textarea name="comment" cols="30" rows="5"><?php echo $edit_comment; ?></textarea>
  <input type="hidden" name="edit_number" value="<?php echo $_POST["edit_num"]; ?>" /><br />
  <input type="submit" value="���M"><br />
  </form><br />
  
<!-- �폜�ԍ����̓t�H�[�� -->
  <form action="mission_2-5.php" method="POST">
  �폜�Ώ۔ԍ�: <br />
  <input type="text" name="del_num" size="30" value="" /><br />
  <input type="submit" value="�폜����"><br />
  </form>

<!-- �ҏW�t�H�[�� -->
<!-- �ʂ�php�t�@�C������肻���ɒl�𑗂� -->
  <form action="mission_2-5.php" method="POST">
  �ҏW�Ώ۔ԍ�: <br />
  <input type="text" name="edit_num" size="30" value="" /><br />
  <input type="submit" value="�ҏW����">
  </form>
  
<?php
//�E�F�u�\���̃u���b�N
 if(isset($name) and isset($comment) and empty($edit_number) or isset($del) or isset($edit_number)) {
   	$file=file($filename); //�s���Ƃɔz��̗v�f�Ɋi�[
   foreach($file as $value) {
     	$data=explode("<>",$value); //exolode�Ŕz��ɂ���
     	echo $data[0]."\n";  //�ԍ�
     	echo $data[1].'<br />'; //���O
     	echo $data[2].'<br />'; //�R�����g
     	echo $data[3].'<br />'; //���t
     	echo '<hr />';
   }
 }
?>

</body> 
</html>
