navigator.getUserMedia = (navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

var constraints = {
    video: true,
    audio: false
};
var video_statut = true;
var image_statut = false;

var current = "like";

if (navigator.getUserMedia)
    navigator.getUserMedia(constraints, successCallback, errorCallback);
else
    console.error("getUserMedia not supported");

function successCallback(localMediaStream) {
    var video = document.querySelector('video');
    video.src = window.URL.createObjectURL(localMediaStream);
    video.play();
};

function errorCallback(err) {
    video_statut = false;
    console.log("The following error occured: " + err);
};

var width = 275;

function takeSnap() {
    if (video_statut == true || image_statut == true) {
        var video = document.querySelector('video');
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var filter = document.querySelector('input[name = "img_filter"]:checked');
        if (filter) {
            canvas.width = 640;
            canvas.height = 480;
            document.getElementById("canvas").appendChild(canvas);

            if (document.getElementById('image').src) {
                var image = new Image();
                image.src = document.getElementById('image').src;
                context.drawImage(image, 0, 0, 640, 480);
            } else
                context.drawImage(video, 0, 0, 640, 480);

            var img = new Image();
            img.src = filter.value;
            context.drawImage(img, 220, 240, width, width);

            var data = canvas.toDataURL('image/png');
            canvas.setAttribute('src', data);
            document.getElementById('img').value = data;

            var fd = new FormData(document.forms["form"]);
            var httpr = new XMLHttpRequest();
            httpr.open('POST', 'user/upload_img.php', true);
            httpr.send(fd);
        } else
            alert("Vous devez d'abord selectionner un filtre.");
    } else
        alert("Vous devez d'abord activer votre webcam ou choisir une image.");
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        image = document.getElementById('image');
        reader.onload = function(e) {
            image.style.display = "";
            image.setAttribute('src', e.target.result);
            image.height = 480;
            image.width = 640;
            document.getElementById('video').style.display = "none";
        };

        reader.readAsDataURL(input.files[0]);
    }
    image_statut = true;
}

function show_img(img_url) {
    if (video_statut == true || image_statut == true){
        current = img_url;
        var element = document.getElementById("filtercanvas");
        if (element)
        element.parentNode.removeChild(element);
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
            canvas.width = 640;
            canvas.height = 480;
            canvas.draggable = true;
            canvas.id = "filtercanvas";
            document.getElementById("canvasvideo").appendChild(canvas);
        var img = new Image();
        img.src = document.getElementById(img_url).value;
        context.drawImage(img, 220, 240, width, width);
    }
}

function plus() {
    width += 20;
    show_img(current);
}

function moins() {
    width -= 20;
    if (width < 20)
        width = 20;
    show_img(current);
}
