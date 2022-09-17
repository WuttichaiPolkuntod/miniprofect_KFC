<?php
    if(isset($_POST['submit'])){
        include 'connect.php';
        $username=$_POST['Username'];
        $password=$_POST['Password'];
        $sql="SELECT * FROM customer WHERE cus_id='$username'and cus_password='$password'";
        $result=$con->query($sql);
        $row=mysqli_fetch_array($result);
        $num=mysqli_num_rows($result);
		$sql2="SELECT * FROM user WHERE username='$username'and password='$password'";
        $result2=$con->query($sql2);
		$row2=mysqli_fetch_array($result2);
        $num2=mysqli_num_rows($result2);
        if($num==0 && $num2==0){
            echo "<script>alert('Username หรือ Password ไม่ถูกต้อง')</script>";
        }
        else{
			if($num2==1){
				session_start();
            	$_SESSION['username']=$row2['username'];
            	$_SESSION['name']=$row2['name'];
				header("location:admin/index.php");
			}
			else{
				session_start();
            	$_SESSION['username']=$row['cus_id'];
            	$_SESSION['name']=$row['cus_name'];
				header("location:index.php");
			}
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Log in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="admin/login/css/style.css">

	</head>
	<body>
	<div class="container-login" style="background-image: url(admin/login/images/bg-login.png);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex border border-5 border-dark">
						<div class="img" style="background-image: url(admin/login/images/login.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" class="form-control" name="Username">
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" name="Password">
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password ?</a>
									</div>
		            </div>
		          </form>
		          <p class="text-center">Don't have an account? <a data-toggle="tab" href="#signup">Sign Up</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
	</div>
	<script src="admin/login/js/jquery.min.js"></script>
  <script src="admin/login/js/popper.js"></script>
  <script src="admin/login/js/bootstrap.min.js"></script>
  <script src="admin/login/js/main.js"></script>

	</body>
</html>

