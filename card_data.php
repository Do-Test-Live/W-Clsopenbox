<?php
session_start();
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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		
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
							<h2>輸入資料</h2>
							<form action="#" method="POST">
								<div class="form-item-inner5">
									<label>信用卡號</label>
									<input type="text" name="" /> 
									<div class="form-area-inner6">
										<div class="form-area-inner7">
											<label>CVV</label>
											<input type="text" name="" /> 
										</div>
										<div class="form-area-inner7">
											<label>過期日</label>
											<input type="text" name="" /> 
										</div>
									</div>
									<label>姓名</label>
									<input type="text" name="" /> 
									<button type="submit">抽獎</button>
								</div>
							</form>
						</div>
					</div>
					<div class="form-area-inner2">
						<div class="form-item">
							<h2>輸入資料</h2>
							<form action="#" method="POST">
								<div class="form-item-inner">
									<label>信用卡號</label>
									<input type="text" name="" /> 
									<label>CVV</label>
									<input type="text" name="" />
									<label>過期日</label>
									<input type="text" name="" />
									<label>姓名</label>
									<input type="text" name="" />
									<div class="form-area-inner8">
										<button type="submit">抽獎</button>
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

<?php
if($_SESSION['status'] == 'success'){
    ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
            })
        </script>
        <?php
        unset($_SESSION['status']);
}
?>
		
		

		
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