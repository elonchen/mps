<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function get_style_forminput( $code = "", $array = "" )
{
	$title = is_array( $array ) ? $array['title'] : "";
	$url = is_array( $array ) ? $array['url'] : "";
	$link = is_array( $array ) ? $array['link'] : "";
	$size = is_array( $array ) ? $array['size'] : "";
	$width = is_array( $array ) ? $array['width'] : "";
	$height = is_array( $array ) ? $array['height'] : "";
	$alt = is_array( $array ) ? $array['alt'] : "";
	$vbm_style_form = array( "code" => "\r\n\t\t\t<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"vbm\">\r\n\t\t\t<tr class=\"firstr\"><td colspan=\"2\">HTML ����</td></tr>\r\n\t\t\t<tr><td width=\"45%\" bgcolor=\"white\" valign=\"top\">��� HTML ����:<br /><i style=\"color:#666\">��ֱ��������Ҫչ�ֵĹ��� HTML ����</i></td><td bgcolor=\"white\"><textarea  rows=\"10\" name=\"advnew[code][html]\" id=\"advnew[code][html]\" cols=\"50\">".$code."</textarea></td></tr>\r\n\t\t\t</table>", "text" => "\r\n\t\t\t<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"vbm\">\r\n\t\t\t<tr class=\"firstr\"><td colspan=\"2\">���ֹ��</td></tr>\r\n\t\t\t<tr><td width=\"45%\" bgcolor=\"white\" >��������(<font color=\"red\">*����</font>):<br /><i style=\"color:#666\">���������ֹ�����ʾ����</i></td><td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[text][title]\" value=\"".$title."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t<tr>\r\n\t\t\t<td width=\"45%\" bgcolor=\"white\" >��������(<font color=\"red\">*����</font>):<br /><i style=\"color:#666\">���������ֹ��ָ��� URL ���ӵ�ַ</i></td><td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[text][link]\" value=\"".$link."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t<tr>\r\n\t\t\t<td width=\"45%\" bgcolor=\"white\" >���ִ�С(ѡ��):<br /><i style=\"color:#666\">���������ֹ���������ʾ���壬��ʹ�� pt��px��em Ϊ��λ</i></td>\r\n\t\t\t<td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[text][size]\" value=\"".$size."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t</table>", "image" => "\r\n\t\t\t<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"vbm\">\r\n\t\t\t<tr class=\"firstr\"><td colspan=\"2\">ͼƬ���</td></tr>\r\n\t\t\t<tr><td width=\"45%\" bgcolor=\"white\" >ͼƬ��ַ(<font color=\"red\">*����</font>):<br /><i style=\"color:#666\">������ͼƬ����ͼƬ���õ�ַ</i></td><td bgcolor=\"white\">\r\n\t<input name=\"advnew[image][url]\" id=imgsrc type=\"text\" class=\"text\" value=\"".$url."\"/> \r\n\t<label><input type=\"radio\" onclick='document.getElementById(\"iframe\").style.display = \"none\";' name=\"ifout\" value=\"no\" checked=\"checked\" class=\"radio\"/>Զ��ͼƬ</label>\r\n\t<label><input type=\"radio\" onclick='document.getElementById(\"iframe\").style.display = \"block\";' name=\"ifout\" value=\"yes\" class=\"radio\"/>�����ϴ�</label>\r\n\t<iframe src=\"include/upfile.php?watermark=0&adv=1\" width=\"450\" frameborder=\"0\" scrolling=\"no\" onload=\"this.height=iFrame1.document.body.scrollHeight\" id=\"iframe\" style=\"display:none; margin-top:10px\"></iframe>\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t<tr>\r\n\t\t\t<td width=\"45%\" bgcolor=\"white\" >ͼƬ����(<font color=\"red\">*����</font>):<br /><i style=\"color:#666\">������ͼƬ���ָ��� URL ���ӵ�ַ</i></td>\r\n\t\t\t<td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[image][link]\" value=\"".$link."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t<tr>\r\n\t\t\t<td width=\"45%\" bgcolor=\"white\" >ͼƬ���(ѡ��):<br /><i style=\"color:#666\">������ͼƬ���Ŀ�ȣ���λΪ����</i></td>\r\n\t\t\t<td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[image][width]\" value=\"".$width."\" ></td>\r\n\t\t\t</tr>\r\n\t\t\t<tr><td width=\"45%\" bgcolor=\"white\" >ͼƬ�߶�(ѡ��):<br /><i style=\"color:#666\">������ͼƬ���ĸ߶ȣ���λΪ����</i></td><td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[image][height]\" value=\"".$height."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t<tr>\r\n\t\t\t<td width=\"45%\" bgcolor=\"white\" >ͼƬ�滻����(ѡ��):<br /><i style=\"color:#666\">������ͼƬ���������ͣ������Ϣ</i></td><td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[image][alt]\" value=\"".$alt."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t</table>", "flash" => "\r\n\t\t\t<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"vbm\">\r\n\t\t\t<tr class=\"firstr\"><td colspan=\"2\">Flash ���</td></tr>\r\n\t\t\t<tr><td width=\"45%\" bgcolor=\"white\" >Flash ��ַ(<font color=\"red\">*����</font>):<br /><i style=\"color:#666\">������ Flash ���ĵ��õ�ַ</i></td>\r\n\t\t\t<td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[flash][url]\" value=\"".$url."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t<tr>\r\n\t\t\t<td width=\"45%\" bgcolor=\"white\">Flash ���(<font color=\"red\">*����</font>):<br /><i style=\"color:#666\">������ Flash ���Ŀ�ȣ���λΪ����</i></td>\r\n\t\t\t<td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[flash][width]\" value=\"".$width."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t<tr>\r\n\t\t\t<td width=\"45%\" bgcolor=\"white\" >Flash �߶�(<font color=\"red\">*����</font>):<br /><i style=\"color:#666\">������ Flash ���ĸ߶ȣ���λΪ����</i></td>\r\n\t\t\t<td bgcolor=\"white\"><input class=\"text\" type=\"text\" size=\"50\" name=\"advnew[flash][height]\" value=\"".$height."\" >\r\n\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t</table>" );
	foreach ( $vbm_style_form as $ktypeform => $vform )
	{
		$mymps .= "<div id=\"style_".$ktypeform."\" style=\"";
		if ( is_array( $array ) )
		{
			$mymps .= $array['style'] == $ktypeform ? "display:yes" : "display:none";
		}
		else
		{
			$mymps .= $array == $ktypeform ? "display:yes" : "display:none";
		}
		$mymps .= "\" class=\"maintablediv\">";
		$mymps .= $vform;
		$mymps .= "</div>";
	}
	return $mymps;
}

