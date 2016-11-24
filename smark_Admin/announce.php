<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "announce" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
$part = $part ? $part : "all";
$cityid = $cityid ? intval( $cityid ) : 0;
if ( $part == "add" || $part == "edit" )
{
	require_once( dirname( __FILE__ )."/include/color.inc.php" );
	$mymps_title_color = $color;
}
if ( $part == "add" )
{
	chk_admin_purview( "purview_��������" );
	$acontent = get_editor( "content", "Normal" );
	$here = "������վ����";
	include( mymps_tpl( "announce_add" ) );
}
else if ( $part == "insert" )
{
	$db->query( "Insert Into `".$db_mymps."announce` (id,cityid,title,titlecolor,content,pubdate,begintime,endtime,author,redirecturl) Values ('','{$cityid}','{$title}','{$titlecolor}','{$content}','{$timestamp}','".strtotime( $begintime )."','".strtotime( $endtime ).( "','".$author."','{$redirecturl}')" ) );
	$inid = $db->insert_id( );
	clear_cache_files( "city_".$cityid );
	$nav_path = "��վ������� &raquo ������վ����";
	$message = "�ɹ�����һƪ���� <<".$title.">>";
	$after_action = "<a href='../about.php?part=announce#".$inid."' target=\"_blank\"><u>�鿴�ù���</u></a>&nbsp;&nbsp;<a href='?part=add'><u>�������ӹ���</u></a>&nbsp;&nbsp;<a href='?part=edit&id={$inid}'><u>���±༭�ù���</u></a>&nbsp;&nbsp;<a href='announce.php'><u>�����ӹ������</u></a>";
	show_message( $nav_path, $message, $after_action );
}
else if ( $part == "edit" )
{
	if ( trim( $_POST[action] ) == "dopost" )
	{
		$sql = "UPDATE `".$db_mymps."announce` SET cityid = '{$cityid}',title='{$title}',titlecolor ='{$titlecolor}',content='{$content}',author='{$author}',pubdate='{$timestamp}',begintime='".strtotime( $begintime )."',endtime='".strtotime( $endtime ).( "',redirecturl='".$redirecturl."' WHERE id = '{$id}'" );
		$res = $db->query( $sql );
		clear_cache_files( "city_".$cityid );
		$nav_path = "��վ������� &raquo �޸���վ����";
		$message = "�ɹ��޸Ĺ��� <<".$title.">>";
		$after_action = "<a href='../about.php?part=announce#".$id."' target=\"_blank\"><u>�鿴�ù���</u></a>&nbsp;&nbsp;<a href='?part=add'><u>��Ҫ����һƪ����</u></a>&nbsp;&nbsp;<a href='?part=edit&id={$id}'><u>���±༭�ù���</u></a>&nbsp;&nbsp;<a href='announce.php'><u>�����ӹ������</u></a>";
		show_message( $nav_path, $message, $after_action );
	}
	else
	{
		$id = intval( $id );
		$here = "�޸���վ����";
		$edit = $db->getrow( "SELECT * FROM ".$db_mymps."announce WHERE id = '{$id}'" );
		$acontent = get_editor( "content", "Normal", $edit['content'] );
		include( mymps_tpl( "announce_edit" ) );
	}
}
else if ( $part == "delete" )
{
	$id = intval( $id );
	if ( empty( $id ) )
	{
		write_msg( "û��ѡ���¼" );
	}
	else
	{
		mymps_delete( "announce", "WHERE id = '".$id."'" );
		clear_cache_files( "city_".$cityid );
		write_msg( "ɾ������ ".$id." �ɹ�", $url, "Mymps_record" );
	}
}
else if ( $part == "all" )
{
	chk_admin_purview( "purview_�ѷ�������" );
	$page = empty( $page ) ? 1 : intval( $page );
	$where = $title ? " AND title like '%".$title."%'" : "";
	$where .= $author ? " AND author like '%".$author."%'" : "";
	$where .= $admin_cityid ? " AND cityid = '".$admin_cityid."'" : $cityid ? " AND cityid = '".$cityid."'" : " AND cityid = '0'";
	$sql = "SELECT * FROM ".$db_mymps."announce WHERE 1 {$where} ORDER BY id DESC";
	$rows_num = mymps_count( "announce", "WHERE 1".$where );
	$param = setparam( array( "id", "title", "author", "cityid" ) );
	$announce = page1( $sql );
	$here = "�����б�";
	include( mymps_tpl( "announce_all" ) );
}
else if ( $part == "delall" )
{
	clear_cache_files( "city_".$cityid );
	write_msg( "ɾ������ ".mymps_del_all( "announce", $_POST[id] )." �ɹ�", $url, "Mymps_record" );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
