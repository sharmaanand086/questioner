<?php 
session_start();
	$con = mysqli_connect("localhost","roo","","ctf_questionnaire");
  $id = $_POST['id'];
  $answers = $_POST['answers'];
 // var_dump($answers);
 $a = 1;
  foreach($answers as $ans){
    //var_dump($ans)  ;
    
    $convert =addslashes($ans);
     $sql2 = "INSERT INTO `answers`(`id`, `userid`, `qid`, `answers`) VALUES ('','$id','$a','$convert')";
            $rs = mysqli_query($con,$sql2);
            $a++;
  }
   if($rs==true){
                ?>
                <script>
                  window.location.href = 'http://www.coachtofortune.com/questionnaire/thankyou.html';
                    </script>
                <?php
            }
           

?>