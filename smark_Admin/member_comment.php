<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "member_comment" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
$where = $userid ? "WHERE userid = '".$userid."'" : "";
$where .= $commentlevell ? " AND commentlevel = '".$commentlevel."'" : "";
$mlevel = array( );
$mlevel[0] = "<font color=red>����</font>";
$mlevel[1] = "<font color=#006acd>����</font>";
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_ģ�����" );
	$here = "���ѵ���";
	$rows_num = mymps_count( "member_comment", $where );
	$param = setparam( array( "part" ) );
	$comment = page1( "SELECT * FROM `".$db_mymps."member_comment` {$where} ORDER BY id DESC" );
	include( mymps_tpl( CURSCRIPT ) );
}
else if ( is_array( $ids ) )
{
	if ( $part == "delall" )
	{
		foreach ( $ids as $kids => $vids )
		{
			mymps_delete( "member_comment", "WHERE id = ".$vids );
		}
		write_msg( "�ɹ�ɾ��ָ��������Ϣ��", $url, "writerecord" );
	}
	else
	{
		if ( strstr( $part, "level" ) )
		{
			$part = fileext( $part );
			foreach ( $ids as $kids => $vids )
			{
				$db->query( "UPDATE `".$db_mymps."member_comment` SET commentlevel = '{$part}' WHERE id = ".$vids );
			}
			write_msg( "�ɹ��޸�ָ����������Ϣ״̬Ϊ".$mlevel[$part]."��", $url, "writerecord" );
		}
		else
		{
			write_msg( "Undefined Action!" );
		}
	}
}
else
{
	write_msg( "��ѡ����Ҫ��������ĵ�����" );
}
if ( is_object( $db ) )
{
	$db->Close();
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
