<?php
class dbConfig
{
//$db=array();
	public function selectDB($db)
	{
		switch ($db) {
			case  'jd-login' :
			return array("192.168.00.00", 'username', 'password', 'dbname'); 
			break;
			case 'db-catalog_r':
			return array('192.168.00.00', 'username', 'password', 'dbname');
			break;
			default:
			return array();
			break;
		}

	}

}
?>