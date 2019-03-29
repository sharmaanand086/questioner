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
 
                    <input type="text"   name="email" id="email" placeholder="Username"  >
                    <input type="password" id="password" name="password" id="password" placeholder="Password"  >
                    <!--<input type="submit" class="start-button"   name ="submit" id="submit" value="START">-->
                    <div class="start-button"   name ="submit" id="submit"> START</div>
                     <div class="error" id="ack"></div> 
                    <script>

$("#submit").click(function()  
 {
  //alert('sfaf');
  $("#ack").css('display', 'none', 'important');
  var email= document.getElementById('email').value;
  var pass = document.getElementById('password').value;
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
        console.log(data);
        alert(data);
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