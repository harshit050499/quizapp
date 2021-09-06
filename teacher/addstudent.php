<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
	<section>
		<div class="col-sm-12 paddoff">
			<div class="col-sm-2 paddoff">
				<div class="main-box">
        		<div class="heading">
        			<p>Welcome<br> <?php echo $_SESSION['name'];?></p>
        		</div> 
        		<div class="contain-list">
        			<ul>
        				<li ><i class="fa fa-home" aria-hidden="true"></i><a href="teacherdashboard.php">Dashboard</a></li>
        				<li class="active"><i class="fa fa-users" aria-hidden="true"></i><a href="addstudent.php">Add Student</a></li>
        				<li ><i class="fa fa-plus-square" aria-hidden="true"></i><a href="addtest.php">Add Test</a></li>
        				<li><i class="fa fa-file-text" aria-hidden="true"></i><a href="createtest.php">Create Test</a></li>
        				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php">Logout</a></li>
        			</ul>
        		</div>
        	</div>
			</div>
			<div class="col-sm-10 paddoff">

				<div class="main-content">

					<div class="box-heading">
						<p>ADD NEW STUDENT</p>
					</div>
					<div class="box-body">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							
						</div>
						<div class="col-sm-2"></div>
					</div>
					<div class="box-footer"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function adduser()
			{
				var email=document.getElementById('email').value;
				var name=document.getElementById('fname').value + " " +document.getElementById('lname').value;
				var role=document.getElementById('role').value;
				var token='<?php echo password_hash("login", PASSWORD_DEFAULT);?>';
				if(email!="" && role!="")
				{
					if (ValidateEmail(email)) {

						$.ajax(
						{
							type:'POST',
							url:"ajax/adduser.php",
							data:{email:email,role:role,name:name,signup:'signup',token:token},
							success:function(data)
							{
								if(data == 3)
								{
                                    alert('User already Exist.');

                                }
                                else if(data == 0){
                                    alert('registered sucessfully !. ');
                                    window.location.reload();
                                }
                                else if(data == 4)
                                {
                                    alert('name exist.Please enter another name!');
                                }
                                else if(data==7)
                                {
                                    alert("something went wrong");
                                }
                                else
                                {
                                    alert(data);
                                }
							}
						});
					}
				}

			}
			function ValidateEmail(mail){     
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if(reg.test(mail)){
            return true;
        }
        else{
                alert("You have entered an invalid email address!");   
                return false;
            }
}
		</script>
	</section>
</body>

<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</html>
