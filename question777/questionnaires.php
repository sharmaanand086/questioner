<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."third_party/infusionsoft/isdk.php");
require_once(APPPATH."third_party/infusionsoft/class.phpmailer.php");

class Questionnaires extends CI_Controller
{
      
		public function __construct()
		{
			parent::__construct();
			$this->load->library('encrypt');
			$this->load->model('SQuestionnaires_model');
		}
		
		function index( )
		{
		  
			$data['questionnaires'] = $this->SQuestionnaires_model->getAllQuestionnaire();
		//	$this->load->view('site/questionnaires', $data);
			$this->showQuestionOpt( 27 );			
			
		}
		
		function showQuestion( $id )
		{
			$data['questionnaires'] 	= $this->SQuestionnaires_model->getQuestionnaire( $id );
			$data['questions'] 			= $this->SQuestionnaires_model->getQuestionsById( $id );
			
			
			$this->load->view('site/showquestions', $data );
		}
		
		function showQuestionOpt( $id )
		{
			$id = intval($id);
			
			if( $id <= 0 )
			{
				redirect(base_url()."site/questionnaires");
				
			}
			
			$data['questionnaires'] 	= $this->SQuestionnaires_model->getQuestionnaire( $id );
			
			if( empty($data['questionnaires']) )
			{
				redirect(base_url()."site/questionnaires");
			}
			
			$data['questions'] 			= $this->SQuestionnaires_model->getQuestionsById( $id );
			if( $data['questions'] )
			{
				$this->load->model('options_model');
				foreach ( $data['questions'] as $key => $value) 
				{
					$quest_id = intVal($value->question_id);
					$option = $this->options_model->getOptionsByQuestionId($quest_id);
					//var_dump($option);
					if(empty($option))
					{
						$option = $this->options_model->getOptionsByQuestionnaireId( $id );	
					}
					$opt['options'][$quest_id] = $option;
				}
			}
			
			if( isset($opt['options']) )
			{
				$data['options'] = $opt['options'];
			}
		
			$this->load->view('site/showquestionswithoptions', $data );
		}
		
