<?php 
session_start();
	$con = mysqli_connect("localhost","username","password","dbname");

    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    $mstatus = $_POST['mstatus'];
    $empstatus =$_POST['emp'];
                   
            $sql2 = "INSERT INTO `reg`(`id`, `name`, `email`, `password`, `maritals`, `empstatus`) VALUES ('','$name','$email','$pass','$mstatus','$empstatus')";
            $rs = mysqli_query($con,$sql2);
            //var_dump('asd');
            if($rs==true){
                 $check2 ="SELECT * FROM `reg` WHERE email='$email'";
                 $rs2 = mysqli_query($con,$check2);
                 $result = mysqli_fetch_assoc($rs2);
                 $id = $result['id'];
                 //var_dump($id);
               $_SESSION["id"] = $id;
                ?>
                <script>
                  window.location.href = 'http://www.coachtofortune.com/questionnaire/step2.php';
                    </script>
                <?php
            }
     
    
    
    


?>