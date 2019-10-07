<?php
header('Access-Control-Allow-Origin:http://arfeenkhan.com/question1/', false);
	$questionnaires = $questionnaires[0]; 
	
	if( $questionnaires->minutes == 0  && $questionnaires->seconds == 0 )
	{
		$questionnaires->minutes =20;
	}
	
	$warnTimeUp 	= ($questionnaires->minutes-5) * 60000;
	if($warnTimeUp <= 0)
	{
		$warnTimeUp 	= 0;
	}
	
	session_start();
	session_unset();
	
	$_SESSION['questionnaire_id'] = (int) $questionnaires->questionnaire_id;
	
?>
<!doctype html>
<html>
<head>
    <!-- Hotjar Tracking Code for http://arfeenkhan.com/question1/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1500541,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<meta charset="utf-8">
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '306964640195625');
  fbq('track', 'PageView');
</script>
<noscript><img height=""1"" width=""1"" style=""display:none""
  src=""https://www.facebook.com/tr?id=306964640195625&ev=PageView&noscript=1""
/></noscript>
<!-- End Facebook Pixel Code -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Arfeen Khan</title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/Title.png">
<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--
<script type="text/javascript" src="jquery-2.0.3.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/timer/jquery.countdownTimer.js"></script>
<link rel="stylesheet" type="text/css" href="http://speaktofortune.com/questionnaire3/css/timer/jquery.countdownTimer.css" />

<!-- session -->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/session/jquery.session.js"></script>-->
<!-- session -->

