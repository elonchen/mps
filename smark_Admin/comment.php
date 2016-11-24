<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "comment" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
$part = $part ? trim( $part ) : "information";
$action = $action ? trim( $action ) : "list";
$id = isset( $id ) ? $id : "";
if ( in_array( $part, array( "information", "news", "coupon", "group" ) ) )
{
	$part = "information";
}
if ( $part == "information" )
{
	chk_admin_purview( "purview_��Ϣ����" );
}
else if ( $part == "news" )
{
	chk_admin_purview( "purview_��������" );
}
else if ( $part == "coupon" )
{
	chk_admin_purview( "purview_�Ż�ȯ����" );
}
else if ( $part == "group" )
{
	chk_admin_purview( "purview_�Ź�����" );
}
if ( $action == "del" )
{
	if ( empty( $id ) )
	{
		write_msg( "��Ч�����۲����ύ��" );
	}
	$db->query( "DELETE FROM `".$db_mymps."comment` WHERE id = '{$id}' AND type = '{$part}'" );
	write_msg( "�ɹ�ɾ�����Ϊ".$id."����������", "comment.php?part=".$part, "Mymps" );
}
else if ( $action == "delall" )
{
	if ( !is_array( $id ) )
	{
		write_msg( "��û��ѡ���κμ�¼��" );
	}
	$db->query( "DELETE FROM `".$db_mymps."comment` WHERE id ".create_in( $id ).( " AND type = '".$part."'" ) );
	write_msg( "����ɾ���������۳ɹ���", "comment.php?part=".$part, "write_record" );
}
else if ( $action == "level0" )
{
	if ( !is_array( $id ) )
	{
		write_msg( "��û��ѡ���κμ�¼��" );
	}
	foreach ( $id as $k => $v )
	{
		$db->query( "UPDATE `".$db_mymps."comment` SET comment_level = 0 WHERE id = '{$v}' AND type = '{$part}'" );
	}
	write_msg( "��������״̬Ϊ ����״̬ �����ɹ���", "comment.php?part=".$part, "RECORD" );
}
else if ( $action == "level1" )
{
	if ( !is_array( $id ) )
	{
		write_msg( "��û��ѡ���κμ�¼��" );
	}
	foreach ( $id as $k => $v )
	{
		$db->query( "UPDATE `".$db_mymps."comment` SET comment_level = 1 WHERE id = '{$v}' AND type = '{$part}'" );
	}
	write_msg( "��������״̬Ϊ ����״̬ �����ɹ���", "comment.php?part=".$part, "RECORD" );
}
else if ( $action == "list" )
{
	$admindir = getcwdol( );
	$comment_level = isset( $comment_level ) ? intval( $comment_level ) : "";
	require_once( MYMPS_DATA."/info.level.inc.php" );
	$part_arr = array( "information" => "������Ϣ����", "news" => "��������", "group" => "�Ź�����", "coupon" => "�Ż�ȯ����" );
	$here = $part_arr[$part];
	unset( $part_arr );
	$where = " WHERE type = '".$part."' ";
	$where .= $keywords != "" ? " AND a.content LIKE '%".$keywords."%'" : "";
	$where .= $commment_level != "" ? " AND a.comment_level = '0'" : "";
	$sql = "SELECT a.id,a.userid,a.content,a.pubtime,a.ip,a.typeid,a.type,b.title,a.comment_level FROM `".$db_mymps."comment` AS a LEFT JOIN `{$db_mymps}".$part.( "` AS b ON a.typeid = b.id ".$where." ORDER BY a.pubtime DESC" );
	$rows_num = $db->getone( "SELECT COUNT(*) FROM `".$db_mymps."comment` AS a {$where}" );
	$param = setparam( array( "part", "keywords", "comment_level" ) );
	$comment = array( );
	foreach ( page1( $sql ) as $k => $row )
	{
		$arr['id'] = $row['id'];
		$arr['content'] = $row['content'];
		switch ( $part )
		{
			case "information" :
			$arr['title'] = "<a href=../information.php?id=".$row[typeid]." target=_blank>".$row[title]."</a>";
			break;
			case "news" :
			$arr['title'] = "<a href=../news.php?id=".$row[typeid]." target=_blank>".$row[title]."</a>";
			break;
			case "group" :
			$arr['title'] = "<a href=../group.php?id=".$row[infoid]." target=_blank>".$row[title]."</a>";
			break;
			case "coupon" :
			$arr['title'] = "<a href=../coupon.php?id=".$row[infoid]." target=_blank>".$row[title]."</a>";
		}
		$arr['userid'] = $row[userid] ? "<a  href=\"javascript:void(0);\" onclick=\"\r\nsetbg('Mymps��Ա����',400,110,'../box.php?part=member&userid=".$row['userid']."&admindir={$admindir}')\">".$row[userid]."</a>" : $row[ip];
		$arr['pubtime'] = gettime( $row['pubtime'] );
		$arr['ip'] = $row['ip'];
		$arr['comment_level'] = $information_level[$row[comment_level]];
		$comment[] = $arr;
	}
	include( mymps_tpl( "comment" ) );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
