<?php




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Morse Rex Quest</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/script.js" type="module"></script>
    <style>
        .score {
            position: absolute;
            font-size: 3vmin;
            right: 1vmin;
            top: 1vmin;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            color: #fff; /* White text color for contrast */
            padding: 0.5vmin 1vmin; /* Padding for spacing inside the score box */
            border-radius: 0.5vmin; /* Rounded corners for a softer look */
            box-shadow: 0 0.5vmin 1vmin rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
            font-family: 'Arial', sans-serif; /* Modern sans-serif font */
        }

    </style>
</head>
<body>
  <div class="world" data-world>
    <div class="score" data-score>0</div>
<!--    <div class="" data-score>0</div>-->
    <div class="start-screen" data-start-screen>Press Any Key To Start</div>
    <img src="imgs/ground.png" class="ground" data-ground>
    <img src="imgs/ground.png" class="ground" data-ground>
    <img src="imgs/dino-stationary.png" class="dino" data-dino>
  </div>
</body>
</html>