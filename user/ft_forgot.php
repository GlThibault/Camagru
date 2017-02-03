<?php

  header("Location: ../index.php");
  include_once '../config/database.php';

  if (empty($_POST[login]))
  {
    header("Location: ../forgot_u.php?err=Merci de remplir tous les champs.\n");
    exit();
  }
  $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

  $sth = $dbh->prepare("SELECT COUNT(*) FROM users WHERE login = :login");
  $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
  $sth->execute();
  if (!($result = $sth->fetchColumn()))
  {
    header("Location: ../forgot_u.php?err=Le compte n'existe pas.\n");
    exit();
  }
  $hash = md5(rand(0,1000));
  $sth = $dbh->prepare("UPDATE users SET forgot = '$hash' WHERE login = :login");
  $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
  $sth->execute();
  $sth = $dbh->prepare("SELECT mail FROM users WHERE login = :login");
  $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
  $sth->execute();
  $user = $sth->fetch();
  $to      = $user[mail];
  $subject = 'Camagru | Mot de passe oublie';
  $message = "
  ------------------------
  Nom d'utilisateur: '$_POST[login]'
  ------------------------

  Clicker sur le lien suivant pour réactiver votre compte avec un nouveau mot de passe.
  http://localhost:8080/Camagru/forgot.php?email=$to&hash=$hash

  ";

  $headers = 'From:tglandai@student.42.fr' . "\r\n";
  mail($to, $subject, $message, $headers);
  header("Location: ../index.php?err=Pour changer votre mot de passe clique sur le lien envoye sur votre email.\n");
?>