		 function beforethankyou()
		{
		  
		    $id=27;
		     $qn_title = $_POST['qn_title'];
		     $questionnaire_id = $_POST['questionnaire_id'];
		     $totalpage = 9;
		     $totalQuestion = 84;
		    $questionnaires 	= $this->SQuestionnaires_model->getQuestionnaire( $id );
			$questions			= $this->SQuestionnaires_model->getQuestionsById( $id );
              $k=1;
              $abc = array();
              while($k < 85)
              {
                 array_push( $abc, $_POST['abc'.$k]);
                  $k++;
              }
        $this->session->set_userdata('ContactID', $conID);
           $this->load->view('site/beforethankyou', ['qn_title'=>$qn_title,'questionnaire_id'=>$questionnaire_id,'totalpage'=>$totalpage,'totalQuestion'=>$totalQuestion,'questionnaires'=>$questionnaires,'questions'=>$questions,'abc'=>$abc] );
        
                        
            
		    
		}
		function afterthankYouPage(){
		    session_start();
		    $html='';
		    	$pdfname = $_POST['firstname'].".pdf";
                $date1=date_create($this->input->post('session_date'));
                $newofdate =  date_format($date1,"d/m/Y");
                try{
                $mail = new PHPMailer(true); // the true param means it will throw exceptions on     errors, which we need to catch
                
                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->Host = 'mail.arfeenkhan.com';  // Specify main and backup server
                $mail->Port = '26';
                $mail->SMTPAuth = 'true';                               // Enable SMTP authentication
                $mail->Username = 'arfeenkhan@arfeenkhan.com';                            // SMTP username
                $mail->Password = 'rNX7zSKSCnev';                           // SMTP password
                $mail->SMTPSecure = 'SSL/TLS';
                
                //coach email 
                $mail->SetFrom('Arfeenkhan@arfeenkhan.com', 'Arfeen Khan');
               // $mail->AddAddress('anand@arfeenkhan.com', '');
              $mail->AddAddress('preetijain1719@gmail.com', 'Preeti jain');
                // $mail->AddAddress($_POST['email'], $_POST['firstname']);
                 $mail->AddBcc('info@arfeenkhan.com', '');
                $mail->Subject = $_POST['firstname']." Questionnaire Result ";
                
                $mail->Body= " Name : <b>".$_POST['firstname']."</b><br/> Email : <b>".$_POST['email']."</b><br/>Phone : <b>".$_POST['mobile']."</b><br/>Date : <b>".$newofdate."</b><br/>Time : <b>".$_POST['session_time']."</b><br/> Questionnaires Title : <b>".'Discover Your Mindset Blueprint'."</b><br/>".$html;
                $mail->AddAttachment(APPPATH.'pdffile/'.$pdfname );
               $str = $_POST['firstNeedDescAtt'];
              $firstNeedDescAtt = explode(", ",$str);
             $firstNeedDescAtt1 = preg_replace('/\s+/', '', $firstNeedDescAtt);
				foreach ( $firstNeedDescAtt1 as $needpdfkey => $needpdfvalue) 
				{
				    if(empty($needpdfvalue)){
				        
				    }else{
				        $mail->AddAttachment(APPPATH.'pdffile/special_pdf/'.$needpdfvalue );
				    }
				}
		   $str1 = $_POST['pdfDesc'];
              $pdfDesc = explode(", ",$str1);
             $pdfDesc1 = preg_replace('/\s+/', '', $pdfDesc);
				foreach ( $pdfDesc1 as $pdfkey => $pdfvalue) 
				{
				    if(empty($pdfvalue)){
				        
				    }else{
				       $mail->AddAttachment(APPPATH.'pdffile/special_pdf/'.$pdfvalue );
				    }
				}
			$mail->IsHTML(true);
			
		//	echo "abc";
                //2nd mail client
                $mail1 = new PHPMailer(true); // the true param means it will throw exceptions on     errors, which we need to catch
                
                $mail1->IsSMTP(); // telling the class to use SMTP
                $mail1->Host = 'mail.arfeenkhan.com';  // Specify main and backup server
                $mail1->Port = '26';
                $mail1->SMTPAuth = 'true';                               // Enable SMTP authentication
                $mail1->Username = 'arfeenkhan@arfeenkhan.com';                            // SMTP username
                $mail1->Password = 'rNX7zSKSCnev';                           // SMTP password
                $mail1->SMTPSecure = 'SSL/TLS';
                
           $mail1->SetFrom('Arfeenkhan@arfeenkhan.com', 'Arfeen Khan');
                $mail1->AddAddress($_POST['email'], $_POST['firstname']);
                 //$mail1->AddAddress('bhavesh@arfeenkhan.com', 'bhavesh');
                 //$mail1->AddBcc('info@arfeenkhan.com', '');
                $mail1->Subject = $_POST['firstname']." Questionnaire Result ";
                
                $mail1->Body= " Name : <b>".$_POST['firstname']."</b><br/> Email : <b>".$_POST['email']."</b><br/>Phone : <b>".$_POST['mobile']."</b><br/>Date : <b>".$newofdate."</b><br/>Time : <b>".$_POST['session_time']."</b><br/> Questionnaires Title : <b>".'Discover Your Mindset Blueprint'."</b><br/>".$html;
                $mail1->AddAttachment(APPPATH.'pdffile/'.$pdfname );
               $str = $_POST['firstNeedDescAtt'];
              $firstNeedDescAtt = explode(", ",$str);
             $firstNeedDescAtt1 = preg_replace('/\s+/', '', $firstNeedDescAtt);
				foreach ( $firstNeedDescAtt1 as $needpdfkey => $needpdfvalue) 
				{
				    if(empty($needpdfvalue)){
				        
				    }else{
				        //$mail1->AddAttachment(APPPATH.'pdffile/special_pdf/'.$needpdfvalue );
				    }
				}
		   $str1 = $_POST['pdfDesc'];
              $pdfDesc = explode(", ",$str1);
             $pdfDesc1 = preg_replace('/\s+/', '', $pdfDesc);
				foreach ( $pdfDesc1 as $pdfkey => $pdfvalue) 
				{
				    if(empty($pdfvalue)){
				        
				    }else{
				       //$mail1->AddAttachment(APPPATH.'pdffile/special_pdf/'.$pdfvalue );
				    }
				}
			$mail1->IsHTML(true);
          
          
          	$mail1->Send();
				
			if( $mail->Send() )
				{
					//echo "<h1> Thank You ".$_POST['firstname']."</h1>";
					//$thank_page = true;
				}				    
				else
				{
					echo "Email sending failed";
				//	$thank_page = false;
				}	
				
			 } catch (phpmailerException $e) {
			 		echo "Email sending failed";
		             echo $e->errorMessage(); //Pretty error messages from PHPMailer
		            } catch (Exception $e) {
		            	echo "Email sending failed";
		            echo $e->getMessage(); //Boring error messages from anything else!
		        }
		        
		        $data = array(  
                        'name'     => $this->input->post('firstname'),  
                        'email'  => $this->input->post('email'),  
                        'phone'   => $this->input->post('mobile'),  
                        'session_date' => $this->input->post('session_date'),  
                        'session_time' => $this->input->post('session_time') , 
                        'coach_id' =>'77' 
                        );  
        //insert data into database table. 
       //$cid= $this->session->has_userdata('ContactID');
       // var_dump($cid);
      $cid =  $_POST['ContactID'];
      //var_dump($cid);
        $this->db->insert('client_registrations',$data);  
        	$app = new iSDK;
	    
	    	if ($app->cfgCon("connectionName")) 
			{ 
			    //slot tag 
			    $groupId = 21899;
			    $res = $app->grpAssign($cid, $groupId);  
			    $grp = array('_timesetof'  => $this->input->post('session_time'),'_datesetof'  => $this->input->post('session_date'));
    	        $query = $app->dsUpdate("Contact", $cid, $grp);
			}
			    $this->load->view('site/thankyou',$_POST);
		}
	 
