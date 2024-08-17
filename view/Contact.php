<?php

require '../routes.php';
global $frontend_routes, $backend_routes;


session_start();


$Login_page = $frontend_routes['login'];
$ContactController_file = $backend_routes['contact_controller'];

if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Morse Rex Quest - Contact Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="contact_cache/image/png" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/animate.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/util.css">
    <link rel="stylesheet" type="text/css" href="contact_cache/css/main.css">

    <meta name="robots" content="noindex, follow">

    <!-- Custom CSS for fullscreen map -->
    <style>
        .container-contact100 {
            position: relative;
            width: 100%;
            min-height: 100vh;
            background-color: #f2f2f2;
            overflow: hidden;
        }

        .contact100-map {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .wrap-contact100 {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            width: 100%;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
        }

    /*    Validation Model CSS*/

        #validationModal {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            width: 300px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            z-index: 1050;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }

        #validationModal .close {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
            color: #721c24;
        }

        #validationMessage {
            font-size: 16px;
            font-weight: 600;
            text-align: left;
            margin-top: 25px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>

    <script>
        // Function to validate email format
        function validateEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Function to show modal with validation message
        function showModal(message) {
            document.getElementById("validationMessage").innerHTML = message;
            document.getElementById("validationModal").style.display = "block";
        }

        close_modal = () => {
            document.getElementById("validationModal").style.display = "none";
        }

        function validateForm() {
            var name = document.getElementById("contact_name").value;
            var email = document.getElementById("contact_email").value;
            var phone = document.getElementById("contact_phone").value;
            var message = document.getElementById("contact_message").value;

            // Validate name
            if (name === "" || name === null) {
                showModal("Name is Required");
                return false;
            }

            // Validate email
            if (email === "" || email === null) {
                showModal("Email is Required");
                return false;
            }

            // Validate phone
            if (phone === "" || phone === null) {
                showModal("Phone is Required");
                return false;
            }

            // Validate message
            if (message === "" || message === null) {
                showModal("Message is Required");
                return false;
            }


            return true; // Return true if all validations pass
        }

        // Attach the validation function to the form's onsubmit event
        document.getElementById("contact_form").onsubmit = function () {
            return validateForm();
        };
    </script>
</head>
<body>


<!-- Validation Modal -->
<div id="validationModal" class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="close" aria-hidden="true" onclick="close_modal();">&times;</span>
    <p id="validationMessage"></p>
</div>


<div class="container-contact100">
    <div class="contact100-map" id="google_map"></div>
    <div class="wrap-contact100">
        <div class="contact100-form-title" style="background-image: url(contact_cache/images/bg-01.jpg);">
            <span class="contact100-form-title-1">
                Contact Us
            </span>
            <span class="contact100-form-title-2">
                Feel free to drop us a line below!
            </span>
        </div>
        <form action="<?php echo $ContactController_file; ?>" method="post" id="contact_form" onsubmit="return validateForm();" class="contact100-form validate-form">
            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <span class="label-input100">Full Name:</span>
                <input class="input100" type="text" id="contact_name" name="name" placeholder="Enter full name">
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: Your_GMail@gmail.com">
                <span class="label-input100">Email:</span>
                <input class="input100" type="text" id="contact_email" name="email" placeholder="Enter email address">
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Phone is required">
                <span class="label-input100">Phone:</span>
                <input class="input100" type="text" id="contact_phone" name="phone" placeholder="Enter phone number">
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Message is required">
                <span class="label-input100">Message:</span>
                <textarea class="input100" id="contact_message" name="message" placeholder="Your Comment..."></textarea>
                <span class="focus-input100"></span>
            </div>
            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn">
                    <span>
                        Submit
                        <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
<div id="dropDownSelect1"></div>

<script src="contact_cache/js/jquery-3.2.1.min.js"></script>

<script src="contact_cache/js/animsition.min.js"></script>
<script src="contact_cache/js/popper.js"></script>
<script src="contact_cache/js/bootstrap.min.js"></script>
<script src="contact_cache/js/select2.min.js"></script>
<script src="contact_cache/js/moment.min.js"></script>
<script src="contact_cache/js/daterangepicker.js"></script>
<script src="contact_cache/js/countdowntime.js"></script>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('google_map'), {
            zoom: 10,
            center: {lat: 40.722047, lng: -73.986422}  // Default center, will change based on user location
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                var marker = new google.maps.Marker({
                    position: userLocation,
                    map: map
                });

                map.setCenter(userLocation);
            }, function() {
                alert('Geolocation service failed. Please enable location services in your browser.');
            });
        } else {
            // Browser doesn't support Geolocation
            alert('Your browser doesn\'t support geolocation.');
        }
    }

    window.onload = initMap;
</script>

<script src="contact_cache/js/main.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