<!--<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />-->
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>Fonts/font.css" />-->
<link rel="stylesheet" href="http://arfeenkhan.com/question1/css/fontmain.css">
  <link rel="stylesheet" href="http://arfeenkhan.com/question1/css/main.css">
  <link rel="stylesheet" href="http://arfeenkhan.com/question1/css/responsive.css">
 <script>
	var counter = 900000;
	$(document).ready(function()
	{
		//$('#ShowQuestion').hide();
		
		
		 $("#userinfo").click(function()
		{
		  
			if ( !validationUserInfo() )
			{
				return false;
			}
			
			$('#contactIDInfo').empty();
			
			var fistname = $('#firstname').val();
			var emailid = $('#email').val();
			var mobileno = $('#mobile').val();
		//	alert(fistname);	
			$.ajax({
											type : "POST",
											url : "<?php echo base_url(); ?>addtagInfusionsoft",
											data : {
												"fistname" 	: fistname,
												"emailid" 	: emailid,
												"mobileno"	: mobileno
											},
											success: 
								              function(data)
								              {
								                  
													$('#contactIDInfo').html(data);
													console.log(data);
													
													if( data == 0 )
													{
														alert( "Unable to connect to the Internet" );
														
														 window.reload = "<?php echo base_url(); ?>";
													}
													else{
														$('#contactIDInfo').html('<input type="hidden" name="ContactID"  value="'+data+'" />');	
													}
													
								              }
								              
										});
										
			
			
			$('#demo').show();
			$('#career').hide();
			$('.header').hide();
			$('.question-header').show();
			$('.cont_body').hide();
			$('.start').hide();
			$('#ShowQuestion').show();
			$('#questionnaireInfo').show();
			startTimer();
			IntervalWarn();
			
		});
		
		
		
	});
	
	
			function validationUserInfo()
			{
					
				var name = $('#firstname').val();
				var name_regex = /^[a-zA-Z\s]+$/;
				
				if( name == "" )
				{
					alert("Enter Your Name.");
					return false;
				}
				else
				if( name.length < 3 )
				{
					alert("Enter Your Name more than 3 word.");
					return false;
				}
				else 
				if (!name.match(name_regex) ) 
				{
					alert(" Enter alphabets only in Name. ");
					$("#firstname").focus();
					return false;
				}
				
				var email = $('#email').val();
				var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
				
				// Checking Empty Fields
				if ($.trim(email).length == 0 ) {
					alert('Enter Your Email-Id');
					return false;
				}
				else
				if ( !filter.test(email))
				{
					alert('Invalid Email Address');
					return false;
				}
				
				
				
				var mobile = $('#mobile').val();
				//var mob = /^[1-9]{1}[0-9]{9}$/;
				var mob =/^(\+){0,1}(\d|\s|\(|\)){10,20}$/;
				if ($.trim(mobile).length == 0 ) {
					alert('Enter Mobile Number');
					return false;
				}
				else
				if (mob.test($.trim(mobile)) == false) 
				{
				  	alert("Please enter valid mobile number");
					return false;
				}
					
				return true;	
			}
	
	//var reloadFlag = true;
	$(document).keydown(function(event) 
	{
		var $focusedItem = $(document.activeElement);
		if($focusedItem.attr('id') == 'submitButton') 
		{
		    if (event.keyCode == 13) {
		        
		    }
		}
		else{
		    if (event.keyCode == 13) {
		    	event.preventDefault();
		    }
		}
	
	});
		
	/*if( reloadFlag )
	{
		$(window).on('beforeunload', function()
		{
		  return 'Are you sure you want to leave?';
		});
		
	}
	*/
	
	
	var unasnwered = 0;
	
	function getTotalCheckRad()
	{
		var numberOfCheckedRadio = $('input:radio:checked').length; 
 		
 		var totalQuestion 	= $('#totalQuestion').val();
 		unasnwered 		= ( totalQuestion - numberOfCheckedRadio );
 		$('#unasnwered').text(unasnwered);
	}
 	
			function validation()
			{
					
				
					
				var totalpage = $('#totalpage').val();
					
				var checked1 = $("#pagetop"+totalpage+" :radio:checked");
				var groups1 = [];
				$("#pagetop"+totalpage+" :radio").each(function() 
				{
					        if (groups1.indexOf(this.name) < 0) {
					            groups1.push(this.name);
					        }
				});
				
				// if (groups1.length != checked1.length)
				// { 
				//      var total1 = groups1.length - checked1.length;
				//      var a = total1>1?' Questions are ':' Question is ';
					
				//       alert(total1 + a + 'unanwsered in this page');
				//       return false;
				// }	
					
        		//alert(totalpage);
        		getTotalCheckRad();
        		testing();
				//	alert('asdasd');
				return true;
				//alert('asdasd1');
			}
			
			function testing()
			{
				clearTimeout(counter);
				
				$('#afterSubmit').show();
				$('#ShowQuestion').css('display','none');
				$('#timerFinish').hide();
				$('.question-header').css('display','none');
				$('.newShowQuestion').css('display','none');
				
				
			}
			
			$(document).ready(function()
			{
				
				$(".pages").each(function(index)
				{
					getTotalCheckRad();
					var count_div = index+1;
					var selectpageindex = 0;
						
						$(".page"+count_div).hide();
						$(".page1").show();
					
				    $(".showpage"+count_div).click(function()
				    {
				    	getTotalCheckRad();
				    	selectpageindex = count_div;
				    	
				    	////////////////////////////
				    	
				    	var checked = $("#pagetop"+(count_div-1)+" :radio:checked");
				    	var groups = [];
					    $("#pagetop"+(count_div-1)+" :radio").each(function() {
					        if (groups.indexOf(this.name) < 0) {
					            groups.push(this.name);
					        }
					    });
					    
					    if (groups.length != checked.length)
					    { 
					        var total = groups.length - checked.length;
					        var a = total>1?' Questions are ':' Question is ';
					
					        alert(total + a + 'unanwsered in this page');
					        return false;
					    }
				    	
				    	
				    	
				    	////////////////////////////
				    	
				    	
				    	$(".pages").each(function(index2)
						{
							$(".page"+count_div).show();
							$("#ShowQuestion").css('padding-top','4%');
							
							var count2_div = index2+1;
							if ( selectpageindex != count2_div )
							{
								$(".page"+count2_div).hide();
							}
							
						});
				    	
				    });
					
					
				});
				
				
			});
</script>
</head>

<body >
 
<div class="header">
       
        <div class="navbar">
            <div class="logo">ARFEEN KHAN</div>
            <!--<div class="back"><a href="http://arfeenkhan.com/">GO BACK TO ARFEEN<span>KHAN</span>.COM</a></div>-->
        </div>
        <h1 class="discover">Discover your mindset  blueprint</h1>      
        <p class="work">Work your way through 84 Multiple Choice questions and submit your answers to get your Mindset Blueprint</p>

    <div class="getstarted forms " style="display:block;">

    <input type="text" placeholder="Enter your name" class="form-control" name="firstname1" id="firstname2" onchange="myFunction(this.value)" >
    <input type="email" placeholder="Enter your email" class="form-control" name="email1" id="email2" onchange="myFunction11(this.value)" >
    <input type="text" placeholder="Enter your contact number" class="form-control" name="mobile1" id="mobile2" onchange="myFunction12(this.value)" >
    
    
    </div>

    <div class="scroll">
        <p>Scroll to see steps</p>
        <span class="glyphicon glyphicon-menu-down"></span>
    </div>

