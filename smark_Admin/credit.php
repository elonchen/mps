<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "credit" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
$defaultrank = array( "com_certify" => "+50", "per_certify" => "+50", "coin_credit" => "+10" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_�������õȼ�" );
	$here = "����ֵ��������";
	require_once( MYMPS_DATA."/moneytype.inc.php" );
	$credit = $db->getone( "SELECT value FROM `".$db_mymps."config` WHERE type='credit_sco' AND description = 'credit'" );
	$credit = $credit ? $charset == "utf-8" ? utf8_unserialize( $credit ) : unserialize( $credit ) : array( "rank" => $defaultrank );
	include( mymps_tpl( CURSCRIPT ) );
}
else
{
	$db->query( "DELETE FROM `".$db_mymps."config` WHERE description = 'credit' AND type = 'credit_sco'" );
	$db->query( "INSERT INTO `".$db_mymps."config` (description,value,type) values ('credit','".serialize( $credit_new )."','credit_sco')" );
	clear_cache_files( "credit_score" );
	write_msg( "�����������ø��³ɹ���", "credit.php", "WriteRecord" );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
