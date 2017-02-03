navigator.getUserMedia = (navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

var constraints = {
    video: true,
    audio: false
};
var video_statut = true;

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


function takeSnap() {
    if (video_statut == true) {
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
            context.drawImage(img, 220, 240, 200, 200);

            var data = canvas.toDataURL('image/png');
            canvas.setAttribute('src', data);
            document.getElementById('img').value = data;

            var fd = new FormData(document.forms["form"]);
            var httpr = new XMLHttpRequest();
            httpr.open('POST', 'user/upload_img.php', true);
            httpr.send(fd);
        } else
            alert("Vous devez d'abord selectionner une image.");
    } else
        alert("Vous devez d'abord activer votre webcam");
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
}
