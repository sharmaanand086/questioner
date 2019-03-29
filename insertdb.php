<?php 
include("isdk.php");
session_start();
	$con = mysqli_connect("localhost","roo","","ctf_questionnaire");

    $name=$_POST['name'];
    $phone =$_POST['phone'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    $mstatus = $_POST['mstatus'];
    $empstatus =$_POST['emp'];
    $dob = $_POST['dob'];
    $child = $_POST['children'];
    $app = new iSDK;
if ($app->cfgCon("connectionName")) 
{
    $contactId = $app->addWithDupCheck(array('FirstName' => $name, 'Email' => $email,'Phone1' => $phone), 'Email');
    //var_dump($contactId);
	$_SESSION["contactId"]	= 	$contactId;
      

            $sql2 = "INSERT INTO `reg`(`id`, `name`,`phone`,`email`, `password`, `dob`, `maritals`, `children`, `empstatus`) VALUES  ('','$name','$phone','$email','$pass','$dob','$mstatus','$child','$empstatus')";
            $rs = mysqli_query($con,$sql2);
            //var_dump('asd');
            if($rs==true){
                 $check2 ="SELECT * FROM `reg` WHERE email='$email'";
                 $rs2 = mysqli_query($con,$check2);
                 $result = mysqli_fetch_assoc($rs2);
                 $id = $result['id'];
                 //var_dump($id);
              $last_id = $con->insert_id;
              $_SESSION["id"] = $last_id;
                // var_dump($last_id);
            }
                ?>
                <script>
                  window.location.href = 'http://www.coachtofortune.com/questionnaire/step2.php';
                    </script>
                <?php
            }
     
    
    
    


?>