<?php
/*********************/
/*                   */
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

error_reporting( E_ALL ^ E_NOTICE );
$do = isset( $_GET['do'] ) ? htmlspecialchars( trim( $_GET['do'] ) ) : "login";
$go = isset( $_GET['go'] ) ? htmlspecialchars( trim( $_GET['go'] ) ) : "mymps_right";
$part = isset( $_GET['part'] ) ? htmlspecialchars( trim( $_GET['part'] ) ) : "default";
if ( $do == "login" )
{
	define( "IN_MYMPS", true );
	include( dirname( __FILE__ )."/../include/global.php" );
	require_once( MYMPS_DATA."/config.php" );
	require_once( MYMPS_DATA."/config.db.php" );
	require_once( MYMPS_INC."/db.class.php" );
	require_once( MYMPS_INC."/admin.class.php" );
	@include( MYMPS_DATA."/caches/authcodesettings.php" );
	$authcodesettings = $data;
	$data = NULL;
	$url = trim( $url );
	if ( $part == "chk" )
	{
		define( CURSCRIPT, "admin_login" );
		$url = $url ? $url : "index.php?do=manage&go=".$go;
		if ( $authcodesettings['adminlogin'] == 1 && !( $randcode = mymps_chk_randcode( $checkcode ) ) )
		{
			write_msg( "��֤����������뷵����������" );
			exit( );
		}
		$username = trim( $username );
		$password = trim( $password );
		$pubdate = $timestamp ? $timestamp : time( );
		$ip = getip( );
		$row = $db->getrow( "SELECT id,userid,cityid,pwd,uname FROM ".$db_mymps."admin WHERE userid='".$username."' AND pwd='".md5( $password )."'" );
		if ( $row )
		{
			$admin_id = $row['userid'];
			$admin_name = $row['uname'];
			$admin_cityid = $row['cityid'];
			$mymps_admin->mymps_admin_login( $admin_id, $admin_name, $admin_cityid );
			$db->query( "UPDATE ".$db_mymps."admin SET loginip='".getip( ).( "',logintime='".$timestamp."' WHERE userid='{$row['userid']}'" ) );
			$db->query( "INSERT INTO `".$db_mymps."admin_record_login` (id,adminid,adminpwd,pubdate,ip,result) VALUES ('','{$username}','".md5( $password ).( "','".$pubdate."','{$ip}','1')" ) );
			write_msg( $admin_name."���ѳɹ���½ϵͳ��������", $url );
		}
		else
		{
			$db->query( "INSERT INTO `".$db_mymps."admin_record_login` (id,adminid,adminpwd,pubdate,ip,result) VALUES ('','{$username}','{$password}','{$pubdate}','{$ip}','0')" );
			write_msg( "��������û�������������뷵����������" );
		}
	}
	else if ( $part == "out" )
	{
		define( "IN_MYMPS", true );
		$mymps_admin->mymps_admin_logout( );
		write_msg( "���Ѿ���ȫ�˳�ϵͳ��������", "index.php" );
	}
	else if ( $part == "default" )
	{
		define( "IN_MYMPS", true );
		$url = trim($url);
		if ( $mymps_admin->mymps_admin_chk_getinfo( ) )
		{
			write_msg( "", "index.php?do=manage" );
		}
		else
		{
			include( mymps_tpl( "login" ) );
		}
	}
	else
	{
		define( "IN_MYMPS", true );
		write_msg( "", "index.php?do=manage" );
	}
}
else if ( $do == "manage" )
{
	require_once( dirname( __FILE__ )."/global.php" );
	if ( $part == "left" )
	{
		require_once( dirname( __FILE__ )."/include/".( $admin_cityid ? "mymps.citymenu.inc.php" : "mymps.menu.inc.php" ) );
		$part = $part ? $part : "info";
		$mymps_admin_menu = mymps_admin_menu( "left" );
		include( mymps_tpl( "admin_left" ) );
	}
	else if ( $part == "default" )
	{
		include( mymps_tpl( "admin_default" ) );
	}
	else if ( $part == "top" )
	{
		require_once( MYMPS_INC."/db.class.php" );
		require_once( dirname( __FILE__ )."/include/".( $admin_cityid ? "mymps.citymenu.inc.php" : "mymps.menu.inc.php" ) );
		$mymps_admin_menu = mymps_admin_menu( "top" );
		$admindir = getcwdol( );
		$width = $admin_cityid ? "575" : "670";
		if ( $admin_cityid )
		{
			$www = get_city_caches( $admin_cityid );
			$www = $www['domain'];
		}
		else
		{
			$www = "../";
		}
		$admin = get_admin_info( );
		include( mymps_tpl( "admin_top" ) );
	}
	else if ( $part == "right" )
	{
		require_once( MYMPS_INC."/db.class.php" );
		require_once( MYMPS_DATA."/config.inc.php" );
		require_once( dirname( __FILE__ ).( $admin_cityid ? "/include/mymps.citycount.inc.php" : "/include/mymps.count.inc.php" ) );
		foreach ( $ele as $w => $v )
		{
			$mymps_count_str .= $w == "siteabout" ? "<div class=\"clear\"></div>" : "";
			$mymps_count_str .= "<div class=\"countsquare\">\r\n\t\t\t<div class=\"ab\">\r\n\t\t\t";
			foreach ( $element[$w] as $k => $u )
			{
				$mymps_count_str .= "<div class=\"b\">";
				$mymps_count_str .= $u[where] ? "<a href=\"#\" onclick=\"parent.framRight.location='".$u['url']."';\">".$k."<br><div class=\"c\">".mymps_count( $u[table], $u[where] )."</div></a>" : "<a href=\"#\" onclick=\"parent.framRight.location='".$u['url']."';\">".$k."<br><div class=\"c\">".mymps_count( $u[table] )."</div></a>";
				$mymps_count_str .= "</div>";
			}
			$mymps_count_str .= "</div>\r\n\t\t\t<div class=\"a\">".$v."</div>\r\n\t\t\t</div>";
		}
		$gd_info = @gd_info( );
		$gd_version = is_array( $gd_info ) ? $gd_info['GD Version'] : "<font color=red>��֧��GD��</font>";
		$cfg_if_tpledit = $mymps_mymps[cfg_if_tpledit] == 0 ? "<font color=green>�ر�</font>" : "<font color=red>����</font>";
		$if_del_install = !is_file( MYMPS_ROOT."/install/index.php" ) ? "<font color=green>��ɾ��</font>" : "<font color=red>δɾ��</font>";
		$Register_Globals = ini_get( "Register_Globals" ) ? "on" : "off";
		$Magic_Quotes_Gpc = MAGIC_QUOTES_GPC ? "on" : "off";
		$expose_php = ini_get( "expose_php" ) ? "on" : "off";
		$cur_dir = getcwdol( );
		$cur_dir = $cur_dir == "/admin" ? "<font color=red title=������ʹ��admin��ΪĿ¼��>/admin</font>" : "<font color=green>".$cur_dir."</font>";
		$latestbackup = $db->getone( "SELECT value FROM `".$db_mymps."config` WHERE description = 'latestbackup' AND type = 'database'" );
		$parttime = round( ( 0 < $latestbackup ? $timestamp - $latestbackup : 0 ) / 86400 );
		if ( !$latestbackup )
		{
			$message = "<font color=red>����δ���ݹ�ϵͳȫ������</font>";
		}
		else if ( 14 < $parttime )
		{
			$message = "<font color=red>���Ѿ���������û�б���ϵͳȫ��������</font>";
		}
		else if ( $parttime == 0 )
		{
			$message = "<font color=green>�������Ѿ����ݹ�ȫ������</font>";
		}
		else
		{
			$message = "���� <font color=green>".$parttime."</font> ��ǰ���ݹ�ϵͳ���ݣ��ϴα��ݣ�<font color=green>".gettime( $latestbackup )."</font>";
		}
		$message .= "��<a href=\"database.php?part=backup\" style=\"text-decoration:underline\">��˱���ϵͳ����</a>";
		$welcome['����ͳ��'] = $mymps_count_str;
		$welcome['���ò���'] = "<div><span><input value=\"��������Ϣ\" onclick=\"window.open('../".$mymps_global[cfg_postfile]."'); target='_blank'\" type=\"button\" class=\"mymps large\"></span><span><input value=\"�������\" onclick=\"location.href='config.php?part=cache_sys&return_url=".urlencode( "index.php?do=manage&part=right" )."'\" type=\"button\" class=\"mymps large\"></span><span><input value=\"ϵͳ�Ż�\" onclick=\"location.href='optimise.php'\" type=\"button\" class=\"mymps large\"></span><span><input value=\"�������ݿ�\" onclick=\"location.href='database.php?part=backup'\" type=\"button\" class=\"mymps large\"></span></div>";
		$welcome['��ݲ���'] = "<div class=\"mainnav\">\r\n\t\t<ul>\r\n\t\t<li><a href=\"".$mymps_global[SiteUrl]."\" target=\"_blank\"><img border=\"0\" src=\"template/images/default/home.gif\" />��վ��ҳ</a></li>\r\n\t\t<li><a href=\"#\" onclick=\"parent.framRight.location='member.php'\"><img border=\"0\" src=\"template/images/default/user.png\" alt=\"���ע��\" />���ע��</a></li>\r\n\t\t<li><a href=\"#\" onclick=\"parent.framRight.location='announce.php?part=add'\"><img border=\"0\" src=\"template/images/default/tpc.png\" alt=\"�������\" />��������</a></li>\r\n\t\t<li><a href=\"#\" onclick=\"parent.framRight.location='information.php'\"><img border=\"0\" src=\"template/images/default/post.png\"/>������Ϣ</a></li>\r\n\t\t<li><a href=\"#\" onclick=\"parent.framRight.location='friendlink.php'\"><img border=\"0\" src=\"template/images/default/share.png\" />�������</a></li>\r\n\t\t</ul>\r\n\t\t</div>";
		if ( !$admin_cityid )
		{
			$welcome['��ȫ����'] = "<span>���߱༭ģ�幦��</span> ��ǰ��".$cfg_if_tpledit."��������ֻ����ʮ�ֱ�Ҫ��ʱ��ſ����������޸� /data/config.inc.php �رմ˹���<br />\r\n\t\t<span>ϵͳ installĿ¼</span> ��ǰ��".$if_del_install."��Ϊ��ֹվ����Ա���ã���������װ��ɺ�ɾ����Ŀ¼<br />\r\n\t\t<span>ϵͳ����Ŀ¼</span> ��ǰ��".$cur_dir."����������װ��ɺ��޸�Ŀ¼������ֱ���޸ģ���<br />\r\n\t\t<span>���ݰ�ȫ</span>".$message;
			$welcome['���������'] = "<div><span>����������:</span>".$_SERVER['SERVER_SOFTWARE']."</div>\r\n\t\t<div><span>������ϵͳ:</span>".PHP_OS."</div>\r\n\t\t<div><span>��ǰʱ��:</span>".gettime( $timestamp )." ".date( "����N", $timestamp )."</div>\r\n\t\t<div><span>PHP��ʽ�汾:</span>".PHP_VERSION."</div>\r\n\t\t<div><span>Register_Globals:</span>".$Register_Globals." &nbsp;&nbsp;<font color=red>[��off]</font></div>\r\n\t\t<div><span>Magic_Quotes_Gpc:</span>".$Magic_Quotes_Gpc." &nbsp;&nbsp;<font color=red>[��on]</font></div>\r\n\t\t<div><span>expose_php:</span>".$expose_php." &nbsp;&nbsp;<font color=red>[��off]</font></div>\r\n\t\t<div><span>MYSQL�汾:</span>".$db->version( )."</div>\r\n\t\t<div><span>mympsĿ¼: </span>".MYMPS_ROOT."</div>\r\n\t\t<div><span>ʹ������: </span>".$_SERVER['SERVER_NAME']."</div>\r\n\t\t<div><span>�ű���ʱʱ�䣺</span>".ini_get( "max_execution_time" )."</div>\r\n\t\t<div><span>�����ϴ�����</span>".ini_get( "upload_max_filesize" )."</div>\r\n\t\t<div><span>GD��汾</span>".$gd_version."</div>\r\n\t\t<div><span>����ļ���дȨ��</span><a href='javascript:setbg(\"����ļ���дȨ��\",305,380,\"../box.php?part=sp_testdirs\")' class=\"icon_open\" id=\"spanmymsg\" >��˼��</a>";
		}
		foreach ( $welcome as $k => $value )
		{
			$mymps_welcome_str .= "<tr bgcolor=\"#f5fbff\"><td width=\"15\" bgcolor=\"#F6FBFF\" style=\"\">".$k."</td><td bgcolor=\"white\" style=\"padding:15px;\" class=\"other\">".$value."</td></tr>";
		}
		$here = "ϵͳ������ҳ";
		mylicense( "imayang.com" );
		include( mymps_tpl( "inc_head" ) );
		include( mymps_tpl( "admin_index" ) );
		unset( $ele );
		unset( $element );
		echo mymps_admin_tpl_global_foot( );
	}
}
else if ( $do == "power" )
{
	require_once( dirname( __FILE__ )."/global.php" );
	require_once( MYMPS_INC."/member.class.php" );
	$s_uid = trim($userid);
	$s_pwd = trim($userid);
	$member_log->in( $s_uid, $s_pwd, "off", $url );
}
else
{
	define( "IN_MYMPS", true );
	write_msg( "δ֪���������µ�¼��̨����", "index.php?do=login&part=out" );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$db = $mymps_global = $part = $action = $here = NULL;
?>
