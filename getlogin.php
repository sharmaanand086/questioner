<?php
 session_start();
$con = mysqli_connect("localhost","roo","","ctf_questionnaire");
               
                   $pass=  $_POST['pass'];       
                   $email = $_POST['email'];
                   $check ="SELECT * FROM `reg`  WHERE email='$email' AND password='$pass'";
                   $rs = mysqli_query($con,$check);
                   $rowcount=mysqli_num_rows($rs);
                    if($rowcount >0)
                     {
                    echo '1';
                    $check2 ="SELECT * FROM `reg` WHERE email='$email'";
                 $rs2 = mysqli_query($con,$check2);
                 $result = mysqli_fetch_assoc($rs2);
                 $id = $result['id'];
                 //var_dump($id);
              $_SESSION["id1"] = $id;
    				}else{
                    echo'0';
                    } 
                                
                   
                   ?>