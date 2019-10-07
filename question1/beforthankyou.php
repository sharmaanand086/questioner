<?php
$this->db2 = $this->load->database('appointment', TRUE);
//var_dump($questions);
$maxOptValue=10;
header('Access-Control-Allow-Origin: *');
 $email = $_POST['email'];
 $phone = $_POST['mobile'];
 $name = $_POST['firstname'];
?>

<!DOCTYPE html>
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
  <title>Discover your mindset blueprint</title>
  	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <link rel="stylesheet" type="text/css" href="http://arfeenkhan.com/question/css/mainpagestyle.css">
<!-- calender -->
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<style>
	    .dbdate{
	        position: relative;
            width: 20%;
	    }
	    .dbtime{
	          width: 13%;
              margin-left: 303px;
	    }
	</style>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/cc-style.css"></li>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/cc-responsive.css"></li>
  
</head>
<body>

<div class="main-identity">
  <div class="heading1">
     <p class="arfeenkhan">arfeen khan </p>
     <p class="kyidentity"style="">Discover your mindset blueprint</p>
     <!-- <p class="inminutes">in 6 minutes</p>  -->
  </div>
</div>
  <div class="card">
    <iframe src="https://player.vimeo.com/video/361042626?title=0&amp;byline=0&amp;portrait=0"  width=100%; height="450px"; frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
  </div>
 <div class="section-title2">
    
       <div class="intro-text">
    <h5 style="text-align:center;">Now that you have completed the “Discover Your Mindset Blueprint” assessment test, which will help you uncover your natural behavior. And once you understand your 
    natural behavioral patterns, it will be easier for you to recognize the right opportunities to achieve the results you desire. The results to your mindset blueprint 
    will be discussed in a <b>FREE Strategy Session</b> with my personally trained transformational experts who will give you a plan of immediate action to propel towards the results.</h5>

 <h5 style="text-align:center;">This strategy session will empower you with the focus and accountability you need to break through your limitations and reach the success you never thought was possible. 
 My transformational experts are hand-selected and extensively trained. They are among the finest transformational coaches in India, enabling them to guide you through a better 
 life.</h5>
 
