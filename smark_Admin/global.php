<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

function get_member_level( $id = "", $name = "levelid" )
{
	global $db;
	global $db_mymps;
	$member_level = $db->getall( "SELECT id,levelname FROM `".$db_mymps."member_level`" );
	$mymps .= "<select name=\"".$name."\">";
	$mymps .= "<option value=''>>�������</option>";
	foreach ( $member_level as $k => $value )
	{
		$mymps .= "<option value=".$value[id]."";
		$mymps .= $id == $value[id] ? " selected style=\"background-color:#6EB00C;color:white\"" : "";
		$mymps .= ">".$value[levelname]."</option>";
	}
	$mymps .= "</select>";
	return $mymps;
}

function show_message( $nav_path = "", $message = "", $after_action = "" )
{
	global $here;
	write_admin_record( $message );
	$here = MPS_SOFTNAME."������ʾ����";
	include( mymps_tpl( "showmessage" ) );
}

function sizeunit( $filesize )
{
	if ( 1073741824 <= $filesize )
	{
		$filesize = ( round( $filesize / 1073741824 * 100 ) / 100 )." GB";
		return $filesize;
	}else if ( 1048576 <= $filesize )
	{
		$filesize = ( round( $filesize / 1048576 * 100 ) / 100 )." MB";
		return $filesize;
	}else if ( 1024 <= $filesize )
	{
		$filesize = ( round( $filesize / 1024 * 100 ) / 100 )." KB";
		return $filesize;
	}else{
		$filesize .= " bytes";
	}
	return $filesize;
}

function write_file( $sql, $backup_dir, $filename )
{
	$re = true;
	if ( @( $fp = @fopen( @$backup_dir.$filename, "w+" ) ) )
	{
		$re = false;
		echo "���ļ�ʧ��";
	}
	if ( @fwrite( $fp, $sql ) )
	{
		$re = false;
		echo "д�ļ�ʧ��";
	}
	if ( @fclose( $fp ) )
	{
		$re = false;
		echo "�ر��ļ�ʧ��";
	}
	return $re;
}

function down_file( $sql, $filename )
{
	ob_end_clean( );
	header( "Content-Encoding: none" );
	header( "Content-Type: ".( strpos( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) ? "application/octetstream" : "application/octet-stream" ) );
	header( "Content-Disposition: ".( strpos( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) ? "inline; " : "attachment; " )."filename=".$filename );
	header( "Content-Length: ".strlen( $sql ) );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
	echo $sql;
	$e = ob_get_contents( );
	ob_end_clean( );
}

function mylicense( $agree_domain )
{
	// if ( empty( $HTTP_HOST ) )
	// {
	// 	if ( mygetenv( "HTTP_HOST" ) )
	// 	{
	// 		$HTTP_HOST = mygetenv( "HTTP_HOST" );
	// 	}
	// 	else
	// 	{
	// 		$HTTP_HOST = "";
	// 	}
	// }
	// $agree_domain = ".127.0.0.1|.192.168.0.2|localhost|".$agree_domain;
	// $now_domain = getrootdomain( htmlspecialchars( $HTTP_HOST ) );
	// $now_domain = str_replace( ".www.", "", $now_domain );
	// if ( in_array( $now_domain, explode( "|", $agree_domain ) ) )
	// {
	// 	exit( "<a href=\"http://www.it-works.com.cn\">�ٷ���վ</a><p><a href=\"http://www.it-works.com.cn\">������̳</a>" );
	// }
}

function writeable( $dir )
{
	if ( is_dir( $dir ) )
	{
		@mkdir( $dir, 511 );
	}
	if ( is_dir( $dir ) )
	{
		if ( is_writable( $dir ) )
		{
			$writeable = 1;
			return $writeable;
		}
		$writeable = 0;
	}
	return $writeable;
}

function make_header( $table )
{
	global $db;
	$sql = "DROP TABLE IF EXISTS ".$table."\n";
	$db->query( "show create table ".$table );
	$db->nextrecord( );
	$tmp = preg_replace( "/\n/", "", $db->f( "Create Table" ) );
	$sql .= $tmp."\n";
	return $sql;
}

