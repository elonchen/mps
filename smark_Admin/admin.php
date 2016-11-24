<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function get_admin_group( $typeid = "" )
{
	global $db;
	global $db_mymps;
	$admin = $db->getall( "SELECT * FROM `".$db_mymps."admin_type` ORDER BY id desc" );
	foreach ( $admin as $row )
	{
		$mymps .= "<option value=\"".$row[id]."\"";
		$mymps .= $typeid == $row[id] ? "selected style=\"background-color:#6EB00C;color:white\"" : "";
		$mymps .= ">".$row[typename]."</option>";
	}
	return $mymps;
}

define( "CURSCRIPT", "admin" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
switch ( $do )
{
	case "user" :
	$part = $part ? $part : "list";
	if ( $part == "list" )
	{
		chk_admin_purview( "purview_�û��б�" );
		var_dump($typeid);
		$where = $typeid ? "WHERE typeid = ".$typeid."" : "";
		$where .= $admin_cityid ? " AND a.cityid = '".$admin_cityid."'" : ($cityid ? " AND a.cityid = '".$cityid."'" : "");
		$sql = "SELECT a.id,a.userid,a.cityid,a.uname,a.tname,a.logintime,a.loginip,a.typeid,b.typename FROM `".$db_mymps."admin` AS a LEFT JOIN `{$db_mymps}admin_type` AS b ON a.typeid = b.id {$where} ORDER BY a.typeid Asc";
		$admin = $db->getall( $sql );
		$allcities = get_allcities( );
		$here = "����Ա�ʺŹ���";
		include( mymps_tpl( "admin_user" ) );
		break;
	}
	else
	{
		if ( $part == "add" )
		{
			chk_admin_purview( "purview_�û��б�" );
			$here = "������վ����Ա�ʺ�";
			include( mymps_tpl( "admin_user_add" ) );
			break;
		}
		else if ( $part == "insert" )
		{
			$pwd = md5( trim( $pwd ) );
			if ( !is_email( $email ) )
			{
				write_msg( "�����ʼ���ʽ����ȷ��" );
				exit( );
			}
			if ( 0 < mymps_count( "admin", "WHERE userid LIKE '".$userid."'" ) )
			{
			}
			$db->query( "INSERT INTO `".$db_mymps."admin`(userid,cityid,uname,tname,pwd,typeid,email)\r\n\t\t\t\tVALUES('{$userid}','{$cityid}','{$uname}','{$tname}','{$pwd}','{$typeid}','{$email}'); " );
			write_admin_cache( );
			write_msg( "��ӹ���Ա ".$userid." �ɹ�", "?do=user", "record" );
			break;
		}
		else if ( $part == "edit" )
		{
			$id = $id ? $id : $db->getone( "SELECT id FROM `".$db_mymps."admin` WHERE userid = '{$userid}'" );
			$sql = "SELECT * FROM ".$db_mymps."admin WHERE id = '{$id}'";
			$admin = $db->getrow( $sql );
			if ( !$admin )
			{
				write_msg( "�ù���Ա�ʺŲ����ڣ�" );
			}
			if ( $admin_cityid && $admin['cityid'] != $admin_cityid )
			{
				write_msg( "�ù���Ա�����������ķ�վ����֮��" );
			}
			$here = "�޸Ĺ���Ա�ʺ�";
			include( mymps_tpl( "admin_user_edit" ) );
			break;
		}
		else if ( $part == "update" )
		{
			if ( !is_email( $email ) )
			{
				write_msg( "�����ʼ���ʽ����ȷ��" );
				exit( );
			}
			$pwd = !empty( $pwd ) ? "pwd='".md5( $pwd )."'," : "";
			$db->query( "UPDATE ".$db_mymps."admin SET {$pwd} userid='{$userid}',cityid='{$cityid}',uname='{$uname}',typeid='{$typeid}',tname='{$tname}',email='{$email}' WHERE id = '{$id}'" );
			write_admin_cache( );
			write_msg( "��վ����Ա ".$uname." ���ĳɹ�", "admin.php?do=user&part=edit&id=".$id, "record" );
			break;
		}
		else if ( $part == "delete" )
		{
			if ( empty( $id ) )
			{
				write_msg( "û��ѡ���¼" );
				break;
			}
			else if ( mymps_delete( "admin", "WHERE id = '".$id."'" ) )
			{
				write_admin_cache( );
				write_msg( "ɾ������Ա ".$id." �ɹ�", "?do=user", "record" );
				break;
			}
			else
			{
				write_msg( "����Աɾ��ʧ�ܣ�" );
				break;
			}
		}
	}
	case "group" :
	if ( $admin_cityid )
	{
		write_msg( "��û��Ȩ�޷��ʸ�ҳ��" );
	}
	require_once( dirname( __FILE__ )."/include/mymps.menu.inc.php" );
	$part = $part ? $part : "list";
	if ( $part == "list" )
	{
		chk_admin_purview( "purview_�û���" );
		$sql = "SELECT * FROM ".$db_mymps."admin_type ORDER BY id desc";
		$group = $db->getall( $sql );
		$here = "ϵͳ�û������";
		include( mymps_tpl( "admin_group" ) );
	}
	else if ( $part == "add" )
	{
		chk_admin_purview( "purview_�û���" );
		$here = "�����û���";
		include( mymps_tpl( "admin_group_add" ) );
	}
	else if ( $part == "insert" )
	{
		$purview = is_array( $purview ) ? implode( ",", $purview ) : "";
		$typename = trim( $typename );
		$ifsystem = trim( $ifsystem );
		if ( empty( $typename ) )
		{
			$sql = "select count(*) from ".$db_mymps."admin_type where typename = '{$typename}'";
			if ( $db->getone( $sql ) )
			{
			}
		}
		$res = $db->query( "Insert Into `".$db_mymps."admin_type`(id,typename,ifsystem,purviews)\r\n\t\t\t\tValues('','{$typename}','{$ifsystem}','{$purview}')" );
		write_admin_cache( );
		write_msg( "����û��� ".$typename." �ɹ�", "?do=group", "record" );
	}
	else if ( $part == "edit" )
	{
		$sql = "SELECT * FROM ".$db_mymps."admin_type WHERE id = '{$id}'";
		$group = $db->getrow( $sql );
		$purview = explode( ",", $group['purviews'] );
		$here = "�޸��û���Ȩ��";
		include( mymps_tpl( "admin_group_edit" ) );
	}
	else if ( $part == "update" )
	{
		$purview = is_array( $purview ) ? implode( ",", $purview ) : "";
		$sql = "UPDATE `".$db_mymps."admin_type` SET typename='{$typename}',ifsystem='{$ifsystem}',purviews='{$purview}' WHERE id = '{$id}'";
		if ( $res = $db->query( $sql ) )
		{
			write_admin_cache( );
			write_msg( "�û��� ".$typename." �޸ĳɹ�", "?do=group&part=edit&id=".$id, "record" );
		}
	}
	else if ( $part == "delete" )
	{
		if ( empty( $id ) )
		{
			write_msg( "û��ѡ���¼" );
		}
		else if ( 0 < mymps_count( "admin", "WHERE typeid = '".$id."'" ) )
		{
			write_msg( "���û��������г�Ա������ɾ����" );
		}
		else if ( mymps_delete( "admin_type", "WHERE id = '".$id."'" ) )
		{
			write_admin_cache( );
			write_msg( "ɾ���û��� ".$id." �ɹ�", "?do=group", "record" );
		}
		else
		{
			write_msg( "����Ա�û���ɾ��ʧ�ܣ�" );
		}
	}
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
