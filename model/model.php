<?php
class model  
{
	

	public function getImageList($docid)
	{


		$albums = Array();
		$res_getnames=array();

		$dataManager=new dataManager();
		$res_getnames=$dataManager->getCatIds($docid);

		if ($res_getnames) {
			foreach($res_getnames as $value)
			{
				$catalogue[$value[CATALOGUE_ID]] = $value[CATALOGUE_NAME];
				$cat_arr[] = $value[CATALOGUE_ID];
			}

		}

		if (count($cat_arr) > 0)
			$catlist =  implode("','", $cat_arr);
		else
			$catlist = "'" . $cat_arr . "'";
		$arrlist = array();
		$arrphoto = array();
		$get_data = $dataManager->getImageData($docid,$catlist);
		if ($get_data) {
			$k = 0;
			foreach ($get_data as $row_data) {

				$data[$row_data[DOC_ID]][SHOWCASE][$k][IMAGE_THUMB] = $row_data[PRODUCT_THUMB_URL];
				$data[$row_data[DOC_ID]][SHOWCASE][$k][IMAGE_LARGE] = $row_data[PRODUCT_URL];
				$data[$row_data[DOC_ID]][SHOWCASE][$k][IMAGE_NAME] = $row_data[PRODUCT_NAME];
				if ($row_data[PRODUCT_POSITION] == 1) {
					$data[$row_data[DOC_ID]][DISP_PIC] = $row_data[PRODUCT_URL];
				}
				$k++;
			}
		}
		
		return $data;
		
	}
	public function companyDetails($docid)
	{
		
		$qrySty=URL_COMPANY_DETAILS.'?docid='.$docid;
		$getData=$this->getCurlCall($qrySty);
		$decodeData= json_decode($getData);
		$address=array();
		$address[COMPANY_NAME]=$decodeData->$docid->companyname;
		$address[AREA]=$decodeData->$docid->area;
		$address[BUILDING_NAME]=$decodeData->$docid->building_name;
		$address[STREET]=$decodeData->$docid->street;
		$address[CITY]=$decodeData->$docid->city;
		$address[DATA_CITY]=$decodeData->$docid->data_city;
		$address[LANDMARK]=$decodeData->$docid->landmark;
		$address[PINCODE]=$decodeData->$docid->pincode;
		$address[LANDLINE_DISPLAY]=$decodeData->$docid->landline_display;
		$address[MOBILE_DISPLAY]=$decodeData->$docid->mobile_display;
		$address[MOBILE_FEEDBACK]=$decodeData->$docid->mobile_feedback;
		$address[LANDLINE_FEEDBACK]=$decodeData->$docid->landline_feedback;
		$address[EMAIL_DISPLAY]=$decodeData->$docid->email_display;
		$address[LATITUDE]=$decodeData->$docid->latitude;
		$address[LONGITUDE]=$decodeData->$docid->longitude;
		$address[CUSTOMER_CARE_NUMBER]=$decodeData->$docid->duplicate_check_phonenos;
		$address[EMAIL_FEEDBACK]=$decodeData->$docid->email_feedback;
		return array($docid=>$address);
	}

	public function getBizInfo($docid)
	{
		
		$res_getnames=array();
		$dataManager=new dataManager();
		$res_getnames=$dataManager->getBizInfo($docid);
		return array(BIZ_INFO=>$res_getnames);

	}
	
