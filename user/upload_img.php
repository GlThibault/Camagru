<?php
  if (!file_exists('../snaps')) {
      mkdir('../snaps', 0775, true);
  }
  $img = $_POST['img'];
  $img = str_replace('data:image/png;base64,', '', $img);
  $img = str_replace(' ', '+', $img);
  $data = base64_decode($img);
  $file = "../snaps/" . mktime() . ".png";
  $success = file_put_contents($file, $data);
  print $success ? $file : 'Unable to save the file.';

  $file = "snaps/" . mktime() . ".png";
  include_once '../config/database.php';
  $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $sth = $dbh->prepare("INSERT INTO snap (login, img) VALUES (:login, :file)");
  $sth->bindParam(':login', $_POST[user], PDO::PARAM_STR);
  $sth->bindParam(':file', $file, PDO::PARAM_STR);
  $sth->execute();

?>
