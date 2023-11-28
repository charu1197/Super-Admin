<?php
if (isset($_POST['photoInput'])) {
    $photo_data = $_POST['photoInput'];

    // Decode and save the image data to a file
    $photo_name = 'captured_photo.jpg';
    $upload_dir = './uploads/';

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    file_put_contents($upload_dir . $photo_name, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo_data)));

    echo "Photo saved successfully!";
} else {
    echo "No photo data received.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webcam Photo Capture</title>
</head>
<body>
    <h1>Webcam Photo Capture</h1>

    <video id="video" width="640" height="480" autoplay></video>
    <br>
    <button id="startbutton">Capture Photo</button>
    <br>
    <canvas id="canvas" width="640" height="480"></canvas>
    <br>
    <img id="capturedPhoto" src="" alt="Captured Photo">

    <script src="script.js">
        (() => {
    const width = 640;
    let height = 0;
    let streaming = false;
    let video = null;
    let canvas = null;
    let photo = null;
    let startbutton = null;

    function startup() {
        video = document.getElementById("video");
        canvas = document.getElementById("canvas");
        photo = document.getElementById("capturedPhoto");
        startbutton = document.getElementById("startbutton");

        navigator.mediaDevices
            .getUserMedia({ video: true, audio: false })
            .then((stream) => {
                video.srcObject = stream;
                video.play();
            })
            .catch((err) => {
                console.error(`An error occurred: ${err}`);
            });

        video.addEventListener(
            "canplay",
            (ev) => {
                if (!streaming) {
                    height = video.videoHeight / (video.videoWidth / width);

                    if (isNaN(height)) {
                        height = width / (4 / 3);
                    }

                    video.setAttribute("width", width);
                    video.setAttribute("height", height);
                    canvas.setAttribute("width", width);
                    canvas.setAttribute("height", height);
                    streaming = true;
                }
            },
            false
        );

        startbutton.addEventListener(
            "click",
            (ev) => {
                takepicture();
                ev.preventDefault();
            },
            false
        );
    }

    function clearphoto() {
        const context = canvas.getContext("2d");
        context.fillStyle = "#AAA";
        context.fillRect(0, 0, canvas.width, canvas.height);

        const data = canvas.toDataURL("image/jpeg");
        photo.setAttribute("src", data);
    }

    function takepicture() {
        const context = canvas.getContext("2d");
        if (width && height) {
            canvas.width = width;
            canvas.height = height;
            context.drawImage(video, 0, 0, width, height);

            const data = canvas.toDataURL("image/jpeg");
            photo.setAttribute("src", data);

            // Set the value of the hidden input field with the data URL
            document.getElementById("photoInput").value = data;
        } else {
            clearphoto();
        }
    }

    window.addEventListener("load", startup, false);
})();

    </script>
</body>
</html>
