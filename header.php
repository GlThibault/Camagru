<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="camagru.css">
</head>

<div class="wrapper">
    <header class="header">
        <a href="index.php" id="title"><h1>Camagru</h1></a>
        <ul class="navbar">
            <li><a href="index.php">Index</a></li>
            <li><a href="montage.php">Montage</a></li>
            <li><a href="galerie.php">Galerie</a></li>
            <?php
            if ($_SESSION[Username] && !empty($_SESSION[Username]))
              echo "<li><a href='user/ft_disconnect.php'>Se déconnecter</a></li>";
            ?>
        </ul>
    </header>

</html>
