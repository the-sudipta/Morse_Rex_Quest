<?php

require '../routes.php';
global $frontend_routes, $backend_routes;


//echo '<h1>'.login_page().'</h1>'

$loginController_file = $backend_routes['login_controller'];


$signup_decider = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Morse Rex Quest - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="login_cache/image/png" href="favicon.ico">

    <link rel="stylesheet" type="text/css" href="login_cache/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="login_cache/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="login_cache/css/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="login_cache/css/animate.css">

    <link rel="stylesheet" type="text/css" href="login_cache/css/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="login_cache/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="login_cache/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="login_cache/css/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="login_cache/css/util.css">
    <link rel="stylesheet" type="text/css" href="login_cache/css/main.css">

    <meta name="robots" content="noindex, follow">

    <style>
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
            var email = document.getElementById("login_email").value;
            var password = document.getElementById("login_password").value;

            // Validate email
            if (email === "" || email === null) {
                showModal("Email is Required");
                return false;
            }

            // Validate password
            if (password === "" || password === null) {
                showModal("Password is Required");
                return false;
            }

            return true; // Return true if all validations pass
        }

        // Attach the validation function to the form's onsubmit event
        document.getElementById("login_form").onsubmit = function () {
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

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-b-160 p-t-50">
            <form action="<?php echo $loginController_file; ?>" method="post" id="login_form" onsubmit="return validateForm();" class="login100-form validate-form">
                <span class="login100-form-title p-b-43">
                    Account Login
                </span>
                <div class="wrap-input100 rs1 validate-input" data-validate="Email is required">
                    <input class="input100" type="text" name="email" id="login_email">
                    <span class="label-input100">Email</span>
                </div>
                <div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" id="login_password" >
                    <span class="label-input100">Password</span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Sign in
                    </button>
                </div>
                <div class="text-center w-full p-t-23">
                    <!--                    <a href="#" class="txt1">-->
                    <!--                        Forgot password?-->
                    <!--                    </a>-->
                </div>
            </form>
        </div>
    </div>
</div>

<script src="login_cache/js/jquery-3.2.1.min.js"></script>
<script src="login_cache/js/animsition.min.js"></script>
<script src="login_cache/js/popper.js"></script>
<script src="login_cache/js/bootstrap.min.js"></script>
<script src="login_cache/js/select2.min.js"></script>
<script src="login_cache/js/moment.min.js"></script>
<script src="login_cache/js/daterangepicker.js"></script>
<script src="login_cache/js/countdowntime.js"></script>
<script src="login_cache/js/main.js"></script>

<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
