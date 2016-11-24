<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "group" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
$part = $part ? trim( $part ) : "list";
$id = isset( $id ) ? intval( $id ) : "";
chk_admin_purview( "purview_�ѷ����Ź�" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	require_once( MYMPS_ROOT."/plugin/group/include/functions.php" );
	require_once( MYMPS_DATA."/grouplevel.inc.php" );
	$here = ( $part == "edit" ? "�޸�" : "" )."�ѷ�����Ź��";
	if ( $part == "edit" )
	{
		if ( empty( $id ) )
		{
			write_msg( "�Ź����Ų���Ϊ�գ�" );
		}
		$edit = $db->getrow( "SELECT * FROM `".$db_mymps."group` WHERE groupid = '{$id}'" );
		if ( empty( $edit['groupid'] ) )
		{
			write_msg( "���Ź���Ѳ����ڣ�" );
		}
		$edit['des'] = de_textarea_post_change( $edit['des'] );
		$edit['othercontent'] = de_textarea_post_change( $edit['othercontent'] );
		$acontent = get_editor( "content", "", $edit['content'], "100%", "400px" );
		$meetdate = $edit['meetdate'] ? date( "Y-m-d", $edit['meetdate'] ) : "";
		$enddate = $edit['enddate'] ? date( "Y-m-d", $edit['enddate'] ) : "";
	}
	else
	{
		$gname = isset( $gname ) ? trim( $gname ) : "";
		$userid = isset( $userid ) ? trim( $userid ) : "";
		$meetdate = isset( $meetdate ) ? intval( strtotime( $meetdate ) ) : "";
		$enddate = isset( $enddate ) ? intval( strtotime( $enddate ) ) : "";
		$cate_id = isset( $cate_id ) ? intval( $cate_id ) : "";
		$cityid = isset( $cityid ) ? intval( $cityid ) : "";
		$where = " WHERE 1";
		$where .= $gname != "" ? " AND gname LIKE '%".$gname."%'" : "";
		$where .= $userid != "" ? " AND userid = '".$userid."'" : "";
		$where .= $meetdate != "" ? " AND meetdate >= '".$meetdate."'" : "";
		$where .= $enddate != "" ? " AND enddate <= '".$enddate."'" : "";
		$where .= !empty( $cate_id ) ? " AND cate_id = '".$cate_id."'" : "";
		$where .= $admin_cityid ? " AND cityid = '".$admin_cityid."'" : $cityid ? " AND cityid = '".$cityid."'" : "";
		$group = page1( "SELECT * FROM `".$db_mymps."group` {$where} ORDER BY displayorder DESC" );
		$rows_num = $db->getone( "SELECT COUNT(groupid) FROM `".$db_mymps."group` {$where}" );
		$param = setparam( array( "part", "gname", "userid", "meetdate", "enddate", "cate_id", "cityid" ) );
		$meetdate = !$meetdate ? "" : date( "Y-m-d", $meetdate );
		$enddate = !$enddate ? "" : date( "Y-m-d", $meetdate );
	}
	include( mymps_tpl( "group_".$part ) );
}
else
{
	if ( $part == "list" )
	{
		if ( empty( $selectedids ) )
		{
			write_msg( "��û��ѡ���κ�һ���Ź����" );
		}
		$create_in = create_in( $selectedids );
		if ( !$action || !in_array( $action, array( "delall", "glevel0", "glevel1", "glevel2", "glevel3", "glevel4" ) ) )
		{
			write_msg( "����δָ����������" );
		}
		if ( $action == "delall" )
		{
			$query = $db->query( "SELECT * FROM `".$db_mymps."group` WHERE groupid ".$create_in );
			while ( $row = $db->fetchrow( $query ) )
			{
				$delete[$row['id']]['picture'] = $row['picture'];
				$delete[$row['id']]['pre_picture'] = $row['pre_picture'];
			}
			foreach ( $delete as $k => $v )
			{
				@unlink( @MYMPS_ROOT.@$v['picture'] );
				@unlink( @MYMPS_ROOT.@$v['pre_picture'] );
			}
			$db->query( "DELETE FROM `".$db_mymps."group` WHERE groupid ".$create_in );
			unset( $delete );
			unset( $row );
			unset( $query );
			unset( $create_in );
		}
		else if ( in_array( $action, array( "glevel0", "glevel1", "glevel2", "glevel3", "glevel4" ) ) )
		{
			switch ( $action )
			{
				case "glevel0" :
				$action = 0;
				break;
				case "glevel1" :
				$action = 1;
				break;
				case "glevel2" :
				$action = 2;
				break;
				case "glevel3" :
				$action = 3;
				break;
				case "glevel4" :
				$action = 4;
			}
			$db->query( "UPDATE `".$db_mymps."group` SET glevel = '{$action}' WHERE groupid ".$create_in );
			unset( $create_in );
			unset( $action );
		}
	}
	else if ( $part == "edit" )
	{
		if ( empty( $id ) )
		{
			write_msg( "�Ź����Ų���Ϊ�գ�" );
		}
		if ( empty( $gname ) )
		{
			write_msg( "����Ʋ���Ϊ�գ�" );
		}
		if ( empty( $gaddress ) )
		{
			write_msg( "��ص㲻��Ϊ�գ�" );
		}
		if ( empty( $des ) )
		{
			write_msg( "����˵������Ϊ�գ�" );
		}
		if ( empty( $meetdate ) )
		{
			write_msg( "����ʱ�䲻��Ϊ�գ�" );
		}
		if ( empty( $enddate ) )
		{
			write_msg( "��ֹʱ�䲻��Ϊ�գ�" );
		}
		$name_file = "group_image";
		$meetdate = intval( strtotime( $meetdate ) );
		$enddate = intval( strtotime( $enddate ) );
		$des = textarea_post_change( $des );
		$othercontent = textarea_post_change( $othercontent );
		$cate_id = intval( $cate_id );
		$areaid = intval( $areaid );
		$gaddress = trim( $gaddress );
		$signintotal = intval( $signintotal );
		$masterqq = intval( $masterqq );
		$displayorder = intval( $displayorder );
		if ( $_FILES[$name_file]['name'] )
		{
			require_once( MYMPS_INC."/upfile.fun.php" );
			$destination = "/group/".date( "Ym" )."/";
			$mymps_image = start_upload( $name_file, $destination, 0, $mymps_mymps['cfg_group_limit']['width'], $mymps_mymps['cfg_group_limit']['height'], $picture, $pre_picture );
			$picture = $mymps_image[0];
			$pre_picture = $mymps_image[1];
			unset( $mymps_image );
		}
		unset( $name_file );
		$db->query( "UPDATE `".$db_mymps."group` SET gname='{$gname}',des='{$des}',content='{$content}',cate_id='{$cate_id}',areaid='{$areaid}',gaddress='{$gaddress}',picture='{$picture}',pre_picture='{$pre_picture}',meetdate='{$meetdate}',enddate='{$enddate}',dateline='{$timestamp}',mastername='{$mastername}',masterqq='{$masterqq}',glevel='{$glevel}',signintotal='{$signintotal}',glevel='{$glevel}',commenturl='{$commenturl}',biztype='{$biztype}',othercontent='{$othercontent}',displayorder='{$displayorder}' WHERE groupid = '{$id}'" );
		$url = "?part=edit&id=".$id;
	}
	write_msg( "�����ɹ���", $url ? $url : "?part=list" );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
