<?php include mymps_tpl('inc_head');?>
<style>
FIELDSET{ float:left; width:44%; margin:10px 10px 5px 5px; height:150px; line-height:25px;}
</style>
<script type='text/javascript' src='js/vbm.js'></script>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">������ʾ</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
    <li><?=MPS_SOFTNAME?>��Ϊ�������ȵ�CMSϵͳ��������<b>��ģ��</b>��α��̬�Լ�����̬�����л��Ĺ��ܣ���ʼDIY�����վSEO���ðɣ�</li>
	<li>������ʹ�ù����ļ�����ɲο��˽̳�����<a style="text-decoration:underline" href="http://www.it-works.com.cn/thread-149397-1-1.html" target="_blank">http://www.it-works.com.cn/thread-149397-1-1.html</a></li>
    </td>
  </tr>
</table>
</div>
<form action="seoset.php" method="post">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">SEO��������</td>
  </tr>
 <tr bgcolor="#f1f5f8">
 <td style="width:35%; line-height:22px">��վ���⣬��ʾ��title��ǩ����վ����֮���ʵ����ֹؼ���</td>
 <td bgcolor="#ffffff"><input name="seo_sitename" value="<?=$seo['seo_sitename']?>" class="text"/></td>
 </tr>
 <tr bgcolor="#f1f5f8">
 <td style="width:35%; line-height:22px">��վ�ؼ��ʣ�����ؼ����ԡ�,���ָ���<br />
��վ���� <font color="red">{city}</font> ����(δ�������÷�վ�ؼ���ʱ��Ч)</td>
 <td bgcolor="#ffffff"><input name="seo_keywords" value="<?=$seo['seo_keywords']?>" class="text"/></td>
 </tr>
 <tr bgcolor="#f1f5f8">
 <td style="width:35%; line-height:22px">��վ������������255���ַ�<br />
��վ���� <font color="red">{city}</font> ����(δ�������÷�վ����ʱ��Ч)</td>
 <td bgcolor="#ffffff"><textarea name="seo_description" style="height:100px; width:205px"><?=$seo['seo_description']?></textarea></td>
 </tr>
 <tr class="firstr">
  	<td colspan="2">SEO��ϸ����</td>
  </tr>
 <tr bgcolor="#f5f8ff" style="font-weight:bold">
      <td>���ҳ��</td>
      <td>��ʾ��ʽ</td>
    </tr>
 <tr bgcolor="#f1f5f8">
 <td style="width:35%">վ��/about.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_about],'seo_force_about')?></td>
 </tr>
  <tr bgcolor="#f1f5f8">
  <td >����/category.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_category],'seo_force_category')?></font></td>
 </tr>
  <tr bgcolor="#f1f5f8">
  <td >��Ϣ/info.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_info],'seo_force_info')?></td>
 </tr>
 <tr bgcolor="#f1f5f8">
  <td >����/news.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_news],'seo_force_news')?></td>
  <tr bgcolor="#f1f5f8">
 </tr>
  <tr bgcolor="#f1f5f8">
  <td >�ռ�/space.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_space],'seo_force_space')?></td>
 </tr>
  <tr bgcolor="#f1f5f8">
  <td >����/store.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_store],'seo_force_store')?></td>
 </tr>
  <tr bgcolor="#f1f5f8">
  <td>�̼һ�ҳ/corp.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_yp],'seo_force_yp')?></td>
 </tr>
</table>
</div>
<center><label for="updatefile"><input id="updatefile" name="updatefile" value="1" type="checkbox">����α��̬�����ļ�</label></center>
<center><input name="seoset_submit" value="�� ��" class="mymps large" type="submit"/></center>
</form>
<div class="clear" style="margin-top:5px"></div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
 <tr class="firstr">
  	<td colspan="2">α��̬����˵��</td>
 </tr>
<!-- <tr>
    <td colspan="2" bgcolor="#f6ffdd">
    IISα��̬�����ļ� /rewrite/httpd.ini��Apacheα��̬�����ļ� /rewrite/.htaccess�����в���֮������ϵ�ٷ��ͷ��Ի�ð���
    </td>
 </tr>-->
 <tr>
 	<td bgcolor="#ffffff" colspan="2">
     <FIELDSET><LEGEND>IIS.����վ��������α��̬˵��</LEGEND> 
     ���ڶ����վʹ�ö�����������,��Ҫ�������������������ǰ����������IP .�磺��*.mymps.com.cn���������㵱ǰ��������IP
     </FIELDSET>
      <FIELDSET><LEGEND>Apache.����վ��������α��̬˵��</LEGEND>
         1�����ڶ����վʹ�ö�����������,��Ҫ�������������������ǰ����������IP<br />
      2������->��վ����->�ѽ���վ->ȫ����վ���ö�������
      <br />
3��<input class="mymps mini" value="����apacheα��̬����" onclick="location.href='?action=makeapacherewrite'" type="button" alt="�������apacheα��̬�����ļ�" title="�������apacheα��̬�����ļ�"><br />
4���޸�apache�����ļ�,�����һ��������´���
<br />Include <?php echo str_replace('\\','/',MYMPS_ROOT);?>/apache.txt 
</FIELDSET>
     <FIELDSET><LEGEND>IIS.����վ����Ŀ¼α��̬˵��</LEGEND>
     IISα��̬�����ļ� /rewrite/httpd.ini
     <br />1�����������û������α��̬����·�� /rewrite/rewrite.dll
     <br />2��VPS������������û������ISAPI�� ·��Ϊ����/rewrite/rewrite.dll
     </FIELDSET>
      <FIELDSET><LEGEND>Apache.����վ����Ŀ¼α��̬˵��</LEGEND> 
      Apacheα��̬�����ļ� /rewrite/.htaccess
      </FIELDSET>
    </td>
 </tr> 
 </table>
</div>
<?php mymps_admin_tpl_global_foot();?>