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
        				<li ><i class="fa fa-home" aria-hidden="true"></i><a href="admindashboard.php">Dashboard</a></li>
        				<li class="active"><i class="fa fa-user" aria-hidden="true"></i><a href="addteacher.php">Add Teacher</a></li>
        				<li ><i class="fa fa-graduation-cap" aria-hidden="true"></i><a href="adduni.php">Add University</a></li>
        				
        				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php">Logout</a></li>
        			</ul>
        		</div>
        	</div>
			</div>
			<div class="col-sm-10 paddoff">

				<div class="main-content">

					<div class="box-heading">
						<p>ADD NEW TEACHER</p>
					</div>
					<div class="box-body">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div class="contain-form">
								<form>
									<div class="form-group">
										<label for="name">NAME:</label>
											<div class="contain-input">
												<div class="col-sm-6 paddoff">
													<input class="form-control" type="text" name="fname" id="fname" placeholder="First Name">
												</div>
												<div class="col-sm-6 paddoff">
													<input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name">
												</div>
											</div>
									</div>
									<div class="form-group">
										<label for="email">Email:</label>
										<div class="contain-input">
										<input class="form-control" type="email" name="email" id="email">
										</div>
									</div>
									<div class="form-group">
										<label for="class">University</label>
										<div class="contain-input">
											
										<div class="list" id="list" style="width: 100%;float: left;">
										</div>
										</div>
									</div>
									<div class="form-group">
										<label for="class">Class</label>
										<div class="contain-input">
											
										<div class="list" id="listclass" style="width: 100%;float: left;">
										</div>
										</div>
									</div>
									<div class="button" style="text-align: center;margin: 25px 0px;">
	                                <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="adduser();">
	                         		</div>
								</form>
							</div>
						</div>
						<div class="col-sm-2"></div>
					</div>
					<div class="box-footer"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			getuni();
			function getuni()
		{
			var token='<?php echo password_hash("getuni", PASSWORD_DEFAULT);?>';

			$.ajax(
									{
										type:'POST',
										url:"ajax/getuni.php",
										data:{token:token},
										success:function(data)
										{
											// alert(data);

											$('#list').html(data);
										}
									});
		}
		function getclass()
		{
			var uid = document.getElementById('university').value;
			var token='<?php echo password_hash("getclass", PASSWORD_DEFAULT);?>';

			$.ajax(
									{
										type:'POST',
										url:"ajax/getclass.php",
										data:{token:token,uid:uid},
										success:function(data)
										{
											// alert(data);

											$('#listclass').html(data);
										}
									});
		}
			function adduser()
			{
				var email=document.getElementById('email').value;
				var name=document.getElementById('fname').value + " " +document.getElementById('lname').value;
				var classname=document.getElementById('class').value;
				var uniid=document.getElementById('university').value;
				var token='<?php echo password_hash("login", PASSWORD_DEFAULT);?>';
				if(email!="" && classname!="")
				{
					if (ValidateEmail(email)) {

						$.ajax(
						{
							type:'POST',
							url:"ajax/addteacher.php",
							data:{email:email,classname:classname,name:name,uniid:uniid,token:token},
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