	public function homepageDetails($docid){
		
	/*	$slist=array();
		$getData = array("0" =>array( 
		"cnm"=> "Business Crimes", 
		"cid"=> "123457", 
		"curl"=> "http://192.168.24.163:8080/banner/ac_dealers_b.jpg", 
		"slist"=> $slist  
		),
		"1"=>array("cnm"=> "Criminal Compliances", 
		"cid"=> "965875", 
		"curl"=> "http://192.168.24.163:8080/banner/ayurvedic_doctors_b.jpg", 
		"slist"=> $slist
		), 
		"2"=>array("cnm"=> "Consumer Disputes", 
		"cid"=> "259687", 
		"curl"=> "http://192.168.24.163:8080/banner/wall_paper_dealers_b.jpg", 
		"slist"=> $slist
		),
		"3"=>array("cnm"=> "Family & Matrimonial Disputes", 
		"cid"=> "457862", 
		"curl"=> "http://192.168.24.163:8080/banner/offset_printers_b.jpg", 
		"slist"=> $slist
		),
		"4"=>array("cnm"=> "Intellectual Property Rights", 
		"cid"=> "365444", 
		"curl"=> "http://192.168.24.163:8080/banner/car_hire_b.jpg", 
		"slist"=> $slist
		),
		"5"=>array("cnm"=> "Counterfeiting", 
		"cid"=> "789456", 
		"curl"=> "http://192.168.24.163:8080/banner/dress_material_retailers_b.jpg", 
		"slist"=> array("0"=>array("snm"=>"Disputes","sid"=>"234547","surl"=>"http://192.168.24.163:8080/banner/grocery_stores_b.jpg"),"1"=>array("snm"=>"Compliance","sid"=>"234512","surl"=>"http://192.168.24.163:8080/banner/laptop_dealers_b.jpg"))
		),
		"6"=>array("cnm"=> "Extradition & Mutual Legal Assistance", 
		"cid"=> "856479", 
		"curl"=> "http://192.168.24.163:8080/banner/north_indian_restaurants_b.jpg", 
		"slist"=> $slist
		),
		"7"=>array("cnm"=> "Admirality/Maritime Law", 
		"cid"=> "147895", 
		"curl"=> "http://192.168.24.163:8080/banner/diagnostic_centres_b.jpg", 
		"slist"=> $slist
		),
		"8"=>array("cnm"=> "Civil Litigation", 
		"cid"=> "665478", 
		"curl"=> "http://192.168.24.163:8080/banner/surgical_equipment_dealers_b.jpg", 
		"slist"=> $slist
		),
		"9"=>array("cnm"=> "Business Crimes", 
		"cid"=> "447895", 
		"curl"=> "http://192.168.24.163:8080/banner/ac_dealers_b.jpg", 
		"slist"=> $slist
		),
		);
        		$getData =array("homepageDetails"=>$getData);
        		return $getData;*/


        		//$qry='http://sunnyshende.jdsoftware.com/web_services/web_services/CompanyDetails.php?docid='.$docid.'&case=w_omni';
        		$qry=API_DOMAIN.'CompanyDetails.php?docid='.$docid.'&case=w_omni';

        		$res=$this->getCurlCall($qry);

        		return $res;
        	}


