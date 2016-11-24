<?php
define('CURSCRIPT','payrecord');
require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once MYMPS_DATA."/moneytype.inc.php";

$part = $part ? $part : 'list';

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

if($admin_cityid) write_msg('��û��Ȩ�޷��ʸ�ҳ��');

if(!submit_check(CURSCRIPT.'_submit')) {
	chk_admin_purview("purview_��Ա֧����¼");
	$here     = '����֧����¼';
	$where    = " WHERE 1";
	
	$rstarttime = $starttime ? strtotime($starttime) : 0;
	$rendtime = $endtime ? strtotime($endtime) : 0;
	$status = $status ? intval($status) : 1;
	
	$where .= $rstarttime ? " AND posttime >= '$rstarttime'" : "" ; 
	$where .= $rendtime ? " AND posttime <= '$rendtime'" : "" ; 
	
	if(!empty($keywords)){
		switch($action){
			case 1:
			$where .= " AND orderid LIKE '%".$keywords."%'";
			break;
			case 2:
			$where .= " AND userid LIKE '%".$keywords."%'";
			break;
			case 3:
			$where .= " AND payip LIKE '%".$keywords."%'";
			break;
			case 4:
			$where .= " AND paybz LIKE '%".$keywords."%'";
			break;
		}
	}
	
	if($status == 2){
		$where .= " AND ifadd = 1 AND (paybz = '֧�����' OR paybz = '֧���ɹ�')";
	} elseif($status == 3){
		$where .= " AND ifadd = 0 AND paybz = '�ȴ�֧��'";
	}
	
	$sql	  = "SELECT * FROM `{$db_mymps}payrecord` $where ORDER BY posttime DESC";
	$rows_num = mymps_count('payrecord',$where);
	$param	  = setParam(array('starttime','endtime','keywords','action','status'));
	$list	  = page1($sql);
	$starttime  =  $starttime ? date('Y-m-d',$starttime) : '';
	$endtime 	=  $endtime   ? date('Y-m-d',$endtime)	 : '';
	$fee = $db ->getOne("SELECT COUNT(money) FROM `{$db_mymps}payrecord` $where");
	include(mymps_tpl(CURSCRIPT));
} else {
	if(is_array($delids)){
		$i=1;
		foreach ($delids as $kids => $vids){
			mymps_delete(CURSCRIPT,"WHERE id = ".$vids);
		}
	}
	write_msg('��Ա��ֵ��¼���³ɹ���',$url,'MympsRecord');
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
?>