function get_adv_style( $style = "", $formname = "style" )
{
	global $vbm_adv_style;
	$vbm_adv_style_form = "<select name='".$formname."' id='{$formname}' style=\"vertical-align: middle\" onchange=\"var styles, key;styles=new Array('code','text','image','flash'); for(key in styles) {var obj=\$obj('style_'+styles[key]); obj.style.display=styles[key]==this.options[this.selectedIndex].value?'':'none';}\">";
	foreach ( $vbm_adv_style as $k => $v )
	{
		if ( $k == $style && $k != "" )
		{
			$vbm_adv_style_form .= "<option value='".$k."' selected style='background-color:#6EB00C;color:white'>{$v}</option>\r\n";
		}
		else
		{
			$vbm_adv_style_form .= "<option value='".$k."'>{$v}</option>\r\n";
		}
	}
	$vbm_adv_style_form .= "</select>\r\n";
	return $vbm_adv_style_form;
}

function get_adv_option( $type = "", $formname = "type" )
{
	global $vbm_adv_type;
	$vbm_adv_type_form = "<select name='".$formname."' id='{$formname}' onchange=\"if(this.options[this.selectedIndex].value) {this.form.submit()}\" style=\"vertical-align: middle\">";
	$vbm_adv_type_form .= "<option value='' selected>��ѡ��������</option>\r\n";
	foreach ( $vbm_adv_type as $k => $v )
	{
		if ( $k == $type && $k != "" )
		{
			$vbm_adv_type_form .= "<option value='".$k."' selected style='background-color:#6EB00C;color:white'>{$v['name']}</option>\r\n";
		}
		else
		{
			$vbm_adv_type_form .= "<option value='".$k."'>{$v['name']}</option>\r\n";
		}
	}
	$vbm_adv_type_form .= "</select>\r\n";
	return $vbm_adv_type_form;
}

function get_infoad_target( $selected )
{
	$category_cache = get_categories_tree( "", "category" );
	$option .= "<option value='all' ";
	$option .= $selected[0] == "all" ? " selected " : "";
	$option .= ">ȫ��</option>";
	foreach ( $category_cache as $k => $v )
	{
		$option .= "<optgroup label='".$v['catname']."'>";
		if ( $v['children'] )
		{
			foreach ( $v['children'] as $child )
			{
				$option .= "<option value=".$child['catid'];
				$option .= is_array( $selected ) && in_array( $child[catid], $selected ) ? " selected" : "";
				$option .= ">".$child['catname']."</option>";
			}
		}
		$option .= "</optgroup>";
	}
	return $option;
}

