<?php
if(!defined('IN_MYMPS')) exit('Forbidden');

$userid	 	= mhtmlspecialchars($userid);
$userpwd 	= trim($userpwd);
$loginip 	= GetIP();
$logintime  = $timestamp ? $timestamp : time();
$memory 	= isset($memory) ? trim($memory) : '';
$url 		= trim($url);

if($authcodesettings['login'] == 1 && !$randcode = mymps_chk_randcode($checkcode)){
	write_msg('��֤����������뷵����������');
}

($userid == '' || $userpwd == '') && write_msg("�û��ʺŻ����벻��Ϊ��");

$row  = $db -> getRow("SELECT userid,status FROM `{$db_mymps}member` WHERE (userid='$userid' OR email = '$userid' OR tel = '$userid' OR mobile = '$userid') AND userpwd='".md5($userpwd)."'");
$s_uid = $row['userid'];

$userid = $userid ? $userid : $s_uid;

if(PASSPORT_TYPE == 'phpwind'){
	//pw����
	require MYMPS_ROOT.'/pw_client/uc_client.php';
	$user_login = uc_user_login($userid,md5($userpwd),0);
	if($user_login['status'] == '-2'){
		write_msg('������ĵ�¼�������!');
	} elseif($user_login['status'] == '-1') {
		write_msg('������ĵ�¼�ʺŲ�����!');
	} elseif($user_login['status'] == '1' && !$i =$db -> getOne("SELECT COUNT(id) FROM `{$db_mymps}member` WHERE userid = '$userid'")){
		member_reg($userid,md5($userpwd),$userid.'@163.com');
	}

} elseif(PASSPORT_TYPE == 'ucenter') {
	//UC����
	require MYMPS_ROOT.'/uc_client/client.php';
	list($uid, $username, $password, $email) = uc_user_login($userid, $userpwd);
	
	if($uid > 0) {
	
		if(!$db->getOne("SELECT count(*) FROM {$db_mymps}member WHERE userid='$userid'")) {
			member_reg($userid,md5($userpwd));
		}else{
			$db->query("UPDATE `{$db_mymps}member` SET userpwd = '".md5($userpwd)."' WHERE userid = '$userid'");
		}
		$s_uid = $userid;
		
	} else {
	
		if($uid == -1) {
			write_msg( '�û�������,���߱�ɾ��');
		} elseif ($uid == -2) {
			write_msg( '�����������');
		} else {
			write_msg( 'δ�������');
		}
		exit;
	}
} 

//mymps��¼
if($s_uid){
	
	if(PASSPORT_TYPE == 'phpwind' && $user_login['synlogin']){
		echo $user_login['synlogin'];
	} elseif(PASSPORT_TYPE == 'ucenter'){
		echo uc_user_synlogin($uid);
	}
	
	if(empty($row['status'])){
		write_msg('�����˺� [<b>'.$s_uid.'</b>] Ŀǰ����<font color=red>����״̬</font>��<br>��������������֤�ʼ���ȴ��ͷ���Ա��ͨ�˺ţ�');
	} else {
		$member_log -> in($s_uid,md5($userpwd),$memory,'noredirect');	
		//var_dump($s_uid);die;
		//var_dump($member_log->chk_in());die;		
		echo mymps_goto($url ? $url : $mymps_global['SiteUrl'].'/member/index.php');
	}
	
}else{
	//$db->query("INSERT INTO `{$db_mymps}member_record_login` (id,userid,userpwd,pubdate,ip,result) VALUES ('','$userid','$userpwd','$logintime','$loginip','0')");
	write_msg("��¼ʧ�ܣ��������˴�����˺Ż����룡");
}
?>