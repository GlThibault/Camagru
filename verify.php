<?php

  header("Location: index.php");
  include_once 'config/database.php';
  $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $result = $dbh->query("SELECT COUNT(*) FROM users WHERE mail = '$_GET[email]' AND state = '$_GET[hash]'");
  if ($result->fetchColumn()) {
    $dbh->exec("UPDATE users SET state = 'active' WHERE mail = '$_GET[email]' AND state = '$_GET[hash]'");
    header("Location: index.php?err=Votre compte est maintenant valide. Vous pouvez vous connecter.\n");
  }
  else
    header("Location: index.php?err=Erreur.\n");
?>
