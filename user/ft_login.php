<?php
  session_start();
  header("Location: ../index.php");
  include_once '../config/database.php';

  if (empty($_POST[login]) || empty($_POST[passwd])) {
      header("Location: ../index.php?err=Merci de remplir tous les champs.\n");
      exit();
  }
  $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

  $sth = $dbh->prepare("SELECT COUNT(*) FROM users WHERE login = :login");
  $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
  $sth->execute();
  if ($user = $sth->fetchColumn()) {
      $passwd = hash(SHA256, $_POST[passwd]);
      $sth = $dbh->prepare("SELECT COUNT(*) FROM users WHERE passwd = :passwd AND login = :login");
      $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
      $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
      $sth->execute();
      if ($sth->fetchColumn()) {
        $sth = $dbh->prepare("SELECT COUNT(*) FROM users WHERE passwd = :passwd AND login = :login AND state = 'active'");
        $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
        $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
        $sth->execute();
        if ($sth->fetchColumn()){
          $_SESSION[Username] = $_POST[login];
          exit();}
        else {
          header("Location: ../index.php?err=Activer votre compte.\n");
        }
      }
      else {
          header("Location: ../index.php?err=Mauvais mot de passe.\n");
        exit();
      }
  } else {
      header("Location: ../index.php?err=Le compte n'existe pas.\n");
      exit();
  }
?>
