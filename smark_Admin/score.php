<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "score" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
$defaultrank = array( "register" => "+10", "login" => "+2", "information" => "+2", "coupon" => "+2", "group" => "+2", "goods" => "+2", "com_certify" => "+10", "per_certify" => "+10" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_�������õȼ�" );
	$here = "������������";
	$score = $db->getone( "SELECT value FROM `".$db_mymps."config` WHERE type='credit_sco' AND description = 'score'" );
	$score = $score ? $charset == "utf-8" ? utf8_unserialize( $score ) : unserialize( $score ) : array( "rank" => $defaultrank );
	include( mymps_tpl( CURSCRIPT ) );
}
else
{
	$db->query( "DELETE FROM `".$db_mymps."config` WHERE description = 'score' AND type = 'credit_sco'" );
	$db->query( "INSERT INTO `".$db_mymps."config` (description,value,type) values ('score','".serialize( $score_new )."','credit_sco')" );
	clear_cache_files( "credit_score" );
	write_msg( "�����������ø��³ɹ���", "score.php", "WriteRecord" );
}
if ( is_object( $db ) )
{
	$db->Close();
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>