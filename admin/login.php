<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<section>
		<div class="col-sm-12">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="group">
					
					<div class="forms">
						<div class="loginform" id="loginform">
							<form>
								<div class="form-group">
									<label>USERNAME</label>
									<input type="text" class="form-control" name="email" id="email" placeholder="Enter your name">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password"  class="form-control" name="password" id="password" placeholder="Enter your password">
								</div>
								<div>
									
									<input type="submit" name="login" id="submit" onclick="sendlogin();">
								</div>
							</form>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>

	</section>

<script type="text/javascript">



function sendlogin()
{
	var email = document.getElementById('email').value;
	var password = document.getElementById('password').value;
	var token = "<?php echo password_hash('logintoken', PASSWORD_DEFAULT);?>";
	if(email!="" && password!="")
	{
			$.ajax(
				{
					type:'POST',
					url:"ajax/login.php",
					data:{email:email,password:password,token:token},
					success:function(data)
					{
						if(data == 0)
						{
							window.location = "admindashboard.php";
						}
					}
				});
	}
	else
	{
		alert('please fill all the fields');
	}


}


</script>
<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>





</body>
</html>