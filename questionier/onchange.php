<?php 
  $con = mysqli_connect("localhost","username","password","dbname");
  if(isset($_POST['email']))
{
     
    $email=$_POST['email'];
   
       $check ="SELECT * FROM `reg` WHERE email='$email'";
       $rs = mysqli_query($con,$check);
        
       if(mysqli_num_rows($rs)>0)
       {
           echo "1";
       }
       else{
           echo"0";
       }
}

?>