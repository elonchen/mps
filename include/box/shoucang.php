<?php
!defined('IN_MYMPS') && exit('FORBIDDEN');
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";
require_once MYMPS_INC."/cache.fun.php";
require_once MYMPS_INC."/member.class.php";
$infoid = $_REQUEST['infoid'] ? intval($_REQUEST['infoid']) : '';
!$infoid && write_msg('�ղص���Ϣ����ID����Ϊ��!','olmsg');
$log = $member_log -> chk_in();

switch($log){
	case true:
	
	$msg = '<br>';
	if($db->getOne("SELECT COUNT(id) FROM `{$db_mymps}shoucang` WHERE infoid = '$infoid' AND userid = '$s_uid'") > 0){
		$msg .= '<style>div{line-height:28px; font-size:12px; text-align:left; float:left; margin-bottom:30px; color:#585858;} span{margin-left:25px; margin-right:15px; display:block; float:left; height:64px; width:64px; background:url('.$mymps_global[SiteUrl].'/template/default/images/post/info_icons.png) 0 -128px no-repeat; margin-bottom:30px;}</style><span></span><div>���ã����Ѿ��ղع�����Ϣ�������ظ��ղ�Ŷ��<br />�鿴 <a href=\''.$mymps_global[SiteUrl].'/member/index.php?m=shoucang\' target=_blank style=\'font-size:14px;\'>�ҵ��ղ�>></a></div>';
	} else {
		$r		= $db -> getRow("SELECT a.title,b.dir_typename,a.cityid FROM `{$db_mymps}information` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.catid = b.catid WHERE a.id = '$infoid'");
		$url	= Rewrite('info',array('id'=>$infoid,'dir_typename'=>$r['dir_typename'],'cityid'=>$r['cityid']));
		//$url	= str_replace($mymps_global['SiteUrl'],'',$url);
		if(!$s_uid) exit('��Ч�ĵ�¼�û��������µ�¼��');
		$db->query("INSERT INTO `{$db_mymps}shoucang` (infoid,title,url,userid,intime)VALUES('$infoid','$r[title]','$url','$s_uid','$timestamp')");
		$msg .= '<style>div{line-height:28px; font-size:12px; text-align:left; float:left; margin-bottom:30px; color:#585858;} span{margin-left:25px; margin-right:15px; display:block; float:left; height:64px; width:64px; background:url('.$mymps_global[SiteUrl].'/template/default/images/post/info_icons.png) 0 0 no-repeat; margin-bottom:30px;}</style><span></span><div>��ϲ���ѳɹ��ղص��û����ġ��ҵ��ղؼ��У�<br />�鿴 <a href=\''.$mymps_global[SiteUrl].'/member/index.php?m=shoucang\' target=_blank style=\'font-size:14px;\'>�ҵ��ղ�>></a>';
	}
	echo $msg;
	$msg = $r = NULL;
	
	break;
	
	default:
	
		@include MYMPS_DATA.'/caches/authcodesettings.php';
		$authcodesettings = $data;
		$gourl = 'shoucang';
		include MYMPS_ROOT.'/template/box/login.html';
		$data = $authcodesettings = NULL;
	
	break;
}

?>