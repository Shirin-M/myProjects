<?php
//include("dataManager.php");
class model  
{
public function test()
{
    $commonManager=New dataManager();
	$message=$commonManager->firstData();
	return $message;
}
public function getHomePageData()
{
//	$getResponse=array();

	$commonManager=new dataManager();
	$getData=$commonManager->getHomePageData();
	$count=count($getData);
	foreach ($getData as  $value) {
    	$getResponse["id"]=$value['fldId'];
		$getResponse["linkLocation"]=$value['fldLinkLocation'];
		$getResponse["linkIdentifier"]=$value['fldLinkIdentifier'];
		$getResponse["count"]=$value['fldCount'];
		$sendResponse[] = $getResponse;

	}
	return $sendResponse;
	
}
public function welcome()
{
	$commonManager=new dataManager();
	$getData="msg";
	return $getData;
}
}
?>