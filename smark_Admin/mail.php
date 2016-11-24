<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

define( "CURSCRIPT", "mail" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
require_once( MYMPS_INC."/email.fun.php" );
if ( !in_array( $part, array( "setting", "template", "sendlist" ) ) || !$part )
{
    $part = "setting";
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{	
	switch ( $part )
	{
		case "setting" :
		chk_admin_purview( "purview_�ʼ�������" );
		$here = "�ʼ�����������";
		$res = $db->query( "SELECT description,value FROM ".$db_mymps."config WHERE type='mail'" );
		while ( $row = $db->fetchrow( $res ) )
		{
			$mail_config[$row['description']] = $row['value'];
		}
		break;
		case "sendlist" :
		chk_admin_purview( "purview_�ʼ����ͼ�¼" );
		$here = "�ʼ����ͼ�¼";
		$list = $db->getall( "SELECT * FROM `".$db_mymps."mail_sendlist` ORDER BY last_send DESC" );
		break;
		default :
		chk_admin_purview( "purview_�ʼ�ģ��" );
		$here = "�ʼ�ģ�����";
		$tpl = mail_template_list( );
		if ( $template_id )
		{
			$edit = $db->getrow( "SELECT * FROM `".$db_mymps."mail_template` WHERE template_id = '{$template_id}'" );
		}
		break;
	}
	include( mymps_tpl( CURSCRIPT."_".$part ) );
}
else
{
	if ($part == "test" )
	{
		if ( !empty( $test_mail )) {

			$test_mail = trim( $test_mail );
			if ( !send_email( $test_mail, "����".$mymps_global[SiteName]."�Ĳ����ʼ�", "������յ�������ʼ�����������Ѿ��ɹ����������������������ʱ�䣺".gettime( time( ) ) ) )
			{
				write_msg( "�����ʼ�����ʧ�ܣ�����ϸ���ú����������Ϣ", "?part=setting" );
			}
			else
			{
				write_msg( "��ϲ�����Ѿ��ɹ����������ʼ�", "?part=setting", "write_record" );
			}
		}else{
			write_msg( "����д�ʼ���ַ", "?part=setting", "write_record" );
		}
	}
	if ( $part == "setting" )
	{
		$des = array( "mail_service", "smtp_server", "smtp_serverport", "smtp_mail", "mail_user", "mail_pass" );
		mymps_delete( "config", "WHERE type = 'mail'" );
		foreach ( $des as $key )
		{
			$db->query( "INSERT ".$db_mymps."config (description,value,type) VALUES ('{$key}','".trim( $$key )."','mail')" );
		}
		clear_cache_files( "mail_config" );
		write_msg( "�ʼ��������������óɹ���", "?part=".$part, "WriteRecord" );
	}
	else if ( $part == "template" )
	{
		$return_url = "?part=template";
		if ( is_array( $delids ) )
		{
			foreach ( $delids as $kids => $vids )
			{
				mymps_delete( "mail_template", "WHERE template_id = ".$vids );
			}
		}
		if ( is_array( $add ) && $add[template_subject] && $add[template_code] )
		{
			if ( $db->getone( "SELECT template_id FROM `".$db_mymps."mail_template` WHERE template_code = '{$add['template_code']}'" ) )
			{
				write_msg( "����д��ģ���ʶ���ظ��ˣ�" );
			}
			else
			{
				$db->query( "INSERT `".$db_mymps."mail_template` (template_subject,template_code,is_html,is_sys,last_modify)VALUES('{$add['template_subject']}','{$add['template_code']}','{$add['is_html']}','{$add['is_sys']}','".time( )."')" );
			}
		}
		if ( is_array( $edit ) && $edit[template_id] && $edit[template_subject] && $edit[template_code] && $edit[template_content] )
		{
			$db->query( "UPDATE `".$db_mymps."mail_template` SET template_subject = '{$edit['template_subject']}', template_code = '{$edit['template_code']}' , is_html  = '{$edit['is_html']}' , template_content = '{$edit['template_content']}' , last_modify = '".time( ).( "'  WHERE template_id = '".$edit['template_id']."'" ) );
			$return_url = "?part=template&template_id=".$edit[template_id];
		}
		clear_cache_files( "mail_template" );
		write_msg( "�ʼ�ģ�����ӻ���³ɹ���", $return_url, "write_record" );
	}
	else if ( $part == "sendlist" )
	{
		$return_url = "?part=sendlist";
		if ( is_array( $delids ) )
		{
			foreach ( $delids as $kids => $vids )
			{
				mymps_delete( "mail_sendlist", "WHERE id = ".$vids );
			}
		}
		write_msg( "�ɹ�ɾ���ʼ����ͼ�¼��", $return_url, "write_record" );
	}
}
if ( is_object( $db ) )
{
	$db->Close();
}
$mymps_global = $db = $db_mymps = $part = NULL;
?>
