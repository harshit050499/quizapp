
<?php


	include('../connection.php');
    session_start();
	if(isset($_POST["signup"]))
	{
		
		$name=test_input($_POST['name']);
		$email=test_input($_POST['email']);
		$pass=test_input($_POST['pass']);
		$cpass=test_input($_POST['cpass']);
		$flag=0;
        $key=password_hash("abc", PASSWORD_DEFAULT);
		if(validiate_input($name,0) && validiate_input($email,1) && validiate_input($pass,2))
		{
			$check=$db->prepare('SELECT * from user_details WHERE  email = ?');
			$data=array($name);
			$check->execute($data);
			if($check->rowCount() == 1)
			{
				$flag=1;
				echo 3;
			}
            $check=$db->prepare('SELECT * from user_details WHERE name=?');
            $data=array($name);
            $check->execute($data);
            if($check->rowcount() ==1)
            {
                    $flag=1;
                    echo 4;
            }
			if($flag==0)
			{
				$password1_hash=password_hash($pass,PASSWORD_DEFAULT);
				$query=$db->prepare("INSERT INTO user_details(name,email,password,status) VALUES (?, ?, ?,?)");
				$data=array($name,$email,$password1_hash,'admin');
				$execute=$query->execute($data);
				if($execute)
				{
					
					echo 0;
				}
				else
				{
					echo 7;
				}
			}
		}
	}




	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function validiate_input($data, $type){

    if($type==0){
        //echo "0";
        if(preg_match('/[^a-zA-Z0-9 ._-]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }
    }
    if($type==1){
        //echo "1";
        if (preg_match("/^[a-zA-Z0-9 ._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $data)) {
            //echo "match";
            return true;
        }else{
            //echo "injection";
            return false;
        }

    }
    if($type==2){
        //echo "2";
        if (preg_match('/[^a-zA-Z0-9@&_-]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }

    }
    if($type==3){
        //echo "2";
        if (preg_match('/[^a-zA-Z0-9 _,]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }

    }

}
?>