define( "CURSCRIPT", "advertisement" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( MYMPS_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/adv.inc.php" );
$part = $part ? $part : "list";
$cityid = isset( $cityid ) ? intval( $cityid ) : 0;
if ( !defined( "IN_ADMIN" ) || !defined( "IN_MYMPS" ) )
{
	exit( "Access Denied" );
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_������λ" );
	if ( $part == "intro" )
	{
		$here = "���λ��ϸ����";
	}
	else if ( $part == "add" )
	{
		$here = "���ӹ��";
	}
	else if ( $part == "edit" )
	{
		$here = "����޸�";
		if ( !( $edit = $db->getrow( "SELECT * FROM `".$db_mymps."advertisement` WHERE advid = ".$advid ) ) )
		{
            write_msg( "��ǰ��治���ڣ�" );
		}
		$edit['targets'] = explode( "\t", $edit['targets'] );
		$adv_style = $charset == "gb2312" ? unserialize( $edit[parameters] ) : utf8_unserialize( $edit[parameters] );
	}
	else
	{
		$here = "������";
		$where = $type ? " AND type = '".$type."'" : "";
		$where .= $admin_cityid ? " AND cityid = '".$admin_cityid."'" : " AND cityid = '".$cityid."'";
		$rows_num = mymps_count( CURSCRIPT, "WHERE 1".$where );
		$param = setparam( array( "part", "type", "cityid" ) );
		$adv = array( );
		$adv = page1( "SELECT * FROM `".$db_mymps."advertisement` WHERE 1 {$where} ORDER BY displayorder ASC" );
	}
	include( $part == "add" || $part == "edit" ? mymps_tpl( CURSCRIPT ) : mymps_tpl( CURSCRIPT."_".$part ) );
}
else
{
	if ( $part == "list" )
	{
		if ( is_array( $titlenew ) )
		{
			foreach ( $titlenew as $key => $value )
			{
				$db->query( "UPDATE `".$db_mymps."advertisement` SET title = '{$value}',displayorder='{$displayorder[$key]}',available='{$available[$key]}' WHERE advid = '{$key}'" );
			}
		}
		if ( is_array( $delids ) )
		{
			foreach ( $delids as $kids => $vids )
			{
				mymps_delete( "advertisement", "WHERE advid = ".$vids );
			}
		}
	}
	else
	{
		$advnew['starttime'] = $advnew['starttime'] ? strtotime( $advnew['starttime'] ) : 0;
		$advnew['endtime'] = $advnew['endtime'] ? strtotime( $advnew['endtime'] ) : 0;
		if ( !$advnew['title'] )
		{
			write_msg( "�����ⲻ��Ϊ�գ�" );
		}
		else if ( 50 < strlen( $advnew['title'] ) )
		{
			write_msg( "������̫���ˣ�������25���ַ���" );
		}
		else if ( $advnew['endtime'] && ( $advnew['endtime'] <= time( ) || $advnew['endtime'] <= $advnew['starttime'] ) )
		{
			write_msg( "��ֹʱ�䲻��С�ڵ�ǰʱ�����ʼʱ��" );
		}
        else if ( !( $advnew['style'] == "code" ) && !$advnew['code']['html'] && !( $advnew['style'] == "text" ) && !$advnew['text']['title'] && !$advnew['text']['link'] && !( $advnew['style'] == "image" ) && !$advnew['image']['url'] && !$advnew['image']['link'] && $advnew['style'] == "flash" && ( !$advnew['flash']['url'] && !$advnew['flash']['width'] && !$advnew['flash']['height'] ) )
		{
			write_msg( "�������ύ�Ƿ���" );
		}
		if ( $part == "advadd" )
		{
			$db->query( "INSERT INTO ".$db_mymps."advertisement (available, type) VALUES ('1', '{$type}')" );
			$advid = $db->insert_id( );
		}
		else
		{
			$type = $db->getone( "SELECT type FROM ".$db_mymps."advertisement WHERE advid='{$advid}'" );
		}
		foreach ( $advnew[$advnew['style']] as $key => $val )
		{
			$advnew[$advnew['style']][$key] = stripslashes( $val );
		}
		$targetsarray = array( );
		if ( is_array( $advnew['targets'] ) )
		{
			foreach ( $advnew['targets'] as $target )
			{
				if ( !in_array( $target, array( "index", "all" ) ) && !preg_match( "/^\\d+$/", $target ) )
				{
					$targetsarray[] = $target;
				}
			}
		}
		$advnew['targets'] = implode( "\t", $targetsarray );
		$advnew['displayorder'] = isset( $advnew['displayorder'] ) ? implode( "\t", $advnew['displayorder'] ) : "";
		switch ( $advnew['style'] )
		{
			case "code" :
			$advnew['code'] = $advnew['code']['html'];
            $advnew['code'] = str_replace( "\";", "\" ;", $advnew['code'] );
			break;
			case "text" :
			$advnew['code'] = "<a href=\"".$advnew['text']['link']."\" target=\"_blank\" ".( $advnew['text']['size'] ? "style=\"font-size: ".$advnew['text']['size']."\"" : "" ).">".$advnew['text']['title']."</a>";
			break;
			case "image" :
			$advnew['code'] = "<a href=\"".$advnew['image']['link']."\" target=\"_blank\"><img src=\"".$advnew['image']['url']."\"".( $advnew['image']['height'] ? " height=\"".$advnew['image']['height']."\"" : "" ).( $advnew['image']['width'] ? " width=\"".$advnew['image']['width']."\"" : "" ).( $advnew['image']['alt'] ? " alt=\"".$advnew['image']['alt']."\"" : "" )." border=\"0\"></a>";
			break;
			case "flash" :
			$advnew['code'] = "<embed width=\"".$advnew['flash']['width']."\" height=\"".$advnew['flash']['height']."\" src=\"".$advnew['flash']['url']."\" type=\"application/x-shockwave-flash\"></embed>";
			break;
		}
		if ( $type == "floatad" )
		{
			$sourcecode = $advnew['code'];
			$advnew['floath'] = 40 <= $advnew['floath'] && $advnew['floath'] <= 600 ? intval( $advnew['floath'] ) : 200;
			$advnew['code'] = str_replace( array( "\r\n", "\r", "\n" ), "<br />", $advnew['code'] );
			$advnew['code'] = addslashes( $advnew['code']."<br /><span style=\"text-align:left; display:block; width:30px\"><a href=\"javascript:void();\" onMouseOver=\"this.style.cursor='pointer'\" onClick=\"closeBanner();\">�ر�</a></span>" );
			$advnew['code'] = "theFloaters.addItem('floatAdv1',6,'document.documentElement.clientHeight-".$advnew['floath']."','<div style=\"position: absolute; right: 6px; top: 25px;\">".$advnew['code']."</div>');";
		}
		else if ( $type == "couplead" )
		{
			$advnew['code'] = addslashes( $advnew['code']."<br /><span style=\"text-align:left; display:block; width:30px\"><a href=\"javascript:void();\" onMouseOver=\"this.style.cursor='pointer'\" onClick=\"closeBanner();\">�ر�</a></span>" );
			$advnew['code'] = "theFloaters.addItem('coupleAdL',6,0,'<div style=\"position: absolute; left: 6px; top: 42px;\">".$advnew['code']."</div>');theFloaters.addItem('coupleAdR','document.body.clientWidth-6',0,'<div style=\"position: absolute; right: 6px; top: 42px;\">".$advnew['code']."</div>');";
		}
		else if ( $type == "intercat" )
		{
			$advnew['position'] = !is_array( $advnew['position'] ) && !in_array( "0", $advnew['position'] ) ? $advnew['position'] : "";
		}
		if ( $advnew['style'] == "code" )
		{
			$advnew['parameters'] = addslashes( serialize( array_merge( array( "style" => $advnew['style'] ), array( "html" => $advnew['code'] ), array( "position" => $advnew['position'] ), array( "displayorder" => $advnew['displayorder'] ), $sourcecode ? array( "sourcecode" => $sourcecode ) : array( ), $advnew['floath'] ? array( "floath" => $advnew['floath'] ) : array( ) ) ) );
		}
		else
		{
			$advnew['parameters'] = addslashes( serialize( array_merge( array( "style" => $advnew['style'] ), $advnew[$advnew['style']], array( "html" => $advnew['code'] ), array( "position" => $advnew['position'] ), array( "displayorder" => $advnew['displayorder'] ), $advnew['floath'] ? array( "floath" => $advnew['floath'] ) : array( ) ) ) );
		}
		$advnew['code'] = addslashes( $advnew['code'] );
		$query = $db->query( "UPDATE ".$db_mymps."advertisement SET title='{$advnew['title']}', targets='{$advnew['targets']}', parameters='{$advnew['parameters']}', code='{$advnew['code']}', starttime='{$advnew['starttime']}', endtime='{$advnew['endtime']}', cityid='{$advnew['cityid']}' WHERE advid='{$advid}'" );
	}
	clear_cache_files( "adv_index" );
	clear_cache_files( "adv_category" );
	clear_cache_files( "adv_info" );
	clear_cache_files( "adv_other" );
	clear_cache_files( "city_".$cityid );
	clear_cache_files( "city_".$oldcityid );
	updateadvertisement( );
	write_msg( "�ɹ����¹�����ã�", $forward_url ? $forward_url : "adv.php", "write_record" );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = $part = $adv = NULL;
?>