function make_record( $table, $num_fields )
{
	global $db;
	$comma = "";
	$sql .= "INSERT INTO ".$table." VALUES(";
		for ($i = 0; $i < $num_fields; $i++)
		{
			$sql .= $comma."'".mysql_escape_string( $db->record[$i] )."'";
			$comma = ",";
		}
	$sql .= ")\n";//
	return $sql;//
}

function import( $fname )
{
	global $db;
	$sqls = file( $fname );
	foreach ( $sqls as $sql )
	{
		str_replace( "\r", "", $sql );
		str_replace( "\n", "", $sql );
		$db->query( trim( $sql ) );
	}
	return true;
}

function chk_admin_purview( $purview )
{
	global $admin_uname,$admin_id;
	if ( !$admin_id )
	{
		write_msg( "����û�е�¼�����¼���ٽ��к���������" );
	}
	$data = read_static_cache( "admin" );
	if ( $data === false )
	{
		$data = write_admin_cache( );
	}
	$admin_uname = $data[$admin_id]['uname'];
	if ( !in_array( $purview, explode( ",", $data[$admin_id]['purviews'] ) ) )
	{
	}
}

function get_admin_info( )
{
	global $admin_id;
	if ( !$admin_id )
	{
		write_msg( "����û�е�¼�����¼���ٽ��к���������" );
	}
	$data = read_static_cache( "admin" );
	if ( $data === false )
	{
		$res = write_admin_cache( );
	}
	else
	{
		$res = $data;
	}
	return $res[$admin_id];
}

function mymps_admin_tpl_global_foot( )
{
	global $mymps_starttime;
	global $mtime;
	global $db;
	$mtime = explode( " ", microtime( ) );
	$totaltime = number_format( $mtime[1] + $mtime[0] - $mymps_starttime, 6 );
	$sitedebug = "Processed in ".$totaltime." second(s) , ".$db->query_num." queries";
	echo "<div class=\"clear\" style=\"height:10px\"></div><div class=\"copyright\">Powered by <a href=\"http://www.it-works.com.cn/\" target=\"_blank\"><b style=\"color:#0070af\">Smark</b></a> <a href=\"http://www.it-works.com.cn/\" target=\"_blank\"><b style=\"color:#FF6600\">".MPS_VERSION."</b></a> &copy; , ".$sitedebug." <a href=\"javascript:scroll(0,0)\" style=\"margin-left:10px;\">�����ˡ�</a></div></div></div></body></html>";
}

function fileimage( $file )
{
	$ext = fileext( $file );
	if ( $ext == "html" || $ext == "htm" )
	{
		$images = "template/images/file_html.gif";
		return $images;
	}
	if ( $ext == "gif" || $ext == "png" )
	{
		$images = "template/images/file_gif.gif";
		return $images;
	}
	if ( $ext == "bmp" )
	{
		$images = "template/images/file_bmp.gif";
		return $images;
	}
	if ( $ext == "jpg" || $ext == "jpeg" )
	{
		$images = "template/images/file_jpg.gif";
		return $images;
	}
	if ( $ext == "swf" )
	{
		$images = "template/images/file_swf.gif";
		return $images;
	}
	if ( $ext == "js" )
	{
		$images = "template/images/file_script.gif";
		return $images;
	}
	if ( $ext == "css" )
	{
		$images = "template/images/file_css.gif";
		return $images;
	}
	if ( $ext == "txt" )
	{
		$images = "template/images/file_txt.gif";
		return $images;
	}
	$images = "template/images/file_unknow.gif";
	return $images;
}

function is_pic( $file )
{
	$ext = fileext( $file );
	if ( $ext == "gif" || $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "bmp" )
	{
		return "yes";
	}
	return "no";
}

function getsize( $fs )
{
	if ( 1073741824 <= $fs )
	{
		return number_format( @$fs / 1024 * 1024 * 1024, 3 )." G";
	}else if ( 1048576 <= $fs && $fs < 1073741824 )
	{
		return number_format( @$fs / 1024 * 1024, 3 )." M";
	}else if ( 1024 <= $fs && $fs < 1048576 )
	{
		return number_format( @$fs / 1024, 3 )." KB";
	}else if ( $fs < 1024 )
	{
		return $fs."Byte";
	}
}

