<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "data_replace" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
$part = isset( $part ) ? $part : "default";
if ( $part == "default" )
{
	$here = "���ݿ������滻";
	chk_admin_purview( "purview_���ݿ�ά��" );
	include( mymps_tpl( "data_replace" ) );
}
else
{
	if ( $part == "do_action" )
	{
		if ( empty($exptable) || empty($rpfield) )
		{
			write_msg( "��ָ�����ݱ���ֶΣ�", "olmsg" );
			exit( );
		}
		if ( empty($rpstring) )
		{
			write_msg( "��ָ�����滻���ݣ�", "olmsg" );
			exit( );
		}
		$rs = $db->query( "UPDATE ".$exptable." SET {$rpfield}=REPLACE({$rpfield},'{$rpstring}','{$tostring}')" );
		$db->query( "OPTIMIZE TABLE `".$exptable."`" );
		if ( $rs )
		{
			write_msg( "�ɹ���������滻��", "olmsg", "write_mymps_record" );
			exit( );
		}
		write_msg( "�����滻ʧ�ܣ�", "olmsg", "write_mymps_record" );
		exit( );
	}
}
if ( is_object( $db ) )
{
	$db->close( );
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
