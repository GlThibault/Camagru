<?php
  header("Location: ../galerie.php?page=$_GET[page]");
  session_start();
  include_once '../config/database.php';
  $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $sth = $dbh->prepare("DELETE FROM snap WHERE login = :login AND id = :img");
  $sth->bindParam(':login', $_SESSION[Username], PDO::PARAM_STR);
  $sth->bindParam(':img', $_GET[img], PDO::PARAM_INT);
  $sth->execute();

?>
