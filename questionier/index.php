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
  
</head>
<body>
<div class="main-container">
    <div class="inner-container">
        <div class="row" style="margin:0;">
            <div class="col-md-6 left-side">
                <div class="logo">
                    <img src="image/logo.png">
                </div>
                <div class="main-text">
                    <p class="main-heading">Help us know you better</p>
                    <p class="explanation">Sign up and fill a quick questionnaire to help us understand you
    better, so we can provide best possible opportunities to you!</p>
                </div>
            </div>
            <div class="col-md-6 right-side">
                <div class="inner-section">
                    <p class="title">let's begin</p>
                    <form action="insertdb.php" method="post" name="registeruser">
                        <input type="hidden" id="emailf" value="0" />
                        <input type="hidden" id="passwordf" value="0" />
                    <div class="input-sections">
                        <input class="user name" id="name" type="text" name="name" placeholder="Username">
                        <input class="user" id="email" type="text" name="email" placeholder="Email ID">
                        <input class="user message" id="password" type="text" name="password" placeholder="Password">
                        <input class="user message" id="confirm_password" type="text" name="cpassword" placeholder="Confirm Password">
                        
                    </div>
                 <div class="radio-section">
                        <div class="first">
                            <p>Marital Status</p>
                            <div class="adjust">
                                <p><input class="red" type="radio" name="mstatus" value="Married"> 
                                    <label for="Married">Married</label>
                                </p>
                                <p><input type="radio" name="mstatus" value="Single"> 
                                    <label for="Single">Single</label>
                                </p>
                            </div>
                        </div>
                        <div class="second">
                            <p>Employment Status</p>
                            <div class="adjust">
                                <p><input type="radio" name="emp" value="In a job">
                                    <label for="job">In a job</label>
                                </p>
                                <p><input type="radio" name="emp" value="Self Employed">
                                    <label for="Employed">Self Employed</label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="start-button" onclick="check()">START</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 var a;
$('input[name=email]').change(function()
 {
//  alert('sfaf');
  var email = document.getElementById('email').value;
 // alert(email);
 var p = document.getElementById('password').value.length;
  var cp = document.getElementById('confirm_password').value.length;
  //alert(p);
  if(p=="" && cp==""){
     $('.message').css('border', '2px solid red'); 
  }
  
    $.ajax({  
        url : "onchange.php",
        data : {email: email},
        type : "POST",
        success : function(data) {
            // alert(data);
            if(data == 1){
               
                $("#email").css('border', '2px solid red');
            }
            if(data == 0){
                 document.getElementById("emailf").value = 1;
                 $("#email").css('border', '2px solid #81b746');
            }
        },
        error : function() {
        }
    });


});
$('#name').on('keyup',function(){
    var name= document.getElementById('name').value.length;
    // alert(name);
    if(name>3){
         $('.name').css('border', '2px solid #81b746');
    }else{
        $('.name').css('border', '2px solid red');
    }
     
});
  
$('#password, #confirm_password').on('keyup', function () {
 
  if ($('#password').val() == $('#confirm_password').val()) {
    //$('.message').html('Matched confirm Password').css('color', 'green');
    $('.message').css('border', '2px solid #81b746');
    document.getElementById("passwordf").value = 1;
  } else {
      // $('.message').html('Not Matching Confirm Password').css('color', 'red');
       $('.message').css('border', '2px solid red');
  }
   
    
});

function check(){
   var emailf=  document.getElementById("emailf").value ;
   var passwordf=  document.getElementById("passwordf").value ;
   var namef=  document.getElementById("name").value ;
   //alert(emailf);
   if(emailf == 1 && namef != "" && passwordf == 1){
   var x = document.getElementsByName('registeruser');
   x[0].submit();
    }
}

 </script>
</body>
</html>