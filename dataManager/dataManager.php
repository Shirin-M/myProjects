<?php
class dataManager extends dbConfig
{
	protected $detObj;
	protected $jdLogin;
	protected $jst;

	public function __construct()
	{

	}

	public function getCatIds($docid)
	{
		$this->detObj = new DB($this->selectDB('db-catalog_r'));
		$getData=$this->detObj->select('SELECT catalogue_id,catalogue_name  from tbl_catalogue_main where docid=? and delete_flag = 0 and approved IN (1,2) order by catalogue_name, catalogue_id', array($docid), array('%s'));
		return $getData;
	}

	public function getImageData($docid,$catlist)
	{         $this->detObj=new DB($this->selectDB('db-catalog_r'));
	return $this->detObj->select('SELECT catalogue_id,docid,product_url,product_thumb_url,product_name,product_description,product_label,product_id,product_position from tbl_catalogue_details where docid=? and catalogue_id in (?)  and delete_flag = 0 and approved IN (1,2) and display_flag = 1 order by display_order, product_name, product_id', array($docid,$catlist), array('%s','%s'));
}


public function getBizInfo($docid)
{

	$this->jdLogin =new DB($this->selectDB('jd-login'));
	return $this->jdLogin->select('SELECT content_final from content_management_india where contractid=?',array($docid),array('%s'));
}



}
?>
