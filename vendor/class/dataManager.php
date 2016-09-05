<?php
//require("./config/dbConfig.php");
include_once("config/dbConfig.php");
include_once("database.php");
$GLOBALS['db'] = new database($config['Database']);

class dataManager 
{
public function firstData()
{
$msg="test";
return $msg;
}
public function getHomePageData()
{

$table = 'accesslog_2022016';
$condition = array();
//$condition=array();
$rs = $GLOBALS['db']->get_all($table, $condition);
return $rs;
}

}
?>