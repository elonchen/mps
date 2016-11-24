<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function bodyimg( $obj )
{
	if ( isset( $obj ) )
	{
		if ( preg_match( "<img.*src=[\"](.*?)[\"].*?>", $obj, $regs ) )
		{
			return $obj = $regs[1];
		}
	}else{
		return false;
	}
}

function mystripslashes( $string )
{
	if ( !is_array( $string ) )
	{
		return stripslashes( $string );
	}else{
		foreach ( $string as $key => $val )
		{
			$string[$key] = new_stripslashes( $val );
		}
		return $string;
	}
}

define( "CURSCRIPT", "news" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_DATA."/info.level.inc.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
$part = $part ? $part : "list";
$iscommend_arr = array( "0" => "����", "1" => "<font color=red>�Ƽ�</font>" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_���Ź���" );
	if ( $part == "list" )
	{
		$here = "��վ���Ź���";
		$where .= $title != "" ? "WHERE a.title LIKE '%".$title."%'" : "WHERE 1";
		$where .= $catid ? " AND a.catid IN (".get_cat_children( $catid, "channel" ).")" : "";
		$sql = "SELECT a.*,b.catname FROM `".$db_mymps."news` AS a LEFT JOIN `{$db_mymps}channel` AS b ON a.catid = b.catid {$where} ORDER BY a.begintime DESC";
		$rows_num = $db->getone( "SELECT COUNT(*) FROM `".$db_mymps."news` AS a {$where}" );
		$param = setparam( array( "part", "title", "catid" ) );
		$news = page1( $sql );
		include( mymps_tpl( "news_list" ) );
	}
	else if ( $part == "edit" && $id )
	{
		$row = $db->getrow( "SELECT * FROM ".$db_mymps."news WHERE id = '{$id}'" );
		$acontent = get_editor( "content", "Default", $row[content], "100%", "600px" );
		$here = "�༭����";
		include( mymps_tpl( CURSCRIPT ) );
	}
	else if ( $part == "add" )
	{
		$acontent = get_editor( "content", "Default", "", "100%", "600px" );
		$here = "�������";
		include( mymps_tpl( CURSCRIPT ) );
	}
	else if ( $part == "del" )
	{
		if ( empty( $id ) )
		{
			write_msg( "û��ѡ���¼" );
		}
		$html_path = $db->getone( "SELECT html_path FROM `".$db_mymps."news` WHERE id = '{$id}'" );
		@unlink( @MYMPS_ROOT.$html_path );
		mymps_delete( "news", "WHERE id = '".$id."'" );
		write_msg( "ɾ������ ".$id." �ɹ�", $url, "Mymps" );
	}
}
else
{
	if ( $part == "list" )
	{
		$i = "";
		if ( is_array( $delids ) )
		{
			$i = 1;
			foreach ( $delids as $kids => $vids )
			{
				$html_path = $db->getone( "SELECT html_path FROM `".$db_mymps."news` WHERE id = '{$vids}'" );
				@unlink( @MYMPS_ROOT.$html_path );
				mymps_delete( "news", "WHERE id = ".$vids );
			}
		}
		else
		{
			write_msg( "��û��ָ������ID" );
		}
		if ( $i == 1 )
		{
			write_msg( "ָ��������ID�Ѿ���ɾ����", $url, "insertecord" );
		}
	}
	else if ( $part == "add" )
	{
		if ( !$title )
		{
			write_msg( "����д���ű���" );
		}
		if ( !$catid )
		{
			write_msg( "����д��������" );
		}
		if ( $isjump == 1 && !$redirect_url )
		{
			write_msg( "������������ת��ַ!" );
		}
		if ( $isjump != 1 && !$content )
		{
			write_msg( "������������ת��ַ!" );
		}
		if ( $isjump == 1 )
		{
			$do_mymps = $db->query( "INSERT INTO `".$db_mymps."news` (title,cityid,catid,redirect_url,isjump,isbold,iscommend,begintime,introduction,author,source,keywords) VALUES ('{$title}','{$cityid}','{$catid}','{$redirect_url}','1','{$isbold}','{$iscommend}','{$timestamp}','{$introduction}','{$author}','{$from}','{$keywords}')" );
		}
		else
		{
			$redirect_url = "";
			if ( $ifout == "bodyimg" )
			{
				$imgpath = bodyimg( mystripslashes( $content ) );
			}
			$do_mymps = $db->query( "INSERT INTO `".$db_mymps."news` (title,cityid,keywords,catid,isbold,iscommend,content,hit,perhit,begintime,introduction,author,source,imgpath) VALUES\r\n('{$title}','{$cityid}','{$keywords}','{$catid}','{$isbold}','{$iscommend}','{$content}','{$hit}','{$perhit}','{$timestamp}','{$introduction}','{$author}','{$from}','{$imgpath}')" );
		}
		$id = $db->insert_id( );
		if ( is_array( $isfocus ) && $imgpath )
		{
			foreach ( $isfocus as $kfocus => $vfocus )
			{
				if ( $vfocus == "index" )
				{
					$typename = "��վ��ҳ";
				}
				else
				{
					$typename = "������ҳ";
				}
				$db->query( "INSERT INTO `".$db_mymps."focus` (image,pre_image,words,url,pubdate,focusorder,typename)\r\n\t\t\t\tVALUES('{$imgpath}','{$imgpath}','{$title}','{$viewpath}','{$timestamp}','{$id}','{$typename}')" );
			}
			clear_cache_files( "focus_index" );
			clear_cache_files( "focus_news" );
		}
		$nav_path = "���Ź��� &raquo ��������";
		$message = "�ɹ�����һƪ���� <<".$title.">>";
		$after_action = "<a href=\"../news.php?id=".$id.( "\" target=\"_blank\"><u>�鿴������</u></a>&nbsp;&nbsp;<a href='?part=add'><u>������������</u></a>&nbsp;&nbsp;<a href='?part=edit&id=".$id."'><u>���±༭������</u></a>&nbsp;&nbsp;<a href='?part=list'><u>���������Ź���</u></a>" );
		show_message( $nav_path, $message, $after_action );
	}
	else if ( $part == "edit" )
	{
		if ( !$id )
		{
			write_msg( "��δָ��Ҫ�༭������" );
		}
		if ( !$title )
		{
			write_msg( "����д���ű���" );
		}
		if ( !$catid )
		{
			write_msg( "����д��������" );
		}
		if ( $isjump == 1 && !$redirect_url )
		{
			write_msg( "������������ת��ַ!" );
		}
		if ( $isjump != 1 && !$content )
		{
			write_msg( "����д��������!" );
		}
		if ( $isjump == 1 )
		{
			$do_mymps = $db->query( "UPDATE `".$db_mymps."news` SET title = '{$title}' , redirect_url = '{$redirect_url}' , catid = '{$catid}', cityid = '{$cityid}' , keywords = '{$keywords}' , iscommend = '{$iscommend}' , isbold = '{$isbold}' , isjump = '1' , hit = '{$hit}' , perhit = '{$perhit}' , imgpath = '{$imgpath}' , author = '{$author}' , source = '{$from}' , introduction = '{$introduction}' WHERE id = '{$id}'" );
		}
		else
		{
			$redirect_url = "";
			if ( $ifout == "bodyimg" )
			{
				$imgpath = bodyimg( mystripslashes( $content ) );
			}
			$do_mymps = $db->query( "UPDATE `".$db_mymps."news` SET title = '{$title}', content = '{$content}', keywords = '{$keywords}' , catid = '{$catid}' , cityid = '{$cityid}' , iscommend = '{$iscommend}' , isbold = '{$isbold}' , isjump = '0' , hit = '{$hit}' , perhit = '{$perhit}' ,begintime = '{$timestamp}' , imgpath = '{$imgpath}' , author = '{$author}' , source = '{$from}' , introduction = '{$introduction}' WHERE id = '{$id}'" );
		}
		$viewpath = $mymps_global['SiteUrl']."/news.php?id=".$id;
		if ( is_array( $isfocus ) && $imgpath )
		{
			foreach ( $isfocus as $kfocus => $vfocus )
			{
				if ( $vfocus == "index" )
				{
					$typename = "��վ��ҳ";
				}
				else
				{
					$typename = "������ҳ";
				}
				$db->query( "INSERT INTO `".$db_mymps."focus` (image,pre_image,words,url,pubdate,focusorder,typename,cityid)\r\n\t\t\t\tVALUES('{$imgpath}','{$imgpath}','{$title}','{$viewpath}','{$timestamp}','{$id}','{$typename}','{$cityid}')" );
			}
			clear_cache_files( "focus_index" );
			clear_cache_files( "focus_news" );
		}
		$nav_path = "���Ź��� &raquo �޸�����";
		$message = "�ɹ��޸����� <<".$title.">>";
		$after_action = "<a href=".$viewpath.( " target=\"_blank\"><u>�鿴������</u></a>&nbsp;&nbsp;<a href='?part=add'><u>��Ҫ����һƪ����</u></a>&nbsp;&nbsp;<a href='?part=edit&id=".$id."'><u>���±༭������</u></a>&nbsp;&nbsp;<a href='?part=list'><u>���������Ź���</u></a>" );
		show_message( $nav_path, $message, $after_action );
	}
}
if ( is_object( $db ) )
{
	$db->close( );
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
