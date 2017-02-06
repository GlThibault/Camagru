<?php

  header('Location: ../index.php');
  include_once '../config/database.php';

  if (empty($_POST[login]) || empty($_POST[mail]) || empty($_POST[passwd]) || empty($_POST[passwd2])) {
      header("Location: ../create.php?err=Merci de remplir tous les champs.\n");
      exit();
  }

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT COUNT(*) FROM users WHERE login = :login');
      $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  if ($sth->fetchColumn()) {
      header("Location: ../create.php?err=Login deja pris.\n");
      exit();
  }
  if ($_POST[passwd] != $_POST[passwd2]) {
      header("Location: ../create.php?err=Les mots de passes ne correspondent pas.\n");
      exit();
  }
  $passwd = hash(SHA256, $_POST[passwd]);
  $hash = md5(rand(0, 1000));

  try {
      $sth = $dbh->prepare('INSERT INTO users (login, mail, passwd, state) VALUES (:login, :mail, :passwd, :hash)');
      $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
      $sth->bindParam(':mail', $_POST[mail], PDO::PARAM_STR);
      $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
      $sth->bindParam(':hash', $hash, PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }
  
  $to = $_POST[mail];
  $subject = 'Camagru | Inscription';
  $message = "

  Votre compte a été crée, vous pouvez vous connecté avec l'identifiant suivant après avoir activé votre compte.

  ------------------------
  Nom d'utilisateur: '$_POST[login]'
  ------------------------

  Clicker sur le lien suivant pour activer votre compte
  http://localhost:8080/Camagru/verify.php?email=$_POST[mail]&hash=$hash

  ";

  $headers = 'From:tglandai@student.42.fr'."\r\n";
  mail($to, $subject, $message, $headers);
  header("Location: ../index.php?err=Votre compte a ete cree. Merci de l'activer avec le lien envoye sur votre email.\n");
