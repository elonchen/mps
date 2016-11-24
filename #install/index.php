<?php 
define('IN_MYMPS', true);

$charset	= 'gbk';
$dbcharset	= 'gbk';

require_once(dirname(__FILE__)."/global.php");
require_once(dirname(__FILE__)."/../include/global.php");
require_once(dirname(__FILE__)."/../include/cache.fun.php");

chk_mymps_install();

$step = isset($_GET['step']) ? intval($_GET['step']) : '';
$step = $step ? $step : '1' ;

$installinfo= "��ӭ���� <font class=\"softname\">".MPS_SOFTNAME."</font> <font class=\"version\">".MPS_VERSION."</font> ��װ�򵼣���װǰ����ϸ�Ķ���װ˵����ſ�ʼ��װ����װ�ļ�����ͬ���ṩ���й������װ��˵����������ϸ�Ķ���<div style=\"margin-top:.5em\">��װ�����������κ����� &nbsp;<a href=\"".MPS_BBS."\" target=\"_blank\" class=\"black\"><u><b>�뵽�ٷ�������Ѱ�����</b></u></a></div>";

if($step == '1'){

	$info = "�Ķ���װЭ��";
	include(mymps_tpl("inc_head"));
	$licence = openfile("../licence.txt");
	?>
	<div class="agreement">
		<?php echo $licence;?>
	</div>
	<div class="c"></div>
	<div id="content">

		<div class="wrapD">
			<div class="wrapE">
				<div class="c"></div>
			</div>
		</div>
		<div class="stepbt">
			<strong class="last">����������Ķ������װЭ��</strong>
			<input style="cursor:pointer;"  class="next mymps large" type="button" onclick="location.href='?step=2'" value="ͬ��Э�飬������һ��">
		</div>

	</div>
</div>
<?php

}elseif($step == '2'){
	
	$info = "�Ķ�ʹ��˵��";
	include(mymps_tpl("inc_head"));
	$licence = openfile("../readme.txt");
	?>
	<div class="agreement">
		<?php echo $licence?>
	</div>
	<div class="c"></div>
	<div id="content">

		<div class="wrapD">
			<div class="wrapE">
				<div class="c"></div>
			</div>
		</div>
		<div class="stepbt">
			<input type="button" onclick="javascript:history.go(-1);" class="gray large last" value="��һ�����Ķ���װЭ��">
			<input style="cursor:pointer;" class="next mymps large" type="button" onclick="location.href='?step=3'" value="������һ��">
		</div>

	</div>
</div>

<?php

}elseif($step == '3'){

	$info = "���ϵͳ����";
	$phpv = @phpversion();
	$sp_server = $_SERVER["SERVER_SOFTWARE"];
	$sp_name = "www.itworks.net.cn";//$_SERVER["SERVER_NAME"];
	$short_open_tag = ini_get('short_open_tag')?'<font color=green>֧��</font>':'<font color=red>���޸�php.ini��short_open_tag=On�������޷���װ</font>';
	$disabled = ini_get('short_open_tag')?'':'disabled="disabled"';
	require_once(MYMPS_DATA."/sp_testdirs.php");
	include(mymps_tpl("inc_head"));
	?>
	<div class="c"></div>
	<div id="content">
		<div class="wrapD">
			<div class="wrapE">
				<div class="boxA">
					<div style="width:57%; float:left">
						<h3>���ϵͳ����</h3>
						<table class="dlA">
							<tr>
								<td width="130">����������</td>
								<td><?php echo $sp_name; ?></td>
							</tr>
							<tr>
								<td>����������ϵͳ</td>
								<td><?php echo defined('PHP_OS')?PHP_OS: ' '; ?></td>
							</tr>
							<tr>
								<td>��������������</td>
								<td><?php echo $sp_server; ?></td>
							</tr>
							<tr>
								<td>PHP��ʽ�汾</td>
								<td><?php echo $phpv; ?></td>
							</tr>
							<tr>
								<td>mymps·��</td>
								<td><?php echo MYMPS_ROOT; ?></td>
							</tr>
							<tr>
								<td>�̱��֧��</td>
								<td><?php echo $short_open_tag; ?></td>
							</tr>
						</table>
					</div>
					<div style="margin-left:56%">
						<h3>���Ŀ¼��д</h3>
						<div style="margin-top:20px;">
							<?php include(MYMPS_TPL."/box/sp_testdirs.html"); ?>
						</div>
					</div>
					
				</div>
				<div class="c"></div>
				<br />
			</div>
		</div>
		<div class="stepbt">
			<input type="button" onclick="javascript:history.go(-1);" class="gray large last" value="��һ�����Ķ�ʹ��˵��">
			<input style="cursor:pointer;" class="next mymps large" type="button" onclick="location.href='?step=4'" value="������һ��" <?php echo $disabled; ?>>
		</button>
	</div>

</div>
</div>
<?php

}elseif ($step == '4'){
	
	$info = "��д���ݿ���Ϣ";
	include(mymps_tpl("inc_head"));
	?>
	<div class="c"></div>
	<script language="JavaScript">
		function $obj(id) {
			return document.getElementById(id);
		}
		function postcheck(){
			if(document.install.db_host.value==""){
				alert('���ݿ����������Ϊ��');
				document.install.db_host.focus();
				return false;
			}
			if (document.install.db_user.value=="") {
				alert('���ݿ��û�������Ϊ��');
				document.install.db_user.focus();
				return false;
			}
			if (document.install.db_name.value=="") {
				alert('���ݿ�������Ϊ��');
				document.install.db_name.focus();
				return false;
			}
			if (!document.install.db_pass.value && !confirm('��������ݿ�����Ϊ�գ��Ƿ�ʹ�ÿյ����ݿ�����')) {
				return false;
			}
			document.install.mymps.disabled=true;
			document.install.mymps.value="��װ��...";
			return true;
		}
	</script>
	<div id="content">
		<form name="install" action="index.php?step=5" method="post" onsubmit="return postcheck();">
			<div class="wrapD">
				<div class="wrapE">
					<div class="boxA">
						<div style="width:57%; float:left">
							<h3>��д���ݿ���Ϣ</h3>
							<table class="dlA">
								<tr>
									<td>���ݿ������</td>
									<td><input type="text" name="db_host" value="localhost" class="inputA" /></td>
								</tr>
								<tr>
									<td>���ݿ��û���</td>
									<td><input type="text" name="db_user" value="" class="inputA" /></td>
								</tr>
								<tr>
									<td>���ݿ�����</td>
									<td><input type="text" name="db_pass" value="" class="inputA" /></td>
								</tr>
								<tr>
									<td>���ݿ���</td>
									<td><input type="text" name="db_name" class="inputA" /></td>
								</tr>
								<tr>
									<td height="18">���ݱ�����ǰ׺(��Ǳ�Ҫ.<b>�뱣��Ĭ��</b>)</td>
									<td><input type="text" name="db_mymps" value="my_" class="inputA" /></td>
								</tr>
							</table>
						</div>
						<div style="margin-left:56%">
							<h3>��д��վ��ʼ����Ϣ</h3>
							<table class="dlA dlB">
								<tbody id="showadmin">
									<tr>
										<td>�û���</td>
										<td><input type="text" name="manager" class="inputA" /> ϵͳ��¼��</td>
									</tr>
									<tr>
										<td>����</td>
										<td><input type="text" name="manager_pass" class="inputA" /></td>
									</tr>
									<tr>
										<td>ȷ������</td>
										<td><input type="text" name="manager_chkpass" class="inputA" /></td>
									</tr>
									<tr>
										<td height="18">Email</td>
										<td><input type="text" name="email" class="inputA" value="" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						
					</div>
					<div class="c"></div>
				</div>
			</div>
			<div class="c"></div>
			<div class="wrapCC">
				<table cellpadding="0" cellspacing="0" class="wrapCC_table">
					<tr>
						<td height="18">cookie����ǰ׺(��Ǳ�Ҫ.<b>�뱣��Ĭ��</b>)</td>
						<td><input type="text" name="cookiepre" value="<?php echo random(4).'_'; ?>" class="inputB" /></td>
					</tr>
					<tr>
						<td height="18">cookiedomain(��Ǳ�Ҫ.<b>�뱣��Ĭ��</b>)</td>
						<td><input type="text" name="cookiedomain" value="itworks.net.cn" class="inputB" /></td>
					</tr>
					<tr>
						<td height="18">cookiepath(��Ǳ�Ҫ.<b>�뱣��Ĭ��</b>)</td>
						<td><input type="text" name="cookiepath" value="/" class="inputB" /></td>
					</tr>
					<tr>
						<td height="18">��װȫ����ʡ�е�������?</td>
						<td><input type="checkbox" name="installarea"/></td>
					</tr>
					<tr>
						<td height="18">��װĬ����Ϣ��Ŀ����?</td>
						<td><input type="checkbox" name="installcategory" checked="checked"/></td>
					</tr>
					<tr>
						<td height="18">��װĬ�Ϲ������?</td>
						<td><input type="checkbox" name="installadv"/></td>
					</tr>
					<tr>
						<td height="18">��װ��Ϣģ������?</td>
						<td><input type="checkbox" name="installinfomodel" checked="checked"/> ���鰲װ</td>
					</tr>
					<tr>
						<td height="18">��װ�Ż�ȯ����?</td>
						<td><input type="checkbox" name="installcoupon" checked="checked"/> ���鰲װ</td>
					</tr>
					<tr>
						<td height="18">��װ�Ź�����?</td>
						<td><input type="checkbox" name="installgroup" checked="checked"/> ���鰲װ</td>
					</tr>
					<tr>
						<td height="18">��װ�̼���ҵ����?</td>
						<td><input type="checkbox" name="installcorp" checked="checked"/> ���鰲װ</td>
					</tr>
				</table>
			</div>
			<div class="stepbt">
				<input type="button" onclick="javascript:history.go(-1);" class="gray large last" value="��һ�������ϵͳ����">
				<input style="cursor:pointer;" class="next mymps large" type="submit" value="������һ��" name="mymps" id="mymps"></button>
			</div>
		</form>
	</div>
</div>
<?php

}elseif($step == '5'){
	@set_time_limit(0);
	$db_host  	= trim($_POST['db_host']);
	$db_user  	= trim($_POST['db_user']);
	$db_pass  	= trim($_POST['db_pass']);
	$db_name  	= trim($_POST['db_name']);
	$db_mymps 	= trim($_POST['db_mymps']);
	$admin      = trim($_POST['manager']);
	$password   = trim($_POST['manager_pass']);
	$repassword = trim($_POST['manager_chkpass']);
	$email      = trim($_POST['email']);
	$in_type	= trim($_POST['install_type']);
	
	!$db_host && write_msg("δ��д���ݿ��������ַ��");
	!$db_user && write_msg("δ��д���ݿ�������û�����");
	!$db_name && write_msg("δ��д���ݿ����ơ�");
	(!$db_mymps || strstr($db_mymps, '.')) && write_msg("��ָ�������ݱ�ǰ׺�������ַ����뷵���޸ġ�");
	
	!$admin && write_msg("δ��д��ʼ�˵�¼�û�����");
	!$password && write_msg("δ��д��ʼ�˹������롣");
	!$repassword && write_msg("δ��д�ظ����롣");
	($password != $repassword) && write_msg("������������벻һ�¡�");

	$conn = @mysql_connect($db_host, $db_user, $db_pass);
	($conn === false) && write_msg("��װʧ�ܣ��������ݿ��û����Լ����ݿ������Ƿ���ȷ��"); 
	
	mysql_connect($db_host, $db_user, $db_pass);
	$cur_os = PHP_OS;
	$cur_phpversion = PHP_VERSION;
	($cur_phpversion < '4.3.0') && write_msg("����PHP�汾����4.3.0, �޷���װʹ�� ".MPS_SOFTNAME."<br />");
	$cur_mysqlversion = mysql_get_server_info();
	($cur_mysqlversion < '3.23') && write_msg("����MySQL�汾����3.23, ���ڳ���û�о�����ƽ̨�Ĳ���, �������� MySQL4 �����ݿ������.<br />");
	
	$yes = mysql_select_db($db_name);
	if($yes === false){
		$sql = $mysql_version >= '4.1' ? "CREATE DATABASE $db_name DEFAULT CHARACTER SET $dbcharset" : "CREATE DATABASE $db_name";
		(mysql_query($sql, $conn) === false) && write_msg("�޷��������ݿ�,������ز����Ƿ���ȷ��");
	}
	
	@mysql_close($conn);
	
	$files = "<?php\n\n";
	$files .= "\$charset    = \"$charset\";\n\n";
	$files .= "//ϵͳ�ַ�������\n\n";
	$files .= "\$dbcharset = \"$dbcharset\";\n\n";
	$files .= "//���ݿ��ַ�������\n\n";
	$files .= "\$db_host    = \"$db_host\";\n\n";
	$files .= "//���ݿ��������ַ��һ��Ϊlocalhost\n\n";
	$files .= "\$db_name    = \"$db_name\";\n\n";
	$files .= "//ʹ�õ����ݿ�����\n\n";
	$files .= "\$db_user    = \"$db_user\";\n\n";
	$files .= "//���ݿ��ʺ�\n\n";
	$files .= "\$db_pass    = \"$db_pass\";\n\n";
	$files .= "//���ݿ�����\n\n";
	$files .= "\$db_mymps   = \"$db_mymps\";\n\n";
	$files .= "//���ݿ�ǰ׺\n\n";
	$files .= "\$db_intype  = \"$in_type\";\n\n";
	$files .= "\$cookiepre = \"$cookiepre\";\n\n";
	$files .= "//cookies����ǰ׺\n\n";
	$files .= "\$cookiedomain = \"$cookiedomain\";\n\n";
	$files .= "\$cookiepath = \"$cookiepath\";\n\n";
	$files .= "?>";
	
	$file = @fopen(MYMPS_DATA . '/config.db.php', 'wb+');
	
	!$file && write_msg('�޷������ݿ������ļ� /config.db.php');
	if(!@fwrite($file, trim($files))){
		write_msg('�޷�д�������ļ� config.db.php');
		exit;
	}
	@fclose($file);
	
	require_once(MYMPS_INC."/db.class.php");
	
	if($install = import(MYMPS_ROOT.'/install/install.sql',$db_mymps,$dbcharset)){
		
		if($installarea) import(MYMPS_ROOT.'/install/install_area.sql',$db_mymps,$dbcharset);
		
		if($installcategory) import(MYMPS_ROOT.'/install/install_category.sql',$db_mymps,$dbcharset);
		
		if($installcoupon) import(MYMPS_ROOT.'/install/install_coupon.sql',$db_mymps,$dbcharset);
		
		if($installgroup) import(MYMPS_ROOT.'/install/install_group.sql',$db_mymps,$dbcharset);
		
		if($installcorp) import(MYMPS_ROOT.'/install/install_corp.sql',$db_mymps,$dbcharset);
		if($installinfomodel) import(MYMPS_ROOT.'/install/install_infomodel.sql',$db_mymps,$dbcharset);
		if($installadv) import(MYMPS_ROOT.'/install/install_adv.sql',$db_mymps,$dbcharset);
		
		$password = md5($password);
		$now_domain = "http://www.itworks.net.cn";//get_inurl();
		$db->query("INSERT INTO `{$db_mymps}admin` (userid,uname,pwd,email,typeid) VALUES ('$admin','$admin','$password','$email','1')");
		$db->query("UPDATE `{$db_mymps}config` SET value = 'blue' WHERE description = 'cfg_tpl_dir'");
		$db->query("UPDATE `{$db_mymps}config` SET value = '$now_domain' WHERE description = 'SiteUrl'");
		update_config_cache();
		write_lock();
		restore_headerurl();
		restore_footerurl();
		$step = "!";
		$info = "��ɰ�װ";
		$mymps_install_success_info = "��ϲ������ ".MPS_SOFTNAME."������Ϣϵͳ ".MPS_VERSION." �Ѿ���װ�ɹ���";
		include(mymps_tpl("inc_head"));
		?>
		<div class="c"></div>
		<div id="content">

			<div class="wrapD">
				<div class="wrapE">
					<div class="boxB">
						<div class="cgLeft"></div>
						<div class="cg" style="margin-left:35%">
							<h1><?php echo $mymps_install_success_info; ?></h1>
							<ul class="listA">
								<li>ϵͳǰ̨��ַ �� <a href="<?php echo $now_domain; ?>/index.php" target="_blank" style="color:#000"><?php echo $now_domain?>/index.php</a></li>
								<li>ϵͳ��̨��ַ �� <a href="<?php echo $now_domain; ?>/admin/index.php?go=config" target="_blank" style="color:#000"><?php echo $now_domain?>/admin/index.php</a></li>
								<li><?php echo MPS_SOFTNAME;?>�ٷ���̳ �� <a href="<?php echo MPS_BBS;?>" target="_blank" style="color:#000"><?php echo MPS_BBS?></a></li>
							</ul>
						</div>
					</div>
					<div class="c"></div>
				</div>
			</div>
			<div class="stepbt"><input type="button" class="next gray large" onClick="closewindows();" value="�رմ���"></div>
			<script language="JavaScript">
				function closewindows(){
					var agt = navigator.userAgent.toLowerCase();
					var is_ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
					if (is_ie) {
						var ieversion = parseFloat(agt.substring(agt.indexOf("msie")+5,agt.indexOf(';',agt.indexOf("msie"))));
						if (ieversion < 5.5) {
							var str  = '<object id="notipclose" classid="clsid:adb880a6-d8ff-11cf-9377-00aa003b7a11"><param name="command" value="close"></object>';
							document.body.insertadjacenthtml(beforeend,str);
							document.all.notipclose.click();
						} else {
							window.opener = null;
							window.close();
						}
					} else {
						window.close();
					}
				}
			</script>

		</div>

	</div>
	<?php
} else {
	write_msg('����'.MPS_SOFTNAME.'��װʧ�ܣ�');
}
}

