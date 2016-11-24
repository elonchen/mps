<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function strend( $str, $sign )
{
	$str = trim( $str );
	$len = strlen( $str );
	$signend = substr( $str, -1, 1 );
	if ( $signend == $sign )
	{
		return substr( $str, 0, $len - 1 );
	}
	return $str;
}

define( "CURSCRIPT", "config" );
@set_time_limit( 0 );
$part = isset( $part ) ? trim( $part ) : "list";
require_once( dirname( __FILE__ )."/global.php" );
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
if ( $part != "phpinfo" )
{
	require_once( MYMPS_INC."/db.class.php" );
	chk_admin_purview( "purview_ϵͳ����" );
}
if ( $part == "phpinfo" )
{
	$here = "ϵͳ����";
	@phpinfo( );
}
else if ( $part == "list" )
{
	chk_admin_purview( "purview_ϵͳ����" );
	require_once( dirname( __FILE__ )."/include/config.inc.php" );
	$here = "Mymps ϵͳ��������";
	$res = $db->query( "SELECT description,value FROM ".$db_mymps."config WHERE type = 'config'" );
	while ( $row = $db->fetchrow( $res ) )
	{
		$config_global[$row['description']] = $row['value'];
	}
	include( mymps_tpl( "mymps_config" ) );
}
else if ( $part == "update" )
{
	require_once( dirname( __FILE__ )."/include/config.inc.php" );
	mymps_delete( "config", "WHERE type = 'config' AND description != 'cfg_tpl_dir' AND description != 'screen_index' AND description != 'screen_cat' AND description != 'screen_info' AND description != 'bodybg' AND description != 'screen_search' AND description != 'head_style' AND description != 'cfg_citiesdir' AND description != 'cfg_redirectpage' AND description != 'cfg_independency' AND description != 'cfg_cityshowtype'" );
	foreach ( $admin_global as $k => $a )
	{
		$_POST[$k] = str_replace( "'", " ", $_POST[$k] );
		$info_k = mhtmlspecialchars( trim( $_POST[$k] ) );
		$info_k = str_replace( "��", ",", $info_k );
		$db->query( "INSERT INTO `".$db_mymps."config` (value,description) VALUES ('{$info_k}','{$k}')" );
	}
	update_config_cache( );
	unset( $admin_global );
	write_msg( "ϵͳ�������óɹ���", CURSCRIPT.".php", "record" );
}
else if ( $part == "badwords" )
{
	chk_admin_purview( "purview_��֤���˵���" );
	if ( trim( $action ) == "dopost" )
	{
		$cfg_badwords0 = str_replace( "��", ",", trim( $cfg_badwords0 ) );
		$cfg_badwords0 = strend( $cfg_badwords0, "," );
		$cfg_badwords1 = str_replace( "��", ",", trim( $cfg_badwords1 ) );
		$cfg_badwords2 = intval( $cfg_badwords2 );
		mymps_delete( "badwords" );
		$db->query( "INSERT INTO `".$db_mymps."badwords` (words,view,ifcheck) VALUES ('".$cfg_badwords0."','".$cfg_badwords1."','".$cfg_badwords2."')" );
		clear_cache_files( "badwords" );
		write_msg( "����������óɹ���", "config.php?part=badwords", "write_record" );
	}
	else
	{
		$here = "Υ�������������";
		$res = $db->query( "SELECT words,view,ifcheck FROM ".$db_mymps."badwords" );
		while ( $row = $db->fetchrow( $res ) )
		{
			$filter['words'] = $row['words'];
			$filter['view'] = $row['view'];
			$filter['ifcheck'] = $row['ifcheck'];
		}
		include( mymps_tpl( $part ) );
	}
}
else if ( $part == "commentsettings" )
{
	if ( $action == "do_post" )
	{
		$db->query( "DELETE FROM `".$db_mymps."config` WHERE description = 'comment' AND type = 'comment'" );
		$db->query( "INSERT INTO `".$db_mymps."config` (description,value,type) values ('comment','".serialize( $comment )."','comment')" );
		clear_cache_files( "commentsettings" );
		write_msg( "�������۵������ø��³ɹ���", "config.php?part=commentsettings", "WriteRecord" );
	}
	else
	{
		$here = "�������۵�������";
		$comment = $db->getone( "SELECT value FROM `".$db_mymps."config` WHERE type='comment' AND description = 'comment'" );
		$comment = $comment ? $charset == "utf-8" ? utf8_unserialize( $comment ) : unserialize( $comment ) : array( );
		include( mymps_tpl( $part ) );
	}
}
else if ( $part == "cache_sys" )
{
	chk_admin_purview( "purview_��������" );
	$here = "���ݻ���";
	$cachearray = array( "write_admin_cache" => "���¹���Ա����", "updateadvertisement" => "���¹�滺��", "write_cron_cache" => "���¶�ʱ���񻺴�", "write_checkanswer_cache" => "������֤�ʴ𻺴�", "update_checkanswer_settings" => "������֤�ʴ����û���", "update_jswizard_settings" => "�������ݵ������û���", "write_jswizard_cache" => "�������ݵ�����Ŀ����", "write_authcode_cache" => "������֤�����û���", "write_plugin_cache" => "���²������", "write_insidelink_cache" => "����վ���������ӻ���", "write_qqlogin_cache" => "����QQ��¼�ӿ����û���" );
	include( mymps_tpl( "cache_sys" ) );
}
else if ( $part == "cache_update" )
{
	if ( is_array( $updatecache ) )
	{
		foreach ( $updatecache as $k => $v )
		{
			if ( $v == "tpl_caches" )
			{
				$k1 = clear_tpl_files( 5, $ext );
				$k2 = clear_tpl_files( 4, $ext );
				$k3 = clear_tpl_files( 2, $ext );
				$msg .= "�ɹ������ҳ�����ļ�".( $k1 + $k2 + $k3 )."��";
			}
			else if ( $v == "tpl_compiles" )
			{
				$msg .= "<br />�ɹ����ģ������ļ�".clear_tpl_files( 3, $ext )."��";
			}
		}
	}
	write_msg( $msg, $return_url ? $return_url : "?part=cache" );
}
else if ( $part == "cache_sysupdate" )
{
	@set_time_limit( 0 );
	if ( is_array( $updatecache ) )
	{
		$count = clear_cache_files( );
	}

	foreach ( $updatecache as $k => $v )
	{
		switch ( $v )
		{
			case "write_admin_cache" :
			write_admin_cache();
			break;
			case "updateadvertisement" :
			updateadvertisement();
			break;
			case "write_cron_cache" :
			write_cron_cache();
			break;
			case "write_checkanswer_cache" :
			write_checkanswer_cache();
			break;
			case "update_checkanswer_settings" :
			update_checkanswer_settings();
			break;
			case "update_jswizard_settings" :
			update_jswizard_settings();
			break;
			case "write_jswizard_cache" :
			write_jswizard_cache();
			break;
			case "write_authcode_cache" :
			write_authcode_cache();
			break;
			case "write_plugin_cache" :
			write_plugin_cache();
			break;
			case "write_insidelink_cache" :
			write_insidelink_cache();
			break;
			case "write_qqlogin_cache" :
			write_qqlogin_cache();
			break;
		}
	}
	$updatecache = NULL;
	write_msg( "ϵͳ������³ɹ�������������ļ�".$count."��", $return_url ? $return_url : "?part=cache_sys" );
}                                                                                                            
else if ( $part == "cache" )
{
	require_once( dirname( __FILE__ )."/include/cache.inc.php" );
	chk_admin_purview( "purview_��������" );
	$cache = get_cache_config( );
	$here = "ҳ�滺��";
	include( mymps_tpl( "cache" ) );
}
else if ( $part == "cacheupdate" )
{
	mymps_delete( "cache" );
	clear_cache_files( "cache" );
	require_once( dirname( __FILE__ )."/include/cache.inc.php" );
	foreach ( $admin_cache as $q => $w )
	{
		foreach ( $w as $k => $a )
		{
			$cpage = $k;
			$ctime = intval( $_POST[$k."_time"] );
			$copen = intval( $_POST[$k."_open"] );
			$db->query( "INSERT INTO `".$db_mymps."cache` (page,time,open) VALUES ('{$cpage}','{$ctime}','{$copen}')" );
		}
	}
	write_msg( "ϵͳ�������óɹ���", "config.php?part=cache", "record" );
}
else if ( $part == "imgcode" )
{
	chk_admin_purview( "purview_��֤���˵���" );
	if ( trim( $action ) == "do_post" )
	{
		$db->query( "DELETE FROM `".$db_mymps."config` WHERE type = 'authcode'" );
		if ( is_array( $settingsnew['open'] ) )
		{
			foreach ( $settingsnew['open'] as $key => $val )
			{
				$db->query( "INSERT INTO `".$db_mymps."config` (description,value,type) values ('{$key}','{$val}','authcode')" );
			}
		}
		$settingsnew['type'] = $settingsnew['type'] != "" ? $settingsnew['type'] : "engber";
		$db->query( "INSERT INTO `".$db_mymps."config` (description,value,type) values ('type','{$settingsnew['type']}','authcode')" );
		foreach ( array( "noise", "line", "snow", "distort", "incline", "close", "number" ) as $key )
		{
			$db->query( "INSERT INTO `".$db_mymps."config` (description,value,type) values ('{$key}','{$settingsnew[$key]}','authcode')" );
		}
		write_authcode_cache( );
		write_msg( "��֤�����ø��³ɹ���", "?part=imgcode", "write_record" );
	}
	else
	{
		$here = "��֤����ʾ����";
		$query = $db->query( "SELECT * FROM `".$db_mymps."config` WHERE type = 'authcode'" );
		while ( $row = $db->fetchrow( $query ) )
		{
			$res[$row['description']] = $row['value'];
		}
		include( mymps_tpl( "mymps_".$part ) );
	}
}
else if ( $part == "checkask" )
{
	chk_admin_purview( "purview_��֤���˵���" );
	if ( trim( $action ) == "do_post" )
	{
		mymps_delete( "config", "WHERE type = 'checkanswe'" );
		$db->query( "INSERT INTO `".$db_mymps."config` (description,value,type)VALUES('whenregister','{$whenregister}','checkanswe')" );
		$db->query( "INSERT INTO `".$db_mymps."config` (description,value,type)VALUES('whenpost','{$whenpost}','checkanswe')" );
		if ( is_array( $question ) )
		{
			foreach ( $question as $key => $q )
			{
				$q = trim( $q );
				$a = cutstr( mhtmlspecialchars( trim( $answer[$key] ) ), 50 );
				if ( !$q || !$a )
				{
					$db->query( "UPDATE `".$db_mymps."checkanswer` SET question='{$q}', answer='{$a}' WHERE id='{$key}'" );
				}
			}
		}
		if ( is_array( $newquestion ) && is_array( $newanswer ) )
		{
			foreach ( $newquestion as $key => $q )
			{
				$q = trim( $q );
				$a = cutstr( mhtmlspecialchars( trim( $newanswer[$key] ) ), 50 );
				if ( !$q || !$a )
				{
					$db->query( "INSERT INTO\t`".$db_mymps."checkanswer` (question, answer) VALUES ('{$q}', '{$a}')" );
				}
			}
		}
		if ( is_array( $delete ) )
		{
			$db->query( "DELETE FROM `".$db_mymps."checkanswer` WHERE ".create_in( $delete, "id" ) );
		}
		write_checkanswer_cache( );
		update_checkanswer_settings( );
		write_msg( "��֤�ʴ����ø��³ɹ���", "?part=checkask", "write_record" );
	}
	else
	{
		$here = "��֤�ʴ�����";
		$c = $db->getall( "SELECT * FROM `".$db_mymps."checkanswer` ORDER BY id DESC" );
		$res = $db->query( "SELECT description,value FROM ".$db_mymps."config WHERE type = 'checkanswe'" );
		while ( $row = $db->fetchrow( $res ) )
		{
			$when[$row['description']] = $row['value'];
		}
		include( mymps_tpl( "mymps_".$part ) );
	}
}
else
{
	unknown_err_msg( );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
