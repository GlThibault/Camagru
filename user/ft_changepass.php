<?php
  header("Location: ../index.php");
  include_once '../config/database.php';

  if (empty($_POST[login]) || empty($_POST[passwd]) || empty($_POST[passwd2]) || empty($_POST[email]) || empty($_POST[hash]))
  {
    header("Location: ../index.php?err=Merci de remplir tous les champs.\n");
    exit();
  }
  if ($_POST[passwd] != $_POST[passwd2])
  {
    header("Location: ../index.php?err=Les mots de passes ne correspondent pas.\n");
    exit();
  }
  $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

  $sth = $dbh->prepare("SELECT COUNT(*) FROM users WHERE login = :login");
  $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
  $sth->execute();
  if (!$sth->fetchColumn())
  {
    header("Location: ../index.php?err=Le compte n'existe pas.\n");
    exit();
  }
  $passwd = hash(SHA256, $_POST[passwd]);
  $sth = $dbh->prepare("SELECT COUNT(*) FROM users WHERE login = :login AND mail = :email AND forgot = :hash");
  $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
  $sth->bindParam(':hash', $_POST[hash], PDO::PARAM_STR);
  $sth->bindParam(':email', $_POST[email], PDO::PARAM_STR);
  $sth->execute();
  if ($sth->fetchColumn()) {
    $sth = $dbh->prepare("UPDATE users SET forgot = 'NULL', passwd = :passwd WHERE login = :login AND mail = :email AND forgot = :hash");
    $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
    $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
    $sth->bindParam(':hash', $_POST[hash], PDO::PARAM_STR);
    $sth->bindParam(':email', $_POST[email], PDO::PARAM_STR);
    $sth->execute();
    header("Location: ../index.php?err=Votre mot de passe a ete correctement change.\n");
  }
  else
    header("Location: ../index.php?err=Erreur.\n");
?>
