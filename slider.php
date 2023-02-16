<?php

session_start();

/*$user_id = $_SESSION['id'];

$status = $_GET['status'];*/

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
            <div class="row text-center">
                <img src="images/banner1.jpg">
            </div>
            <div id="carouselExampleControls" class="carousel slide mt-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active my-auto">
                        <div class="row text-white text-center">
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/1.png" style="width: 250px;">
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/2.png" style="width: 250px;">
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/3.png" style="width: 250px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item my-auto">
                        <div class="row text-white text-center">
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/4.png" style="width: 250px;">
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/5.png" style="width: 250px;">
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/6.png" style="width: 250px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item my-auto">
                        <div class="row text-white text-center">
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/7.png" style="width: 250px;">
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/8.png" style="width: 250px;">
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <img src="images/9.png" style="width: 250px;">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="row mt-5 flex align-items-center justify-content-center">
                <img src="images/box.png" style="max-width: 50%;">
            </div>
            <div class="row flex align-items-center justify-content-center mt-3">
                <button class="btn stripe-button" id="payButton" style="background: url('images/buy.png'); height: 50px; width: 100px; background-position: center; background-size: cover; background-repeat: no-repeat;">
                    <div class="spinner hidden" id="spinner"></div>
                    <span id="buttonText"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="image-item7">
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

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function (stripe) {
        return fetch("payment_init.php?quantity=5", {
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