<h4 style="font-weight:bold; text-align:center; margin-bottom: 3%;">Select your suitable date & time to schedule your FREE Strategy Session</h4>
    </div>
    
    
  <div class="getstarted forms ">
     <form style="width:100%" class="getstarted" id="questionnaireForm" method="post" action="<?php echo base_url(); ?>thankYouPage" >
    <input type="hidden" placeholder="Enter your name" name="firstname" id="firstname" class="form-control"  value="<?php echo $name; ?>">
    <input type="hidden" placeholder="Enter your email" class="form-control" name="email" id="email"   value="<?php echo $email; ?>">
    <input type="hidden" placeholder="Enter your contact number" class="form-control" name="mobile" id="mobile" value="<?php echo $phone; ?>">
     <input type="hidden" name="qn_title"  value="<?php echo $qn_title; ?>" />				
		<input type="hidden" name="questionnaire_id"  value="<?php echo $questionnaire_id; ?>" />
		<input type="hidden"  id="totalpage" value="<?php echo $totalpage; ?>" />
		<input type="hidden"  id="totalQuestion" value="<?php echo $totalQuestion; ?>" />
	    <input type="hidden" name="session_date" id="session_date" value="" required>
        <input type="hidden" name="session_time" id="session_time" value="" required>
        
		<?php
	$a= 1;
	foreach($abc as $row){
	    ?>
	    <input type="hidden" id="abc<?php echo  $a; ?>" name="abc<?php echo  $a; ?>" class="green" value="<?php echo $row; ?>" >
	    <?php
	    $a++;
	}
	$j=1;
	while($j < 84)
			{?>
			<input type="hidden" class="question_id" name="question_id[]" value="<?php echo $this->encrypt->encode(intval($questions[$j]->question_id)); ?>" />
			<input type="hidden" id="value_max[<?php echo intval($questions[$j]->question_id); ?>]" name="value_max[<?php echo intval($questions[$j]->question_id); ?>]" value="<?php echo $this->encrypt->encode(intval($maxOptValue)); ?>" />

  	
  	<?php $j++;	} ?>
  	
   
 
 		</div>
 		<div>
 		    	<?php      $this->db->select('*');
                            $this->db->from('calander');
                            $this->db->order_by('id', 'ASC');
                            $this->db->where('coach_id','9');
                            $query1 = $this->db->get();
                            $row = $query1->row();
                            $results = $query1->result_array();
                      $date =  $row->date;
                      $year = date('Y',strtotime($date));
                      $month = date('F',strtotime($date));
                      $day = date('d',strtotime($date));
                      $dayname  = date('D', strtotime($date));
                
                     // echo $date;echo"<br>";
                     // echo $year;
                    //  echo $month; 
                     // echo $day;
                     // echo $dayname;
                     
            	        ?>
 		    </form>
    
 			<p class="heading-duration"><b>Duration:</b><span>15 minutes</span></p>
 			
 			<div class="main-box">
 			    <div class="adjust-title">
 			    <p style="">Available starting times for<span><b id="textchabge">  <?php echo $dayname; ?>, <?php echo $month; ?> <?php echo $day; ?>, <?php echo $year; ?></b></span></p>
 			    </div>
 			<div class="calender" id="calender" >
           <?php 
                            $this->db->distinct();
                            $this->db->select('date');
                            $this->db->from('calander');
                            $this->db->where('coach_id','9');
                            $query2 = $this->db->get();
                            $results2 = $query2->result_array();
                   foreach($results2 as $res2)
            	    {
            	     
            	     $buttondate = $res2['date'];
            	      $year1 = date('Y',strtotime($buttondate));
            	      $month1 = date('F',strtotime($buttondate));
                      $month12 = date('m',strtotime($buttondate));
                      $day1 = date('d',strtotime($buttondate));
                      $dayname1  = date('D', strtotime($buttondate));
                       ?>     
            <div class="date_div" id="<?php echo $day1; ?>-<?php echo $month12; ?>-<?php echo $year1; ?>"><p><?php echo $day1; ?>th <?php echo $month1; ?></p></div>
          <?php }  ?>
            
            <input type="hidden" name="maindate" id="maindate" value="<?php echo $month; ?>-<?php echo $day; ?>-<?php echo $year; ?>" />
            <input type="hidden" name="formateddate" id="formateddate" value="<?php echo $date ?>" />
 				</div>
 				<div class="calender-schedule">
 					
 					<div class="time-slot" style="text-align: center;">
 						<div class="amslot">
 			
                      <?php
            	   // var_dump($results);
            	    foreach($results as $result1)
            	    {
            	         $disable = $result1['apmtime'];
            	        $disable1 = $result1['date'];
            	         $condition22 = "session_date = '" .  $disable1. "' AND session_time = '" .  $disable. "'   AND coach_id = '9' ";
            	          $this->db->select('*');
                            $this->db->from('client_registrations');
                            $this->db->where($condition22);
                            $query12 = $this->db->get();
                          $rowCount = $query12->num_rows();
                         if($rowCount < 1)
                         {
                            //echo $result1['aptime'];
         				?>
         				
                              <p class="schedule-time abc displayclass<?php echo $result1['date']; ?>" onClick="set_time(this.id)" name="" id="<?php echo $result1['apmtime']; ?>" tabindex="1"><?php echo $result1['apmtime']; ?></p>
                        <?php
                         }
                          else{
                              ?>
                              <p disabled  class="schedule-time abc displayclass<?php echo $result1['date']; ?>"  style="background-color:#89a0a0;cursor: not-allowed;"> <?php echo $result1['apmtime']; ?> </p>
                               <?php
                          }
            	    }
                ?>
                <input type="hidden" id="timedatevalue" name="timedatevalue" value="" required>
            </div>
 					</div>
 				</div>
 			</div>
 			<div class="change">

 			</div>
        </div>
 		<div class="final-sub">
  <button class="sub-butn" onclick="finalsubmit();" >SUBMIT</button>
  </div>
 	</div>

    
           
    <script>
    $( document ).ready(function() {
        
    $('.schedule-time').show();
    $('.displayclass2').hide();
     $('.displayclass<?php echo $day; ?>').show();
    });
     
    $( ".date_div" ).click(function() {
        var id = $(this).attr("id");
        
        var res = id.split("-");
        var d = res[0];
        var m= res[1];
        var y = res[2];
        var fl =y +'-'+m+'-'+d;
        //alert(d); alert(m); 
        //alert(y);
       // alert(fl);
      var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
var d1 = new Date(fl);
var dayName = days[d1.getDay()];
//alert(dayName);
   function getMonth(m){
  var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];
  return monthNames[m];
}
 var mm =getMonth(m-1);  
// alert(mm);
  var fulldate = ' '+dayName +' ,'+ mm +' '+d +', '+y; 
  //alert(fulldate);
  var halfdate =  ' '+dayName +'-'+m+'-'+y;
             $('.abc').hide();
             var ddd=   $('.displayclass'+fl).show();
            $('#textchabge').text(fulldate); 
            $('#maindate').val(halfdate);
            $('#formateddate').val(fl);
            var ddd= fl;
            
           document.getElementById('session_date').value = ddd;
            
    });
      
//     $( "#nddec1" ).click(function() {
//         $('.displayclass1').show();
//         $('.displayclass2').hide();
//         $('#textchabge').text(' Sun, Sep 29, 2019');
//         $('#maindate').val('September-29-2019');
//         $('#formateddate').val('2019-09-29');
//          var ddd1= '2019-09-29';
            
//         document.getElementById('session_date').value = ddd1;
// });
  
    
function set_time(timedate){
      $('#timedatevalue').val(timedate);
      var aplytime =  document.getElementById('timedatevalue').value;
      document.getElementById('session_time').value =aplytime;
}
  function finalsubmit(){
      var t =  document.getElementById('session_time').value;
      var d =  document.getElementById('session_date').value;
       var fn =  document.getElementById('firstname').value;
      var ei =  document.getElementById('email').value;
       var mn =  document.getElementById('mobile').value;
     
     if(d==''){
         alert('Please select Your Appointment Date !');
         return false;
     }else if(t==''){
         alert('Please select Your Appointment Time !');
         return false;
     }else if(fn==''){
          alert('Please Fill Your Name !');
         return false;
     }else if(ei==''){
          alert('Please select Your Email Id !');
         return false;
     }else if(mn==''){
          alert('Please select Your Mobile Number !');
         return false;
     }else{
           $("#questionnaireForm").submit();
     }
      
  }
</script>    
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("calender");
var btns = header.getElementsByClassName("date_div");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    if (current.length > 0) { 
      current[0].className = current[0].className.replace(" active", "");
    }
    this.className += " active";
  });
}
</script>
   </div> 
    </div>
</body>
</html>
