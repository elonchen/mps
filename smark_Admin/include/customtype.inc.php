<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

$customtypearr = array( );
$customtypearr['info'] = "������Ϣ";
if ( ifplugin( "news" ) )
{
	$customtypearr['news'] = "��վ����";
}
if ( $mymps_global['cfg_if_corp'] == 1 )
{
	$customtypearr['store'] = "�̼ҵ���";
}
if ( ifplugin( "goods" ) )
{
	$customtypearr['goods'] = "��Ʒ";
}
?>