</div>         
	
<?php
	/*
	<a href="<?php echo base_url(); ?>" > List Questionnaires </a>
	*/	
?>

<?php
	if( $questions )
			{
?>
<span class="info" style="display:none;">
<?php	
	$total_question = count($questions);
	//echo "Total Question : ".$total_question."<br/>";
	$per_page 		= $questionnaires->per_page;
	//echo "Question per page : ".$per_page."<br/>";
	$page_num 		=  (int) ($total_question/$questionnaires->per_page);
						
	if ( ($page_num == 0) || ($page_num == 1) ) 
	{
		$page_num = 1;
	}
	else{
		$page_num = ($page_num+1);
	}
						
	//echo " Total Pages : ". $page_num ."<br/><br/>";
?>


			
</span>
<?php
			}
			
?>
<div class="cont_body">
<div class="cont_1">
    <div class="left"><img src="http://arfeenkhan.com/question/images/step1.png" /></div>
    <div class="right">
    <h1><span>Step one:</span> Spontaneous action</h1>
        <p>Every statement has 3 options. <span>Yes, No</span> &<span> Partly.</span> Select an option that comes to you instantly without thinking.
If you don’t know whether it applies to you, it’s usually best to choose <span> No.</span></p>

    </div>
</div>

<div class="cont_2">
<div class="left"><img src="http://arfeenkhan.com/question/images/step2.png" /></div>
    <div class="right">
    <h1><span>Step Two:</span> Finish before time</h1>
        <p>You only have <span> 20 minutes </span>to finish all 84 questions. So don’t spend time thinking, just answer and move ahead.</p>
    </div>
</div>

<div class="cont_3">
<div class="left"><img src="http://arfeenkhan.com/question/images/step3.png" /></div>
    <div class="right">
    <h1><span>Step three:</span> Submit. You’re done! </h1>
        <p>Make sure you finish all questions. Once you’re done with all 84 questions, hit <span>Submit</span> and you’re done.</p>
    </div>
    
    </div>
</div>


<div id="career" style="display:none;">

<h1> <?php echo $questionnaires->title; ?></h1>

