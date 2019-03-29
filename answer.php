<?php
 session_start();
$ID = $_SESSION['id1'];
//$ID=375;
//echo $ID;
$ftime;
$con = mysqli_connect("localhost","roo","","ctf_questionnaire");
 $check1 ="SELECT * FROM `reg` WHERE `id` ='$ID'";
       $rs1 = mysqli_query($con,$check1);
         while($row1= mysqli_fetch_assoc($rs1)){
             $ftime = $row1["ftime"];
             //echo $ftime;
         }
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
<body>
<div class="main-section">
    <div class="header">
        <div class="container ">
            <div class="extra_header">
            <div class="logo">
                <p><span><img src="image/ak.png"></span>ARFEEN KHAN</p>
            </div>
            <p class="header-text">Fill out this quick questionnaire and hit the submit button</p>
        </div></div>
    </div>

    <div class="second-section">
        <div class="container">
             <form method="post" action="insertquestion.php">
             <input type="hidden" id="id" value="<?php echo $ID ?>" name="id">
        <?php 
                   $check ="SELECT * FROM `questions`";
                   $rs = mysqli_query($con,$check);
                   $a=1;
                   
                   while($row= mysqli_fetch_assoc($rs)){
                       $questionid = $row["id"];
                    $answer = "SELECT * FROM `answers` WHERE userid='$ID' AND qid = '$questionid'";
                     $rs1 = mysqli_query($con,$answer);
                      $row_cnt = mysqli_num_rows($rs1);
                    //var_dump($row_cnt);
                    if($row_cnt > 0){
                    while($row1 = mysqli_fetch_assoc($rs1)){
                    
                   ?>
            <div class="questions">
               
                <p><span> <?php echo $a++ ?>. </span><?php echo $row["question"]; ?>
                 <input required class="ques" id="" type="text" name="answers[]" value="<?php echo $row1["answers"]; ?>" placeholder="Start writing answer....">
                </p>
                <!--<input class="ques" id="" name="" placeholder="Start writing answer....">-->
            </div>
             <?php    }}
                      else{
                          ?>
                          <div class="questions">
               
                     <p><span> <?php echo $a++ ?>. </span><?php echo $row["question"]; ?>
                     <input required class="ques" id="" type="text" name="answers[]" value="<?php echo $row1["answers"]; ?>" placeholder="Start writing answer....">
                    </p>
                    <!--<input class="ques" id="" name="" placeholder="Start writing answer....">-->
                    </div>
                          <?php
                      
                         
                    } 
                 }
             ?>
             <input type="submit" class="submit-button"  name="submit" value="SUBMIT">
            </form>
            <!--<div class="submit-button">SUBMIT</div>-->
        </div>

    </div>
</div>
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog abcd">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title conditions">Terms And Conditions</h4>
        </div>
        <div class="modal-body">
            <div class="terms">
         <p><input type="checkbox" name="city[]" style="margin-right:8px;"> I understand that I'm getting started with program.</p>

          <p><input type="checkbox" name="city[]" style="margin-right:8px;">  I am not going to settle and I will put efforts in to help people change their lives.</p>
            
          <p><input type="checkbox" name="city[]" style="margin-right:8px;">  I'm serious about getting incredible support and I will make the most of it.</p>
            
           <p><input type="checkbox" name="city[]" style="margin-right:8px;"> I know that this is not a get rich quick scheme.</p>
            
          <p><input type="checkbox" name="city[]" style="margin-right:8px;">  I am ready to invest time and energy in myself to build a financially free future.</p>
            
          <p><input type="checkbox" name="city[]" style="margin-right:8px;">  I know that the money I have paid is non - refundable.</p>
            
          <p><input type="checkbox" name="city[]" style="margin-right:8px;">  I understand that there's no guarantee that I will make money, however, If I put efforts in, I will make good money.</p>
            
          <p><input type="checkbox" name="city[]" style="margin-right:8px;">  My work is my mission and I'm not going to waste anymore time and efforts that don't pay off.</p>
          
           <p><input type="checkbox" name="city[]" style="margin-right:8px;"> I agree to all Terms & Conditions </p>
          </div>
          <div class="agree"><span class="sub-button" id="agree" >I am starting the course now</span></div>
        </div>
      </div>
      
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
        var checkftime = "<?php echo $ftime; ?>";
        // alert(checkftime);
        if(checkftime == 0){
            $("#myModal").modal('show');
        }else{
            
        }
        
    });
     $("#agree").click(function(){
      var checkedNum = $('input[name="city[]"]:checked').length;
     
        if (checkedNum == 9) {
        var id='<?php echo $ID; ?>';
            $.ajax({  
        url : "ftimedefine.php",
        data : {id: id},
        type : "POST",
        success : function(data) {
              //alert(data);
              //console.log(data);
            if(data == 1){
                $('#myModal').modal('hide');
            }
        },
        error : function() {
        }
    });
        }else{
            alert('select all checkbox');
        }
});
</script>
</body>
</html>