function mymps_admin_menu( $place = "top", $default = "siteabout" )
{
	global $admin_menu;
	$i = -1;
	foreach ( $admin_menu as $q => $w )
	{
		if ( $place == "top" )
		{
			$i += 1;
			$uri = !$w[url] ? "#" : $w[url];
			$onc = !$w[url] ? "onclick=sethighlight('".$i."');togglemenu('".$q."');return false;" : $w[url];
			$tar = $w[target] ? $w[target] : "";
			$mymps_admin_menu .= "<li class=\"".$w['style']."\"><a href=\"".$uri."\"".$onc." target=".$tar.">".$w[name]."</a></li>";
		}
		else if ( ( $place == "left" ) || is_array( $w[group] ) )
		{
			foreach ( $w[group] as $e => $r )
			{
				$estyle = $q != $default ? "style=\"display:none\"" : "";
				$mymps_admin_menu .= "<dl id=\"".$q."\" ".$estyle.">";
				$mymps_admin_menu .= "<span class=\"wname\">".$w[name]."</span>";
				foreach ( $w[group][$e] as $r => $t )
				{
					if ( is_array( $t ) )
					{
						$mymps_admin_menu .= "<div><span>".$r."</span>";
						foreach ( $w[group][$e][$r] as $y => $u )
						{
							$i += 1;
							$mymps_admin_menu .= "<a href=\"javascript:void(0);\" onClick=\"sethighlight('".$i."');parent.framRight.location='".$u."';\"  >".$y."</a>";
						}
						$mymps_admin_menu .= "</div>";
					}
				}
				$mymps_admin_menu .= "</dl>";
			}
		}
	}
	$i = NULL;
	return $mymps_admin_menu;
}

function mymps_admin_purview( $purview = "" )
{
	global $admin_menu;
	foreach ( $admin_menu as $k => $v )
	{
		if ( $k != "logout" )
		{
			$mymps_admin_purview .= "<tr style=\"font-weight:bold; background-color:#dff6ff\"><td colspan=\"2\">".$v[name]."</td></tr>";
			foreach ( $v[group][element] as $a => $e )
			{
				if ( $a != "ϵͳ����" )
				{
					$mymps_admin_purview .= "<tr bgcolor=\"#f5fbff\"><td>".$a."</td><td>";
					foreach ( $e as $w => $y )
					{
						$mymps_admin_purview .= "<label for=\"purview_".$w."\" style=\"width:110px\"><input type=\"checkbox\" class=\"checkbox\" name=\"purview[]\" id=\"purview_".$w."\" value=\"purview_".$w."\"";
						$mymps_admin_purview .= !is_array( $purview ) || in_array( "purview_".$w, $purview ) || empty( $purview ) ? "checked" : "";
						$mymps_admin_purview .= ">".$w."</label> ";
					}
				}
			}
			$mymps_admin_purview .= "</td></tr>";
		}
	}
	return $mymps_admin_purview;
}

function get_mymps_config_menu( )
{
	global $admin_global_class;
	$i = 0;
	foreach ( $admin_global_class as $k => $value )
	{
		$mymps .= "<li><a id=\"i".$i."\" href=\"javascript:noneblock('h".$i."','i".$i."')\"";
		$mymps .= $i == 0 ? "class=\"current\"" : "";
		$mymps .= ">";
		$mymps .= $value;
		$mymps .= "</a></li>";
		$i++;
	}
	return $mymps;
}

