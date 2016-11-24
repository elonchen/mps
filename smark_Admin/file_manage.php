<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "file_manage" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_DATA."/config.inc.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
$part = $part ? $part : "template";
if ( $downfile )
{
	if ( !is_file( $downfile ) )
	{
		write_msg( "��Ҫ���ص��ļ������ڣ�" );
	}
	if ( fileext( $downfile ) == "php" )
	{
		write_msg( "���ļ�����������!" );
	}
	$filename = basename( $downfile );
	$filename_info = explode( ".", $filename );
	$fileext = $filename_info[count( $filename_info ) - 1];
	header( "Content-type: application/x-".$fileext );
	header( "Content-Disposition: attachment; filename=".$filename );
	header( "Content-Description: PHP3 Generated Data" );
	readfile( $downfile );
	exit( );
}
if ( !empty($delfile))
{
	if ( $part == "template" )
	{
		write_msg( "ģ���ļ�����ɾ�������ֶ���FTPĿ¼�н���ɾ����" );
	}
	if ( fileext( $delfile ) == "html" )
	{
		write_msg( "���ļ�������ɾ��������FTPĿ¼���ֶ�ɾ����" );
	}
	if ( file_exists( $delfile ) )
	{
		@unlink( $delfile );
		$msgs[] = "�ɹ�ɾ���ļ�<br /><br />".$delfile;
		$msgs[] = "<a href=\"".$url."\">��˷��� &raquo;</a>";
		show_msg( $msgs );
		exit( );
	}
	write_msg( "�ļ��Ѳ����ڣ�" );
	exit( );
}
$cfg_if_tpledit = $mymps_mymps['cfg_if_tpledit'] == 0 ? "<font color=green>�ѹر�</font>" : "<font color=red>�ѿ���</font>";
switch ( $part )
{
	case "template" :
	chk_admin_purview( "purview_ģ�����" );
	$here = "ģ�����߹���";
	$mulu = "Mympsģ��Ŀ¼";
	$showdir = MYMPS_TPL."/default";
	if ( $editfile )
	{
		if ( $do == "update" )
		{
			if ( $mymps_mymps['cfg_if_tpledit'] == "0" )
			{
				write_msg( "����ʧ�ܣ�ϵͳ����Ա�ر������߱༭���Ĺ���!<br /><br />�������޸�/dat/config.inc.php��������" );
			}
			$content = str_replace( "&amp;", "&", trim( $content ) );
			$content = str_replace( "&quot;", "\"", trim( $content ) );
			$nowfile = trim( $editfile );
			if ( !is_file( $nowfile ) )
			{
				write_msg( "�Բ��𣬸��ļ������ڣ�" );
			}
			$norootfile = str_replace( MYMPS_ROOT."/template", "", $nowfile );
			if ( $db->getone( "SELECT content FROM `".$db_mymps."template` WHERE filepath LIKE '{$norootfile}'" ) )
			{
				$update_sql = $db->query( "UPDATE `".$db_mymps."template` SET content = '{$content}' WHERE filepath = '{$norootfile}'" );
			}
			else
			{
				$db->query( "INSERT INTO `".$db_mymps."template` (filepath,content) VALUES ('{$norootfile}','{$content}')" );
			}
			$row = $db->getrow( "SELECT filepath,content FROM `".$db_mymps."template` WHERE filepath = '{$norootfile}'" );
			if ( !$row )
			{
				write_msg( "����ʧ�ܣ�" );
				exit( );
			}
			$create_c = createfile( $nowfile, $row[content] );
			if ( $create_c )
			{
				write_msg( "ģ���ļ�".$nowfile."<br /><br />�޸ĳɹ�", $url, "MyMps" );
				break;
			}
			else
			{
				write_msg( "ģ���ļ�".$nowfile."�޷��޸�<br /><br />����templateĿ¼�Ĳ���Ȩ��!" );
				break;
			}
		}
		else if ( $editfile || !empty( $do ) )
		{
			$ext = fileext( $editfile );
			if ( $ext != "html" && $ext != "css" && $ext != "htm" && $ext != "js" )
			{
				write_msg( "���ļ��������߱༭!" );
			}
			if ( !$edit = file_get_contents( $editfile ) )
			{
				write_msg( "���ļ����ɶ���������ļ��Ĳ���Ȩ��" );
			}
			$path = str_replace( "/".end( explode( "/", $editfile ) ), "", $editfile );
			$edit = htmlspecialchars( $edit );
			$acontent = "<textarea name=\"content\" cols=\"110\" rows=\"25\">".$edit."</textarea>";
			include( mymps_tpl( "template_edit" ) );
			exit();
		}
	}
	break;
	case "upload" :
	chk_admin_purview( "purview_��������" );
	$here = "ϵͳ�ϴ���������";
	$mulu = "ϵͳ����Ŀ¼";
	$showdir = MYMPS_UPLOAD;
	break;
}
$path = trim( $path ) ? trim( $path ) : $showdir;
$LastPath = str_replace( "/".end( explode( "/", $path ) ), "", $path );
$con = explode( $showdir, $CurrentPath );
include( mymps_tpl( CURSCRIPT ) );
if ( is_object( $db ) )
{
	$db->close();
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
