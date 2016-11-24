<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function get_special_subject( $arr = "" )
{
	require_once( MYMPS_DATA."/info_special.inc.php" );
	foreach ( $specialarray as $key => $val )
	{
		$mymps .= "<label for=\"".$key."\">";
		$mymps .= "<input class=\"checkbox\" ";
		$mymps .= is_array( $arr ) ? in_array( $key, $arr ) ? "checked " : "" : "";
		$mymps .= "type=\"checkbox\" name=\"parameter[special][]\" value=\"".$key."\" id=\"".$key."\">".$val;
		$mymps .= "</label>";
		$mymps .= in_array( $key, array( 3, 6 ) ) ? "<hr style=\"height:1px; border:1px #C5D8E8 solid;\">" : "";
	}
	return $mymps;
}

function get_special_news( $arr = "" )
{
	$specialarray = array( );
	$specialarray[1] = "�Ƽ�����";
	$specialarray[2] = "ͼƬ����";
	foreach ( $specialarray as $key => $val )
	{
		$mymps .= "<label for=\"".$key."\">";
		$mymps .= "<input class=\"checkbox\" ";
		$mymps .= is_array( $arr ) ? in_array( $key, $arr ) ? "checked " : "" : "";
		$mymps .= "type=\"checkbox\" name=\"parameter[special][]\" value=\"".$key."\" id=\"".$key."\">".$val;
		$mymps .= "</label>";
	}
	return $mymps;
}

function get_special_store( $arr = "" )
{
	$specialarray = array( );
	$specialarray[1] = "�б��Ƽ��̼�";
	$specialarray[2] = "��ҳ�Ƽ��̼�";
	$specialarray[3] = "ִ����֤�̼�";
	foreach ( $specialarray as $key => $val )
	{
		$mymps .= "<label for=\"".$key."\">";
		$mymps .= "<input class=\"checkbox\" ";
		$mymps .= is_array( $arr ) ? in_array( $key, $arr ) ? "checked " : "" : "";
		$mymps .= "type=\"checkbox\" name=\"parameter[special][]\" value=\"".$key."\" id=\"".$key."\">".$val;
		$mymps .= "</label>";
	}
	return $mymps;
}

function get_special_goods( $arr = "" )
{
	$specialarray = array( );
	$specialarray[1] = "�Ƽ���Ʒ";
	$specialarray[2] = "������Ʒ";
	$specialarray[3] = "������Ʒ";
	$mymps = "<select name=\"parameter[special][]\" class=\"select\">";
	$mymps .= "<option value=\"\">��������</option>";
	foreach ( $specialarray as $key => $val )
	{
		$mymps .= "<option value=\"".$key."\"";
		$mymps .= is_array( $arr ) ? in_array( $key, $arr ) ? "checked " : "" : "";
		$mymps .= "  >".$val;
		$mymps .= "</option>";
	}
	$mymps .= "</select>";
	return $mymps;
}

