<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function info_typemodels( $modid = "" )
{
	global $db;
	global $db_mymps;
	$sql = "SELECT id,name,displayorder FROM `".$db_mymps."info_typemodels` ORDER BY displayorder ASC";
	$opt = $db->getall( $sql );
	foreach ( $opt as $k => $value )
	{
		$mymps .= "<option value=\"".$value[id]."\"";
		$mymps .= $modid == $value[id] ? "selected style=\"background-color:#6EB00C;color:white\"" : "";
		$mymps .= ">".$value[name]."</option>";
	}
	return $mymps;
}

define( "CURSCRIPT", "category" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/color.inc.php" );
require_once( dirname( __FILE__ )."/include/ifview.inc.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
if ( $admin_cityid )
{
	write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
}
$part = $part ? $part : "list";
$cat_color = $color;
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	require_once( MYMPS_DATA."/html_type.inc.php" );
	if ( $part == "list" )
	{
		chk_admin_purview( "purview_��Ϣ����" );
		$f_cat = cat_list( "category", 0, 0, false );
		$here = "��Ϣ�����б�";
		include( mymps_tpl( "category_list" ) );
	}
	else
	{
		if ( $part == "edit" )
		{
			include( MYMPS_DATA."/category_tpl.inc.php" );
			include( MYMPS_DATA."/information_tpl.inc.php" );
			$cat = $db->getrow( "SELECT * FROM ".$db_mymps."category WHERE catid = '{$catid}'" );
			$here = "�༭��Ϣ����";
			$cat['description'] = $cat['description'] ? de_textarea_post_change( $cat['description'] ) : "";
			include( mymps_tpl( "category_edit" ) );
		}
		else
		{
			if ( $part == "add" )
			{
				include( MYMPS_DATA."/category_tpl.inc.php" );
				include( MYMPS_DATA."/information_tpl.inc.php" );
				chk_admin_purview( "purview_��ӷ���" );
				$maxorder = $db->getone( "SELECT MAX(catorder) FROM ".$db_mymps."category" );
				$maxorder += 1;
				$here = "�����Ϣ����";
				include( mymps_tpl( "category_add" ) );
			}
			else
			{
				if ( $part == "del" )
				{
					if ( empty( $catid ) )
					{
						write_msg( "û��ѡ���¼" );
					}
					mymps_delete( "category", "WHERE ".get_children( $catid, "catid" ) );
					mymps_delete( "information", "WHERE ".get_children( $catid, "catid" ) );
					clear_cache_files( "category_option_static" );
					clear_cache_files( "category_pid_releate" );
					clear_cache_files( "category_tree" );
					clear_cache_files( "category_dir" );
					write_msg( "ɾ����Ϣ���� ".$catid." �ɹ�", "category.php?part=list", "Mymps" );
				}
			}
		}
	}
}
else if ( $part == "list" )
{
	if ( is_array( $catorder ) )
	{
		foreach ( $catorder as $key => $value )
		{
			$db->query( "UPDATE `".$db_mymps."category` SET catorder = '{$value}' WHERE catid = ".$key );
		}
	}
	if ( is_array( $if_viewids ) )
	{
		$db->query( "UPDATE `".$db_mymps."category` SET if_view = '1' " );
		foreach ( $if_viewids as $key )
		{
			$db->query( "UPDATE `".$db_mymps."category` SET if_view = '2' WHERE catid = ".$key );
		}
	}
	else
	{
		$db->query( "UPDATE `".$db_mymps."category` SET if_view = '1' " );
	}
	foreach ( array( "option_static", "pid_releate", "tree", "dir" ) as $range )
	{
		clear_cache_files( "category_".$range );
	}
	write_msg( "��Ϣ������³ɹ���", "?part=list", "record" );
}
else if ( $part == "add" )
{
	$catname = explode( "\r\n", trim( $catname ) );
	$template = empty( $template ) ? "list" : trim( $template );
	$template_info = empty( $template_info ) ? "info" : trim( $template_info );
	$usecoin = isset( $usecoin ) ? intval( $usecoin ) : 0;
	if ( empty( $catname ) || !is_array( $catname ) )
	{
		write_msg( "����д��������" );
	}
	if ( empty( $catorder ) )
	{
		$sql = "SELECT MAX(catorder) FROM ".$db_mymps."category";
		$maxorder = $db->getone( $sql );
		$catorder = $maxorder;
	}
	if ( is_array( $catname ) )
	{
		foreach ( $catname as $key => $value )
		{
			$value = trim( $value );
			++$catorder;
			$len = strlen( $value );
			if ( 30 < $len )
			{
				write_msg( "������������2����30���ַ�֮��" );
			}
			$db->query( "INSERT INTO ".$db_mymps."category (catname,usecoin,if_view,parentid,modid,catorder,if_upimg,if_mappoint,dir_type,template,template_info) VALUES ('{$value}','{$usecoin}','{$isview}','{$parentid}','{$modid}','{$catorder}','{$if_upimg}','{$if_mappoint}','{$dir_type}','{$template}','{$template_info}')" );
			$insert_id = $db->insert_id( );
			if ( $parentid == 0 )
			{
				if ( $dir_type == 1 )
				{
					$html_dir = "/".$insert_id."/";
				}
				else
				{
					if ( $dir_type == 2 )
					{
						$html_dir = "/".getpinyin( $value )."/";
						$dir_typename = getpinyin( $value );
					}
					else
					{
						if ( $dir_type == 3 )
						{
							$html_dir = "/".getpinyin( $value, 1 )."/";
							$dir_typename = getpinyin( $value, 1 );
						}
					}
				}
			}
			else
			{
				$row = $db->getrow( "SELECT * FROM `".$db_mymps."category` WHERE catid = '{$parentid}'" );
				if ( $dir_type == 1 )
				{
					$html_dir = ( $row['html_dir'] ? $row['html_dir'] : "/" ).$insert_id."/";
				}
				else if ( $dir_type == 2 )
				{
					$html_dir = ( $row['html_dir'] ? $row['html_dir'] : "/" ).getpinyin( $value )."/";
					$dir_typename = getpinyin( $value );
				}
				else if ( $dir_type == 3 )
				{
					$html_dir = ( $row['html_dir'] ? $row['html_dir'] : "/" ).getpinyin( $value, 1 )."/";
					$dir_typename = getpinyin( $value, 1 );
				}
			}
			$db->query( "UPDATE `".$db_mymps."category` SET dir_typename='{$dir_typename}',html_dir = '{$html_dir}' WHERE catid = '{$insert_id}'" );
		}
		foreach ( array( "option_static", "pid_releate", "tree", "dir" ) as $range )
		{
			clear_cache_files( "category_".$range );
		}
		$nav_path = "��ҵ���� &raquo ���ӷ���";
		$message = "�ɹ����ӷ���";
		$after_action = "<a href='?part=add'><u>�������ӷ���</u></a>\r\n\t\t\t&nbsp;&nbsp;<a href='?part=list'><u>�����ӷ������</u></a>";
		show_message( $nav_path, $message, $after_action );
	}
	else
	{
		write_msg( "��Ϣ�������ʧ�ܣ��밴��ʽ��д" );
	}
}
else if ( $part == "edit" )
{
	$template = empty( $template ) ? "list" : trim( $template );
	$usecoin = isset( $usecoin ) ? intval( $usecoin ) : 0;
	if ( empty( $catname ) )
	{
		write_msg( "����д��Ϣ��������" );
	}
	if ( $catid == $parentid )
	{
		write_msg( "������Ϣ���಻��Ϊ�Լ���" );
	}
	$len = strlen( $catname );
	if ($len < 2 || 30 < $len )
	{
		write_msg( "��Ϣ������������2����30���ַ�֮��" );
	}
	if ( $parentid != 0 )
	{
		$row = $db->getrow( "SELECT catname,html_dir FROM `".$db_mymps."category` WHERE catid = '{$parentid}'" );
	}
	$description = $description ? textarea_post_change( $description ) : "";
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
		else
		{
			if ( $dir_type == 2 )
			{
				$html_dir = "/".getpinyin( $catname )."/";
			}
			else
			{
				if ( $dir_type == 3 )
				{
					$html_dir = "/".getpinyin( $catname, 1 )."/";
				}
			}
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
	if ( $mydir && 1 < $db->getone( "SELECT COUNT(catid) FROM `".$db_mymps."category` WHERE dir_typename = '{$mydir}' AND dir_typename != ''" ) )
	{
		write_msg( "��ָ����Ŀ¼��".$mydir."�Ѵ��ڣ��뻻һ�����ƣ�" );
		exit( );
	}
	$db->query( "UPDATE `".$db_mymps."information` SET dir_typename = '{$mydir}' WHERE catid = '{$catid}'" );
	$db->query( "UPDATE ".$db_mymps."category SET catname='{$catname}',icon='{$icon}',usecoin='{$usecoin}',if_view = '{$isview}',color='{$fontcolor}',title='{$title}',keywords='{$keywords}',description='{$description}',parentid='{$parentid}',modid='{$modid}',catorder='{$catorder}',dir_type = '{$dir_type}', dir_typename = '{$mydir}', html_dir = '{$html_dir}' ,if_upimg='{$if_upimg}',if_mappoint='{$if_mappoint}',template='{$template}',template_info='{$template_info}' WHERE catid = '{$catid}'" );
	if ( $children_mod == "1" )
	{
		$db->query( "UPDATE `".$db_mymps."category` SET modid = '{$modid}' WHERE ".get_children( $catid, "catid" ) );
	}
	if ( $children_tpl == "1" )
	{
		$db->query( "UPDATE `".$db_mymps."category` SET template = '{$template}' WHERE ".get_children( $catid, "catid" ) );
	}
	if ( $children_tplinfo == "1" )
	{
		$db->query( "UPDATE `".$db_mymps."category` SET template_info = '{$template_info}' WHERE ".get_children( $catid, "catid" ) );
	}
	if ( $children_upload == "1" )
	{
		$db->query( "UPDATE `".$db_mymps."category` SET if_upimg = '{$if_upimg}' WHERE ".get_children( $catid, "catid" ) );
	}
	if ( $children_map == "1" )
	{
		$db->query( "UPDATE `".$db_mymps."category` SET if_mappoint = '{$if_mappoint}' WHERE ".get_children( $catid, "catid" ) );
	}
	if ( $children_des == "1" )
	{
		$db->query( "UPDATE `".$db_mymps."category` SET description = '{$description}' WHERE ".get_children( $catid, "catid" ) );
	}
	if ( $children_usecoin == "1" )
	{
		$db->query( "UPDATE `".$db_mymps."category` SET usecoin = '{$usecoin}' WHERE ".get_children( $catid, "catid" ) );
	}
	foreach ( array( "option_static", "pid_releate", "tree", "dir" ) as $range )
	{
		clear_cache_files( "category_".$range );
	}
	$nav_path = "��ҵ���� &raquo �༭��ҵ";
	$message = "�ɹ��༭��Ϣ���� ".$catname;
	$after_action = "<a href='?part=add'><u>�������ӷ���</u></a>\r\n\t\t&nbsp;&nbsp;<a href='?part=edit&catid=".$catid."'><u>���±༭����ҵ</u></a>&nbsp;&nbsp;<a href='?part=list#{$catid}'><u>�����ӷ������</u></a>";
	show_message( $nav_path, $message, $after_action );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
