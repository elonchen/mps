<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function get_color_options( $tcolor = "" )
{
	global $color;
	foreach ( $color as $k => $v )
	{
		$mymps .= "<option value=".$k." style=background-color:".$k;
		if ( $k == $tcolor )
		{
			$mymps .= " selected";
		}
		$mymps .= ">".$v."</option>";
	}
	return $mymps;
}

$color = array( "#ff0000" => "��ɫ", "#006ffd" => "����", "#444444" => "ǳ��", "#000000" => "��ɫ", "#46a200" => "��ɫ", "#ff9900" => "��ɫ", "#ffffff" => "��ɫ" );
?>
