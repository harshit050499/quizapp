<?php
	include('../connection.php');
    session_start();
    if($_POST['login'] == "teacher" && password_verify("login", $_POST['token']))
    {
        
         $email=test_input($_POST['email']);
         $pass=test_input($_POST['pass']);
        if(validiate_input($email,1) && validiate_input($pass,2))
        {
            $check=$db->prepare('SELECT * from teacher WHERE  email = ?');
            $data=array($email);
            $check->execute($data);
            if($check->rowcount()>0)
            {
                while($datarow=$check->fetch())
                {
                    if(password_verify($pass,$datarow['password']))
                    {
                         $_SESSION['id']=$datarow['id'];
                         $_SESSION['mail']=$email;
                         $_SESSION['name']=$datarow['name'];
                         // $_SESSION['apikey']=$datarow['apikey'];
                        echo 0;
                        
                    }
                    else
                    {
                        echo 1;
                    }
                }
            }
        }
        else
        {
            echo 2;
        }
    }
    if($_POST['login'] == "student" && password_verify("login", $_POST['token']))
    {
        
         $email=test_input($_POST['email']);
         $pass=test_input($_POST['pass']);
        if(validiate_input($email,1) && validiate_input($pass,2))
        {
            $check=$db->prepare('SELECT * from teacher WHERE  email = ?');
            $data=array($email);
            $check->execute($data);
            if($check->rowcount()>0)
            {
                while($datarow=$check->fetch())
                {
                    if(password_verify($pass,$datarow['password']))
                    {
                         $_SESSION['id']=$datarow['id'];
                         $_SESSION['mail']=$email;
                         $_SESSION['name']=$datarow['name'];
                         // $_SESSION['apikey']=$datarow['apikey'];
                        echo 0;
                        
                    }
                    else
                    {
                        echo 1;
                    }
                }
            }
        }
        else
        {
            echo 2;
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