<?php
$payment_id = $_GET['payment_id'];
include('config/db_config.php');
$result = 0;
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $spot = mysqli_real_escape_string($con, $_POST['spot']);
    $time = mysqli_real_escape_string($con, $_POST['time']);

    $address = mysqli_real_escape_string($con, $_POST['address']);

    $register_address = $con->query("INSERT INTO `address`(`name`, `email`, `phone_number`, `address`, `spot`, `time`, `txn_id`) 
VALUES ('$name','$email','$phone','$address','$spot','$time','$payment_id')");
    if ($register_address) {
        $result = 1;
    } else {
        $result = 2;
    }

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
    <div class="container-fluid">
        <div class="form-area">
            <div class="form-area-inner">
                <div class="form-item">
                    <h2>注冊</h2>
                    <form action="#" method="POST">
                        <?php
                        if ($result == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Thank you!</strong> Your gift will be delivered to your address shortly!
                                <a href="slider.php">Go to Homepage</a>
                            </div>
                            <?php
                        } elseif ($result == 2) {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Sorry!</strong>Something went wrong.
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-item-inner3">
                            <div class="form-item-inner4">
                                <label>電郵</label>
                                <input type="email" name="email" required/>
                                <label>電話</label>
                                <input type="text" name="phone" required>
                                <label>Spot</label>
                                <input type="text" name="spot" required>
                            </div>
                            <div class="form-item-inner4">
                                <label>姓名</label>
                                <input type="text" name="name" required/>
                                <label>地址</label>
                                <input type="text" name="address" required/>
                                <label>Delivery Time</label>
                                <input type="time" name="time" required/>
                            </div>
                            <div class="form-item-inner5">
                                <button type="submit" name="register">注冊</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="image-item2">
            <div class="image-item2-inner">
                <div id="countdown">
                    <ul>
                        <li><span id="days"></span></li>
                        <li><span id="hours"></span></li>
                        <li><span id="minutes"></span></li>
                        <li><span id="seconds"></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="image-item3">
            <div class="increment-group js-increment-group">
                <div class="increment-group__field">
                    <button class="control--button increment-group__button js-increment-button" type="button"
                            data-direction="inc"><span class="is-vhidden"></span><i class="fas fa-plus"></i></button>
                    <input class="control control--text js-increment-input" type="text" pattern="d*"
                           placeholder="Please enter" name="value" readonly="readonly" value="10"/></div>
                <button class="control--button increment-group__button js-increment-button" type="button"
                        data-direction="dec"><span class="is-vhidden"></span><i class="fas fa-minus"></i></button>
            </div>
        </div>
    </div>
    </div>
</main>
<!-- main-area end -->


<!-- Main jQuery -->
<script src="js/jquery-3.4.1.min.js"></script>

<!-- Bootstrap Bundle jQuery -->
<script src="js/bootstrap.bundle.min.js"></script>

<!-- handleCounter jQuery -->
<script src="js/handleCounter.js"></script>

<!-- Fontawesome Script -->
<script src="https://kit.fontawesome.com/7749c9f08a.js"></script>

<!-- Custom jQuery -->
<script src="js/scripts.js"></script>

</body>
</html>