<?php
	if( $questions )
	{
		
		$_SESSION['qn_title'] = $questionnaires->title;
		$qn_title = $questionnaires->title;
		
		if ( !empty($questionnaires->min_desc) ) 
		{
?>
				<p><?php echo htmlentities($questionnaires->min_desc); ?></p>
<?php		
		} 
?>

</div>
	
		
<div class="main">	
	
		<form id="questionnaireForm" method="post" action="<?php echo base_url(); ?>beforethankyou" onsubmit="return validation();" >
		
		
		<div class="textfield">
		
		<h4 style="display:none;">Fill in your details below before you start the test</h4>
		
		
		<div class="inputboxs" style="display:none;">
		
		<input type="text" name="firstname" id="firstname" placeholder="Name" value="" />
						
		<input type="email" name="email" id="email" placeholder="Email" value="" />
						
		<br/>
						
		<!--<div id="showMobile" >-->
			
		<input type="tel" name="mobile" id="mobile" placeholder="Contact No" value="" />
			
		<!--</div>-->
		
		<input type="hidden" name="qn_title"  value="<?php echo $qn_title; ?>" />				
		<input type="hidden" name="questionnaire_id"  value="<?php echo $questionnaires->questionnaire_id; ?>" />
		<input type="hidden"  id="totalpage" value="<?php echo $page_num; ?>" />
		<input type="hidden"  id="totalQuestion" value="<?php echo $total_question; ?>" />
			<span id="contactIDInfo" >
				
			</span>	
		
		</div>
		
		<div class="clear"> </div>
      <div id="userinfo">
		    <!--<button class="start">START</button>-->
		    <button type="button" class="start"><a href="#ShowQuestion" > START </a></button>
        	
		</div>
		
		<div id="afterSubmit" style="display: none;padding-top: 5%;">
		<h1 style="text-align: center;">Please wait! <br/> We are submitting your answers.</h1>
		
		<center>
			<img src="<?php echo base_url(); ?>images/Loading_Animation.gif" height="50%" width="30%" />
		</center>
	</div>
		 <script>
 $( document ).ready(function(){
     $('.start').click(function(){
        window.location.href = '#ShowQuestion';
       // alert(1);
     });
 });
  </script>
		</div>			
 
		<div class="question-header" style="display:none;">
			<div class="name">ARFEEN KHAN</div>
			<div class="timer"><p id="demo"></p>
			<p>Questions remaining: <span id="unasnwered" ></span> / 84</p>
			</div>
			<!--<div class="back-button"><a href="http://arfeenkhan.com/">GO BACK TO ARFEEN<span>KHAN</span>.COM</a></div>-->
		</div>
	<div id="ShowQuestion" class="newShowQuestion" style=" display:none;" >
	
	 
<?php  
	$count_question = 0;
	$next_page_question = 0;
	$showSubmit = FALSE;
	for ($i=1; $i <= ($page_num +1) ; $i++) 
	{
		/*if( empty($questions[$count_question]) )
			{
				break;
			}
		*/				
									
	?>
	


<div id="pagetop<?php echo $i; ?>" >
	
         
<div class="pages">	
	
	<div class="page<?php echo $i; ?>"  >
	
	<!--<div class="pagetop"   >-->
	
	<!--<h3>Page <?php echo $i; ?></h3>-->
	
	<?php
	/*
	 <div class="info">
	
	<?php echo "Total Question : ".$total_question."<br/>"; ?>
	<?php echo "Remaining Question : " ; ?><span id="unasnwered" ></span>
	
	</div>
	 */
	?> 
	<div class="clear"> </div>
	
	<!--</div>-->
	
	<ul class="test123" style="list-style-type: none;" >
	
	<?php
		$show_quest_per_page = $per_page + $next_page_question;
													
		for ($j=$count_question; $j <= ($show_quest_per_page-1) ; $j++) 
			{
	?>
	
	<div class="questions"><p><?php echo ($j+1)." : ".htmlentities($questions[$j]->question)." ?"; ?></p>
	<?php if ( !empty($questions[$j]->question_id)) { ?> 
	<input type="hidden" class="question_id" name="question_id[]" value="<?php echo $this->encrypt->encode(intval($questions[$j]->question_id)); ?>" />
															
	<?php 
													}
															
	if( isset($options[$questions[$j]->question_id]) ) {
																
	$maxOptValue = 0;
	?>
	<ul  style="list-style-type: decimal;" >
		<?php foreach (($options[$questions[$j]->question_id]) as $optkey => $optvalue) { 
																		
		$max_value[] = intval($optvalue->value);
		$maxOptValue = max($max_value);
																		
		?>
	<li>
	<input onchange="getTotalCheckRad();" type="radio" id="abc<?php echo ($j+1); ?>"   name="abc<?php echo ($j+1); ?>" value="<?php echo $this->encrypt->encode(intval($optvalue->value)); ?>" ><?php echo $optvalue->text; ?> 
																		
	</li>
	<?php } ?>
																	
	</ul>
	
	<?php }
																
		if( empty( $options[$questions[$j]->question_id] ) ) {
		$maxOptValue = 10;
	
	?>	
	
	<ul class="hello">
				<input onchange="getTotalCheckRad();"     type="radio" id="abc<?php echo ($j+1); ?>g" name="abc<?php echo ($j+1); ?>" class="green" value="<?php echo $this->encrypt->encode(10); ?>" >
            <label for="abc<?php echo ($j+1); ?>g" class=""></label>

            <input onchange="getTotalCheckRad();"    type="radio" id="abc<?php echo ($j+1); ?>r" name="abc<?php echo ($j+1); ?>" class="red" value="<?php echo $this->encrypt->encode(0); ?>" >
            <label for="abc<?php echo ($j+1); ?>r" class=""></label>

            <input onchange="getTotalCheckRad();"  type="radio" id="abc<?php echo ($j+1); ?>b" name="abc<?php echo ($j+1); ?>" class="blue" value="<?php echo $this->encrypt->encode(5); ?>" >
            <label for="abc<?php echo ($j+1); ?>b" class=""></label>
		
	</ul></div>
	<?php } 
															
	if ( !empty($questions[$j]->question_id)) 
		{
	?>
		<input type="hidden" id="value_max[<?php echo intval($questions[$j]->question_id); ?>]" name="value_max[<?php echo intval($questions[$j]->question_id); ?>]" value="<?php echo $this->encrypt->encode(intval($maxOptValue)); ?>" />
	<?php } ?>			
	
	</li>												
	
	<br/>
	
<div class="clear"> </div> 

	<?php
	++$count_question;
	++$next_page_question;
															
		if ( $count_question == $total_question ) 
				{
					break;	
				}
			}
													 
		if($i != 1)
			{ ?> 
				<?php /* 
				<a class="showpage<?php echo ($i-1); ?>" href="#pagetop<?php echo ($i-1); ?>" > Previous Page </a>
				*/ ?><div class="imp_button" style="display:inline-block">
				<a class="showpage<?php echo ($i-1); ?>" href="#ShowQuestion" ><div class="next_page "> Previous Page </div></a> 
				
				<?php 
			} 
														
		if( isset($questions[$count_question]) )
			{
			?>	
				<?php /*
				<a class="showpage<?php echo ($i+1); ?>" href="#pagetop<?php echo ($i+1); ?>" > Next Page </a>
				*/ ?>
				
				    
				<a class="showpage<?php echo ($i+1); ?> " href="#ShowQuestion"  ><div class="next_page "> Next Page </div></a>
				</div>
			<?php 
													
			}else
			
			{
				?>
				<div class=""> <input type="submit" id="submitButton" class="showpage<?php echo $i; ?> final-submit" name="submit" value="SUBMIT" ></div>
				
				<?php
			}
													
?>
	
		
									
	</div>
	</ul>
	</div>	

</div>		
			<?php
										
	}
									
			}
			else
			{
			?> 	<strong><?php echo "Questions is Coming Soon."; ?></strong> <?php	
								}
			?>	
				

	</div>