		function thankYouPage()
		{
		   session_start();
		   // var_dump($this->input->post());
		   // IF NOT GETTING THE VALUE OF YOUR YES NO OR PARTIY CHANGE THE VALUE OF  ENCRYPTION CODE AT VIEW PAGE showquestionswithoptions
		//	echo $_POST['firstname'];
 
		//var_dump($maximumvalues);
	  	//session_start();
					
				error_reporting(0);
					
				$app = new iSDK;
				if(  ( (array_key_exists('firstname', $_SESSION))) && ( (array_key_exists('email', $_SESSION)))   )
				{
					$_POST['firstname'] 	= $_SESSION['firstname'];
					$_POST['email'] 		= $_SESSION['email'];
					$_POST['qn_title'] 		= $_SESSION['qn_title'];
					 
					$k =1;
					if(array_key_exists('question_id', $_SESSION))
					{
						foreach ($_SESSION['question_id'] as $key => $value) 
						{
								if( $value )
								{
									if ( isset($value) )
									{
										$_POST['question_id'][($k-1)] = $value;
									}
									 
								 
									$_POST['abc'.$k] = @$_SESSION['abc'][($k-1)];
								}
							
							++$k;
							}
					}
					
				}
				else
				{
					if(  ( !(array_key_exists('email', $_POST))) || ( empty($_POST['email'])  ) )
					{
						//session_destroy();
						//redirect(base_url()."questionnaires");
					}
					
					$_SESSION['firstname'] 	= @$_POST['firstname'];
					$_SESSION['email'] 		= @$_POST['email'];
					
				}
			// var_dump($_POST['email']);
				
				$total 				= 0;
				$contribution_mark	= 0;
				$growth_mark		= 0;
				$love_mark			= 0;
				$centainty_mark		= 0;
				$variety_mark		= 0;
				$significande_mark	= 0;
				$other_mark			= 0;
				
				$max_contribution_mark	= 0;
				$max_growth_mark		= 0;
				$max_love_mark			= 0;
				$max_centainty_mark		= 0;
				$max_variety_mark		= 0;
				$max_significande_mark	= 0;
				$max_other_mark			= 0;
				
				$i=1;
				foreach ($_POST as $key => $value) 
				{
					$quest_id = 0;
					$maxOptVal = 0;
					
					if ( isset($_POST['question_id'][($i-1)]))
					{
						$quest_id =(int) $this->encrypt->decode($_POST['question_id'][($i-1)]);
					}
					 
					if ( ( $quest_id != 0 ) && array_key_exists( 'value_max' , $_POST) )  
					{
						$maxOptVal =(int) $this->encrypt->decode($_POST['value_max'][$quest_id]);
					}
					
					if( $quest_id == 0 )
					{
						break;
					}
					
					$value2 = (int) $this->encrypt->decode( @$_POST['abc'.$i] );
					$total =   $total+$value2;
					
					$category_id =(int) $this->SQuestionnaires_model->getCategoryByQuestId( $quest_id );
					
					switch ($category_id) 
					{
						case '1':
							$contribution_mark = $value2+$contribution_mark;
							$max_contribution_mark = $maxOptVal+ $max_contribution_mark;
							break;
						case '2':
							$growth_mark = $value2+$growth_mark;
							$max_growth_mark = $maxOptVal+$max_growth_mark;
							break;
						case '3':
							$love_mark = $value2+$love_mark;
							$max_love_mark = $maxOptVal+$max_love_mark;
							break;
						case '4':
							$centainty_mark = $value2+$centainty_mark;
							$max_centainty_mark = $maxOptVal+$max_centainty_mark;
							break;
						case '5':
							$variety_mark = $value2+$variety_mark;
							$max_variety_mark = $maxOptVal+$max_variety_mark;
							break;	
						case '6':
							$significande_mark = $value2+$significande_mark;
							$max_significande_mark = $maxOptVal+$max_significande_mark;
							break;	
						case '0':
							$other_mark = $value2+$other_mark;
							$max_other_mark = $maxOptVal+$max_other_mark;
							break;	
						default:
							$other_mark = $value2+$other_mark;
							$max_other_mark = $maxOptVal+$max_other_mark;
							break;	
					}
					
					++$i;
				}
				
				$allmark = array(  
							" Contribution Mark " 			=> $contribution_mark,
							" Growth Mark " 				=> $growth_mark,
							" Love / Connection Mark " 		=> $love_mark,		
							" Certainty Mark " 				=> $centainty_mark,		
							" Variety / Uncertainty Mark " 	=> $variety_mark,
							" Significance Mark " 			=> $significande_mark /*,	
							" Other Mark " 					=> $other_mark */
							);
					
				$maximumvalues = array(  
								" Contribution Mark " 			=> $max_contribution_mark,
								" Growth Mark " 				=> $max_growth_mark,
								" Love / Connection Mark " 	=> $max_love_mark,
								" Certainty Mark " 				=> $max_centainty_mark,
								" Variety / Uncertainty Mark " 	=> $max_variety_mark,
								" Significance Mark " 			=> $max_significande_mark /*,
								" Other Mark " 					=> $max_other_mark */
							);			
 				      
				
				$html = "";
				$storeAllCatMarks = "";
				//ob_clean(); 
				$no = 1;
				$html .= "<br/><b>Result </b> <br/>";
				$descTopCategory = FALSE;
				
				$firstmaxval 	= 0;
				$secondmaxval	= 0;
				$pre_maxValue 	= 0;
				
				$twoTopCat = FALSE;
			 	foreach ($allmark as $key => $value) 
				{
					$max = 0;
					$maxValue = max($allmark);
					$maxIndex = array_search(max($allmark), $allmark);
					
					
					//$max = 	$maximumvalues[$maxIndex];
					$firstmaxbegin 	 =  "";
					$firstmaxend	 =  "";
					
					if( (($no < 3) && ($total!=0) ) || ($pre_maxValue==$maxValue) ) 
					{
						if( $no == 1 )
						{
							$firstmaxval = $maxValue;
						}
						
						if( $no == 2 )
						{
							$secondmaxval = $maxValue;
						}
						
						if( (($no == 2) && ($maxValue!=0)) ) 
						{
							$twoTopCat = TRUE;
							$pre_maxValue = $maxValue;
						}
						
						if( $maxValue != 0)  
						{
							$firstmaxbegin 		=  "<b>";
							$firstmaxend	 	=  "</b>";
							$descTopCategory[] 	= $maxIndex;	
						}
						
					}
					
						//$html .= $no++." : ".$maxIndex." :  ". $maxValue ." / ".$max."<br/>";
						$html .= $firstmaxbegin.$no++." : ".$maxIndex." :  ". $maxValue.$firstmaxend."<br/>";
						$storeAllCatMarks .= $firstmaxbegin.($no-1)." : ".str_replace (' Mark ', '', $maxIndex)." :  ". $maxValue.$firstmaxend.","; 
						
					unset( $allmark[ $maxIndex ] );
				}
				
				$html = str_replace (' Mark ', '', $html);
				
				$allcategoriesmarks = array(  
							" Contribution Mark " 			=> $contribution_mark,
							" Growth Mark " 				=> $growth_mark,
							" Love / Connection Mark " 		=> $love_mark,		
							" Certainty Mark " 				=> $centainty_mark,		
							" Variety / Uncertainty Mark " 	=> $variety_mark,
							" Significance Mark " 			=> $significande_mark /*,	
							" Other Mark " 					=> $other_mark */
							);
				
				
				$diffcategoriesmarks 		= "else";
				$sameneedcategoriesmarks 	= FALSE;
				
				if( ( $firstmaxval != 0 ) && ( $firstmaxval == ($allcategoriesmarks[ end($descTopCategory) ]) ))
				{
					$diffcategoriesmarks    	= "";
					$sameneedcategoriesmarks 	= TRUE;	
				}
				
			 
				$firstNeedDescAtt = array();
				
				//$pdfoneCatDesc = FALSE;
				$oneCatDesc = "";
				
				if( $sameneedcategoriesmarks )
				{
				
					if ( (in_array(" Contribution Mark ", $descTopCategory))   )
					{
						$firstNeedDescAtt[] = "contribution.pdf";
					}		
					 $diffcategoriesmarks;
					if ( (in_array(" Growth Mark ", $descTopCategory))   )
					{
						$firstNeedDescAtt[] = "growth.pdf";
					}
					 $diffcategoriesmarks;
					if ( (in_array(" Love / Connection Mark ", $descTopCategory)) )
					{
						$firstNeedDescAtt[] = "love_and_connection.pdf";
					}
					 $diffcategoriesmarks;
					if ( (in_array(" Certainty Mark ", $descTopCategory))   )
					{
						$firstNeedDescAtt[] = "certainty.pdf";
					}
					 $diffcategoriesmarks;
					if ( (in_array(" Variety / Uncertainty Mark ", $descTopCategory))   )
					{
						$firstNeedDescAtt[] = "uncertainty.pdf";
					}
					 $diffcategoriesmarks;
					if ( (in_array(" Significance Mark ", $descTopCategory))   )
					{
						$firstNeedDescAtt[] = "significance.pdf";
					}
					
				}			
				
				
				
				if( ($descTopCategory) && !($sameneedcategoriesmarks) )
				{
					//$p=1;
					/*foreach ($descTopCategory as $key => $value) 
					{*/
						
						//$oneCatDesc .= "<br/><br/>";
						$oneCatDeschead = "<h3> IF	YOUR	FIRST	NEED	IS	FOR ".str_replace (' Mark ', '', $descTopCategory[0])."</h3>";
						
						switch ($descTopCategory[0])
						{
							case ' Contribution Mark ':
								//$pdfoneCatDesc = "contribution.pdf";
								$firstNeedDescAtt[] = "contribution.pdf";
								 
							 break;
							
							case ' Growth Mark ':
								//$pdfoneCatDesc = "growth.pdf";
								$firstNeedDescAtt[] = "growth.pdf";
								 
								break;
							
							
							case ' Love / Connection Mark ':
								//$pdfoneCatDesc = "love_and_connection.pdf";
								$firstNeedDescAtt[] = "love_and_connection.pdf";
								 
								break;
							
							case ' Certainty Mark ':
								//$pdfoneCatDesc = "certainty.pdf";
								$firstNeedDescAtt[] = "certainty.pdf";
								 break;
							
							case ' Variety / Uncertainty Mark ':
								//$pdfoneCatDesc = "uncertainty.pdf";
								$firstNeedDescAtt[] = "uncertainty.pdf";
								 break;
							
							case ' Significance Mark ':
								//$pdfoneCatDesc = "significance.pdf";
								$firstNeedDescAtt[] = "significance.pdf";
								 break;
								
							default:
								$pdfoneCatDesc = FALSE;
								$oneCatDesc = "";
								break;
								 
						}	
						
						$oneCatDesc = "<h3>".$oneCatDeschead."</h3>".htmlentities($oneCatDesc);
						
						
					//	$p++;
					//}
					
				}
				
				$singleattchmentfileN = array(  
							" Contribution Mark " 			=> "contribution",
							" Growth Mark " 				=> "growth",
							" Love / Connection Mark " 		=> "love",		
							" Certainty Mark " 				=> "certainty",		
							" Variety / Uncertainty Mark " 	=> "uncertainty",
							" Significance Mark " 			=> "significance" /*,	
							" Other Mark " 					=> $other_mark */
							);	
				
				
					//$pdfDesc =FALSE;
				$pdfDesc = array();
				$desc = "";
				
				if( !($sameneedcategoriesmarks) )
				{
					
					foreach ($descTopCategory as $allkey => $allvalue) 
					{
						if ( $allkey != 0  )
						{
							$b = $singleattchmentfileN[$allvalue]."_and_".$singleattchmentfileN[$descTopCategory[0]].".pdf";
							
							if ( !(file_exists(APPPATH.'pdffile/special_pdf/'.$b)) ) 
							{
							    $b = $singleattchmentfileN[$descTopCategory[0]]."_and_".$singleattchmentfileN[$allvalue].".pdf";
							}
							
							$pdfDesc[] = $b;
						}			
					}
					
					
				
				}
				
				
				if(($twoTopCat) && ($sameneedcategoriesmarks) )
				{
						//case (  (in_array(" Certainty Mark ", $descTopCategory) ) && ($descTopCategory[1] == ' Variety / Uncertainty Mark ') ):
						if ( (in_array(" Certainty Mark ", $descTopCategory))  && (in_array(" Variety / Uncertainty Mark ", $descTopCategory))  )
						{
							
							//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
							$pdfDesc[] = "certainty_and_uncertainty.pdf";
						 
						}	
						 $diffcategoriesmarks;   
						//else 
							if( (in_array(" Certainty Mark ", $descTopCategory))  && (in_array(" Significance Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "certainty_and_significance.pdf";
							 
							}	   
						//else 
						 $diffcategoriesmarks;
							if( (in_array(" Certainty Mark ", $descTopCategory))  && (in_array(" Love / Connection Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "certainty_and_love.pdf";
							 
							}   
						//else   
						 $diffcategoriesmarks;
							if( (in_array(" Certainty Mark ", $descTopCategory))  && (in_array(" Growth Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "certainty_and_growth.pdf";
								 	}		
					//else 
					 $diffcategoriesmarks;
							if( (in_array(" Certainty Mark ", $descTopCategory))  && (in_array(" Contribution Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "certainty_and_contribution.pdf";
								 
							}	
						//else   
						 $diffcategoriesmarks;
							if( (in_array(" Variety / Uncertainty Mark ", $descTopCategory))  && (in_array(" Significance Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "uncertainty_and_significance.pdf";
							 
							}	
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Variety / Uncertainty Mark ", $descTopCategory))  && (in_array(" Love / Connection Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "uncertainty_and_love.pdf";
								 
							}	
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Variety / Uncertainty Mark ", $descTopCategory))  && (in_array(" Growth Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "uncertainty_and_growth.pdf";
								 
							}	
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Variety / Uncertainty Mark ", $descTopCategory))  && (in_array(" Contribution Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "uncertainty_and_contribution.pdf";
								 
							}
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Significance Mark ", $descTopCategory))  && (in_array(" Love / Connection Mark ", $descTopCategory)) )
							{
						   		//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
						   		$pdfDesc[] = "significance_and_love.pdf";
						   		 
							}
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Significance Mark ", $descTopCategory))  && (in_array(" Growth Mark ", $descTopCategory)) )
							{
						   		//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
						   		$pdfDesc[] = "significance_and_growth.pdf";
						   	  
							}
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Significance Mark ", $descTopCategory))  && (in_array(" Contribution Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "significance_and_contribution.pdf";
								 
							}
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Love / Connection Mark ", $descTopCategory))  && (in_array(" Growth Mark ", $descTopCategory)) )
							{	 
						   		//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
						   		$pdfDesc[] = "love_and_growth.pdf";
						   		 
							}
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Love / Connection Mark ", $descTopCategory))  && (in_array(" Contribution Mark ", $descTopCategory)) )
							{	
						   		//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
						   		$pdfDesc[] = "love_and_contribution.pdf";
								 
							}
						//else
						 $diffcategoriesmarks;
							if( (in_array(" Growth Mark ", $descTopCategory))  && (in_array(" Contribution Mark ", $descTopCategory)) )
							{
								//$desc = $descTopCategory[0].' : '.$descTopCategory[1];
								$pdfDesc[] = "growth_and_contribution.pdf";
								}
					/*	else
						{
							$pdfDesc = FALSE;
				        	$desc = 'Some error has occurred. Please Inform Support team. We will get back to you.';
				        }
						*/
					$Heading_desc ="If your first two needs are for ".str_replace (' Mark ', '', $descTopCategory[0]) ." and ".str_replace(' Mark ','', $descTopCategory[1]);	
						
					$desc = "<h3>".$Heading_desc."</h3>".htmlentities($desc);
							
				}
			 
			 
				$_SESSION['total'] = $total;
				
				$storeAllCatMark =  strip_tags($storeAllCatMarks);
				
				$this->load->model('user_model');
				$this->user_model->storeMarks($storeAllCatMark);
				//die;
			//	var_dump($total); 
				
				$userinfo = "	Name	:	<b>".@$_POST['firstname']."</b> <br><br>	Email	:	<b>".@$_POST['email']."</b><br><br>	Questionnaire Title	:	<b>".@$_POST['qn_title']."</b><br><br>";
			    
				
				$result = str_replace ('<br/>', '<br><br>', $html);
				$pdfname = $_POST['firstname'].".pdf";
			//	var_dump($pdfname);
				  $this->createPDFFile($pdfname, $userinfo, $result);
				
			 		
		//$app = new iSDK;
		if ($app->cfgCon("connectionName")) 
		{
		 
		 //insert query to client data in database with date and time 
		        $conID= $app->addWithDupCheck(array('FirstName' =>$_POST['firstname'], 'Email' => $_POST['email'],'Phone1' => $_POST['mobile']), 'EmailAndName');
			    $_SESSION["ContactID"] = $conID;
				//$ContactID = $arr['Contact.Id'];
				$ContactID = $conID;
			    $groupId = 21897;
			    $res = $app->grpAssign($ContactID, $groupId);  
                $setcontactid=  $this->session->set_userdata('ContactID', $ContactID);
		   // get result then false 
		   		if ( !$result2 )
			   {
			   		// remove 
			    	$removeResult = $app->grpRemove($contactId, $groupId);
					 if( $removeResult )
					 {
						$result3 = $app->grpAssign($contactId, $groupId); 
					 }
					 
				}
			   
				 
				 		
				$_SESSION['flag']		= TRUE; 
				
				$_POST['ContactID'] ="";
				
				if( (array_key_exists('time', $_SESSION)) && ($_SESSION['time'] == 0 ) )
				{
						$thank_page               = FALSE;
						$timerdata['questionnaire_id'] =  $_SESSION['questionnaire_id'];
						session_destroy();
						$this->load->view('site/timerthankyou',$timerdata );
				}
					$thank_page = true;
				if( $thank_page )
				{
					session_start();
				$data['postdata']=$_POST;
				$data['ContactID'] = $setcontactid;
				$data['max2cat']= $descTopCategory;
                $data['firstNeedDescAtt']= $firstNeedDescAtt;
                $data['pdfDesc']= $pdfDesc;
                $data['mark']= $allcategoriesmarks;
                // insert top need in db
                 $namestr = array();
                 $topmarks = array();
                foreach($data['max2cat'] as $key => $val ){
                  array_push($namestr,$val);
                foreach($data['mark'] as $key2 => $val2 ){
                    if($val==$key2){
                         array_push($topmarks,$val2);
                       
                    }
                    
                }
				    
				}
				$names_str1 = serialize($namestr);
                 $topmarks22 = serialize($topmarks);
                 $data2 = array(  
                        'name'     => $_POST['firstname'],  
                        'email'  => $_POST['email'],  
                        'mobile'   => $_POST['mobile'],  
                        'tagnumber' => '21897',  
                        'coachid' => '77' ,
                        'topneeds' =>$names_str1,
                        'marks'	=>$topmarks22
                        );  
        //insert data into database table.  
        $this->db->insert('submitquestion',$data2);
       // var_dump($data2);
			    $this->load->view('site/beforethankyou',$data);
			 
				}
				
		}
}

		function setFormVariablesINSession()
		{
			session_start();
			if(  ( !(array_key_exists('qn_title', $_POST)))   )
			{
			//	redirect( base_url() );
			}
				
			$_SESSION['firstname'] 	 	= $_POST['firstname'];
			$_SESSION['email'] 		 	= $_POST['email'];
			$_SESSION['question_id'] 	= $_POST['question_id'];
			$_SESSION['abc'] 			= $_POST['abc'];
			$_SESSION['time'] 			= 0;
			
			
		}
		
		function lists( $id )
		{
			$data['questionnaires'] 	= $this->SQuestionnaires_model->getQuestionnaire( $id );
			$data['questions'] 			= $this->SQuestionnaires_model->getQuestionsById( $id );
			
			$this->load->view('site/showquestions', $data );
		}
		
		function addtagInfusionsoft()
		{
			session_start();
			
			$firstname	 	= $_POST['fistname'];
			$email 		 	= $_POST['emailid'];
			$mobile 		= $_POST['mobileno'];
			
			//$firstname	 	= "Mobin";
			//client visitors tag
					 
			 $data = array(  
                        'name'     => $firstname,  
                        'email'  => $email,  
                        'phone'   => $mobile,  
                        'tagnumber' => '21895',  
                        'coachid' => '77' 
                        );  
        //insert data into database table.  
        $this->db->insert('reg-client',$data);
			
			//require_once(APPPATH."third_party/infusionsoft/isdk.php");
			
			$app = new iSDK;  
			if ($app->cfgCon("connectionName")) 
			{ 
			    $conID = $app->addWithDupCheck(array('FirstName' =>$firstname, 'Email' => $email,'Phone1' => $mobile), 'EmailAndName');
  
				$_SESSION["ContactID"] = $conID;
				
				//$ContactID = $arr['Contact.Id'];
				$ContactID = $conID;
				$this->session->set_userdata('ContactID', $conID);
			    $groupId = 21895;
			    $res = $app->grpAssign($ContactID, $groupId);	
				
				// get result then false 
		   		if ( !$res )
			   {
			   		// remove 
			    	$removeRes = $app->grpRemove($ContactID, $groupId);
					 if( $removeRes )
					 {
						$res3 = $app->grpAssign($ContactID, $groupId); 
					 }
					
			   }
				
				//echo '<input type="hidden" name="ContactID"  value="'.intval($conID).'" />';
				
				echo intval($conID);
				
			}
		
		}
		
		
		function createPDFFile( $pdfname ,$userinfo, $result  )
		{
			require_once(APPPATH."third_party/fpdf/my_fpdf.php");
		 	
			$pdf = new PDF();
			// First page
			$pdf->AddPage();
			$pdf->SetFont('Arial','',20);
			//$pdf->Image('images/logo.jpg',10,12,30,0,'JPG','');
			$pdf->Image(APPPATH.'third_party/fpdf/images/logo.jpg',10,12,190,50,'JPG','');
			//$pdf->Write(5,"testing 2 To find out what's new in this tutorial, click ");
			
			// Line break
			$pdf->Ln(70);
			$pdf->WriteHTML($userinfo);   
			
			// Line break
			$pdf->Ln(10);
			$pdf->WriteHTML($result); 
			$pdf->SetFont('','U');
			$link = $pdf->AddLink();
		 
			 
			$pdf->Output(APPPATH."pdffile/".$pdfname,"F");
				
		}
			

}
?>