<?php
  if ($_GET[err]){echo "<script>alert(\"".htmlentities($_GET[err])."\");window.location.href = \"forgot.php\";</script>";}
  include_once 'header.php';
?>
<title>Camagru | Changer mot de passe</title>
  <article class="main">

    <form class="login" action="user/ft_changepass.php" method="post">
      <label><b>Nom d'utilisateur</b></label>
      <input class="form" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">

      <label><b>Mot de passe</b></label>
      <input class="form" type="password" placeholder="Enter Password" name="passwd" required tabindex="2">

      <label><b>Retapper le mot de passe</b></label>
      <input class="form" type="password" placeholder="Enter Password" name="passwd2" required tabindex="3">
      <?php
        if ($_GET[hash] && $_GET[email])
        {
          echo "<input type='hidden' name='email' value='$_GET[email]'>
                <input type='hidden' name='hash' value='$_GET[hash]'>";
        }
      ?>
      <button type="submit" class="button" tabindex="4">Change son mot de passe</button>
    </form>
  </article>
</div>
