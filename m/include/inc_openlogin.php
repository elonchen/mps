<?php

if ( CURSCRIPT != "wap" )
{
    exit( "FORBIDDEN" );
}
$url = isset( $url ) ? strip_tags( $url ) : "";
$action = isset( $action ) ? trim( $action ) : "";
if ( !submit_check( "log_submit" ) )
{
    if ( !in_array( $action, array( "bind", "reg" ) ) )
    {
        $action = "reg";
    }
    session_start( );
    if ( empty( $_SESSION['nickname'] ) || empty( $_SESSION['openid'] ) )
    {
        redirectmsg( "session�ỰʧЧ�������µ�½��", $mymps_global[SiteUrl]."/include/qqlogin/qq_login.php" );
    }
    $nickname = $_SESSION['nickname'];
    $figureurl_qq_1 = $_SESSION['figureurl_qq_1'];
    $mixcode = md5( $cookiepre );
}
else
{
    if ( !in_array( $action, array( "bind", "reg" ) ) )
    {
        redirectmsg( "���������·����ȷ!", "olmsg" );
    }
    session_start( );
    $openid = mhtmlspecialchars( $_SESSION['openid'] );
    $cname = mhtmlspecialchars( $_SESSION['nickname'] );
    if ( $action == "bind" )
    {
        if ( empty( $cname ) || empty( $openid ) )
        {
            redirectmsg( "��¼״̬�ѳ�ʱ�������µ�½��", $mymps_global[SiteUrl]."/include/qqlogin/qq_login.php" );
        }
        $userid = isset( $_POST['bind_userid'] ) ? mhtmlspecialchars( trim( $_POST['bind_userid'] ) ) : "";
        $userpwd = isset( $_POST['bind_userpwd'] ) ? mhtmlspecialchars( trim( $_POST['bind_userpwd'] ) ) : "";
        $bind_userid = isset( $_POST['bind_userid'] ) ? mhtmlspecialchars( $_POST['bind_userid'] ) : "";
        $bind_userpwd = isset( $_POST['bind_userpwd'] ) ? mhtmlspecialchars( $_POST['bind_userpwd'] ) : "";
        $mixcode = isset( $_POST['mixcode'] ) ? mhtmlspecialchars( $_POST['mixcode'] ) : "";
        if ( !$mixcode && $mixcode != md5( $cookiepre ) )
        {
            errormsg( "ϵͳ�ж�������·����ȷ����" );
        }
        if ( empty( $bind_userid ) || empty( $bind_userpwd ) )
        {
            redirectmsg( "ԭ�û�����ԭ�������벻��Ϊ��", "index.php?mod=openlogin&action=bind" );
        }
        if ( !$db->getone( "SELECT id  FROM `".$db_mymps."member` WHERE userid = '{$userid}' AND userpwd = '".md5( $userpwd )."'" ) )
        {
            redirectmsg( "ԭ�ʺŻ��������벻��ȷ���뷵����������!", "index.php?mod=openlogin&action=bind" );
        }
        $db->query( "DELETE FROM `".$db_mymps."member` WHERE openid = '{$openid}'" );
        $db->query( "UPDATE `".$db_mymps."member` SET openid = '{$openid}' WHERE userid = '{$userid}'" );
        $bind_userid = $bind_userpwd = $qqlogin = NULL;
        $member_log->in( $userid, md5( $userpwd ), "off", "noredirect" );
        @session_unregister( "openid" );
        @session_unregister( "nickname" );
        @session_unregister( "access_token" );
        @session_unregister( "appid" );
        redirectmsg( "��ϲ! �󶨳ɹ�", "index.php?mod=member" );
    }
    else if ( $action == "reg" )
    {
        $userid = isset( $_POST['userid'] ) ? mhtmlspecialchars( trim( $_POST['userid'] ) ) : "";
        $email = isset( $_POST['email'] ) ? mhtmlspecialchars( trim( $_POST['email'] ) ) : "";
        $userpwd = isset( $_POST['userpwd'] ) ? mhtmlspecialchars( md5( trim( $_POST['userpwd'] ) ) ) : "";
        if ( $userid == "" )
        {
            redirectmsg( "����д���ĵ�¼�û���", "index.php?mod=openlogin" );
        }
        if ( $email == "" )
        {
            redirectmsg( "����д���ĵ��������ʺ�", "index.php?mod=openlogin" );
        }
        if ( $userpwd == "" )
        {
            redirectmsg( "����д���ĵ�¼����", "index.php?mod=openlogin" );
        }
        $reg_corp = 0;
        $rs = checkuserid( $userid, "�û���" );
        if ( $rs != "ok" )
        {
            redirectmsg( $rs, "index.php?mod=openlogin" );
        }
        if ( 20 < strlen( $userid ) )
        {
            redirectmsg( "�����û�������20���ַ���������ע��!", "index.php?mod=openlogin" );
        }
        if ( strlen( $userpwd ) < 5 )
        {
            redirectmsg( "����û������������(��������3���ַ�)��������ע��!", "index.php?mod=openlogin" );
        }
        if ( !is_email( $email ) )
        {
            redirectmsg( "Email��ʽ����ȷ��", "index.php?mod=openlogin" );
        }
        if ( $db->getone( "SELECT id FROM `".$db_mymps."member` WHERE userid = '{$userid}' AND openid = ''" ) )
        {
            redirectmsg( "��ָ�����û��� {\$userid} �Ѵ��ڣ���ʹ�ñ���û���!", "index.php?mod=openlogin" );
        }
        $userpwd = md5( $userpwd );
        $db->query( "UPDATE `".$db_mymps."member` SET jointime='{$timestamp}',logintime='{$timestamp}',userpwd = '{$userpwd}',email='{$email}' WHERE userid = '{$userid}' " );
        @session_unregister( "openid" );
        @session_unregister( "nickname" );
        @session_unregister( "access_token" );
        @session_unregister( "appid" );
        $member_log->in( $userid, $userpwd, "off", "noredirect" );
        redirectmsg( "��ϲ! ���Ѿ�ע��ɹ�", "index.php?mod=member" );
    }
}
include( mymps_tpl( "member_openlogin" ) );
?>
