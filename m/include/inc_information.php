<?php

if ( CURSCRIPT != "wap" )
{
    exit( "FORBIDDEN" );
}
$id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : "";
if ( !$id )
{
    errormsg( "��Ϣ����ID����Ϊ�գ�" );
}
if ( !( $row = $db->getrow( "SELECT * FROM `".$db_mymps."information` WHERE id = '{$id}' AND info_level >= 1" ) ) )
{
    errormsg( "����Ϣ����δͨ����˻򲻴��ڣ�" );
}
$city = $db->getrow( "SELECT * FROM `".$db_mymps."city` WHERE cityid = {$row['cityid']}" );
$row['endtime'] = get_info_life_time( $row['endtime'] );
$row['contactview'] = $row['endtime'] == "<font color=red>�ѹ���</font>" && $mymps_global['cfg_info_if_gq'] != 1 ? 0 : 1;
$rowr = $db->getrow( "SELECT catid,parentid,catname,template_info,modid,usecoin FROM `".$db_mymps."category` WHERE catid = '{$row['catid']}'" );
$row['catid'] = $rowr['catid'];
$row['parentid'] = $rowr['parentid'];
$row['catname'] = $rowr['catname'];
$row['template_info'] = $rowr['template_info'];
$row['modid'] = $rowr['modid'];
$row['usecoin'] = $rowr['usecoin'];
$row['image'] = 0 < $row['img_count'] ? $db->getall( "SELECT prepath,path FROM `".$db_mymps."info_img` WHERE infoid = '{$id}' ORDER BY id DESC" ) : false;
if ( 1 < $rowr['modid'] )
{
    $extr = $db->getrow( "SELECT * FROM `".$db_mymps."information_{$rowr[modid]}` WHERE id ='{$id}'" );
    if ( $extr )
    {
        $des = get_info_option_array( );
        unset( $extr->'iid' );
        unset( $extr->'id' );
        unset( $extr->'content' );
        foreach ( $extr as $k => $v )
        {
            $val = get_info_option_titval( $des[$k], $v );
            $arr['title'] = $val['title'];
            $arr['value'] = $val['value'];
            $row['extra'][] = $arr;
            $row[$k] = $v;
        }
        $des = NULL;
    }
}
$relevant = mymps_get_infos( 6, "", "", "", $row['catid'], "", "", "", false );
$parentcats = get_parent_cats( "category", $row['catid'] );
$parentcats = is_array( $parentcats ) ? array_reverse( $parentcats ) : "";
include( mymps_tpl( "info" ) );
?>
