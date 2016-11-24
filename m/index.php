<?php

function errormsg( $error_msg )
{
    global $charset;
    global $mymps_global;
    global $cityid;
    echo "<?xml version=\"1.0\" encoding=\"".$charset."\"?>";
    include( mymps_tpl( "header_error" ) );
    echo "<div>".$error_msg."</div>";
    include( mymps_tpl( "footer_error" ) );
    exit( );
}

function redirectmsg( $redirectmsg, $url )
{
    global $charset;
    global $mymps_global;
    global $cityid;
    echo "<?xml version=\"1.0\" encoding=\"".$charset."\"?>";
    include( mymps_tpl( "header_error" ) );
    echo "<div>".$redirectmsg." <a href=\"".$url."\">�����ת</a></div>";
    include( mymps_tpl( "footer_error" ) );
    exit( );
}

function setparams( $param )
{
    foreach ( $param as $k => $v )
    {
        global $$v;
        $params .= $$v ? urlencode( $v )."=".$$v."&" : "";
    }
    return $params;
}

function pager( )
{
    global $page;
    global $totalpage;
    global $rows_num;
    global $param;
    if ( $totalpage == 1 && $page == 1 )
    {
        $nav = $rows_num."����¼";
        return $nav;
    }
    if ( $page - 1 < 1 )
    {
        $nav .= "<a href=\"javascript:void();\" class=\"pageprev pagedisable\">��һҳ</a>";
        $nav .= "<a class=\"pageno pagecur\">".$page."</a>";
        $nav .= ( ( "<a href=\"?".$param."page=".( $page + 1 ) )."\" class=\"pageno\">".( $page + 1 ) )."</a>";
        if ( $page + 1 < $totalpage )
        {
            $nav .= ( ( "<a href=\"?".$param."page=".( $page + 2 ) )."\" class=\"pageno\">".( $page + 2 ) )."</a>";
        }
    }
    else
    {
        $nav .= "<a href=\"?".$param."page=".( $page - 1 < 1 ? 1 : $page - 1 )."\" class=\"pageprev\">��һҳ</a>";
        if ( $totalpage == 3 && $page == 3 )
        {
            $nav .= ( ( "<a href=\"?".$param."page=".( $page - 2 ) )."\" class=\"pageno\">".( $page - 2 ) )."</a>";
        }
        $nav .= ( "<a href=\"?".$param."page=".( $page - 1 ) )."\" class=\"pageno\">".( $page - 1 < 1 ? 1 : $page - 1 )."</a>";
        $nav .= "<a class=\"pageno pagecur\">".$page."</a>";
        if ( $page < $totalpage )
        {
            $nav .= ( ( "<a href=\"?".$param."page=".( $page + 1 ) )."\" class=\"pageno\">".( $page + 1 ) )."</a>";
        }
    }
    if ( $page < $totalpage )
    {
        $nav .= ( "<a href=\"?".$param."page=".( $page + 1 ) )."\" class=\"pagenext\">��һҳ</a>";
        return $nav;
    }
    $nav .= "<a href=\"javascript:void();\" class=\"pagenext pagedisable\">��һҳ</a>";
    return $nav;
}

define( "WAP", true );
define( "CURSCRIPT", "wap" );
define( "IN_MYMPS", true );
define( "IN_SMT", true );
require_once( dirname( __FILE__ )."/../include/global.php" );
require_once( MYMPS_DATA."/config.php" );
require_once( MYMPS_DATA."/config.db.php" );
require_once( MYMPS_INC."/db.class.php" );
$mobile_settings = get_mobile_settings( );
if ( $mobile_settings['allowmobile'] != 1 )
{
    errormsg( "��վ�ֻ�����ͣ���ʣ�" );
}
if ( pcclient( ) )
{
    write_msg( "", $mymps_global['SiteUrl'] );
}
$lat = isset( $lat ) ? ( double )$lat : "";
$lng = isset( $lng ) ? ( double )$lng : "";
if ( $lat && $lng )
{
    $cityid = get_latlng2cityid( $lat, $lng );
}
$cityid = isset( $cityid ) ? intval( $cityid ) : mgetcookie( "cityid" );
if ( !in_array( $mod, array( "category", "index", "items", "information", "login", "openlogin", "myhome", "register", "mypost", "post", "search", "member", "shoucang", "history", "delete", "about", "changecity", "news", "corp", "store" ) ) )
{
    $mod = "index";
}
if ( $cityid )
{
    if ( !( $city = $db->getrow( "SELECT * FROM `".$db_mymps."city` WHERE cityid = '{$cityid}'" ) ) )
    {
        redirectmsg( "��ǰ��վ�����ڣ���ǰ��ѡ�����ķ�վ��", "index.php?mod=changecity" );
    }
    $city = get_city_caches( $cityid );
    msetcookie( "cityid", $cityid );
}
$s_uid = $iflogin = NULL;
include( MYMPS_INC."/member.class.php" );
$returnurl = urlencode( geturl( ) );
if ( $member_log->chk_in( ) )
{
    $iflogin = 1;
}
else
{
    $iflogin = 0;
}
include( MYMPS_ROOT."/m/include/inc_".$mod.".php" );
if ( is_object( $db ) )
{
    $db->close( );
}
$parent_cats = $loginfo = $newinfo = $mod = $ac = $mymps_global = $catid = $areaid = $db = $db_mymps = $mobile_settings = $member_log = NULL;
?>