</div>
	</form>
</div>

    <div class="getstarted forms " style="display:none;">

    <input type="text" placeholder="Enter your name" class="form-control" name="firstname1" id="firstname2" onchange="myFunction(this.value)">
    <input type="email" placeholder="Enter your email" class="form-control" name="email1" id="email2" onchange="myFunction11(this.value)">
    <input type="text" placeholder="Enter your contact number" class="form-control" name="mobile1" id="mobile2" onchange="myFunction12(this.value)">
    
    
    </div>
 <script>
 
 	
  
                                 
                                 	
                                 	function  startTimer() 
                                 	{
									  
                                 	
                                    $('#demo').countdowntimer({
                                        //minutes :20,
                                        minutes : <?php echo $questionnaires->minutes; ?>,
                                        //seconds : 00,
                                        seconds : <?php echo $questionnaires->seconds; ?>,
                                        size : "lg",
                                      	timeUp : timeisUp ,
                                        expiryUrl : "<?php echo base_url(); ?>beforethankyou"
                                        
                                    });
                                    
                                    function timeisUp() 
                                    {
                                    	var firstname 	= $('#firstname').val();
                                    	var email 		= $('#email').val();
                                    	var question_ids= new Array();
                                    	var options		= new Array();	
                                    	
                                    	/*
                                    	if ( ($.trim(firstname).length == 0 ) || ($.trim(email).length == 0 )   ) 
                                    	{
                                    		validation();
                                    		$('.pages').show();
                                    		return false;
                                    	}
                                    	*/
                                    	
                                    	var m = 1;
                                    	$('input[name="question_id[]"]').each(function() {
										    question_id = $(this).val();
										    question_ids.push(question_id);
										    
										    var ab = $("input[type='radio'][name='abc"+m+"']:checked").val();
										    //var ab= $('#abc'+m).val();
										    //alert(ab);
										   	options.push(ab);
										    m++;
										});
										
										
                                    	$.ajax({
											type : "POST",
											url : "<?php echo base_url(); ?>setFormVariablesINSession",
											data : {
												"firstname" 	: firstname,
												"email" 		: email,
												"abc"			: options,
												"question_id"	: question_ids
											}
											
										});
										
										alert('Time is Over.');
										$('#ShowQuestion').hide();
										$('#afterSubmit').hide();
										$('#timerFinish').show();
										
										
					        		}
					        	
					        	}	
					        		
                  function IntervalWarn()
                  {
             		<?php if ($warnTimeUp == 0 ){
	            	?>
	            	//window.setTimeout("TickSecond()", 0 );
	            	<?php 	
	             }else{
	             	?>
	             		window.setTimeout("Tick()", <?php echo $warnTimeUp; ?> );
	             	<?php
	             }?>  
	             
	             	     
                  } 
                         
             
                          
            
     		function Tick() 
			{
				alert('Few Minutes Remaining.');
			}
			
		/*	function TickSecond() 
			{
				alert('Few Second Remaining.');
			}
		*/
			
    </script>
    <script>
function myFunction(val) {
    //alert(val);
      document.getElementById("firstname").value = val;
   
}
function myFunction11(val) {
     document.getElementById("email").value = val;
    
}
function myFunction12(val) {
    document.getElementById("mobile").value = val;
     
}

 
</script>
</body>
</html>