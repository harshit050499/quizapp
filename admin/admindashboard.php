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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
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
        				<li class="active"><i class="fa fa-home" aria-hidden="true"></i><a href="admindashboard.php">Dashboard</a></li>
        				<li ><i class="fa fa-user" aria-hidden="true"></i><a href="addteacher.php">Add Teacher</a></li>
        				<li ><i class="fa fa-graduation-cap" aria-hidden="true"></i><a href="adduni.php">Add University</a></li>
        				
        				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php">Logout</a></li>
        			</ul>
        		</div>
        	</div>
			</div>
			<div class="col-sm-10 paddoff">

				<div class="main-content">

					<div class="box-heading">
						<p>ADMIN DASHBOARD</p>
					</div>
					<div class="box-body">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							
							
						</div>
						<div class="col-sm-2"></div>n
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
