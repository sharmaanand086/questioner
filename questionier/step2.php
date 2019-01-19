<?php
 session_start();
$ID = $_SESSION['id'];
//echo $ID;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/resp.css">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
        history.go(1);
    };
    </script>
</head>
<body onload="noBack();" >
<div class="main-section">
    <div class="header">
        <div class="container ">
            <div class="extra_header">
            <div class="logo">
                <img src="image/logo.png">
            </div>
            <p class="header-text">Fill out this quick questionnaire and hit the submit button</p>
        </div></div>
    </div>

    <div class="second-section">
        <div class="container">
             <form method="post" action="insertquestion.php">
             <input type="hidden" id="id" value="<?php echo $ID ?>" name="id">
        <?php   $con = mysqli_connect("localhost","username","password","dbname");

                   $check ="SELECT * FROM `questions`";
                   $rs = mysqli_query($con,$check);
                   $a=1;
                   while($row= mysqli_fetch_assoc($rs)){
                    
                   ?>
            <div class="questions">
               
                <p><span> <?php echo $a++ ?>. </span><?php echo $row["question"]; ?>
                 <input class="ques" id="" type="text" name="answers[]" placeholder="Start writing answer....">
                </p>
                <!--<input class="ques" id="" name="" placeholder="Start writing answer....">-->
            </div>
             <?php }?>
             <input type="submit" class="submit-button"  name="submit" value="SUBMIT">
            </form>
            <!--<div class="submit-button">SUBMIT</div>-->
        </div>

    </div>
</div>

</body>
</html>