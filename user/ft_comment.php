<?php
  session_start();
  if (!$_SESSION['Username'] || empty($_SESSION['Username'])) {
      header('Location: index.php?err=Vous devez vous connectez pour acceder a cette page.');
      exit();
  }
  if (empty($_POST['comment']) || empty($_GET['img_id'])) {
      header("Location: ../galerie.php?page=$_GET[page]");
      exit();
  }
  include_once '../config/database.php';
  header("Location: ../galerie.php?page=$_GET[page]");

  try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare('INSERT INTO comments (login, img_id, comment) VALUES  (:login, :img_id, :comment)');
    $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
    $sth->bindParam(':login', $_SESSION[Username], PDO::PARAM_STR);
    $sth->bindParam(':comment', $_POST[comment], PDO::PARAM_STR);
    $sth->execute();
    $sth = $dbh->prepare('SELECT users.mail FROM users INNER JOIN snap ON users.login = snap.login WHERE snap.id = :img_id');
    $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
    $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  $mail = $sth->fetchColumn();
  $to = $mail;
  $subject = 'Camagru | Nouveau commentaire';
  $message = "

  Un nouveau commentaire a été posté sur votre photo par : $_SESSION[Username]

  Commentaire : $_POST[comment]

  ";

  $headers = 'From:tglandai@student.42.fr'."\r\n";
  mail($to, $subject, $message, $headers);
