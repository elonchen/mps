<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "plugin" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) )
{
	exit( "Access Denied" );
}
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
chk_admin_purview( "purview_�Ѱ�װ���" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	if ( $op == "disable" && !empty( $id ) )
	{
		$db->query( "UPDATE `".$db_mymps."plugin` SET disable = '1' WHERE id = '{$id}'" );
		write_plugin_cache( );
		echo "<script language=\"javascript\">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>";
		write_msg( "�ɹ����øò����", "plugin.php", "write_record" );
	}
	else if ( $op == "able" && !empty( $id ) )
	{
		$db->query( "UPDATE `".$db_mymps."plugin` SET disable = '0' WHERE id = '{$id}'" );
		write_plugin_cache( );
		echo "<script language=\"javascript\">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>";
		write_msg( "�ɹ����øò����", "plugin.php", "write_record" );
	}
	else if ( $op == "edit" && !empty( $id ) )
	{
		$here = "�������";
		$edit = $db->getrow( "SELECT * FROM `".$db_mymps."plugin` WHERE id = '{$id}'" );
		if ( !$edit['flag'] )
		{
			write_msg( "����ָ���Ĳ�������ڣ�" );
		}
		$edit['config'] = $charset == "utf-8" ? utf8_unserialize( $edit['config'] ) : unserialize( $edit['config'] );
		include( mymps_tpl( "plugin_edit" ) );
	}
	else
	{
		$here = "�������";
		$plugin = $db->getall( "SELECT * FROM `".$db_mymps."plugin`" );
		include( mymps_tpl( CURSCRIPT ) );
	}
}
else
{
	if ( $op == "edit" && !empty( $id ) )
	{
		$config = serialize( $config );
		$db->query( "UPDATE `".$db_mymps."plugin` SET config = '{$config}' WHERE id = '{$id}'" );
		$return = "plugin.php?op=edit&id=".$id;
	}
	write_plugin_cache( );
	echo "<script language=\"javascript\">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>";
	write_msg( "������ø��³ɹ���<br />��δ���ֲ���Ĺ���˵�����F5ˢ�������", $return ? $return : "plugin.php", "write_admin_record" );
}
if ( is_object( $db ) )
{
	$db->Close();
}
$mymps_global = $db = $op = $db_mymps = $part = NULL;
?>
