<?php
  if ($_GET[err]){echo "<script>alert(\"".htmlentities($_GET[err])."\");window.location.href = \"forgot_u.php\";</script>";}
  include_once 'header.php';
?>
<title>Camagru | Change mot de passe</title>
  <article class="main">

    <form class="login" action="user/ft_forgot.php" method="post">
      <label><b>Nom d'utilisateur</b></label>
      <input class="form" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">

      <button type="submit" class="button" tabindex="2">Réinitialiser son mot de passe</button>
    </form>
  </article>
</div>
