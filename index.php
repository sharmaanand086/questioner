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
        <!--<div class="row" style="margin:0;">-->
            <div class="img-div left-side">
                <div class="logo1">
                    <p><span><img src="image/ak.png"></span>ARFEEN KHAN</p>
                </div>
                <div class="main-text">
                    <p class="main-heading">Help us know you better</p>
                    <p class="explanation">Sign up and fill a quick questionnaire to help us understand you
    better, so we can provide best possible opportunities to you!</p>
                </div>
                <div class="start-button login_button" data-toggle="modal" data-target="#myModal"  style="">LOGIN</div>
            </div>
            
            <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog abcd">
    
      <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header" style="background:#fff; margin:0; padding:0;border-bottom:none;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
      
        <div class="modal-body">
            <div class="login-sec">
			<div class="login">
				<p>LOGIN</p>
							</div>
			<div class="id-pass">
				
				<input type="text" id="username" name="username" placeholder="Username" class="username" required="">
				<input type="password" id="password1" name="password" placeholder="Password" class="username" required="">
				<div class="agree" style="margin-bottom: 3%;"><span class="sub-button" id="submit" >SUBMIT</span></div>
				<div class="error" id="ack"></div> 
			<!--<div class="error"></div>-->
					<!--<label class="comment">-->
					<!--	<input class="check" type="checkbox" checked="checked" name="remember">keep me signed in-->
					<!--</label>-->
					<!--<div class="forgot" data-toggle="modal" data-target="#myModal">  Forgot Password </div> -->
				
												</div>
		</div>
        
        </div>
      </div>
      
    </div>
  </div>
            
            
            
            
            
            
            
            
            <div class="img-div right-side">
                <div class="inner-section">
                    <p class="title">let's begin</p>
                    <form action="insertdb.php" method="post" name="registeruser">
                        <input type="hidden" id="emailf" value="0" />
                        <input type="hidden" id="passwordf" value="0" />
                    <div class="input-sections">
                        <input class="user name" id="name" type="text" name="name" placeholder="Name">
                         <input class="user phone" id="phone" type="text" name="phone" placeholder="Contact Number">
                        <input class="user" id="email" type="text" name="email" placeholder="Email ID">
                        <span id="error" style="display:none;color:red">Email already Registered Try Another!</span>
                        
                        <input class="user message" id="password" type="password" name="password" placeholder="Password">
                        <input class="user message" id="confirm_password" type="password" name="cpassword" placeholder="Confirm Password">
                         <input class="user" id="dob" type="text" onfocus="(this.type='date')" name="dob" placeholder="Date of birth.">
                        
                    </div>
                 <div class="radio-section">
                        <div class="first">
                            <p>Marital Status</p>
                            <div class="adjust">
                                <p><input class="red" type="radio" name="mstatus" id="married" value="Married" onclick="func(this.id)"> 
                                    <label for="Married">Married</label>
                                </p>
                                <p><input type="radio" name="mstatus" value="Single" id="single" onclick="func(this.id)"> 
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
                      <div class="input-sections">
                          
                               <input class="user " id="children" type="text" name="children" placeholder="Number of child.." style="display:none;" >
                              
                          </div>
                    <div class="start-button" onclick="check()">START</div>
                    </form>
                </div>
            </div>
        <!--</div>-->
    </div>
</div>
<script>
//  $("#agree").click(function(){
 
     
     
//  });

</script>
<script>
 var a;
$('input[name=email]').change(function()
 {
//  alert('sfaf');
  var email = document.getElementById('email').value;
 // alert(email);
//  var p = document.getElementById('password').value.length;
//  var cp = document.getElementById('confirm_password').value.length;
//   //alert(p);
//   if(p=="" && cp==""){
//      $('.message').css('border', '2px solid red'); 
//   }
  
    $.ajax({  
        url : "onchange.php",
        data : {email: email},
        type : "POST",
        success : function(data) {           // alert(data);
                 if(data==0){
                 document.getElementById("emailf").value = 1;
                 $("#email").css('border', '2px solid #81b746');
                 $("#error").css('display','none');
                 
                 }
                 if(data==1){
                $("#email").css('border', '2px solid red');
                 $("#error").css('display','block');
               document.getElementById("emailf").value = 0;
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
$('#phone').on('keyup',function(){
    var name= document.getElementById('phone').value.length;
    // alert(name);
    if(name>9){
         $('.phone').css('border', '2px solid #81b746');
    }else{
        $('.phone').css('border', '2px solid red');
    }
     
});
  
$('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == "" || $('#confirm_password').val() == "") {
        
    }else{
        if ($('#password').val() == $('#confirm_password').val()) {
    //$('.message').html('Matched confirm Password').css('color', 'green');
    $('.message').css('border', '2px solid #81b746');
    document.getElementById("passwordf").value = 1;
  } else {
      // $('.message').html('Not Matching Confirm Password').css('color', 'red');
       $('.message').css('border', '2px solid red');
  }
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

 
function func(e) {
  //$(e).text('there');
  var x = document.getElementById(e).value;
  //alert(x);
  if (x == 'Married') {
    var y = document.getElementById('children');
    y.style.display = 'block';
  }if(x == 'Single'){
      var z = document.getElementById('children');
      z.style.display = 'none'; 
  }
}

$("#submit").click(function()  
 {
  //alert('sfaf');
  $("#ack").css('display', 'none', 'important');
  var email= document.getElementById('username').value;
  var pass = document.getElementById('password1').value;
// alert(pass );
 if(email=='' || pass=='')
          {
            $("#ack").css('display','inline','important');
            $("#ack").css("color", "red");
            $("#ack").html("Please enter your username and password!");
          }
         else
          {
      $.ajax({  
        url : "getlogin.php",
        data : {email:email,pass:pass},
        type : "POST",           
        beforeSend: function(){
                    $("#ack").css('display', 'inline', 'important');
                    $("#ack").html("Please Wait...");
                },      
        success : function(data) 
        {
        //console.log(data);
        //alert(data);
                    if(data=='1'){
                        $("#ack").css('display', 'inline', 'important');
                        $("#ack").html("<font color='green'>loged In</font>");
                         window.location.href="http://www.coachtofortune.com/questionnaire/answer.php";
                    }
                    if(data=='0'){
                        $("#ack").css('display', 'inline', 'important');
                        $("#ack").html("<font color='red'>Wrong username or password!</font>");                         
                    }
                
        },
        error : function()
         {
          
        }
    });

}
  return false;
});
 
 </script>
</body>
</html>