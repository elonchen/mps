<?php
if($action == 'sendmail'){
	
	$email = isset($email) ? mhtmlspecialchars($email): '';
	if($authcodesettings['forgetpass'] == 1 && !$randcode = mymps_chk_randcode($checkcode)){write_msg('��֤����������뷵����������');}
	empty($email)  && write_msg("����д���������ַ��");
	//if(mgetcookie('emailsended'.$email) == 1){write_msg("��Ϣһ���ٷ����ʼ�");}
	$user_info = $db ->getRow("SELECT * FROM `{$db_mymps}member` WHERE email = '$email'");
	if ($user_info['userid']){
		require MYMPS_INC.'/email.fun.php';
		$code = base64_encode($user_info['id'].".".md5($user_info['id'].'+'.$user_info['userpwd']).'.'.$timestamp);
		
		globalassign();
		if (send_pwd_email($user_info['id'], $user_info['userid'], $email, $code)){
			//msetcookie("emailsended".$userinfo['email'],1);
			$status = 'error2';
			include mymps_tpl($mod.'_2');
		}else{
			$status = 'error2';
			$msg = '�����ʼ�ʧ�ܣ�����ϵ�ͷ���'.$mymps_global["SiteTel"].'�������룡';
			include mymps_tpl($mod.'_4');
		}
	
	}else{
	
		$status = 'error2';
		$msg = '�õ���������û��������ڣ�����ϵ�ͷ���'.$mymps_global["SiteTel"].'��';
		globalassign();
		include mymps_tpl($mod.'_4');
	
	}
	
} elseif($action == 'resetpwd'){
	$uid = $uid ? intval($uid) : '';
	$userid = $userid ? mhtmlspecialchars($userid) : '';
	$userpwd = $userpwd ? mhtmlspecialchars($userpwd) : '';
	$email = $email ? mhtmlspecialchars($email) : '';
	if(empty($userpwd)) write_msg('��������������룡');
	if(PASSPORT_TYPE == 'phpwind'){
		//pw����
		require MYMPS_ROOT.'/pw_client/uc_client.php';
		$pw_user = uc_user_get($userid);
		$result = uc_user_edit($pw_user['uid'], $pw_user['username'], '', md5($userpwd), '');
	} elseif(PASSPORT_TYPE == 'ucenter') {
		//UC����
		require MYMPS_ROOT.'/uc_client/client.php';
		$result =  uc_user_edit($userid, $userpwd, $userpwd, $email, 1);
	}
	
	if (!empty($userpwd)){
		$db->query("UPDATE `{$db_mymps}member` SET userpwd='".md5($userpwd)."' WHERE id = '$uid'");
		$status = 'success';
	} else {
		$status = 'error';
		$msg = 'δ������������޸�ʧ�ܣ�';
	}
	
	globalassign();
	include mymps_tpl($mod.'_4');
}
?>