<?php include mymps_tpl('inc_head');?>
<style>
.ttip{ color:#666; margin-top:5px; text-align:left}
</style>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
<div class="mpstopic-category">
	<div class="panel-tab">
		<ul class="clearfix tab-list">
			<li><a href="?part=bbs" <?php if($part == 'bbs'){?>class="current"<?php }?>>��̳����</a></li>
			<li><a href="?part=qqlogin" <?php if($part == 'qqlogin'){?>class="current"<?php }?>>QQ��¼����</a></li>
		</ul>
	</div>
</div>
</div>

<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">���˵��</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
<li><?php if($part == 'bbs'){?>������õ�����ϵͳ���Ϸ�������ȷ�Ľ������ã�����ᵼ���û�����������ע�ᡢ��¼Mymps<?php }else {?>���㿪ͨQQ�ʺŵ�¼����֮ǰ�뵽 <a href="http://opensns.qq.com/login?from=http://connect.opensns.qq.com/apply" target="_blank" style="text-decoration:underline">http://opensns.qq.com/login?from=http://connect.opensns.qq.com/apply</a>����appid, appkey, ��ע��callback��ַ<?}?></li>
    </td>
  </tr>
</table>
</div>

<form method="post" action="?">
<input name="part" value="<?=$part?>" type="hidden">
<?php if($part == 'bbs'){?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr"><td colspan="2">����<?php echo $here; ?></td></tr>
<tr bgcolor="#ffffff" style="font-weight:bold">
<td width="25%" style=" text-align:right;">
ѡ�����Ϸ���:  &nbsp;&nbsp;
</td>
<td>
<label for="none"><input name="passport_type" type="radio" class="radio" id="none" value="none" onclick='$obj("uc_div").style.display = "none";' <?php if($selected == 'none'){echo 'checked';}?>>�����ϵ�������̳</label> 
<label for="ucenter"><input class="radio" name="passport_type" type="radio" id="ucenter" value="ucenter" onclick='$obj("uc_div").style.display = "";$obj("client").innerHTML=$obj("server").innerHTML="ucenter";' <?php if($selected == 'ucenter'){echo 'checked';}?>>����ucenter1.6</label>
<label for="phpwind"><input class="radio" name="passport_type" type="radio" id="phpwind" value="phpwind" onclick='$obj("uc_div").style.display = "";$obj("client").innerHTML=$obj("server").innerHTML="phpwind";' <?php if($selected == 'phpwind'){echo 'checked';}?>>����phpwind 8.x</label>
</td>
</tr>
<tbody id="uc_div" <?php if($selected == 'none'){echo 'style="display:none"';}?>>
<tr style="background-color:#f1f5f8;">
  <td height=25 style="text-align:right"><b><span id="client"><?php echo $selected; ?></span>Ӧ�����ã�</b></td>
  <td>&nbsp;</td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height="25" style="text-align:right">�����API URL��</td>
  <td><input name="ucsettings[uc_api]" type=text id="uc_api" value="<?=$ucsettings[uc_api]?>" class="text">
  <font color="red"> *</font><div class="ttip">���� ����˵�ַ����Ŀ¼�ı������£��޸Ĵ��һ������벻Ҫ�Ķ�<br />����: http://www.site.com/ucenter (���Ҫ��'/')��</div></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">ͨ����Կ��</div>
  </td>
  <td><input name="ucsettings[uc_key]" type=text id="uc_key" value="<?=$ucsettings[uc_key]?>" class="text">
    <font color="red"> *</font><div class="ttip">ֻ����ʹ��Ӣ����ĸ�����֣��� 64 �ֽڡ�<br />Ӧ�ö˵�ͨ����Կ����������ñ���һ�£������Ӧ�ý��޷��� UCenter ����ͨ�š�</div></td>
</tr>
<tr bgcolor=#FFFFFF>
	<td height=25><div align="right">ucenter��mymps�ڣ�</div></td>
    <td>      
    <select name="ucsettings[uc_connect]">
        <option value="mysql" selected="selected"> ͬһ������ </option>
		<option value="NULL" selected="selected"> ��ͬ������ </option>
    </select>
    <font color="red">*</font>    </td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���ؿͻ���Ӧ��ID��</div></td>
  <td><input name="ucsettings[uc_appid]" type=text id="uc_appid" value="<?=$ucsettings[uc_appid]?>" class="text"> <font color="red">*</font></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���ؿͻ���IP��</div>
  </td>
  <td><input name="ucsettings[uc_ip]" type=text id="uc_ip" value="<?=$ucsettings[uc_ip]?>" class="text"><div class="ttip">
������������ռ��ɡ�������������������⵼�·�������Ӧ��ͨ��ʧ�ܣ��볢������Ϊ��Ӧ�����ڷ������� IP ��ַ��</div></td>
</tr>
<tr style="background-color:#f1f5f8;">
  <td height=25 style="text-align:right"><b><span id="server"><?php echo $selected; ?></span>���ݿ�������ã�</b></td>
  <td>&nbsp;</td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���ݿ���������</div>
    </td>
  <td><input name="ucsettings[uc_dbhost]" type=text id="uc_dbhost" value="<?=$ucsettings[uc_dbhost] ? $ucsettings[uc_dbhost] : 'localhost'?>" class="text">
    <font color="red">*</font><div class="ttip">Ĭ��:localhost����� MySQL �˿ڲ���Ĭ�ϵ� 3306������д������ʽ��127.0.0.1:6033��</div></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���ݿ�����</div></td>
  <td><input name="ucsettings[uc_dbname]" type=text id="uc_dbname" value="<?=$ucsettings[uc_dbname]?>" class="text">
    <font color="red">*</font></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���ݿ��û�����</div></td>
  <td><input name="ucsettings[uc_dbuser]" type=text id="uc_dbuser" value="<?=$ucsettings[uc_dbuser]?>" class="text">
    <font color="red">*</font></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���ݿ����룺</div></td>
  <td><input name="ucsettings[uc_dbpwd]" type=password id="uc_dbpwd" value="<?=$ucsettings[uc_dbpwd]?>" class="text">
    <font color="red">*</font></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���ݱ�ǰ׺��</div></td>
  <td><input name="ucsettings[uc_dbpre]" type=text id="uc_dbpre" value="<?=$ucsettings[uc_dbpre]?>" class="text">
    <font color="red">*</font>
    <div class="ttip">uc�����ʹ�õ����ݿ��ǰ׺,һ��Ϊ uc_ <br />
      phpwind�����ʹ�õ����ݿ��ǰ׺,һ��Ϊ pw_ </div></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���ݿ��ַ�����</div></td>
  <td><input name="ucsettings[uc_charset]" type=text id="uc_charset" value="<?=$ucsettings[uc_charset]?>" class="text">
    <font color="red">*</font><div class="ttip">����д��������ݿ�ı��� gbk��ut8</div></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">UCenter/phpwind �ַ����룺</div></td>
  <td><input name="ucsettings[uc_dbcharset]" type=text id="uc_dbcharset" value="<?=$ucsettings[uc_dbcharset]?>" class="text">
    <font color="red">*</font><div class="ttip">����д���ݿ�ı��� gbk��ut8</div></td>
</tr>
</tbody>
</table>
</div>
<?php } else {?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr"><td colspan="2">����QQ��¼����</td></tr>
<tr bgcolor="#ffffff" style="font-weight:bold">
<td width="25%" style=" text-align:right; background-color:#f7f7f7">
�Ƿ���QQ��¼���ϣ�
</td>
<td style="background-color:#f7f7f7">
<label for="open"><input name="qqsettings[open]" type="radio" class="radio" id="open" value="1" onclick='$obj("qqdetail").style.display = "";' <?php if($qqsettings['open'] == 1){echo 'checked';}?>>����</label> 
<label for="close"><input class="radio"  name="qqsettings[open]" type="radio" id="close" value="0" onclick='$obj("qqdetail").style.display = "none";' <?php if(!$qqsettings['open']){echo 'checked';}?>>�ر�</label>
</td>
</tr>
<tbody id="qqdetail" <?php if(!$qqsettings['open']){?>style="display:none;"<?php }?>>
<tr bgcolor=#FFFFFF>
  <td height=25 width="25%" ><div align="right">���뵽��appid��</div></td>
  <td><input name="qqsettings[appid]" type=text id="appid" value="<?=$qqsettings[appid]?>" class="text">
  <font color="red"> *</font></td>
</tr>
<tr bgcolor=#FFFFFF>
  <td height=25><div align="right">���뵽��appkey��</div></td>
  <td><input name="qqsettings[appkey]" type=text id="appkey" value="<?=$qqsettings[appkey]?>" class="text">
    <font color="red"> *</font></td>
</tr>
<tr bgcolor=#FFFFFF>
	<td height=25><div align="right">callback��ַ��</div><div class="ttip">QQ��¼�ɹ�����ת�ĵ�ַ����ȷ����ַ��ʵ���ã�����ᵼ�µ�¼ʧ�ܡ�</div></td>
    <td>      
    <input name="qqsettings[callback]" type=text id="callback" value="<?=$qqsettings[callback] ? $qqsettings[callback] : $mymps_global[SiteUrl].'/include/qqlogin/qq_callback.php'?>" class="text">
    <font color="red"> *</font></td>
</tr>
</tbody>
</table>
</div>
<?php }?>
<center><input type="submit" value="�� ��" class="mymps large" name="passport_submit"/>  </center>
</form>
<?php mymps_admin_tpl_global_foot();?>