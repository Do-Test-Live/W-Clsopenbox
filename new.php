<?php

session_start();

$user_id = $_SESSION['id'];

$status = $_GET['status'];

// Include configuration file
require_once 'config.php';

?>


<!DOCTYPE html>
<html lang="en-US">
<head>
    <!-- Meta setup -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="decription" content="">

    <!-- Title -->
    <title>Welcome</title>

    <!-- Fav Icon -->
    <link rel="icon" href="images/favicon.ico"/>

    <!-- Include Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css"/>

    <!-- Main StyleSheet -->
    <link rel="stylesheet" href="style.css"/>

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css"/>

</head>
<body>

<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- main-area start -->
<main class="main-area">
    <div class="container">
        <div class="information-item">
            <div class="row text-white text-center mt-sm-0 mt-5">
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
            </div>
            <div class="row text-white text-center mt-sm-0 mt-3">
                <div class="col-lg-4 col-md-4 col-4">
                    <button class="btn stripe-button" id="payButton" style="background: url('images/buy.png'); height: 100px; width: 200px; background-position: center; background-size: cover; background-repeat: no-repeat;">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="buttonText"></span>
                    </button>
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <button class="btn stripe-button" id="payButton1" style="background: url('images/buy.png'); height: 100px; width: 200px; background-position: center; background-size: cover; background-repeat: no-repeat;">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="buttonText"></span>
                    </button>
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <button class="btn stripe-button" id="payButton" style="background: url('images/buy.png'); height: 100px; width: 200px; background-position: center; background-size: cover; background-repeat: no-repeat;">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="buttonText"></span>
                    </button>
                </div>
            </div>
            <div class="row text-white text-center mt-sm-0 mt-5">
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
            </div>
            <div class="row text-white text-center mt-sm-0 mt-5">
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <img src="images/box.png" style="width: 250px;">
                </div>
            </div>
        </div>
    </div>
    <div class="image-item6">
        <div class="image-item2-inner">

        </div>
    </div>
<?php
if(isset($user_id)){
    ?>
    <div class="image-item4">
        <div class="image-item2-inner">

        </div>
    </div>
    <?php
}
?>
</main>
<!-- main-area end -->



<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

    // Select payment button
    const payBtn = document.querySelector("#payButton");


    // Payment request handler
    payBtn.addEventListener("click", function (evt) {
        setLoading(true);

        createCheckoutSession().then(function (data) {
            if (data.sessionId) {
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            } else {
                handleResult(data);
            }
        });
    });

    payBtn1.addEventListener("click", function (evt) {
        setLoading(true);

        createCheckoutSession().then(function (data) {
            if (data.sessionId) {
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            } else {
                handleResult(data);
            }
        });
    });

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function (stripe) {
        return fetch("payment_init.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                createCheckoutSession: 1,
            }),
        }).then(function (result) {
            return result.json();
        });
    };

    // Handle any errors returned from Checkout
    const handleResult = function (result) {
        if (result.error) {
            showMessage(result.error.message);
        }

        setLoading(false);
    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#buttonText").classList.add("hidden");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#buttonText").classList.remove("hidden");
        }
    }

    // Display message
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#paymentResponse");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 5000);
    }
</script>

<!-- Main jQuery -->
<script src="js/jquery-3.4.1.min.js"></script>

<!-- Bootstrap Bundle jQuery -->
<script src="js/bootstrap.bundle.min.js"></script>

<!-- handleCounter jQuery -->
<script src="js/handleCounter.js"></script>

<!-- Fontawesome Script -->
<script src="https://kit.fontawesome.com/7749c9f08a.js"></script>



</body>
</html>