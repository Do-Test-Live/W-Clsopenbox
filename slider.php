<?php
include('config/db_config.php');
session_start();

require_once 'config.php';

if (isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];
}

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
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="row mt-5 flex align-items-center justify-content-center">
                <img src="images/box.png" style="max-width: 50%;">
            </div>
            <div class="row flex align-items-center justify-content-center mt-3">
                <button class="btn stripe-button buy-button" id="payButton">
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


    <div class="image-item3">
        <div class="increment-group js-increment-group">
            <div class="increment-group__field">
                <button class="control--button increment-group__button js-increment-button" type="button"
                        data-direction="inc" id="increment-count"><span class="is-vhidden"></span><i
                            class="fas fa-plus"></i></button>
                <input class="control control--text js-increment-input" type="text" pattern="d*"
                       name="value" readonly="readonly" id="count-text" value="0"/></div>
            <button class="control--button increment-group__button js-increment-button" type="button"
                    data-direction="dec" id="decrement-count"><span class="is-vhidden"></span><i
                        class="fas fa-minus"></i></button>
        </div>
    </div>

</main>
<!-- main-area end -->

<?php
if (isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];
    ?>
    <div class="modal fade show" style="display: inline-block;" id="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-content-inner">
                    <div class="row">


                        <?php
                        $fetch_amount = $con->query("select paid_amount from transactions where txn_id = '$payment_id' and payment_status='succeeded'");
                        if ($fetch_amount) {
                            while ($amount = mysqli_fetch_assoc($fetch_amount)) {
                                $payment_amount = $amount['paid_amount'];
                            }
                        } else {
                            echo 'something wrong';
                        }
                        $no_of_gift = $payment_amount / 500;

                        $select_gift = $con->query("select * from products ORDER BY rand() limit $no_of_gift");
                        if ($select_gift) {
                            $gifts = '';
                            while ($data = mysqli_fetch_assoc($select_gift)) {
                                $gifts = $gifts . ',' . $data['product_id'];
                                ?>
                                <div class="col-4">
                                    <img src="<?php echo $data['product_image']; ?>" alt="" style="max-width: 100px;"/>
                                </div>
                                <?php
                            }
                        } else {
                            echo 'something wrong 2';
                        }

                        ?>

                    </div>
                    <div class="row text-center">
                        <a href="insert_gift.php?payment_id=<?php echo $payment_id; ?>&gift=<?php echo $gifts; ?>">
                            <button class="btn stripe-button buy-button" onclick="clam_button();"
                                    style="background-image: url('images/claim-now.png');">
                                <div class="spinner hidden"></div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <?php
}
?>


<script>
    const total_count = document.getElementById("count-text");
    var count = 1;
    total_count.value = count;

    // Function to increment count
    document.getElementById("increment-count").addEventListener("click", function () {
        count++;
        if (count < 10) {
            console.log(count);
            total_count.value = count;
            document.getElementById("decrement-count").disabled = false;
        } else {
            document.getElementById("increment-count").disabled = true;
        }

    });

    // Function to decrement count
    document.getElementById("decrement-count").addEventListener("click", function () {
        if (count > 1) {
            count--;
            console.log(count);
            total_count.value = count;
            document.getElementById("increment-count").disabled = false;
        } else {
            document.getElementById("decrement-count").disabled = true;
        }

    });

    function clam_button() {
        document.getElementById('modal').classList.remove('show');
    }
</script>


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
        return fetch("payment_init.php?quantity=" + total_count.value, {
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