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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	.hidden
	{
		display: none;
	}
	.show
	{
		display: block;
	}
	.optionbutton
	{
		margin: 50px 0px;
		width: 100%;
    float: left;
	}
	.contain-forms
	{
		margin: 25px 0px;
	}
</style>
<body style="background-color:#06508f; "> 
	<section style="margin-top: 30px;">
		<div class="col-sm-12">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div class="main-head">
					<p>QUIZ PORTAL</p>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</section>
	<section>
	<div class="col-sm-12">
		
		<div class="col-sm-4">
			
		</div>
		
		<div class="col-sm-4">
			<div class="optionbutton" style="text-align: center;">
			<div class="col-sm-6">
				<button id="loginbutton" onclick="slogin();">AS A STUDENT</button>
			</div>
			<div class="col-sm-6">
				<button id="signupbutton" onclick="tlogin();">AS A TEACHER</button>
			</div>
			</div>
			<div class="contain-forms">
				<div class="login-form " id="studentlogin">
					
					<form>
						<fieldset>
						<div class="form-group">
							<label for="name">Student Email:</label>
							<input class="form-control" type="email" name="email" id="email">
						</div>
						<div class="form-group">
							<label for="name">Password:</label>
							<input class="form-control" type="password" name="password" id="password">
						</div>
					
						<div class="button" style="text-align: center;margin: 25px 0px;">
                                <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="studentlogin();">
                         </div>
                        </fieldset>
					</form>
				</div>
				<div class="signup-form hidden" id="teacherlogin">
					<p>TEACHER FORM</p>
					<form id='form'>
						<fieldset>
						<div class="form-group">
							<label for="name">Teacher Email:</label>
							<input class="form-control" type="email" name="temail" id="temail">
						</div>
						<div class="form-group">
							<label for="name">Password:</label>
							<input class="form-control" type="password" name="tpassword" id="tpassword">
						</div>
					
						<div class="button" style="text-align: center;margin: 25px 0px;">
                                <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="teacherlogin();">
                         </div>
                       
                    </fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	function slogin()
	{
		var slogin=document.getElementById('studentlogin');
		var tlogin=document.getElementById('teacherlogin');
		tlogin.classList.add('hidden');
		slogin.classList.remove('hidden');
		slogin.classList.add('show');
	}
	function tlogin()
	{
		var slogin=document.getElementById('studentlogin');
		var tlogin=document.getElementById('teacherlogin');
		slogin.classList.add('hidden');
		tlogin.classList.remove('hidden');
		tlogin.classList.add('show');	
	}
	function studentlogin()
	{
		var email=document.getElementById('email').value;
		var pass=document.getElementById('password').value;
		var token='<?php echo password_hash("login", PASSWORD_DEFAULT);?>';
		if(email!="" && pass!="")
		{
			if (ValidateEmail(email)) {

				$.ajax(
				{
					type:'POST',
					url:"ajax/login.php",
					data:{email:email,pass:pass,login:'student',token:token},
					success:function(data)
					{
						if(data == 0)
						{
							window.location = "studentdashboard.php";
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
	function teacherlogin()
	{
		
		var email=document.getElementById('temail').value;
		var pass=document.getElementById('tpassword').value;
		var token='<?php echo password_hash("login", PASSWORD_DEFAULT);?>';
		if(email!="" && pass!="")
		{
			if (ValidateEmail(email)) {

				$.ajax(
				{
					type:'POST',
					url:"ajax/login.php",
					data:{email:email,pass:pass,login:'teacher',token:token},
					success:function(data)
					{
						if(data == 0)
						{
							window.location = "teacherdashboard.php";
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
	
	function save()
	{
			

			var name=document.getElementById('name').value;
			var email=document.getElementById('email11').value;
			var pass=document.getElementById('password11').value;
			var cpass =document.getElementById('cpassword').value;
			
			if(name!="" && email!="" && pass!="" && cpass!="" )
			{
			var a = ValidateEmail(email);
            var b = passmatch(pass,cpass);
            
            
				if( a== true && b== true){
                    $.ajax({
                                        type: "POST",
                                        url: "ajax/signup.php",
                                        data: {name:name,pass:pass,cpass:cpass,email:email,signup:'signup'},
                                        success: function(data){
                                          
                                             if(data == 3){
                                                alert('You are already registered. kindly Login.');

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
                                             else{
                                                alert(data);
                                             }
                                     
                                         
                                        }
                                      });
              }
			}
			else
			{
				alert("INPUT ALL THE DATA");
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
function passmatch(a,b){
   
    if(a == b){ return (true);}
    else{ alert("You have entered an invalid Password!"); return(false); }
}
</script>
</section>

<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</body>

</html>