function get_waterimg_position( $value = "" )
{
	$mymps .= "<input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"0\" ";
	$mymps .= $value == 0 ? "checked" : "";
	$mymps .= ">\r\n���λ��\r\n\t<table width=\"300\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tr>\r\n  <td width=\"33%\"><input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"1\"";
	$mymps .= $value == 1 ? "checked" : "";
	$mymps .= ">\r\n��������</td>\r\n<td width=\"33%\"><input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"4\"";
	$mymps .= $value == 4 ? "checked" : "";
	$mymps .= ">\r\n��������</td>\r\n<td><input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"7\"";
	$mymps .= $value == 7 ? "checked" : "";
	$mymps .= ">\r\n��������</td>\r\n</tr>\r\n<tr>\r\n<td><input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"2\"";
	$mymps .= $value == 2 ? "checked" : "";
	$mymps .= ">\r\n��߾���</td>\r\n<td><input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"5\"";
	$mymps .= $value == 5 ? "checked" : "";
	$mymps .= ">\r\nͼƬ����</td>\r\n<td><input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"8\"";
	$mymps .= $value == 8 ? "checked" : "";
	$mymps .= ">\r\n�ұ߾���</td>\r\n</tr>\r\n<tr>\r\n<td><input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"3\"";
	$mymps .= $value == 3 ? "checked" : "";
	$mymps .= ">\r\n�ײ�����</td>\r\n<td><input type=\"radio\" class=\"radio\" name = \"cfg_upimg_watermark_position\"  value=\"6\"";
	$mymps .= $value == 6 ? "checked" : "";
	$mymps .= ">\r\n�ײ�����</td>\r\n<td><input name = \"cfg_upimg_watermark_position\" type=\"radio\" class=\"radio\"   value=\"9\"";
	$mymps .= $value == 9 ? "checked" : "";
	$mymps .= ">\r\n�ײ�����</td>\r\n</tr>\r\n</table>";
	return $mymps;
}

