<?php
 session_start();
$ID = $_SESSION['id'];
echo $ID;

?>

<html>
<head>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post" action="insertquestion.php">
       <input type="hidden" id="id" value="<?php echo $ID ?>" name="id">
       <?php  $con = mysqli_connect("localhost","username","password","dbname");

       $check ="SELECT * FROM `questions`";
       $rs = mysqli_query($con,$check);
       while($row= mysqli_fetch_assoc($rs)){
        
       ?>
       <p><?php echo $row["question"]; ?><br>
       
       <input type="text" name="answers[]">
       
       </p>
       
       <?php }?>
       <input type="submit" name="submit" value="submit">
        </form>
    </div>

 </body>
  
 </html>