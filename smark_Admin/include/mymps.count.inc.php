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
$ele = array( "information" => "��Ϣ", "member" => "��Ա", "certify" => "��֤ ", "siteabout" => "վ��", "plugin" => "���" );
$element[information] = array( "��Ϣ" => array( "table" => "information", "url" => "information.php" ), "����" => array( "table" => "comment", "where" => "WHERE type = 'information'", "url" => "comment.php?part=information" ), "�ٱ�" => array( "table" => "info_report", "url" => "information.php?part=report" ) );
$element[member] = array( "����" => array( "table" => "member", "where" => "WHERE if_corp = '0' AND status = '1'", "url" => "member.php?if_corp=0" ), "�̼�" => array( "table" => "member", "where" => "WHERE if_corp = '1' AND status = '1'", "url" => "member.php?if_corp=1" ), "�����" => array( "table" => "member", "where" => "WHERE `status` = '0'", "url" => "member.php?part=verify&do_action=default" ), "��ֵ��¼" => array( "table" => "payrecord", "url" => "payrecord.php" ) );
$element[certify] = array( "ִ��" => array( "table" => "certification", "where" => "WHERE typeid = '1'", "url" => "certification.php?typeid=1" ), "���֤" => array( "table" => "certification", "where" => "WHERE typeid = '2'", "url" => "certification.php?typeid=2" ) );
$element[siteabout] = array( "����" => array( "table" => "announce", "url" => "announce.php" ), "����" => array( "table" => "faq", "url" => "faq.php" ), "����" => array( "table" => "flink", "url" => "friendlink.php" ) );
$element[plugin] = array( "����" => array( "table" => "news", "url" => "news.php" ), "�Ż�ȯ" => array( "table" => "coupon", "url" => "coupon_list.php" ), "�Ź�" => array( "table" => "group", "url" => "group_list.php" ), "����" => array( "table" => "group_signin", "url" => "group_signin.php" ), "��Ʒ" => array( "table" => "goods", "url" => "goods_list.php" ), "����" => array( "table" => "goods_order", "url" => "goods_order.php" ) );
if ( $mymps_global['cfg_if_corp'] != 1 )
{
	unset( $element[plugin]['�Ż�ȯ'] );
	unset( $element[plugin]['�Ź�'] );
	unset( $element[plugin]['��Ʒ'] );
	unset( $element[plugin]['����'] );
	unset( $element[plugin]['����'] );
	unset( $element[member]['�̼�'] );
	unset( $element[certify]['ִ��'] );
}
?>
