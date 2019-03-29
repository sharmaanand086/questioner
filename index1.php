<html>
<head>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="insertdb.php" method="post" name="registeruser">
            <input type="hidden" id="emailf" value="0" />
            <input type="hidden" id="passwordf" value="0" />
            
 <p> Name<input type="text" name="name" id="name" required/> </p>
 <p> Email<input type="text" name="email" id="email" required/>
  
 </p>
 <p> Password<input type="password" name="password"  id="password" required /></p>
 <p> c Password<input type="password" name="cpassword"   id="confirm_password" required/>
  <span id='message'></span>
 </p>
 <p>marital status:
 <br>
 married<input type='radio' name="mstatus" value="married" required>
 unmarried <input type='radio' name="mstatus" value="unmarried"  required>
 </p>
  <p>Employement status:
 <br>
 in job<input type='radio' name="emp" value="injob" required>
 self employed <input type='radio' name="emp" value="selfemployeed" required >
 </p>
 <!--<p><button   value="register" name="register" onclick="check()">submit</button></p> -->
 <a onclick="check()">abc</a>
 </form>
        
    </div>

 </body>
 
 <script>
 var a;
$('input[name=email]').change(function()
 {
//  alert('sfaf');
  var email = document.getElementById('email').value;
 // alert(email);
    $.ajax({  
        url : "onchange.php",
        data : {email: email},
        type : "POST",
        success : function(data) {
             alert(data);
            if(data == 1){
               
                 $(this).css('border', '2px solid red');
            }
            if(data == 0){
                 document.getElementById("emailf").value = 1;
                 $(this).css('border', '2px solid red');
            }
        },
        error : function() {
        }
    });


});

$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
    document.getElementById("passwordf").value = 1;
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});

function check(){
   var emailf=  document.getElementById("emailf").value ;
   var passwordf=  document.getElementById("passwordf").value ;
   var namef=  document.getElementById("name").value ;
   alert(emailf);
   if(emailf == 1 && namef != "" && passwordf == 1){
   var x = document.getElementsByName('registeruser');
   x[0].submit();
    }
}

 </script>
 </html>