<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "friendlink" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
$do = $do ? $do : "link";
switch ( $do )
{
	case "link" :
	$part = $part ? $part : "list";
	require_once( MYMPS_INC."/flink.fun.php" );
	if ( $part == "list" )
	{
		chk_admin_purview( "purview_��������" );
		$where = $ifindex ? " WHERE ifindex = '{$ifindex}'" : " WHERE 1";
		$where .= $catid ? " AND catid = '{$catid}'" : "";
		$where .= $admin_cityid ? " AND cityid = '{$admin_cityid}'" : $cityid ? " AND cityid = '{$cityid}'" : " AND cityid = '0'";
		$rows_num = mymps_count( "flink", $where );
		$param = setparam( array( "do", "cityid", "part", "ifindex", "catid" ) );
		$links = page1( "SELECT * FROM {$db_mymps}flink {$where} ORDER BY ordernumber ASC" );
		$here = "�������ӹ���";
		$cats = $db->getAll( "SELECT * FROM `{$db_mymps}category` WHERE parentid = '0'" );
		include( mymps_tpl( CURSCRIPT."_default" ) );
	}
	else if ( $part == "add" )
	{
		chk_admin_purview( "purview_��������" );
		$here = "�����������";
		$sql = "SELECT * FROM {$db_mymps}flink_type ORDER BY id Asc";
		$links = $db->getAll( $sql );
		include( mymps_tpl( CURSCRIPT."_add" ) );
	}
	else if ( $part == "insert" )
	{
		$sql = "Insert Into `{$db_mymps}flink`(id,cityid,ifindex,url,webname,weblogo,typeid,createtime,ischeck,ordernumber,catid)\r\n\t\t\t\tValues('','{$cityid}','{$ifindex}','{$url}','{$webname}','{$weblogo}','{$typeid}','{$timestamp}','{$ischeck}','{$ordernumber}','{$catid}'); ";
		$res = $db->query( $sql );
		clear_cache_files( "city_".$cityid );
		write_msg( "����������� {$webname} �ɹ�", "?part=list", "mymps" );
	}
	else if ( $part == "edit" )
	{
		$sql = "SELECT * FROM {$db_mymps}flink WHERE id = '{$id}'";
		$link = $db->getRow( $sql );
		$here = "�༭��������";
		include( mymps_tpl( CURSCRIPT."_edit" ) );
	}
	else if ( $part == "update" )
	{
		if ( empty( $url ) || empty( $webname ) )
		{
			write_msg( "������������Ϣ" );
			exit( );
		}
		$sql = "UPDATE {$db_mymps}flink SET cityid='{$cityid}',webname='{$webname}',weblogo='{$weblogo}',url='{$url}',catid='{$catid}',ordernumber='{$ordernumber}',createtime='{$timestamp}',ifindex='{$ifindex}',ischeck='{$ischeck}',msg='".textarea_post_change( $msg )."',name='{$name}',qq='{$qq}',email='{$email}',typeid='{$typeid}',dayip='{$dayip}',pr='{$pr}' WHERE id = '{$id}'";
		$res = $db->query( $sql );
		clear_cache_files( "city_".$cityid );
		write_msg( "�༭���� {$webname} �ɹ�", "?part=edit&id=".$id, "mymps" );
	}
	else if ( $part == "delete" )
	{
		if ( empty( $id ) )
		{
			write_msg( "û��ѡ���¼" );
		}
		mymps_delete( "flink", "WHERE id = '{$id}'" );
		clear_cache_files( "city_".$cityid );
		write_msg( "ɾ���������� {$id} �ɹ�", "friendlink.php".$cityid );
	}
	else if ( $part == "doall" )
	{
		if ( is_array( $ordernumber ) )
		{
			foreach ( $ordernumber as $korder => $value )
			{
				$db->query( "UPDATE `{$db_mymps}flink` SET ordernumber = '{$value}' WHERE id = '{$korder}'" );
			}
		}
		if ( is_array( $ids ) && in_array( $do_action, array( "index", "inside", "del", "check2", "check1" ) ) )
		{
			if ( $do_action == "index" )
			{
				$db->query( "UPDATE `{$db_mymps}flink` SET ifindex = '2' WHERE ".create_in( $ids, "id" ) );
			}
			else if ( $do_action == "inside" )
			{
				$db->query( "UPDATE `{$db_mymps}flink` SET ifindex = '1' WHERE ".create_in( $ids, "id" ) );
			}
			else if ( $do_action == "del" )
			{
				$db->query( "DELETE FROM `{$db_mymps}flink` WHERE ".create_in( $ids, "id" ) );
			}
			else if ( $do_action == "check2" )
			{
				$db->query( "UPDATE `{$db_mymps}flink` SET ischeck = '2' WHERE ".create_in( $ids, "id" ) );
			}
			else if ( $do_action == "check1" )
			{
				$db->query( "UPDATE `{$db_mymps}flink` SET ischeck = '1' WHERE ".create_in( $ids, "id" ) );
			}
		}
		clear_cache_files( "city_".$cityid );
		write_msg( "�����������ø��³ɹ���", "?do=link&part=list&cityid=".$cityid, "mymps" );
	}
	break;
	case "type" :
}
$part = $part ? $part : "list";
$here = "<b>��վ���͹���</b>";
if ( $part == "list" )
{
	$sql = "SELECT * FROM {$db_mymps}flink_type ORDER BY id Asc";
	$links = $db->getAll( $sql );
	include( mymps_tpl( CURSCRIPT."_type" ) );
}
else if ( $part == "insert" )
{
	$typename = trim( $typename );
	$sql = "Insert Into `{$db_mymps}flink_type`(id,typename)\r\n\t\t\t\tValues('','{$typename}');";
	$res = $db->query( $sql );
	write_msg( "�����վ���� {$typename} �ɹ�", "?do=type", "mymps" );
}
else if ( $part == "update" )
{
	$typename = trim( $_POST['typename'] );
	$sql = "UPDATE {$db_mymps}flink_type SET typename='{$typename}' WHERE id = '{$id}'";
	$res = $db->query( $sql );
	write_msg( "���� {$typename} ���ĳɹ�", "?do=type&part=edit&id=".$id, "mymps" );
}
else if ( $part == "delete" )
{
	if ( empty( $id ) )
	{
		write_msg( "û��ѡ���¼" );
	}
	else
	{
		mymps_delete( "flink_type", "WHERE id = '{$id}'" );
		write_msg( "ɾ������ {$id} �ɹ�", "?do=type", "mymps" );
	}
}
break;
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
