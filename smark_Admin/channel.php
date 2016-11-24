<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "channel" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/color.inc.php" );
require_once( dirname( __FILE__ )."/include/ifview.inc.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
$part = $part ? $part : "list";
$cat_color = $color;
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	require_once( MYMPS_DATA."/html_type.inc.php" );
	if ( $part == "list" )
	{
		chk_admin_purview( "purview_�������" );
		$f_cat = cat_list( "channel", 0, 0, false );
		$here = "������Ŀ�б�";
		include( mymps_tpl( "news_channel_list" ) );
	}
	else if ( $part == "edit" )
	{
		if ( !$catid )
		{
			write_msg( "��ѡ����Ҫ�޸ĵ���ĿID��" );
		}
		$cat = $db->getrow( "SELECT * FROM ".$db_mymps."channel WHERE catid = '{$catid}'" );
		$here = "�༭������Ŀ";
		include( mymps_tpl( "news_channel_edit" ) );
	}
	else if ( $part == "add" )
	{
		$maxorder = $db->getone( "SELECT MAX(catorder) FROM ".$db_mymps."channel" );
		$maxorder += 1;
		$here = "���������Ŀ";
		include( mymps_tpl( "news_channel_add" ) );
	}
	else if ( $part == "del" )
	{
		if ( !$catid )
		{
			write_msg( "��ѡ����Ҫ�޸ĵ���ĿID��" );
		}
		mymps_delete( "channel", "WHERE catid = '".$catid."'" );
		mymps_delete( "channel", "WHERE parentid = '".$catid."'" );
		mymps_delete( "news", "WHERE catid IN(".get_cat_children( $catid, "channel" ).")" );
		foreach ( array( "option_static", "pid_releate" ) as $range )
		{
			clear_cache_files( "channel_".$range );
		}
		write_msg( "ɾ��������Ŀ ".$catid." �ɹ�", "channel.php?part=list", "Mymps" );
	}
}
else if ( $part == "list" )
{
	if ( is_array( $catorder ) )
	{
		$cur_action .= "���� ";
		foreach ( $catorder as $key => $value )
		{
			$db->query( "UPDATE `".$db_mymps."channel` SET catorder = '{$value}' WHERE catid = ".$key );
		}
	}
	if ( is_array( $if_viewids ) )
	{
		$cur_action .= "�������";
		$db->query( "UPDATE `".$db_mymps."channel` SET if_view = '1' " );
		foreach ( $if_viewids as $k => $val )
		{
			$db->query( "UPDATE `".$db_mymps."channel` SET if_view = '2' WHERE catid = ".$val );
		}
	}
	else
	{
		$db->query( "UPDATE `".$db_mymps."channel` SET if_view = '1' " );
	}
	foreach ( array( "option_static", "pid_releate" ) as $range )
	{
		clear_cache_files( "channel_".$range );
	}
	write_msg( "������Ŀ ".$cur_action." ���³ɹ���", "?part=list", "record" );
}
else if ( $part == "add" )
{
	if ( empty( $catname ) )
	{
		write_msg( "����д������Ŀ���ƣ�" );
	}
	$len = strlen( $catname );
	if ( $len < 2 )
	{
		write_msg( "������Ŀ��������2���ַ�����" );
	}
	$catname = explode( "|", trim( $catname ) );
	if ( empty( $catorder ) )
	{
		$maxorder = $db->getone( "SELECT MAX(catorder) FROM ".$db_mymps."channel" );
		$catorder += 1;
	}
	if ( is_array( $catname ) )
	{
		foreach ( $catname as $key => $value )
		{
			$value = trim( $value );
			++$catorder;
			$len = strlen( $value );
			if ($len < 2 || 30 < $len )
			{
				write_msg( "������������2����30���ַ�֮��" );
			}
			$db->query( "INSERT INTO ".$db_mymps."channel (catname,if_view,title,keywords,description,parentid,catorder,dir_type) VALUES ('{$value}','{$isview}','{$value}','{$value}','{$value}','{$parentid}','{$catorder}','{$dir_type}')" );
			$insert_id = $db->insert_id( );
			if ( $parentid == 0 )
			{
				if ( $dir_type == 1 )
				{
					$html_dir = "/".$insert_id."/";
				}
				else if ( $dir_type == 2 )
				{
					$html_dir = "/".getpinyin( $value )."/";
				}
				else if ( $dir_type == 3 )
				{
					$html_dir = "/".getpinyin( $value, 1 )."/";
				}
			}
			else
			{
				$row = $db->getrow( "SELECT * FROM `".$db_mymps."channel` WHERE catid = '{$parentid}'" );
				if ( $dir_type == 1 )
				{
					$html_dir = ( $row['html_dir'] ? $row['html_dir'] : $row['html_dir'] ).$insert_id."/";
				}
				else if ( $dir_type == 2 )
				{
					$html_dir = ( $row['html_dir'] ? $row['html_dir'] : $row['html_dir'] ).getpinyin( $value )."/";
				}
				else if ( $dir_type == 3 )
				{
					$html_dir = ( $row['html_dir'] ? $row['html_dir'] : $row['html_dir'] ).getpinyin( $value, 1 )."/";
				}
			}
			$db->query( "UPDATE `".$db_mymps."channel` SET html_dir = '{$html_dir}' WHERE catid = '{$insert_id}'" );
		}
		foreach ( array( "option_static", "pid_releate" ) as $range )
		{
			clear_cache_files( "channel_".$range );
		}
		write_msg( "���ŷ�����ӳɹ���", "?part=list", "record" );
	}
	else
	{
		write_msg( "���ŷ������ʧ�ܣ��밴��ʽ��д��" );
	}
}
else if ( $part == "edit" )
{
	if ( empty( $catname ) )
	{
		write_msg( "����д������Ŀ���ƣ�" );
	}
	if ( strlen( $catname ) < 2 )
	{
		write_msg( "������Ŀ��������2���ַ�����" );
	}
	if ( $catid == $parentid )
	{
		write_msg( "������Ŀ����Ϊ�Լ���" );
	}
	if ( $parentid != 0 )
	{
		$row = $db->getrow( "SELECT catname,html_dir FROM `".$db_mymps."channel` WHERE catid = '{$parentid}'" );
	}
	if ( $dir_type == 4 )
	{
		if ( !$mydir )
		{
			write_msg( "����д�Զ���Ŀ¼����" );
		}
		if ( $parentid == 0 )
		{
			$html_dir = "/".$mydir."/";
		}
		else
		{
			$html_dir = $row['html_dir'].$mydir."/";
		}
	}
	else if ( $parentid == 0 )
	{
		if ( $dir_type == 1 )
		{
			$html_dir = "/".$catid."/";
		}
		else if ( $dir_type == 2 )
		{
			$html_dir = "/".getpinyin( $catname )."/";
		}
		else if ( $dir_type == 3 )
		{
			$html_dir = "/".getpinyin( $catname, 1 )."/";
		}
	}
	else if ( $dir_type == 1 )
	{
		$html_dir = $row['html_dir'].$catid."/";
	}
	else if ( $dir_type == 2 )
	{
		$html_dir = $row['html_dir'].getpinyin( $catname )."/";
	}
	else if ( $dir_type == 3 )
	{
		$html_dir = $row['html_dir'].getpinyin( $catname, 1 )."/";
	}
	$sql = "UPDATE ".$db_mymps."channel SET catname='{$catname}',if_view='{$isview}',title='{$title}',color='{$fontcolor}',keywords='{$keywords}',description='{$description}',parentid='{$parentid}',catorder='{$catorder}',dir_type = '{$dir_type}', dir_typename = '{$mydir}', html_dir = '{$html_dir}' WHERE catid = '{$catid}'";
	$res = $db->query( $sql );
	$nav_path = "������Ŀ���� &raquo �༭��Ŀ";
	$message = "�ɹ��༭������Ŀ ".$catname;
	$after_action = "<a href='?part=add'><u>����������Ŀ</u></a>\r\n\t\t&nbsp;&nbsp;<a href='?part=edit&catid=".$catid."'><u>���±༭����Ŀ</u></a>&nbsp;&nbsp;<a href='?part=list#{$catid}'><u>��������Ŀ����</u></a>";
	foreach ( array( "option_static", "pid_releate" ) as $range )
	{
		clear_cache_files( "channel_".$range );
	}
	show_message( $nav_path, $message, $after_action );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
