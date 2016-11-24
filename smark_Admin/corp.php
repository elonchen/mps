<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "corp" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
$part = $part ? $part : "list";
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	if ( $part == "list" )
	{
		chk_admin_purview( "purview_�̼ҷ���" );
		$corp = cat_list( "corp", 0, 0, false );
		$here = "�̼ҷ���";
		include( mymps_tpl( "corp_list" ) );
	}
	else if ( $part == "add" )
	{
		chk_admin_purview( "purview_���ӷ���" );
		$maxorder = $db->getone( "SELECT MAX(corporder) FROM ".$db_mymps."corp" );
		$maxorder += 1;
		$here = "���ӷ���";
		include( mymps_tpl( "corp_add" ) );
	}
	else if ( $part == "edit" )
	{
		$corp = $db->getrow( "SELECT * FROM ".$db_mymps."corp WHERE corpid = '{$corpid}'" );
		$here = "�༭�̼ҷ���";
		include( mymps_tpl( "corp_edit" ) );
	}
	else if ( $part == "del" )
	{
		if ( empty( $corpid ) )
		{
			write_msg( "û��ѡ���¼" );
		}
		mymps_delete( "corp", "WHERE corpid = '".$corpid."'" );
		mymps_delete( "corp", "WHERE parentid = '".$corpid."'" );
		clear_cache_files( "corp_option_static" );
		clear_cache_files( "corp_pid_releate" );
		write_msg( "ɾ���̼ҷ��� ".$corpid." �ɹ�", "?part=list", "Mymps_record" );
	}
}
else if ( $part == "add" )
{
	if ( empty( $corpname ) )
	{
		write_msg( "����д�̼ҷ�������" );
	}
	$corpname = explode( "|", trim( $corpname ) );
	if ( empty( $corporder ) )
	{
		$maxorder = $db->getone( "SELECT MAX(corporder) FROM ".$db_mymps."corp" );
		$corporder = $maxorder + 1;
	}
	if ( is_array( $corpname ) )
	{
		foreach ( $corpname as $key => $value )
		{
			$value = trim( $value );
			++$corporder;
			$len = strlen( $value );
			if ( $len < 2 || 30 < $len )
			{
				write_msg( "������������2����30���ַ�֮��" );
				exit( );
			}
			$db->query( "INSERT INTO ".$db_mymps."corp (corpname,parentid,corporder) VALUES ('{$value}','{$parentid}','{$corporder}')" );
		}
	}
	foreach ( array( "option_static", "pid_releate" ) as $range )
	{
		clear_cache_files( "corp_".$range );
	}
	write_msg( "�ɹ������̼ҷ��࣡", "corp.php?part=list", "write_record" );
}
else if ( $part == "edit" )
{
	if ( empty( $corpname ) )
	{
		write_msg( "����д�̼ҷ�������" );
	}
	$len = strlen( $corpname );
	if ( $corpid == $parentid )
	{
		write_msg( "�������಻��Ϊ�Լ���" );
	}
	if ( $len < 2 || 30 < $len )
	{
		write_msg( "������Ʊ�����2����30���ַ�֮��" );
	}
	$sql = "UPDATE ".$db_mymps."corp SET corpname='{$corpname}',\r\n\t\tparentid='{$parentid}',\r\n\t\tcorporder='{$corporder}'\r\n\t\tWHERE corpid = '{$corpid}'";
	$res = $db->query( $sql );
	foreach ( array( "option_static", "pid_releate" ) as $range )
	{
		clear_cache_files( "corp_".$range );
	}
	$nav_path = "�������� &raquo �༭����";
	$message = "�ɹ��༭�̼ҷ��� ".$corpname;
	$after_action = "<a href='?part=add'><u>���������̼ҷ���</u></a>\r\n\t\t&nbsp;&nbsp;<a href='?part=edit&corpid=".$corpid."'><u>���±༭�÷���</u></a>&nbsp;&nbsp;<a href='?part=list#{$catid}'><u>�����ӷ������</u></a>";
	show_message( $nav_path, $message, $after_action );
}
else if ( $part == "list" && is_array( $corporder ) )
{
	foreach ( $corporder as $key => $value )
	{
		$db->query( "UPDATE `".$db_mymps."corp` SET corporder = '{$value}' WHERE corpid = ".$key );
	}
	foreach ( array( "option_static", "pid_releate" ) as $range )
	{
		clear_cache_files( "corp_".$range );
	}
	write_msg( "�ɹ������̼ҷ��࣡", "corp.php?part=list", "write_record" );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
