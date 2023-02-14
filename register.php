<?php
include ('config/db_config.php');
$result = 0;
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $phone = mysqli_real_escape_string($con,$_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $key = 'clsopenbox';
    $Pwd_peppered = Hash_hmac("Sha256", $password, $key);
    $Pwd_hashed = Password_hash($Pwd_peppered, PASSWORD_ARGON2ID);
    $address1 = mysqli_real_escape_string($con, $_POST['address1']);
    $address2 = mysqli_real_escape_string($con, $_POST['address2']);
    $address3 = mysqli_real_escape_string($con, $_POST['address3']);

    $address = $address1.' '.$address2.' '.$address3;

    $register_data = $con->query("select id from register where email = '$username'");

    if($register_data-> num_rows > 0){
        $result = 1;
    }else{
        $register = $con->query("INSERT INTO `register`(`username`, `name`, `password`, `address`, `email`, `phone`) 
VALUES ('$username','$name','$Pwd_hashed','$address','$email','$phone')");
        if($register){
            $register_id = $con->query("select id from register where email = '$email'");
            if($register_id){
                while ($data = mysqli_fetch_assoc($register_id)){
                    $id = $data['id'];
                }
                session_start();
                $_SESSION['id'] = $id;
                header('Location: new.php');
            }else{
                $result = 2;
            }

        }
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
							<h2>注冊</h2>
							<form action="#" method="POST">
                                <?php
                                if ($result == 1){
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Sorry!</strong> The email you have entered is already registered with us. Go to <a href="login.php">Login Page</a> and login to your account.
                                    </div>
                                    <?php
                                }elseif ($result == 2){
                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!</strong>Something went wrong.
                                    </div>
                                    <?php
                                }
                                ?>
								<div class="form-item-inner3">
									<div class="form-item-inner4">
										<label>用戶名稱</label>
										<input type="text" name="username" required />
										<label>密碼</label>
										<input type="password" name="password" required />
										<label>電郵</label>
										<input type="email" name="email" required />
										<label>電話</label>
										<input type="text" name="phone" required>
									</div>
									<div class="form-item-inner4">
										<label>姓名</label>
										<input type="text" name="name" required/>
										<label>地址</label>
										<input type="text" name="address1" required/>
										<input type="text" name="address2" />
										<input type="text" name="address3" />
									</div>
									<div class="form-item-inner5">
										<button type="submit" name="register">注冊</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="form-area-inner2">
						<div class="form-item">
							<h2>注冊</h2>
							<form action="#" method="POST">
								<div class="form-item-inner">
									<label>用戶名稱</label>
									<input type="text" name="" required /> 
									<label>密碼</label>
									<input type="password" name="" required />
									<label>電郵</label>
									<input type="email" name="" required />
									<label>姓名</label>
									<input type="text" name="">
									<label>地址</label>
									<input type="text" name="">
									<input type="text" name="">
									<input type="text" name="">
								</div>
								<div class="form-item-inner5">
									<button type="submit">注冊</button>
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