<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function delinfo( $id = "" )
{
	global $db;
	global $db_mymps;
	if ( !$id )
	{
		write_msg( "Ϊѡ���κ�����");
	}
	$get_row = $db->getrow( "SELECT a.*,b.modid FROM `".$db_mymps."information` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.catid = b.catid  WHERE a.id = '{$id}'" );
	if ( empty( $get_row['img_path'] ) )
	{
		$del = $db->getall( "SELECT path,prepath FROM `".$db_mymps."info_img` WHERE infoid='{$id}'" );
		foreach ( $del as $k => $v )
		{
			@unlink( @MYMPS_ROOT.@$v[path] );
			@unlink( @MYMPS_ROOT.@$v[prepath] );
		}
		mymps_delete( "info_img", "WHERE infoid = '".$id."'" );
	}else{
		@unlink( @MYMPS_ROOT.@$get_row['html_path'] );
	}
	mymps_delete( "comment", "WHERE type = 'information' AND typeid = '".$id."'" );
	if ( 1 < $get_row['modid'] )
	{
		mymps_delete( "info_extra", "WHERE infoid = '".$id."'" );
	}
	mymps_delete( "information", "WHERE id = '".$id."'" );
}

define( "CURSCRIPT", "test_same" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
$part = isset( $part ) ? $part : "default";
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
if ( $part == "default" )
{
	$here = "�ظ�������Ϣ������";
	chk_admin_purview( "purview_ɾ���ظ�" );
	include( mymps_tpl( "test_same" ) );
}
else if ( $part == "do_list" )
{
	$query = $db->query( "SELECT COUNT(title) AS dd,title FROM `".$db_mymps."information` GROUP BY title ORDER BY dd DESC LIMIT 0,{$pagesize}" );
	$allarc = 0;
	include( mymps_tpl( "test_same_list" ) );
	exit( );
}
else if ( $part == "do_action" )
{
	if ( empty( $infoTitles ) )
	{
		header( "Content-Type: text/html; charset=".$charset."" );
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$charset."\">\r\n";
		write_msg( "û��ָ��ɾ�����ĵ���" );
		exit( );
	}
	$totalarc = 0;
	$orderby = $deltype == "delnew" ? " ORDER BY id DESC " : " ORDER BY id ASC ";
	foreach ( $infoTitles as $titles => $title )
	{
		$title = trim( $title );
		$title = addslashes( $title == "" ? "" : urldecode( $title ) );
		$sql = "SELECT id,title FROM `".$db_mymps."information` WHERE title='{$title}' {$orderby}";
		$query = $db->query( $sql );
		$rownum = $db->num_rows( $query );
		if ( $rownum < 2 )
		{
			$i = 1;
			while ( $row = $db->fetchrow( $query ) )
			{
				++$i;
				$nid = $row['id'];
				$ntitle = $row['title'];
				if ( $rownum < $i )
				{
					++$totalarc;
					delinfo( $nid );
				}
			}
		}
	}
	$db->query( " OPTIMIZE TABLE `".$db_mymps."information`; " );
	write_msg( "һ��ɾ���� [<font color=red>".$totalarc."</font>] ƪ�ظ�����Ϣ���⣡", "olmsg" );
	exit( );
}
?>