        	public function submitFormData($national_catid,$service_id,$docid,$full_name,$mobile,$email,$request_date,$request_time,$remarks,$sku,$source_flag,$template_type){
         		$getCompanyInfo=$this->companyDetails($docid);
        		$companName=$getCompanyInfo[$docid]['companyName'];
        		$companyEmailId=$getCompanyInfo[$docid]['emailDisplay'];
        		$companyMobileNumber=explode(",",$getCompanyInfo[$docid]['mobileDisplay']);
        		//$companyNewNumber=  preg_replace("/[^0-9]/", "", $companyMobileNumber[0]);
        		$companyNewNumber=$companyMobileNumber[0];
        		$vendorMobileNumber = substr($companyNewNumber, strpos($companyNewNumber, "-") + 1);    

        		if(empty($request_time))
        		{

        			$request_time_new="";

        		}
        		else
        		{
        			$request_time_new=$request_time;
        		}
        		if(empty($request_date))
        		{
        			$request_date_new="";
        		}
        		else
        		{
        			$request_date_new=$request_date;
        		}
        		$servertext=$usertext='';
        		if(empty($mobile))
        		{
        			$mobiles='';
        		}
        		else
        		{
        			$mobiles=$mobile.',';
        		}
        		if(!empty($email)){
        			if(empty($request_time) && empty($request_date))
        			{
        				
        				$servertext='<table cellspacing="0" cellpadding="0" border="0" width="600" style="border:1px solid #E4E4E4;" align="center"><tbody>
        				<tr><td style="padding:10px 8px 10px 8px; background:#fff; -webkit-text-size-adjust:none;"><a href="http://www.justdial.com"><img src="http://images.jdmagicbox.com/icontent/jdlogotm.gif"></a></td></tr>
        				<tr><td style="padding:10px 8px 10px 8px; Open Sans, Helvetica, Arial; font-size:18px; padding:5px 0 5px 0"></a></td></tr>
        				<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:10px 0px 10px 7px; font-family:Verdana;">Dear <b>'.$companName.',</b></td></tr>
        				<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">You have received a new enquiry. Please see details below:</td></tr>        
        				<tr><td colspan="6" style="padding:0px 0;">
        					<table cellspacing="0" cellpadding="0" border="0" width="100%" class="total">
        						<tbody>
        							<tr><td width="66%" style="padding:10px 0px 10px 10px;font-size:12px; font-family:Verdana;color:#424242;"><b>Customer Info</b></td></tr>
        							<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$full_name.','.$mobiles.''.$email.'</td></tr>
        							<tr><td width="66%" style="padding:10px 0px 10px 10px;font-size:12px; font-family:Verdana;color:#424242;"><b>Message</b></td></tr>
        							<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$remarks.'</td></tr>
        							<tr><td width="66%" style="padding:10px 0px 0px 8px;font-size:12px; font-family:Verdana;color:#424242;">Regards,</td></tr>
        							<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">Team Justdial</td></tr>					
        						</tbody></table>
        					</td>
        				</tr>
        			</tbody></table>';
        		}
        		else
        		{
        			$servertext='<table cellspacing="0" cellpadding="0" border="0" width="600" style="border:1px solid #E4E4E4;" align="center"><tbody>
        			<tr><td style="padding:10px 8px 10px 8px; background:#fff; -webkit-text-size-adjust:none;"><a href="http://www.justdial.com"><img src="http://images.jdmagicbox.com/icontent/jdlogotm.gif"></a></td></tr>
        			<tr><td style="padding:10px 8px 10px 8px; Open Sans, Helvetica, Arial; font-size:18px; padding:5px 0 5px 0"></a></td></tr>
        			<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:10px 0px 10px 7px; font-family:Verdana;">Dear <b>'.$companName.',</b></td></tr>
        			<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">You have received a new enquiry. Please see details below:</td></tr>        
        			<tr><td colspan="6" style="padding:0px 0;">
        				<table cellspacing="0" cellpadding="0" border="0" width="100%" class="total">
        					<tbody>
        						<tr><td width="66%" style="padding:10px 0px 10px 10px;font-size:12px; font-family:Verdana;color:#424242;"><b>Customer Info</b></td></tr>
        						<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$full_name.', '.$mobiles.' '.$email.'</td></tr>
        						
        						<tr><td width="66%" style="padding:10px 0px 10px 10px;font-size:12px; font-family:Verdana;color:#424242;"><b>Message</b></td></tr>
        						<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$remarks.'</td></tr>
        						<tr><td width="66%" style="padding:10px 0px 0px 8px;font-size:12px; font-family:Verdana;color:#424242;">Regards,</td></tr>
        						<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">Team Justdial</td></tr>					
        					</tbody></table>
        				</td>
        			</tr>
        		</tbody></table>';
        	}
        	$usertext='<table cellspacing="0" cellpadding="0" border="0" width="600" style="border:1px solid #E4E4E4;" align="center"><tbody>
        	<tr><td style="padding:10px 8px 10px 8px; Open Sans, Helvetica, Arial; font-size:18px; padding:5px 0 5px 0"></a></td></tr>
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:10px 0px 10px 7px; font-family:Verdana;">Dear <b>'.$full_name.',</b></td></tr>
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">Thanks for messaging us!</td></tr> 
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">We will get in touch with you shortly.</td></tr> 
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">You can also directly contact us on '.$companyNewNumber.'</td></tr>
        	<tr><td width="66%" style="padding:10px 0px 0px 8px;font-size:12px; font-family:Verdana;color:#424242;">Regards,</td></tr>
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$companName.'</td></tr>      
        </tbody></table>';
    }

    if(empty($request_time) && empty($request_date))
    {
    	$smstext='Dear '.$companName.','.
    	'You have received a new enquiry.
    	Customer Info: '.$full_name.', '.$mobile.', '.$email.' 
    	Message:'.$remarks.'
    	Regards,
    	Team Justdial';
    }
    else
    {
    	$smstext='Dear '.$companName.',
    	'.'You have received a new enquiry.
    	Customer Info: '.$full_name.', '.$mobile.', '.$email.' 
    	Booking Info: '.$request_date.', '.$request_time.'
    	Message: '.$remarks.'
    	Regards,
    	Team Justdial';
    }
    $smstext_user = 'Dear '.$full_name.',
    Thanks for messaging us! We will get in touch with you shortly.
    You can also directly contact us on'.$companyNewNumber.'
    Regards,'.
    $companName;
    $mobile_enq='9844333465';//9844333465
    $smstext = preg_replace('/\s+/', ' ',$smstext);
    $smstext_user = preg_replace('/\s+/', ' ',$smstext_user);
    $dataManager=new dataManager();
    $res_getnames=$dataManager->submitForm($national_catid,$service_id,$docid,$full_name,$mobile,$email,$request_date_new,$request_time_new,$remarks,$servertext,$usertext,$smstext,$smstext_user,$mobile_enq,$companyEmailId,$sku,$source_flag,$template_type);
    if($res_getnames)
    {
    	return array(STATUS_CODE=>'1',MSG=>'data inserted successfully');
    	
    }
    else
    {
    	return array(STATUS_CODE=>'0',MSG=>'insert fail');
    }

}

public function getGallphotos($docid){
	$qry=URL_GALLERY_IMAGAE.'?id='.$docid;
	$res=$this->getCurlCall($qry);
	return $res;
}

public function domainMapping($domainName,$latitude,$longitude)
{
	$url="http://sunnyshende.jdsoftware.com/web_services/omni_services/domainMapping.php?domain=".$domainName."&lat=".$latitude."&long=".$longitude."";
	$res=$this->getCurlCall($url);
	return $res;

}


public function serviceMapping($docid,$vertical,$flag,$tempType)
{
	$url="http://sunnyshende.jdsoftware.com/web_services/omni_services/serviceMapping.php?docid=".$docid."&vertical=".$vertical."&custom_flag=".$flag."&template_type=".$tempType."";
	$res=$this->getCurlCall($url);
	return $res;

}


public function getCurlCall($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

public function setUserTestimonial($docid,$name,$mobileno,$emailid,$comment,$image_url,$userid,$src_flag)
{

	$dataManager=new dataManager();
	$dataPortion='{"user_id":"'.$userid.'","name":"'.$name.'","mobile":"'.$mobileno.'","email_id":"'.$emailid.'","user_comment":"'.$comment.'","image_url":"'.$image_url.'","audio_url":"","video_url":"","src_flg":'.$src_flag.'}';
	$data=urlencode($dataPortion);
	$url=TESTIMONIAL_URL.'?docid='.$docid.'&case=TML&data='.$data;
	//$url="http://192.168.20.102:9001/omni_services/miscContent.php?docid=".$docid."&case=TML&data=".$data;

	$res=$this->getCurlCall($url);
	return $res;
}

public function getTestimonial($docid,$start,$limit,$state)
{
	$url=TESTIMONIAL_URL.'?docid='.$docid.'&case=TML&state='.$state.'&start='.$start.'&limit='.$limit.'';
	$response=$this->getCurlCall($url);
	return $response;
}

public function termCondition($docid)
{
	$url=TESTIMONIAL_URL.'?docid='.$docid.'&case=TNC';
	$response=$this->getCurlCall($url);
	return $response;
}

public function getTestimonialImages($docid)
{
	$url=TESTIMONIAL_URL.'?docid='.$docid.'&case=IMAGES';
	$response=$this->getCurlCall($url);
	return $response;
}
public function reservationInfo($docid,$type_flag)
{

	$url=RESERVATION_API."?docid=".$docid."&type_flag=".$type_flag."";
	$response=$this->curl_download($url);
	return $response;
	//$decodeData= json_decode($response);
	//$reservationInfo=array();
	//$reservationInfo[HOURS_OF_OPERATION]=$decodeData->results->compdetails->hours_of_operation;
	//$reservationInfo[COMPANY_NAME]=$decodeData->results->compdetails->companyname;
	//$reservationInfo[AREA]=$decodeData->results->compdetails->area;
	//return array('results'=>$reservationInfo);

}

public function reservationAvailableDetails($docid,$type_flag,$date)
{

	$url=RESERVATION_INFO_API."?docid=".$docid."&type_flag=".$type_flag."&date=".$date."";
	$response=$this->getCurlCall($url);
	return $response;
}


public function sendVerificationCode($mobile,$domain_id,$domain_tag,$user_id)
{
	$new_format=null;
	$user_ip    = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	$currentdate = date('Y-m-d-H:i:s');
	$mobile      = trim($mobile);
	$currentdate = trim($currentdate);
	$mcount      = false;
	$res_count=array();
	$dataManager=new dataManager();
	$res_count=$dataManager->countSMSRequest($mobile);
	$attempt_count=$res_count[0]['total'];
	$success_count=$res_count[0]['cnt'];
	if($attempt_count==20)
	{
		return "REACHED_DAILY_SMS_LIMIT";
	}
	else{
		global $test_mobiles;
		$test_mobiles=array();
		if(in_array($mobile,$test_mobiles) && $new_format)
		{
			$regcode = "123-456";
			$mob_verify_code = "123-456";
		}
		else if(in_array($mobile,$test_mobiles))
		{
			$regcode = "pqrstu";
			$mob_verify_code = "pqrstu";
		}
		else if($new_format)
		{
			$mob_verify_code = "";

			for($i=1; $i<=6; $i++)
			{
				$regcode = mt_rand(1,9);
				$mob_verify_code = $mob_verify_code.$regcode;
				if(3 == $i) $mob_verify_code = $mob_verify_code."-";
			}
		}
		else
		{
			$mob_verify_code ="";
			for($i=1; $i<=6; $i++)
			{
				$regcode = mt_rand(1,9);
				$mob_verify_code = $mob_verify_code.$regcode;
			}
		}
		$sms_text_forward  = $mob_verify_code;
		$sms_text_forward1 = 'Your Justdial Verification Code is ' . $mob_verify_code;
		$res_insert=$dataManager->insertSMSRequest($mobile,$status,$user_ip,$currentdate,$sms_text_forward,$sms_text_forward1,$domain_id,$domain_tag,$user_id);
		if($res_insert)
		{
			return array(STATUS=>'0',MSG=>'Verification code successfully sent');
		}	
		else
		{

			return array(STATUS=>'1',MSG=>'Verfication Code not Sent');
		}

	} 

}

public function rsvnBooking($docid,$date,$num_booking,$time,$name,$mobile,$email,$type_flag,$action_flag,$src,$isOmni)
{

	$url=RESERVATION_URL."/rsvnBooking.php?docid=".$docid."&date=".$date."&time=".$time."&num_booking=".$num_booking."&name=".$name."&mobile=".$mobile."&email=".$email."&type_flag=".$type_flag."&action_flag=".$action_flag."&src=".$src."&isOmni=".$isOmni."";
	$response=$this->getCurlCall($url);
	return $response;
}

public function rsvnAction($reference_number,$action_flag,$src)
{

	$url=RESERVATION_URL."/rsvnAction.php?reference_number=".$reference_number."&action_flag=".$action_flag."&src=".$src."";
	$response=$this->getCurlCall($url);
	return $response;

}

public function verifyOTP($mobile,$otp)
{
	$dataManager=new dataManager();
	$res_getnames=$dataManager->verifyOTP($mobile,$otp);
	return $res_getnames;
}

public function rsvnUserBookingDetails($caller_mobile,$type_flag,$action_flag)
{
	$url=RESERVATION_URL."/rsvnUserBookingDetails.php?caller_mobile=".$caller_mobile."&type_flag=".$type_flag."&action_flag=".$action_flag."";
	$response=$this->getCurlCall($url);
	return $response;
}

public function rsvnBookingDetails($docid,$date,$type_flag)
{
	$url=RESERVATION_URL."/rsvnBookingDetails.php?docid=".$docid."&date=".$date."&type_flag=".$type_flag."";
	$response=$this->getCurlCall($url);
	return $response;
}


public function signUp($e,$m,$ub,$pwd,$did,$first_name,$last_name,$flag)
{


	if($flag==1)
	{

		$dataPortion='{"first_name":"'.$first_name.'","last_name":"'.$last_name.'","e":"'.$e.'","m":"'.$m.'","ub":"'.$ub.'","pwd":"'.md5($pwd).'","did":"'.$did.'"}';
		$data=urlencode($dataPortion);
		$url="http://192.168.20.102:9001/omni_services/profileDetails.php?data=".$data;
		$response=$this->getCurlCall($url);
		$response_status=json_decode($response);
		if($response_status->error->code==1)
		{
        $dataManager=new dataManager();
		$signUP=$dataManager->signUPMessage($m,$pwd);
		return $response;
		}
		else
		{

			return $response;
		}
		
				
	}
	else
	{

		$dataPortion='{"first_name":"'.$first_name.'","last_name":"'.$last_name.'","e":"'.$e.'","m":"'.$m.'","ub":"'.$ub.'","pwd":"'.md5($pwd).'","did":"'.$did.'"}';
		$data=urlencode($dataPortion);
		$url="http://192.168.20.102:9001/omni_services/profileDetails.php?data=".$data;
		$response=$this->getCurlCall($url);
		return $response;

	}
	

}


public function login($pwd,$login,$did)
{

	$url="http://192.168.20.102:9001/omni_services/profileDetails.php?pwd=".$pwd."&login=".$login."&did=".$did."";

	$response=$this->getCurlCall($url);
	return $response;

}

public function forgotPassword($pwd,$login,$did)
{
	$url="http://192.168.20.102:9001/omni_services/Forgot_Password.php?login=".$login."&pwd=".$pwd."&did=".$did."";

	$response=$this->getCurlCall($url);
	return $response;
}
public function isBlackListed($num,$source)
{
	$url="http://192.168.20.109/restaurantapis/user/isBlackListed?num=".$num."&source=".$source."";
	$response=$this->getCurlCall($url);
	return $response;

}

public function smsEmailRestaurant($ref_num,$vertical)
{
	$url="http://192.168.20.109/restaurantapis/messaging/insert_restaurant/".$ref_num."?vertical=".$vertical."";
	$response=$this->getCurlCall($url);
	return $response;

}

public function smsEmailCustomer($ref_num,$vertical)
{
	$url="http://192.168.20.109/restaurantapis/messaging/insert_customer/".$ref_num."?vertical=".$vertical."";
	$response=$this->getCurlCall($url);
	return $response;

}

public function rsvnDoctorBooking($docid,$date,$caller_name,$caller_email,$lastname,$birthdate,$caller_gender,$reason_visit,$nature_visit,$caller_age,$reference_number,$num_booking,$time,$name,$mobile,$email,$type_flag,$action_flag,$src)
{
	$url=RESERVATION_URL."/rsvnBooking.php?docid=".$docid."&type_flag=".$type_flag."&caller_name=".$caller_name."&caller_mobile=".$caller_mobile."&caller_email=".$caller_email."&mobile=".$mobile."&name=".$name."&lastname=".$lastname."&email=".$email."&date=".$date."&time=".$time."&num_booking=".$num_booking."&action_flag=".$action_flag."&birthdate=".$birthdate."&caller_gender=".$caller_gender."&reason_visit=".$reason_visit."&nature_visit=".$nature_visit."&caller_age=".$caller_age."&src=".$src."&reference_number=".$reference_number."";
	$response=$this->curl_download($url);
	return $response;
}

public function isBadWord($badWord)
{

	$dataManager=new dataManager();
	$response=$dataManager->isBadWord($badWord);
	return $response;

}

public function getEventList($docid)
{

	if($docid=="022PXX22.XX22.110910181947.P1L8")
	{

		$myArray = array(array("eventId"=>"1","eventName"=>"BirthDay Party"),array("eventId"=>"2","eventName"=>"Wedding Party"),array("eventId"=>"3","eventName"=>"Marriage Anniversary"));
		return json_encode(array("eventList"=>$myArray));

	}
	else
	{

		return json_encode(array(STATUS=>"1",MSG=>"wrong docid entered"));
	}
}

public function checkProfile($mobile,$did)
{
$dataManager=new dataManager();
$response=$dataManager->checkProfile($mobile,$did);
return $response;
}


public function rsvnDetail($reference_number)
{

	$url=RESERVATION_URL."/rsvnDetails.php?reference_number=".$reference_number;
	$response=$this->getCurlCall($url);
	return $response;
}


public function curl_download($Url){
 
    // is cURL installed yet?
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
 
    // OK cool - then let's create a new cURL resource handle
    $ch = curl_init();
 
    // Now set some options (most are optional)
 
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $Url);
 
    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 
    // Download the given URL, and return output
    $output = curl_exec($ch);
 
    // Close the cURL resource, and free system resources
    curl_close($ch);
 
    return $output;

}

public function eventEnquiry($national_catid,$service_id,$docid,$full_name,$mobile,$email,$request_date,$request_time,$remarks,$sku,$source_flag,$template_type,$eventName,$eventSize){
         		$getCompanyInfo=$this->companyDetails($docid);
        		$companName=$getCompanyInfo[$docid]['companyName'];
        		$companyEmailId=$getCompanyInfo[$docid]['emailDisplay'];
        		$companyMobileNumber=explode(",",$getCompanyInfo[$docid]['mobileDisplay']);
        		//$companyNewNumber=  preg_replace("/[^0-9]/", "", $companyMobileNumber[0]);
        		$companyNewNumber=$companyMobileNumber[0];
        		$vendorMobileNumber = substr($companyNewNumber, strpos($companyNewNumber, "-") + 1);    

        		if(empty($request_time))
        		{

        			$request_time_new="";

        		}
        		else
        		{
        			$request_time_new=$request_time;
        		}
        		if(empty($request_date))
        		{
        			$request_date_new="";
        		}
        		else
        		{
        			$request_date_new=$request_date;
        		}
        		$servertext=$usertext='';
        		if(empty($mobile))
        		{
        			$mobiles='';
        		}
        		else
        		{
        			$mobiles=$mobile.',';
        		}
        		if(!empty($email)){
        			if(empty($request_time) && empty($request_date))
        			{
        				
        				$servertext='<table cellspacing="0" cellpadding="0" border="0" width="600" style="border:1px solid #E4E4E4;" align="center"><tbody>
        				<tr><td style="padding:10px 8px 10px 8px; background:#fff; -webkit-text-size-adjust:none;"><a href="http://www.justdial.com"><img src="http://images.jdmagicbox.com/icontent/jdlogotm.gif"></a></td></tr>
        				<tr><td style="padding:10px 8px 10px 8px; Open Sans, Helvetica, Arial; font-size:18px; padding:5px 0 5px 0"></a></td></tr>
        				<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:10px 0px 10px 7px; font-family:Verdana;">Dear <b>'.$companName.',</b></td></tr>
        				<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">You have received a new enquiry. Please see details below:</td></tr>        
        				<tr><td colspan="6" style="padding:0px 0;">
        					<table cellspacing="0" cellpadding="0" border="0" width="100%" class="total">
        						<tbody>
        							<tr><td width="66%" style="padding:10px 0px 10px 10px;font-size:12px; font-family:Verdana;color:#424242;"><b>Customer Info</b></td></tr>
        							<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$full_name.','.$mobiles.''.$email.'</td></tr>
        							<tr><td width="66%" style="padding:10px 0px 10px 10px;font-size:12px; font-family:Verdana;color:#424242;"><b>Message</b></td></tr>
        							<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$remarks.'</td></tr>
        							<tr><td width="66%" style="padding:10px 0px 0px 8px;font-size:12px; font-family:Verdana;color:#424242;">Regards,</td></tr>
        							<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">Team Justdial</td></tr>					
        						</tbody></table>
        					</td>
        				</tr>
        			</tbody></table>';
        		}
        		else
        		{
        			$servertext='<table cellspacing="0" cellpadding="0" border="0" width="600" style="border:1px solid #E4E4E4;" align="center"><tbody>
        			<tr><td style="padding:10px 8px 10px 8px; background:#fff; -webkit-text-size-adjust:none;"><a href="http://www.justdial.com"><img src="http://images.jdmagicbox.com/icontent/jdlogotm.gif"></a></td></tr>
        			<tr><td style="padding:10px 8px 10px 8px; Open Sans, Helvetica, Arial; font-size:18px; padding:5px 0 5px 0"></a></td></tr>
        			<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:10px 0px 10px 7px; font-family:Verdana;">Dear <b>'.$companName.',</b></td></tr>
        			<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">You have received a new enquiry. Please see details below:</td></tr>        
        			<tr><td colspan="6" style="padding:0px 0;">
        				<table cellspacing="0" cellpadding="0" border="0" width="100%" class="total">
        					<tbody>
        						<tr><td width="66%" style="padding:10px 0px 10px 10px;font-size:12px; font-family:Verdana;color:#424242;"><b>Customer Info</b></td></tr>
        						<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$full_name.', '.$mobiles.' '.$email.'</td></tr>
        						
        						<tr><td width="66%" style="padding:10px 0px 10px 10px;font-size:12px; font-family:Verdana;color:#424242;"><b>Message</b></td></tr>
        						<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$remarks.'</td></tr>
        						<tr><td width="66%" style="padding:10px 0px 0px 8px;font-size:12px; font-family:Verdana;color:#424242;">Regards,</td></tr>
        						<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">Team Justdial</td></tr>					
        					</tbody></table>
        				</td>
        			</tr>
        		</tbody></table>';
        	}
        	$usertext='<table cellspacing="0" cellpadding="0" border="0" width="600" style="border:1px solid #E4E4E4;" align="center"><tbody>
        	<tr><td style="padding:10px 8px 10px 8px; Open Sans, Helvetica, Arial; font-size:18px; padding:5px 0 5px 0"></a></td></tr>
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:10px 0px 10px 7px; font-family:Verdana;">Dear <b>'.$full_name.',</b></td></tr>
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">Thanks for messaging us!</td></tr> 
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">We will get in touch with you shortly.</td></tr> 
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">You can also directly contact us on '.$companyNewNumber.'</td></tr>
        	<tr><td width="66%" style="padding:10px 0px 0px 8px;font-size:12px; font-family:Verdana;color:#424242;">Regards,</td></tr>
        	<tr><td style="width:580; color:#424242; font-size:12px; margin:0px 0px 0px 0px; padding:0px 0px 2px 7px; font-family:Verdana;">'.$companName.'</td></tr>      
        </tbody></table>';
    }

    if(empty($request_time) && empty($request_date))
    {
    	$smstext='Dear '.$companName.','.
    	'You have received a new enquiry.
    	Customer Info: '.$full_name.', '.$mobile.', '.$email.' 
    	Message:'.$remarks.'
    	Regards,
    	Team Justdial';
    }
    else
    {
    	$smstext='Dear '.$companName.',
    	'.'You have received a new enquiry.
    	Customer Info: '.$full_name.', '.$mobile.', '.$email.' 
    	Booking Info: '.$request_date.', '.$request_time.'
    	Message: '.$remarks.'
    	Regards,
    	Team Justdial';
    }
    $smstext_user = 'Dear '.$full_name.',
    Thanks for messaging us! We will get in touch with you shortly.
    You can also directly contact us on'.$companyNewNumber.'
    Regards,'.
    $companName;
    $mobile_enq='9844333465';//9844333465
    $smstext = preg_replace('/\s+/', ' ',$smstext);
    $smstext_user = preg_replace('/\s+/', ' ',$smstext_user);
    $dataManager=new dataManager();
    $res_getnames=$dataManager->eventEnquiry($national_catid,$service_id,$docid,$full_name,$mobile,$email,$request_date_new,$request_time_new,$remarks,$servertext,$usertext,$smstext,$smstext_user,$mobile_enq,$companyEmailId,$sku,$source_flag,$template_type,$eventName,$eventSize);
    if($res_getnames)
    {
    	return array(STATUS_CODE=>'1',MSG=>'data inserted successfully');
    	
    }
    else
    {
    	return array(STATUS_CODE=>'0',MSG=>'insert fail');
    }

}
public function vendorGallery($docid,$image_url,$image_flag)
{

    $dataManager=new dataManager();
    $response=$dataManager->vendorGallery($docid,$image_url,$image_flag);
    
  if($response)
    {
    	return array(STATUS_CODE=>'1',MSG=>'data inserted successfully');
    	
    }
    else
    {
    	return array(STATUS_CODE=>'0',MSG=>'insert fail');
    }



}

}
?>
