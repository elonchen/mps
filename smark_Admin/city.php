<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

@set_time_limit( 0 );
define( "CURSCRIPT", "city" );
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
$mympsdirectory = array( "admin", "api", "attachment", "backup", "data", "html", "images", "include", "install", "member", "mypub", "plugin", "public", "rewrite", "template", "uc_client" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	$here = "��վ����";
	chk_admin_purview( "purview_��վ����" );
	include( mymps_tpl( "city" ) );
}
else
{
	$cfg_redirectpage = "";
	foreach ( $mympsdirectory as $k => $v )
	{
		if ( $cfg_citiesdir == "/".$v )
		{
			write_msg( "���ύ��Ŀ¼����ϵͳĿ¼�ظ��������һ��Ŀ¼��" );
			exit( );
			break;
		}
	}
	mymps_delete( "config", "WHERE description = 'cfg_citiesdir'" );
	mymps_delete( "config", "WHERE description = 'cfg_independency'" );
	mymps_delete( "config", "WHERE description = 'cfg_redirectpage'" );
	mymps_delete( "config", "WHERE description = 'cfg_cityshowtype'" );
	if ( is_array( $independency ) )
	{
		foreach ( $independency as $k => $v )
		{
			$cfg_independency .= $v.",";
		}
		$cfg_independency = substr( $cfg_independency, 0, -1 );
	}
	$db->query( "INSERT INTO `".$db_mymps."config` (description, value) VALUES ('cfg_independency', '{$cfg_independency}')" );
	$db->query( "INSERT INTO `".$db_mymps."config` (description, value) VALUES ('cfg_citiesdir', '{$cfg_citiesdir}')" );
	$db->query( "INSERT INTO `".$db_mymps."config` (description, value) VALUES ('cfg_redirectpage', '{$cfg_redirectpage}')" );
	$db->query( "INSERT INTO `".$db_mymps."config` (description, value) VALUES ('cfg_cityshowtype', '{$cfg_cityshowtype}')" );
	update_config_cache( );
	unset( $admin_global );
	clear_cache_files( "city_0" );
	clear_cache_files( "allcities" );
	clear_cache_files( "changecity_cities" );
	clear_cache_files( "changeprovince_cities" );
	write_msg( "�ɹ����³��з�վ�������", "city.php", "write_record" );
}
?>
