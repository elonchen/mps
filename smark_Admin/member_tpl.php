<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "member_tpl" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/ifview.inc.php" );
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_ģ�����" );
	if ( $part == "edit" )
	{
		$here = "��Աģ�������޸�";
		if ( $edit = $db->getrow( "SELECT * FROM ".$db_mymps."member_tpl WHERE id = ".$id ) )
		{
			include( mymps_tpl( CURSCRIPT."_edit" ) );
		}
		else
		{
			write_msg( "����ָ����ģ�岻���ڻ����ѱ�ɾ����" );
		}
	}
	else
	{
		$here = "��Աģ������";
		$list = $db->getall( "SELECT * FROM ".$db_mymps.CURSCRIPT." ORDER BY displayorder ASC" );
		include( mymps_tpl( CURSCRIPT ) );
	}
}
else
{
	if ( $part == "edit" )
	{
		$forward_url = "?part=edit&id=".$id;
		if ( empty( $displayorder ) )
		{
            write_msg( "ģ�����ƺ�ģ��·������Ϊ�գ�" );
		}
		$db->query( "UPDATE `".$db_mymps."member_tpl` SET tpl_name='{$tpl_name}',tpl_path='{$tpl_path}',if_view='{$isview}',displayorder='{$displayorder}',edittime='".time( ).( "' WHERE id = '".$id."'" ) );
		$i = 1;
	}
	else
	{
		if ( is_array( $delids ) )
		{
			$i = 1;
			foreach ( $delids as $kids => $vids )
			{
				mymps_delete( CURSCRIPT, "WHERE id = ".$vids );
			}
		}
		if ( is_array( $displayorder ) )
		{
			$i = 1;
			foreach ( $displayorder as $keyorder => $vorder )
			{
				$db->query( "UPDATE `".$db_mymps."member_tpl` SET displayorder = '{$vorder}' WHERE id = ".$keyorder );
			}
		}
		if ( is_array( $add ) && $add[tpl_name] && $add[tpl_path] )
		{
			$i = 1;
			$do_insert = $db->query( "INSERT INTO `".$db_mymps."member_tpl` (tpl_name,tpl_path,if_view,displayorder,edittime) VALUES ('{$add['tpl_name']}','{$add['tpl_path']}','{$add['if_view']}','{$add['displayorder']}','".time( )."')" );
			if ( !$do_insert )
			{
                write_msg( "��Աģ������ʧ��!" );
			}
		}
	}
	if ( $i != 1 || !$i )
	{
		write_msg( "��û�н����κβ�����" );
	}
	else
	{
		write_msg( "��Աģ�����ø��³ɹ���", $forward_url, "MympsRecord" );
	}
}
if ( is_object( $db ) )
{
	$db->Close();
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