function get_mymps_config_input( )
{
	global $admin_global;
	global $admin_global_class;
	global $config_global;
	$i = 0;
	foreach ( $admin_global_class as $k => $mymps_v )
	{
		$mymps .= "<div id=\"h".$i."\" class=\"mytable\"";
		$mymps .= $i == 0 ? " " : " style='display:none'";
		$mymps .= "><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"vbm\"><tr class=\"firstr\"><td colspan=\"5\"><div class=\"left\"><a href=\"javascript:collapse_change('".$i."')\">".$mymps_v."</a></div><div class=\"right\"><a href=\"javascript:collapse_change('".$i."')\"><img id=\"menuimg_".$i."\" src=\"template/images/menu_reduce.gif\"/></a></div></td></tr><tbody id=\"menu_".$i."\" style=\"display:\"><tr style=\"font-weight:bold; height:24px; background-color:#f1f5f8\"><td>���˵��</td><td>ֵ</td><td>ģ����ô���</td></tr>";
		foreach ( $admin_global as $k => $a )
		{
			if ( $a['class'] == $mymps_v )
			{
				$mymps .= "<tr bgcolor=\"#ffffff\"><td style=\"width:35%; line-height:22px\">".$a['des']."</td><td>";
				if ( in_array( $k, array( "SiteDescription", "SiteStat", "cfg_forbidden_post_ip", "cfg_forbidden_reg_ip", "cfg_member_regplace", "cfg_member_reg_content", "cfg_site_open_reason", "cfg_disallow_post_tel", "cfg_allow_post_area" ) ) )
				{
					$mymps .= "<textarea name=\"".$k."\" style=\"height:100px; width:205px\">".$config_global[$k]."</textarea>";
				}
				else if ( $k == "cfg_mappoint" )
				{
					$mymps .= "<input name=\"".$k."\" value=\"".$config_global[$k]."\" class=\"text\" id=\"mappoint\"/>";
					$mymps .= "<input type=\"button\" class=\"gray mini\" value=\"��Ҫ��ע\" onclick=\"javascript:setbg('��ͼ��ע',500,250,'../map.php?action=markpoint&width=500&height=250&title=default_map_point&p=".$mymps_global['cfg_mappoint']."')\"/>";
				}
				else if ( $k == "SiteLogo" )
				{
					$mymps .= "<img src=\"".$config_global[$k]."\" class=\"noborder\"/><br /><br />";
					$mymps .= "<input name=\"".$k."\" value=\"".$config_global[$k]."\" class=\"text\"/>";
				}
				else if ( $k == "cfg_upimg_watermark_img" )
				{
					$mymps .= "<img src=\"".$config_global[$k]."\" class=\"noborder\"/><br /><br />";
					$mymps .= "<input name=\"".$k."\" value=\"".$config_global[$k]."\" class=\"text\" id=\"imgsrc\"/>";
					$mymps .= "<label><input type=\"radio\" class=\"radio\" onclick='document.getElementById(\"f".$k."\").style.display = \"none\";' name=\"ifout\" value=\"no\" checked=\"checked\" class=\"radio\"/>Զ��ͼƬ</label>\r\n<label><input type=\"radio\" class=\"radio\" onclick='document.getElementById(\"f".$k."\").style.display = \"block\";' name=\"ifout\" value=\"yes\" class=\"radio\"/>�����ϴ�</label>\r\n<iframe src=\"include/upfile.php?watermark=0\" width=\"450\" frameborder=\"0\" scrolling=\"no\" onload=\"this.height=iFrame1.document.body.scrollHeight\" id=\"f".$k."\" style=\"display:none; margin-top:10px\"></iframe>";
				}
				else if ( $k == "cfg_member_verify" )
				{
					$mymps .= "<label for='verify1'><input ";
					$mymps .= $config_global['cfg_member_verify'] == "1" ? " checked " : "";
					$mymps .= " id='verify1' type=\"radio\" class=\"radio\" value=\"1\" name=\"cfg_member_verify\">�����</label>&nbsp;&nbsp;";
					$mymps .= "<label for='verify2'><input ";
					$mymps .= $config_global['cfg_member_verify'] == "2" ? " checked " : "";
					$mymps .= " id='verify2' type=\"radio\" class=\"radio\" value=\"2\" name=\"cfg_member_verify\">�˹����</label>&nbsp;&nbsp;";
					$mymps .= "<label for='verify3'><input ";
					$mymps .= $config_global['cfg_member_verify'] == "3" ? " checked " : "";
					$mymps .= " id='verify3' type=\"radio\" class=\"radio\" value=\"3\" name=\"cfg_member_verify\">�ʼ����</label>";
				}
				else if ( $k == "cfg_if_info_verify" )
				{
					$mymps .= "<label for='verifyy1'><input ";
					$mymps .= $config_global['cfg_if_info_verify'] == "0" ? " checked " : "";
					$mymps .= " id='verifyy1' type=\"radio\" class=\"radio\" value=\"0\" name=\"cfg_if_info_verify\">�����</label>&nbsp;&nbsp;";
					$mymps .= "<label for='verifyy2'><input ";
					$mymps .= $config_global['cfg_if_info_verify'] == "1" ? " checked " : "";
					$mymps .= " id='verifyy2' type=\"radio\" class=\"radio\" value=\"1\" name=\"cfg_if_info_verify\">�˹����</label>";
				}
				else if ( $k == "cfg_upimg_watermark_position" )
				{
					$mymps .= get_waterimg_position( $config_global[$k] );
				}
				else if ( $a['type'] == "������" )
				{
					$mymps .= "<select name=\"".$k."\"/>";
					$mymps .= "<option value=\"1\"";
					$mymps .= $config_global[$k] == 1 ? " selected='selected' style='background-color:#6eb00c; color:white!important;'" : "";
					$mymps .= ">��/����</option>";
					$mymps .= "<option value=\"0\"";
					$mymps .= $config_global[$k] == 0 ? " selected='selected' style='background-color:#6eb00c; color:white!important;'" : "";
					$mymps .= ">��/�ر�</option>";
					$mymps .= "</select>";
				}
				else
				{
					$mymps .= "<input name=\"".$k."\" value=\"".$config_global[$k]."\" class=\"text\"/>";
				}
				$mymps .= $a['type'] == "������" ? "</td><td width=30%>&nbsp;</td></tr>" : "</td><td width=30%>{\$mymps_global[".$k."]}</td></tr>";
			}
		}
		$mymps .= "</tbody></table></div>";
		$i += 1;
	}
	return $mymps;
}

function iszero( $str )
{
	if ( $str == 0 )
	{
		return 1;
	}
	return $str;
}

function getcwdol( )
{
	$total = $_SERVER[PHP_SELF];
	$file = explode( "/", $total );
	$file = $file[sizeof( $file ) - 1];
	return substr( $total, 0, strlen( $total ) - strlen( $file ) - 1 );
}

function fetchtablelist( $db_mymps = "" )
{
	global $db;
	$arr = explode( ".", $db_mymps );
	$dbname = $arr[1] ? $arr[0] : "";
	$db_mymps = str_replace( "_", "\\_", $db_mymps );
	$sqladd = $dbname ? " FROM ".$dbname." LIKE '{$arr['1']}%'" : "LIKE '".$db_mymps."%'";
	$tables = $table = array( );
	$query = $db->query( "SHOW TABLE STATUS ".$sqladd );
	while ( $table = $db->fetch_array( $query ) )
	{
		$table['Name'] = ( $dbname ? $dbname."." : "" ).$table['Name'];
		$tables[] = $table;
	}
	return $tables;
}

