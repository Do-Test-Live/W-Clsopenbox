<?php
include ('config/db_config.php');
$result = 0;
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $key = 'clsopenbox';
    $Pwd_peppered = Hash_hmac("Sha256", $password, $key);
    $query = $con->query("select * from register where username = '$username'");
    if ($query->num_rows == 1) {
        while ($row = mysqli_fetch_assoc($query)) {
            $pass = $row["password"];
            if (Password_verify($Pwd_peppered, $pass)) {
                session_start();
                $_SESSION["id"] = $row['id'];
                $_SESSION["status"] = 'success';
                header("Location: slider.php");
            } else {
                $result = 2;
            }
        }
    } else {
        $result = 1;
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
		<link rel="icon" href="images/favicon.ico" />	

		<!-- Include Bootstrap -->
		<link rel="stylesheet" href="css/bootstrap.css" />
		
		<!-- Main StyleSheet -->
		<link rel="stylesheet" href="style.css" />	
		
		<!-- Responsive CSS -->
		<link rel="stylesheet" href="css/responsive.css" />	
		
	</head>
	<body>

		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

		<!-- main-area start -->	
		<main class="main-area">
			<div class="container-fluid">
				<div class="form-area">
					<div class="form-area-inner">
						<div class="form-item">
							<h2>登入</h2>
							<form action="#" method="POST">
                                <?php
                                if ($result == 2){
                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!</strong>Something went wrong!
                                    </div>
                                    <?php
                                }
                                ?>
								<div class="form-item-inner">
									<label>用戶名稱</label>
									<input type="text" name="username" required />
									<label>密碼</label>
									<input type="password" name="password" required />
									<div class="form-item-inner2">
										<div>
											<button type="submit" name="login">登入</button>
										</div>
										<div>
											<a href="#">要幫忙嗎?</a>
										</div>
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
			            	<button class="control--button increment-group__button js-increment-button" type="button" data-direction="inc"><span class="is-vhidden"></span><i class="fas fa-plus"></i></button>
			                <input class="control control--text js-increment-input" type="text" pattern="d*" placeholder="Please enter" name="value" readonly="readonly" value="10" /> </div>
			            	<button class="control--button increment-group__button js-increment-button" type="button" data-direction="dec"><span class="is-vhidden"></span><i class="fas fa-minus"></i></button>
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