include(mymps_tpl("inc_foot"));

function restore_headerurl(){
	global $db,$db_mymps,$mymps_global;
	//$db -> query("DELETE FROM `{$db_mymps}navurl` WHERE typeid = '3'");
	/*��Ϣ��Ŀ����*/
	$query = $db -> query("SELECT * FROM `{$db_mymps}category` WHERE parentid = '0'");
	while($row = $db -> fetchRow($query)){
		$category[$row['catid']]['catid'] = $row['catid'];
		$category[$row['catid']]['name']  = $row['catname'];
		$category[$row['catid']]['uri']   = "category.php?catid=".$row['catid'];
		$category[$row['catid']]['flag']  = $row['catid'];
	}
	
	$i=0;
	if(is_array($category)){
		foreach($category as $k => $v){
			$i = $i+1;
			$db -> query("INSERT INTO `{$db_mymps}navurl` (url,target,title,flag,typeid,isview,displayorder,createtime)VALUES('$v[uri]','_self','$v[name]','$v[catid]','3','2','$i','$timestamp')");
		}
	}
}

function restore_footerurl(){
	global $db,$db_mymps,$timestamp;
	$seo = array();
	$seo['seo_force_about'] = 'active';
	$query = $db->query("SELECT * FROM `{$db_mymps}about` ORDER BY displayorder ASC");
	while($row=$db->fetchRow($query)){
		$about[$row['id']]['id']=$row['id'];
		$about[$row['id']]['name']=$row['typename'];
		$about[$row['id']]['uri']= Rewrite('about',array('part'=>'aboutus','id'=>$row['id']));
	}
	
	$url = array();
	$url['faq']['name']				= '��վ����';
	$url['faq']['uri']				= Rewrite('about',array('part'=>'faq'));
	$url['friendlink']['name']		= '��������';
	$url['friendlink']['uri']		= Rewrite('about',array('part'=>'friendlink'));
	$url['annnounce']['name']		= '��վ����';
	$url['annnounce']['uri']		= Rewrite('about',array('part'=>'announce'));
	$url['sitemap']['name']			= '��վ��ͼ';
	$url['sitemap']['uri']			= Rewrite('about',array('part'=>'sitemap'));

	$url = is_array($about) ? array_merge($about,$url) : $url;
	$i=0;
	foreach($url as $k => $v){
		$i = $i+1;
		$db -> query("INSERT INTO `{$db_mymps}navurl` (url,target,title,flag,typeid,isview,displayorder,createtime)VALUES('$v[uri]','_blank','$v[name]','$k','2','2','$i','$timestamp')");
	}
}
?>