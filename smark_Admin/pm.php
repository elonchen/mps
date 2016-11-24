<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function member_groups( )
{
	global $db;
	global $db_mymps;
	$all = $db->getall( "SELECT * FROM `".$db_mymps."member_level`" );
	foreach ( $all as $k => $v )
	{
		$mymps .= "<option value=".$v[id].">".$v[levelname]."</option>";
	}
	return $mymps;
}

define( "CURSCRIPT", "pm" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
require_once( MYMPS_MEMBER."/include/common.func.php" );
if ( !in_array( $part, array( "outbox", "send", "del" ) ) )
{
	$part = "send";
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_վ�ڶ���Ϣ" );
	$here = $part == "send" ? "Ⱥ������Ϣ" : "�ѷ��Ͷ���Ϣ";
	if ( $part == "outbox" )
	{
		$sql = "SELECT * FROM `".$db_mymps."member_pm` WHERE if_sys = '1' AND if_del = '0' ORDER BY id DESC";
		$rows_num = mymps_count( "member_pm", "WHERE if_sys = '1'" );
		$param = setparam( array( "part" ) );
		$pm = page1( $sql );
	}
	else if ( $part == "send" && $id )
	{
		$pm_row = $db->getrow( "SELECT title,content FROM `".$db_mymps."member_pm` WHERE id = '{$id}'" );
		$title = de_textarea_post_change( $pm_row['title'] );
		$content = de_textarea_post_change( $pm_row['content'] );
	}
	else if ( $part == "del" )
	{
		mymps_delete( "member_pm", "WHERE id = '".$id."'" );
		write_msg( "���Ϊ".$id."�Ķ���Ϣ�ѳɹ�ɾ����", $url, "writerecord" );
	}
	include( mymps_tpl( CURSCRIPT."_".$part ) );
}
else
{
	if ( is_array( $delids ) )
	{
		foreach ( $delids as $kids => $vids )
		{
			mymps_delete( "member_pm", "WHERE id = ".$vids );
		}
		write_msg( "ָ���Ķ���Ϣ�ѳɹ�ɾ����", $url );
	}
	set_time_limit( 0 );
	$content = textarea_post_change( $content );
	if ( empty( $touser ) || empty( $group ) )
	{
		exit( "��ָ�������û�����" );
	}
	echo "<style>*{font-size:12px}</style>";
	if ( is_array( $group ) )
	{
		foreach ( $group as $kid => $vid )
		{
			if ( !($rgrow = $db->getall( "SELECT userid FROM `".$db_mymps."member` WHERE levelid = '{$vid}'" ) ))
			{
				echo "�û�Ա������û�л�Ա��";
			}
			else
			{
				foreach ( $rgrow as $row )
				{
					$result = sendpm( $admin_id, $row[userid], $title, $content, 1 );
					if ( $result[succ] == "yes" )
					{
						echo "����״̬��<font color=green>���ͳɹ���</font> �����û���".$result[member]."<br>";
					}
					else
					{
						echo "����״̬��<font color=red>����ʧ�ܣ�</font> �����û���".$result[member]."<br>";
					}
					ob_flush( );
					flush( );
				}
			}
		}
	}
	else
	{
		$touser = str_replace( "��", ",", $touser );
		$touser = explode( ",", $touser );
		foreach ( $touser as $kuser => $vuser )
		{
			$result = sendpm( $admin_id, $vuser, $title, $content, 1 );
			echo "<style>*{font-size:12px}</style>";
			if ( $result[succ] == "yes" )
			{
				echo "����״̬��<font color=green>���ͳɹ���</font> �����û���".$result[member]."<br>";
			}
			else
			{
				echo "����״̬��<font color=red>����ʧ�ܣ�</font> �����û���".$result[member]."<br>";
			}
			ob_flush( );
			flush( );
		}
	}
	write_msg( "����Ϣ���ͽ���", "olmsg", "record" );
}
if ( is_object( $db ) )
{
	$db->Close();
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
