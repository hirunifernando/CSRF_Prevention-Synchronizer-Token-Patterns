<?php

if(isset($_POST['username'],$_POST['password'])){
	$uname = $_POST['username'];
	$pwd = $_POST['password'];
	if($uname == 'sanda' && $pwd == '123'){
		echo 'Successfully logged in';
		session_start();
		$myfile = fopen("Tokens.txt", "w") or die("Unable to open file!");
		$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
		$txt = $_SESSION['token'].",";

		fwrite($myfile, $txt);
		$session_id = session_id();
		setcookie('ssd',$session_id,time()+60*60*24*365,'/');
		$txt1 = $session_id."\n";
		fwrite($myfile, $txt1);
		fclose($myfile);

		echo $_SESSION['token'];

		
	}
	else{
		echo 'Invalid Credentials';
		exit();
	}
	
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Cross Site Request Forgery Protection</title>
		
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	       //When the page has loaded.	    
        $( document ).ready(function(){
            //Perform Ajax request.
            $.ajax({
                url: 'csrf.php',
                type: 'post',
				data: { 
					'sessionid': '<?php echo $_COOKIE['ssd']; ?>'
				},
                success: function(data){
                    console.log(data);
					document.getElementById("token_to_be_added").value = data;
					
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    
                  }
            });
        });
		
    </script>
	</head>
	<body>
	
	<div class="limiter" >
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/post1.png" alt="IMG">
				</div>

				<form class="login100-form validate-form"  action="home.php"   method="post">
					<span class="login100-form-title">
						<h1>Type Something</h1>
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Please enter your post">
						Post:<input class="input100" type="text" name="updatepost" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						</span>
					</div>
					<div class="wrap-input100 validate-input" >
						Token:<input class="input100" type="hidden" name="token" value="" id="token_to_be_added">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" >
					Session Token:<input class="input100" type="hidden" name="sessiontoken" value="<?php echo $_COOKIE['ssd']; ?>" id="sessiontoken">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Update Post
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
