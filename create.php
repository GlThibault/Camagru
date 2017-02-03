<?php
  if ($_GET[err]){echo "<script>alert(\"".htmlentities($_GET[err])."\");window.location.href = \"create.php\";</script>";}
  include_once 'header.php';
?>
<title>Camagru | Créer un compte</title>
  <article class="main">

    <form class="login" action="user/ft_create.php" method="post">
      <label><b>Nom d'utilisateur</b></label>
      <input class="form" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">

      <label><b>Adresse email</b></label>
      <input class="form" type="email" placeholder="Enter Email" name="mail" required tabindex="2">

      <label><b>Mot de passe</b></label>
      <input class="form" type="password" placeholder="Enter Password" name="passwd" required tabindex="3">

      <label><b>Retapper le mot de passe</b></label>
      <input class="form" type="password" placeholder="Enter Password" name="passwd2" required tabindex="4">

      <button type="submit" class="button" tabindex="5">Créer votre compte</button>
    </form>
  </article>
</div>
