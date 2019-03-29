<?php 
include("isdk.php");
session_start();

$app = new iSDK;
if ($app->cfgCon("connectionName")) 
{

  // $contactId = $app->addWithDupCheck(array('FirstName' => $name, 'Email' => $email,'Phone1' => $phone), 'Email');
	   	$contactId =$_SESSION["contactId"];
		$groupId = 8795; 					// Registration speaktofortune.com/payment/
	    $result = $app->grpAssign($contactId, $groupId);
	    //var_dump($contactId);
      
}
    	$con = mysqli_connect("localhost","roo","","ctf_questionnaire");
	    $id=$_POST['id'];
	 
	  $check ="UPDATE `reg` SET `ftime`='1' WHERE `id` ='$id'";
	    $rs = mysqli_query($con,$check);
	    
	    echo "1";	    

?>