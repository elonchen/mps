<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "optimise" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
$step = array( "1" => "ɾ�����ڷ�����Ϣ", "2" => "ɾ�����������Ϣ", "3" => "ֻ������������µĻ�Ա��¼��¼", "4" => "ɾ���޽�����ѵĻ�Ա���Ѽ�¼", "5" => "ɾ��֧��ʧ�ܵĻ�Ա֧����¼", "6" => "ɾ��QQ��¼�������Ա�ʺ�", "7" => "ֻ����".$mymps_mymps['cfg_record_save']."������Ա��¼��¼", "8" => "ֻ����".$mymps_mymps['cfg_record_save']."������Ա������¼", "9" => "ɾ����Ա�Ѷ�����Ϣ", "10" => "ֻ����һ�����ڵ��ʼ����ͼ�¼", "11" => "Mysql���ݿ���Ż�" );
$here = "Mympsϵͳ�Ż�";
if ( $action == "dopost" )
{
	$steporder = $steporder ? mhtmlspecialchars( $steporder ) : array( );
	foreach ( $steporder as $k => $v )
	{
		$next .= $v == 1 ? $k."," : "";
	}
	$next = $next ? $next : ",";
}
else
{
	if ( $next && !intval( $next ) )
	{
		$finished = 1;
	}
}
include( mymps_tpl( CURSCRIPT ) );
if ( !empty( $next ) )
{
	$next = substr( $next, 0, -1 );
	$nextarr = explode( ",", $next );
	$nextid = $nextarr[0];
	$last .= $nextid.",";
	if ( !$nextarr[0] )
	{
		$finished = 1;
	}
	unset( $nextarr[0] );
	$next = implode( ",", $nextarr );
	$next .= ",";
	switch ( $nextid )
	{
		case "1" :
		$where = " WHERE endtime < '".$timestamp."' AND endtime != '0'";
		$query = $db->query( "SELECT id FROM ".$db_mymps."information {$where}" );
		while ( $post = $db->fetchrow( $query ) )
		{
			$ids .= $post['id'].",";
		}
		$selectedids = substr( $ids, 0, -1 );
		if ( $selectedids && $selectedids!=',')
		{
			$query = $db->query( "SELECT * FROM `".$db_mymps."information` WHERE id IN ({$selectedids})" );
			while ( $row = $db->fetchrow( $query ) )
			{
				@unlink( @MYMPS_ROOT.@$row['html_path'] );
			}
			mymps_delete( "information", "WHERE id IN(".$selectedids.")" );
			mymps_delete( "info_extra", "WHERE infoid IN (".$selectedids.")" );
			$query = $db->query( "SELECT * FROM `".$db_mymps."info_img` WHERE infoid IN ({$selectedids})" );
			while ( $row = $db->fetchrow( $query ) )
			{
				@unlink( @MYMPS_ROOT.@$row['imgpath'] );
				@unlink( @MYMPS_ROOT.@$row['pre_imgpath'] );
			}
			mymps_delete( "info_img", "WHERE infoid IN (".$selectedids.")" );
			mymps_delete( "comment", "WHERE typeid IN (".$selectedids.") AND type = 'information'" );
		}
		break;
		case "2" :
		$where = " WHERE info_level = '0'";
		$query = $db->query( "SELECT id FROM ".$db_mymps."information {$where}" );
		while ( $post = $db->fetchrow( $query ) )
		{
			$ids .= $post['id'].",";
		}
		$selectedids = substr( $ids, 0, -1 );
		if ( $selectedids && $selectedids!=',')
		{
			$query = $db->query( "SELECT * FROM `".$db_mymps."information` WHERE id IN ({$selectedids})" );
			while ( $row = $db->fetchrow( $query ) )
			{
				@unlink( @MYMPS_ROOT.@$row['html_path'] );
			}
			mymps_delete( "information", "WHERE id IN(".$selectedids.")" );
			mymps_delete( "info_extra", "WHERE infoid IN (".$selectedids.")" );
			$query = $db->query( "SELECT * FROM `".$db_mymps."info_img` WHERE infoid IN ({$selectedids})" );
			while ( $row = $db->fetchrow( $query ) )
			{
				@unlink( @MYMPS_ROOT.@$row['imgpath'] );
				@unlink( @MYMPS_ROOT.@$row['pre_imgpath'] );
			}
			mymps_delete( "info_img", "WHERE infoid IN (".$selectedids.")" );
			mymps_delete( "comment", "WHERE typeid IN (".$selectedids.") AND type = 'information'" );
		}
		break;
		case "3" :
		$monthdate = strtotime( "-2 month" );
		$db->query( "DELETE FROM `".$db_mymps."member_record_login` WHERE pubdate < '{$monthdate}'" );
		break;
		case "4" :
		$db->query( "DELETE FROM `".$db_mymps."member_record_use` WHERE paycost = '<font color=red>�۳���� 0 </font>'" );
		break;
		case "5" :
		$db->query( "DELETE FROM `".$db_mymps."payrecord` WHERE paybz = '�ȴ�֧��'" );
		break;
		case "6" :
		$db->query( "DELETE FROM `".$db_mymps."member` WHERE openid != '' AND userid != '' AND userpwd = ''" );
		break;
		case "7" :
		if ( $mymps_mymps['cfg_record_save'] )
		{
			$mymps_mymps['cfg_record_save'] = 100;
		}
		$total_count = mymps_count( "admin_record_login" );
		if ( $mymps_mymps['cfg_record_save'] <= $total_count )
		{
			$delrecord = $db->getall( "SELECT id FROM `".$db_mymps."admin_record_login` ORDER BY ID DESC LIMIT 1,".$mymps_mymps['cfg_record_save'] );
			foreach ( $delrecord as $k => $value )
			{
				$id .= $value[id].",";
			}
			$id = substr( $id, 0, -1 );
			mymps_delete( "admin_record_login", "WHERE id NOT IN (".$id.")" );
		}
		break;
		case "8" :
		if ( $mymps_mymps['cfg_record_save'] )
		{
			$mymps_mymps['cfg_record_save'] = 100;
		}
		$total_count = mymps_count( "admin_record_action" );
		if ( $mymps_mymps['cfg_record_save'] <= $total_count )
		{
			$delrecord = $db->getall( "SELECT id FROM `".$db_mymps."admin_record_action` ORDER BY ID DESC LIMIT 1,".$mymps_mymps['cfg_record_save'] );
			foreach ( $delrecord as $k => $value )
			{
				$id .= $value[id].",";
			}
			$id = substr( $id, 0, -1 );
			mymps_delete( "admin_record_action", "WHERE id NOT IN (".$id.")" );
		}
		break;
		case "9" :
		$db->query( "DELETE FROM `".$db_mymps."member_pm` WHERE if_read = '1'" );
		break;
		case "10" :
		$monthdate = strtotime( "-1 month" );
		$db->query( "DELETE FROM `".$db_mymps."mail_sendlist` WHERE last_send < '{$monthdate}' " );
		break;
		case "11" :
		$query = $db->query( "SHOW TABLE STATUS LIKE '".$db_mymps."%'", "SILENT" );
		while ( $table = $db->fetchrow( $query ) )
		{
			$db->query( "OPTIMIZE TABLE ".$table['Name'] );
		}
		break;
	}
	if ( $finished != 1 )
	{
		echo mymps_goto( "?last=".$last."&next=".$next );
		ob_flush( );
		flush( );
		sleep( 1 );
	}
	else
	{
		ob_end_flush( );
	}
}
if ( is_object( $db ) )
{
	$db->close( );
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