function get_timezone_select( $name = "cfg_timezone", $value = "" )
{
	$timezoneoptions = array( "-12" => "(GMT -12:00) �������п˵�, ����ֻ�..", "-11" => "(GMT -11:00) ��;��, ��Ħ��Ⱥ��", "-10" => "(GMT -10:00) ������", "-9" => "(GMT -09:00) ����˹��", "-8" => "(GMT -08:00) ̫ƽ��ʱ��(�����ͼ���..", "-7" => "(GMT -07:00) ɽ��ʱ��(�����ͼ��ô�..", "-6" => "(GMT -06:00) �в�ʱ��(�����ͼ��ô�..", "-5" => "(GMT -05:00) ����ʱ��(�����ͼ��ô�..", "-4" => "(GMT -04:00) ������ʱ��(���ô�), ��..", "-3.5" => "(GMT -03:30) Ŧ����", "-3" => "(GMT -03:00) ��������, ����ŵ˹����..", "-2" => "(GMT -02:00) �д�����, ��ɭ��Ⱥ��,..", "-1" => "(GMT -01:00) ����Ⱥ��, ��ý�Ⱥ�� ..", "0" => "(GMT) ����������, ������, ������, ..", "1" => "(GMT +01:00) ����, ��³����, �籾��..", "2" => "(GMT +02:00) �ն�����, ����������,..", "3" => "(GMT +03:00) �͸��, ���ŵ�, Ī˹��..", "3.5" => "(GMT +03:30) �º���", "4" => "(GMT +04:00) ��������, �Ϳ�, ��˹��..", "4.5" => "(GMT +04:30) ������", "5" => "(GMT +05:00) Ҷ�����ձ�, ��˹����,..", "5.5" => "(GMT +05:30) ����, �Ӷ�����, �����..", "5.75" => "(GMT +05:45) �ӵ�����", "6" => "(GMT +06:00) ����ľͼ, ������, �￨..", "6.5" => "(GMT +06:30) ����", "7" => "(GMT +07:00) ����, ����, �żӴ�", "8" => "(GMT +08:00) ����, ���, ��˹, �¼�..", "9" => "(GMT +09:00) ����, ����, �׶�, ����..", "9.5" => "(GMT +09:30) ��������, �����", "10" => "(GMT +10:00) ������, �ص�, ī����,..", "11" => "(GMT +11:00) ��ӵ�, �¿��������,..", "12" => "(GMT +12:00) �¿���, �����, 쳼�,.." );
	$value = empty( $value ) ? "8" : $value;//
	$m = "<select name=".$name.">";
	foreach ( $timezoneoptions as $key => $val )
	{
		$m .= "<option value=".$key." ".( $value == $key ? "selected" : "" ).">";
		$m .= $val;
		$m .= "</option>";
	}
	$m .= "</select>";
	return $m;
}

define( "IN_MYMPS", true );
define( "IN_MANAGE", true );
require_once( dirname( __FILE__ )."/../include/global.php" );
require_once( MYMPS_DATA."/config.inc.php" );
require_once( MYMPS_DATA."/config.php" );
require_once( MYMPS_DATA."/config.db.php" );
require_once( MYMPS_INC."/admin.class.php" );
if ( $admin_cityid && in_array( CURSCRIPT, array( "advertisement", "faq", "area", "category", "channel", "config", "advertisement", "database", "filemanage", "info_type", "jswizard", "mail", "member_tpl", "passport", "payapi", "payrecord", "plugin", "seoset", "site_about", "record", "city" ) ) )
{
	exit( "��վ����Ա�޸���Ŀ�Ĳ���Ȩ��..." );
}
if ( !$mymps_admin->mymps_admin_chk_getinfo( ) )
{
	write_msg( "", "index.php?do=login&url=".urlencode( geturl( ) ) );
}
else
{
	define( "IN_ADMIN", true );
}
?>
