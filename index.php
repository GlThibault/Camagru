<?php
  if ($_GET[err]){echo "<script>alert(\"".htmlentities($_GET[err])."\");window.location.href = \"index.php\";</script>";}
  include_once "header.php";
?>
<title>Camagru - Index</title>
  <article class="main">
    <p>Ce premier projet vous remet dans le bain après la piscine PHP : vous allez devoir réaliser, en PHP, un petit site Instagram-like permettant à des utilisateurs de réaliser et partager des photo-montages. Vous allez ainsi implémenter, à mains nues (les frameworks sont interdits), les fonctionnalités de base rencontrées sur la majorité des sites possédant une base utilisateur.</p>
  </article>
  <aside class="aside">
    <?php
    session_start();
    if ($_SESSION[Username] && !empty($_SESSION[Username])):
    ?>
      <form class='login' action='user/ft_disconnect.php' method='post'>
        <h3><?=$_SESSION[Username];?></h3><br/>
        <button type='submit' class='button'>Se déconnecter</button>
      </form>
    <?php else: ?>
      <form class="login" action="user/ft_login.php" method="post">
        <label><b>Nom d'utilisateur</b></label>
        <input class="form" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">

        <label><b>Mot de passe</b></label>
        <input class="form" type="password" placeholder="Enter Password" name="passwd" required tabindex="2">

        <button type="submit" class="button" tabindex="4">Se connecter</button>
        <a href="forgot_u.php" id="mdp_forgot">Mot de passe oublié</a>
        <br/>
        <br/>
        <br/>
        <div class="strike"><span>Nouveau ?</span></div>
        <button class="button" id="button_new" onclick="location.href = 'create.php'" tabindex="5">Créer votre compte</button>
      </form>
    <?php endif; ?>
  </aside>
</div>
