<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

if ( !defined( "IN_MYMPS" ) )
{
	exit( "FORBIDDEN" );
}
$ele = array( "information" => "��Ϣ", "member" => "��Ա", "siteabout" => "վ��", "plugin" => "���" );
$element[information] = array( "��Ϣ" => array( "table" => "information", "url" => "information.php", "where" => $admin_cityid ? "WHERE cityid = '{$admin_cityid}'" : "" ) );
$element[member] = array( "����" => array( "table" => "member", "where" => "WHERE if_corp = '0' AND status = '1'", "url" => "member.php?if_corp=0" ), "�̼�" => array( "table" => "member", "where" => $admin_cityid ? "WHERE cityid = '{$admin_cityid}' AND if_corp = '1' AND status = '1'" : "WHERE if_corp = '1' AND status = '1'", "url" => "member.php?if_corp=1" ), "�����" => array( "table" => "member", "where" => $admin_cityid ? "WHERE cityid = '{$admin_cityid}' AND `status` = '0'" : "WHERE `status` = '0'", "url" => "member.php?part=verify&do_action=default" ) );
$element[siteabout] = array( "����" => array( "table" => "announce", "url" => "announce.php", "where" => $admin_cityid ? "WHERE cityid = '{$admin_cityid}'" : "" ), "����" => array( "table" => "flink", "url" => "friendlink.php", "where" => $admin_cityid ? "WHERE cityid = '{$admin_cityid}'" : "" ) );
$element[plugin] = array( "�Ż�ȯ" => array( "table" => "coupon", "url" => "coupon_list.php", "where" => $admin_cityid ? "WHERE cityid = '{$admin_cityid}'" : "" ), "�Ź�" => array( "table" => "group", "url" => "group_list.php", "where" => $admin_cityid ? "WHERE cityid = '{$admin_cityid}'" : "" ), "��Ʒ" => array( "table" => "goods", "url" => "goods_list.php", "where" => $admin_cityid ? "WHERE cityid = '{$admin_cityid}'" : "" ) );
?>