define( "CURSCRIPT", "jswizard" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/customtype.inc.php" );
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
$part = $part ? trim( $part ) : "default";
$action = $action ? trim( $action ) : "";
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_���ݵ���" );
	switch ( $part )
	{
		case "settings" :
		$here = "���ݵ��� - ��������";
		$query = $db->query( "SELECT * FROM `".$db_mymps."config` WHERE type = 'jswizard'" );
		while ( $row = $db->fetchrow( $query ) )
		{
			$settings[$row['description']] = $row['value'];
		}
		include( mymps_tpl( CURSCRIPT."_".$part ) );
		break;
		case "add" :
		$here = "����".$customtypearr[$customtype]."������Ŀ";
		include( mymps_tpl( $customtype == "info" ? CURSCRIPT : CURSCRIPT."_".$customtype ) );
		break;
		case "detail" :
		if ( empty( $id ) )
		{
			write_msg( "�ܱ�Ǹ��û�и����ݵ�����Ŀ��" );
		}
		$paramete = $db->getrow( "SELECT * FROM `".$db_mymps."jswizard` WHERE id = '{$id}'" );
		$flag = $paramete['flag'];
		$parameter = array( );
		$parameter = $charset == "utf-8" ? utf8_unserialize( $paramete['parameter'] ) : unserialize( $paramete['parameter'] );
		$parameter['jstemplate'] = stripslashes( $parameter['jstemplate'] );
		$customtype = $paramete['customtype'];
		$here = $customtypearr[$customtype]."������Ŀ����";
		$customtype = !$customtype ? "info" : $customtype;
		include( mymps_tpl( $customtype == "info" ? CURSCRIPT : CURSCRIPT."_".$customtype ) );
		break;
		case "default" :
		$randam = $db->getone( "SELECT MAX(id) FROM ".$db_mymps."jswizard" ) + 1;
		$randam .= random( 3 );
		$here = "���ݵ���";
		$rows_num = mymps_count( "jswizard" );
		$param = setparam( array( "part" ) );
		$pagi = page1( "SELECT * FROM `".$db_mymps."jswizard` ORDER BY id DESC" );
		foreach ( $pagi as $key => $val )
		{
			$jswizard[$val['id']]['id'] = $val['id'];
			$jswizard[$val['id']]['customtype'] = $val['customtype'];
			$jswizard[$val['id']]['flag'] = $val['flag'];
			$jswizard[$val['id']]['edittime'] = $val['edittime'];
			$jswizard[$val['id']]['parameter'] = $charset == "utf-8" ? utf8_unserialize( $val['parameter'] ) : unserialize( $val['parameter'] );
			$jswizard[$val['id']]['jscharset'] = $jswizard[$val['id']]['parameter']['jscharset'];
		}
		include( mymps_tpl( CURSCRIPT."_".$part ) );
		break;
	}
}
else
{
	if ( is_array( $delids ) )
	{
		$db->query( "DELETE FROM `".$db_mymps."jswizard` WHERE ".create_in( $delids, "id" ) );
		$string = "ɾ�����ݵ�����Ŀ";
		write_jswizard_cache( );
		write_msg( "�ɹ�".$string."", $return_url ? $return_url : "?part=default", "write_record" );
		exit( );
	}
	if ( is_array( $settingsnew ) )
	{
		mymps_delete( "config", "WHERE type = 'jswizard'" );
		foreach ( $settingsnew as $key => $val )
		{
			$db->query( "INSERT INTO `".$db_mymps."config` (`description`,`value`,`type`)VALUES('".$key."','".$val."','jswizard')" );
		}
		update_jswizard_settings( );
		write_msg( "�ɹ�������Ϣ���û������ã�", $return_url, "write_record" );
	}
	if ( empty( $id ) )
	{
		if ( empty( $flag ) && !is_array( $parameter ) )
		{
			write_msg( "Ψһ��ʶ����Ϊ�գ�������ò���Ϊ�գ�" );
		}
		if ( empty( $parameter['jstemplate'] ) )
		{
			write_msg( "���ݵ���ģ�����ݲ���Ϊ�գ�" );
		}
		if ( 0 < $db->getone( "SELECT count(id) FROM `".$db_mymps."jswizard` WHERE flag = '{$flag}'" ) )
		{
			write_msg( "�ñ�ʶ�Ѿ����ڣ������һ��Ψһ��ʶ��" );
		}
		$parameter = addslashes( serialize( $parameter ) );
		$db->query( "INSERT INTO `".$db_mymps."jswizard` (`flag`,`customtype`,`parameter`,`edittime`)VALUES('{$flag}','{$customtype}','{$parameter}','{$timestamp}')" );
		$string = "������ݵ���";
		$return_url = "?part=detail&id=".$db->insert_id( );
	}
	else
	{
		if ( empty( $flag ) || !is_array( $parameter ) )
		{
			write_msg( "Ψһ��ʶ����Ϊ�գ�������ò���Ϊ�գ�" );
		}
		$parameter = addslashes( serialize( $parameter ) );
		$db->query( "UPDATE `".$db_mymps."jswizard` SET flag='{$flag}',parameter='{$parameter}',edittime = '{$timestamp}' WHERE id = '{$id}'" );
		$string = "�޸����ݵ���";
		$return_url = "?part=detail&id=".$id;
		clear_cache_files( "javascript_".$flag );
	}
	write_jswizard_cache( );
	write_msg( "�ɹ�".$string."", $return_url ? $return_url : "?part=default", "write_record" );
}
if ( is_object( $db ) )
{
	$db->close();
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
