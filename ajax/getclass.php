<?php
    include('../connection.php');
    session_start();
    if(password_verify("getclass", $_POST['token']))
    {
        $check=$db->prepare('SELECT * from class');
            $data=array();
            $check->execute($data);
            $count=0;
            if($check->rowcount()>0)
            {
                ?>
                <select id='class' name="class" class="form-control">
                <?php
                while($datarow=$check->fetch())
                {
                    
                    ?>
                    <option value="<?php echo $datarow['name'];?>"><?php echo $datarow['name'];?></option>
                        <?php
                   
                     
            }
        ?></select><?php
    }
}
?>