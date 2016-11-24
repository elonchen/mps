<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "record" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
require_once( MYMPS_DATA."/config.inc.php" );
if ( !in_array( $do, array( "member", "admin" ) ) )
{
	$do = "admin";
}
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
if ( !in_array( $part, array( "login", "money", "action" ) ) )
{
    $part = "login";
}
if ( $result == "false" )
{
	$_result = 0;
}
else if ( $result == "true" )
{
	$_result = 1;
}
else
{
	$_result = "";
}
if ( $action == "delrecord" )
{
	$total_count = mymps_count( $do."_record_".$part );
	if ( $total_count < $mymps_mymps['cfg_record_save'] )
	{
		write_msg( "����ʧ�ܣ���ؼ�¼���� ".$mymps_mymps['cfg_record_save']." ����" );
	}
	$delrecord = $db->getall( "SELECT id FROM `".$db_mymps.$do."_record_".$part."` ORDER BY ID DESC LIMIT 1,".$mymps_mymps['cfg_record_save'] );
	foreach ( $delrecord as $k => $value )
	{
		$id .= $value[id].",";
	}
	$id = substr( $id, 0, -1 );
	mymps_delete( $do."_record_".$part, "WHERE id NOT IN (".$id.")" );
	write_msg( "�ɹ�ɾ��������¼��", $url, "MyMPS" );
	exit( );
}
if ( $action == "doexcel" )
{
	$data[] = array( "�û���", "IP", "�˿�", "����λ��", "�����", "����ϵͳ", "����ʱ��", "����ʱ��" );
	$query = $db->query( "SELECT * FROM `".$db_mymps."member_record_login` ORDER BY pubdate DESC" );
	while ( $row = $db->fetchrow( $query ) )
	{
		$data[$row['id']][] = $row['userid'];
		$data[$row['id']][] = $row['ip'];
		$data[$row['id']][] = $row['port'];
		$data[$row['id']][] = $row['ip2area'];
		$data[$row['id']][] = $row['browser'];
		$data[$row['id']][] = $row['os'];
		$data[$row['id']][] = gettime( $row['pubdate'] );
		$data[$row['id']][] = gettime( $row['outdate'] ? $row['outdate'] : $row['pubdate'] + 3627 );
	}
	require( MYMPS_INC."/php-excel.class.php" );
	$xls = new excel_xml( "gb2312", false, "MemberRecordSheet" );
	$xls->addarray( $data );
	$xls->generatexml( date( "Y-m-d-His", $timestamp ) );
	unset( $xls );
	exit( );
}
if ( $action == "savemonth" )
{
	$monthdate = strtotime( "-2 months" );
	$db->query( "DELETE FROM `".$db_mymps."member_record_login` WHERE pubdate < '{$monthdate}'" );
	write_msg( "�ѳɹ�ɾ��������ǰ�ĵ�¼��¼��", "record.php?do=member&part=login", "Mymps" );
	exit( );
}
switch ( $do )
{
	case "admin" :
	if ( $part == "login" )
	{
		chk_admin_purview( "purview_�����¼" );
		$here = "����Ա��̨�����½��¼";
		$where = "WHERE result like '%".$_result."%' AND (id like '%".$keywords."%' OR adminid like '%".$keywords."%' OR adminpwd like '%".$keywords."%' OR pubdate like '%".$keywords."%' OR ip like '%".$keywords."%')";
		$sql = "SELECT * FROM ".$db_mymps."admin_record_login {$where} ORDER BY id desc";
		$rows_num = $db->getone( "SELECT COUNT(*) FROM `".$db_mymps."admin_record_login` {$where}" );
		$param = setparam( array( "do", "part", "result", "keywords" ) );
		$record = array( );
		foreach ( page1( $sql ) as $k => $row )
		{
			$arr['id'] = $row['id'];
			$arr['adminid'] = $row['adminid'];
			$arr['adminpwd'] = $row['adminpwd'];
			$arr['pubdate'] = gettime( $row['pubdate'] );
			$arr['ip'] = $row['ip'];
			$arr['result'] = $row['result'];
			$record[] = $arr;
		}
		include( mymps_tpl( "record_login" ) );
	}
	else if ( $part == "action" )
	{
		chk_admin_purview( "purview_�����¼" );
		$here = "����Ա��̨���������¼";
		$where = "WHERE a.id like '%".$keywords."%' OR a.adminid like '%".$keywords."%' OR a.action like '%".$keywords."%' OR a.pubdate like '%".$keywords."%' OR a.ip like '%".$keywords."%' ORDER BY a.id desc";
		$sql = "SELECT a.id,a.adminid,a.action,a.pubdate,a.ip,b.typeid,c.typename FROM ".$db_mymps."admin_record_action AS a LEFT JOIN {$db_mymps}admin AS b ON a.adminid = b.userid  LEFT JOIN {$db_mymps}admin_type AS c ON b.typeid = c.id {$where}";
		$rows_num = $db->getone( "SELECT COUNT(*) FROM `".$db_mymps."admin_record_action` AS a {$where} " );
		$param = setparam( array( "do", "part", "result", "keywords" ) );
		$record = array( );
		foreach ( page1( $sql ) as $k => $row )
		{
			$arr['id'] = $row['id'];
			$arr['adminid'] = $row['adminid'];
			$arr['typename'] = $row['typename'];
			$arr['action'] = $row['action'];
			$arr['pubdate'] = gettime( $row['pubdate'] );
			$arr['ip'] = $row['ip'];
			$record[] = $arr;
		}
		include( mymps_tpl( "record_action" ) );
	}
	break;
	case "member" :
	if ( $part == "login" )
	{
		chk_admin_purview( "purview_��Ա��¼��¼" );
		if ( trim( $action ) == "delall" )
		{
			write_msg( "ɾ����ͨ��Ա������־ ".mymps_del_all( "member_record_".$part, $id )." �ɹ�", $url, "mymps" );
		}
		$here = "��ͨ��Ա��½��¼";
		$where = " WHERE userid like '%".$keywords."%' ";
		$sql = "SELECT * FROM ".$db_mymps."member_record_login {$where} ORDER BY id DESC";
		$rows_num = mymps_count( "member_record_login", $where );
		$param = setparam( array( "do", "part" ) );
		$record = array( );
		foreach ( page1( $sql ) as $k => $row )
		{
			$arr['id'] = $row['id'];
			$arr['userid'] = $row['userid'];
			$arr['userpwd'] = $row['userpwd'];
			$arr['pubdate'] = gettime( $row['pubdate'] );
			$arr['outdate'] = gettime( $row['outdate'] ? $row['outdate'] : $row['pubdate'] + 3627 );
			$arr['ip'] = $row['ip'];
			$arr['ip2area'] = $row['ip2area'];
			$arr['browser'] = $row['browser'];
			$arr['port'] = $row['port'];
			$arr['os'] = $row['os'];
			$arr['result'] = $row['result'];
			$record[] = $arr;
		}
		include( mymps_tpl( "record_login_member" ) );
	}
	else if ( $part == "money" )
	{
		chk_admin_purview( "purview_��Ա���Ѽ�¼" );
		$here = "��Ա���Ѽ�¼";
		if ( trim( $action ) == "delall" )
		{
			write_msg( "ɾ�� <b>".$here."</b> ".mymps_del_all( "member_record_use", $id )." �ɹ�", $url, "mymps" );
			exit( );
		}
		$sql = "SELECT * FROM `".$db_mymps."member_record_use` ORDER BY pubtime DESC";
		$rows_num = mymps_count( "member_record_use", $where );
		$param = setparam( array( "do", "part" ) );
		$get = array( );
		foreach ( page1( $sql ) as $k => $row )
		{
			$arr['id'] = $row['id'];
			$arr['userid'] = $row['userid'];
			$arr['subject'] = $row['subject'];
			$arr['paycost'] = $row['paycost'];
			$arr['pubtime'] = gettime( $row['pubtime'] );
			$get[] = $arr;
		}
		include( mymps_tpl( "record_bank" ) );
	}
}
if ( is_object( $db ) )
{
	$db->Close();
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
