<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

$admin_menu[siteabout][name] = "վ ��";
$admin_menu[siteabout][style] = "home";
$admin_menu[siteabout][group][element]['��ҳ����ͼ']['����ͼ�б�'] = "focus.php";
$admin_menu[siteabout][group][element]['��ҳ����ͼ']['�ϴ�����ͼ'] = "focus.php?part=add";
$admin_menu[siteabout][group][element]['��վ����']['�ѷ�������'] = "announce.php";
$admin_menu[siteabout][group][element]['��վ����']['��������'] = "announce.php?part=add";
$admin_menu[siteabout][group][element]['��������']['��������'] = "friendlink.php";
$admin_menu[siteabout][group][element]['��������']['��������'] = "friendlink.php?part=add";
$admin_menu[siteabout][group][element]['����վ��']['����ٱ���'] = "lifebox.php";
$admin_menu[siteabout][group][element]['����վ��']['����绰'] = "telephone.php";
$admin_menu[info][name] = "�� Ϣ";
$admin_menu[info][style] = "";
$admin_menu[info][group][element]['��Ϣ���']['������Ϣ'] = "information.php";
$admin_menu[info][group][element]['��Ϣ���']['��������'] = "infomanage.php";
$admin_menu[info][group][element]['��Ϣ���']['��Ϣ�ٱ�'] = "information.php?part=report";
$admin_menu[member][name] = "�� Ա";
$admin_menu[member][style] = "";
$admin_menu[member][group][element]['��Ա����']['���˻�Ա'] = "member.php?if_corp=0";
$admin_menu[member][group][element]['��Ա����']['�̼һ�Ա'] = "member.php?if_corp=1";
$admin_menu[member][group][element]['��Ա����']['���ӻ�Ա'] = "member.php?part=add";
$admin_menu[member][group][element]['�������']['ʵ����֤'] = "certification.php?typeid=1";
$admin_menu[member][group][element]['�������']['վ�ڶ���Ϣ'] = "pm.php";
$admin_menu[sitesys][name] = "ϵ ͳ";
$admin_menu[sitesys][style] = "";
$admin_menu[sitesys][group][element]['����Ա']['�û��б�'] = "admin.php?do=user";
@include( dirname( __FILE__ )."/../../data/caches/pluginmenu_admin.php" );
if ( is_array( $data ) )
{
	$admin_menu[plugin][name] = "�� ��";
	$admin_menu[plugin][style] = "";
	unset( $data['�Ż�ȯ']['�Ż�ȯ����'] );
	unset( $data['�Ź�']['�Ź�����'] );
	unset( $data['������Ѷ'] );
	unset( $data['��Ʒ']['��Ʒ����'] );
	foreach ( $data as $key => $val )
	{
		$admin_menu[plugin][group][element][$key] = $val;
	}
	unset( $data );
}
$admin_menu[extend][name] = "�� չ";
$admin_menu[extend][style] = "";
$admin_menu[extend][group][element]['������չ']['������λ'] = "adv.php";
?>
