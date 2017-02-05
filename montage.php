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
        <div id="canvasvideo"></div>
      <center>
        <button onclick="plus()" class="button" style="width: 50px;">+</button>
        <button onclick="moins()" class="button" style="width: 50px;">-</button>
      </center>
      <form id="img_filter">
        <label for="like">
          <input type="radio" name="img_filter" value="images/filters/like.png" id="like" onchange="show_img('like')">
          <img class="img" src="images/filters/like.png" height="128" width="128">
        </label>
        <label for="trollface">
          <input type="radio" name="img_filter" value="images/filters/trollface.png" id="trollface" onchange="show_img('trollface')">
          <img class="img" src="images/filters/trollface.png" height="128" width="128">
        </label>
        <label for="moustache">
          <input type="radio" name="img_filter" value="images/filters/moustache.png" id="moustache" onchange="show_img('moustache')">
          <img class="img" src="images/filters/moustache.png" height="128" width="128">
        </label>
        <label for="beachball">
          <input type="radio" name="img_filter" value="images/filters/beachball.png" id="beachball" onchange="show_img('beachball')">
          <img class="img" src="images/filters/beachball.png" height="128" width="128">
        </label>
        <br/>
        <label for="pinkie_pie">
          <input type="radio" name="img_filter" value="images/filters/pinkie_pie.png" id="pinkie_pie" onchange="show_img('pinkie_pie')">
          <img class="img" src="images/filters/pinkie_pie.png" height="128" width="128">
        </label>
        <label for="fireman">
          <input type="radio" name="img_filter" value="images/filters/fireman.png" id="fireman" onchange="show_img('fireman')">
          <img class="img" src="images/filters/fireman.png" height="128" width="128">
        </label>
        <label for="risitas">
          <input type="radio" name="img_filter" value="images/filters/risitas.png" id="risitas" onchange="show_img('risitas')">
          <img class="img" src="images/filters/risitas.png" height="128" width="128">
        </label>
        <label for="saltbae">
          <input type="radio" name="img_filter" value="images/filters/saltbae.png" id="saltbae" onchange="show_img('saltbae')">
          <img class="img" src="images/filters/saltbae.png" height="128" width="128">
        </label>
        <br/>
        <label for="kappa">
          <input type="radio" name="img_filter" value="images/filters/kappa.png" id="kappa" onchange="show_img('kappa')">
          <img class="img" src="images/filters/kappa.png" height="128" width="128">
        </label>
        <label for="trump">
          <input type="radio" name="img_filter" value="images/filters/trump.png" id="trump" onchange="show_img('trump')">
          <img class="img" src="images/filters/trump.png" height="128" width="128">
        </label>
        <label for="panama">
          <input type="radio" name="img_filter" value="images/filters/panama.png" id="panama" onchange="show_img('panama')">
          <img class="img" src="images/filters/panama.png" height="128" width="128">
        </label>
        <label for="sombrero">
          <input type="radio" name="img_filter" value="images/filters/sombrero.png" id="sombrero" onchange="show_img('sombrero')">
          <img class="img" src="images/filters/sombrero.png" height="128" width="128">
        </label>
      </form>
      <br/>
      <button class="button" id="snap" onclick="javascript:takeSnap()">Prendre une photo</button>
      </br>
      <br/>
    <input type='file' accept="image/*" onchange="readURL(this);" />
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
