<?php
  session_start();
  if ($_SESSION[Username] && !empty($_SESSION[Username])) {
      include_once 'header.php';
  } else {
      header('Location: index.php?err=Vous devez vous connectez pour acceder a cette page.');
  }
?>
<script src="webcam.js" charset="utf-8"></script>
<title>Camagru - Montage</title>
  <article class="main">
    <div class="videobox">
      <h3>Live</h3>
        <video id="video"></video>
        <img id="image" height="640px" width="480px" style="display: none;"/>
      <br/>
      <form id="img_filter">
        <label for="like">
          <input type="radio" name="img_filter" value="images/filters/Like.png" id="like">
          <img class="img" src="images/filters/Like.png" height="128" width="128">
        </label>
        <label for="scratches">
          <input type="radio" name="img_filter" value="images/filters/scratches.png" id="scratches">
          <img class="img" src="images/filters/scratches.png" height="128" width="128">
        </label>
        <label for="moustache">
          <input type="radio" name="img_filter" value="images/filters/moustache.png" id="moustache">
          <img class="img" src="images/filters/moustache.png" height="128" width="128">
        </label>
        <label for="beachball">
          <input type="radio" name="img_filter" value="images/filters/beachball.png" id="beachball">
          <img class="img" src="images/filters/beachball.png" height="128" width="128">
        </label>
      </form>
      <br/>
      <button class="button" id="snap" onclick="javascript:takeSnap()">Take a Snap</button>
      </br>
      <br/>
    <input type='file' onchange="readURL(this);" />
    <br/>
    <img id="image" height="640px" width="480px" style="display: none;"/>
  </div>
  </article>

  <aside class="aside2">
    <div class="videobox">
    <h3>Aperçu</h3>
    <div id="canvas"></div>
    <form method='post' accept-charset='utf-8' name='form'>
      <input name='img' id='img' type='hidden'/>
      <?php  echo "<input name='user' id='user' type='hidden' value='$_SESSION[Username]'/>"; ?>
    </form>
  </div>
  </aside>
  <footer class="footer">
  </footer>
</div>
