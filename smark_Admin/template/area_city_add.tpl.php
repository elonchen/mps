<?php include mymps_tpl('inc_head');?>
<script language=javascript>
  function chkform(){
   if(document.form.areaname.value==""){
    alert('������������ƣ���������� | ������');
    document.form.areaname.focus();
    return false;
  }
}

function getpinyin(t){
	if(t != ''){
		url='include/get_pinyin.php?t='+t;
		target='iframe_t';
		document.getElementById('form_t').action=url;
		document.getElementById('form_t').target=target;
		document.getElementById('form_t').submit();
	}
}

function getpinyinhead(t){
	if(t != ''){
		url='include/get_pinyin.php?ishead=1&t='+t;
		target='iframe_t';
		document.getElementById('form_t').action=url;
		document.getElementById('form_t').target=target;
		document.getElementById('form_t').submit();
	}
}
</script>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
  <div class="mpstopic-category">
    <div class="panel-tab">
      <ul class="clearfix tab-list">
        <li><a href="?part=area_city_add" class="current">���ӵ�һ��վ</a></li>
        <li><a href="?part=area_city_add&action=batch">�������ӷ�վ</a></li>
      </ul>
    </div>
  </div>
</div>
<div style="display:none;">
  <iframe width=0 height=0 src='' id="iframe_t" name="iframe_t"></iframe> 
  <form method="post" target="iframe_t" id="form_t"></form>
</div>
<form method=post onSubmit="return chkform()" name="form" action="?">
  <div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td colspan="2" align="left">�������з�վ</td>
      </tr>
      <tr>
        <td colspan="5" bgcolor="#f6ffdd">
          ���ڶ����վ,Ҫʹ�ö��������Ļ�,��Ҫ��������������͵���ǰ����������IP .�磺��*.<?php echo str_replace( array("http://","www."),array("",""),$mymps_global['SiteUrl'] ); ?>��������������������*�ſ�ͷ��.һ�����ú�֮��,��Ҫ��������Ż���Ч.
        </td>
      </tr>
      <tr bgcolor="#ffffff">
        <td width="15%" valign="top">����ʡ��/ֱϽ�У� </td>
        <td>
          <select name="citynew[provinceid]">
            <option value="0">������</option>
            <?php if(is_array($province)){foreach($province as $k => $v){?>
            <option value="<?=$v[provinceid]?>"><?=$v[provincename]?></option>
            <?php }}?>
          </select></td>
        </tr>

        <tr bgcolor="#ffffff">
          <td width="15%" valign="top">��վ�������� </td>
          <td><input name="citynew[cityname]" id="newcityname" onBlur="getpinyinhead(this.value);" class="text" type="text"> <font color="red">*</font><div style="color:#666; margin-top:5px">��: ����</div></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td valign="top">��վ����Ŀ¼���� </td>
          <td><input id="newdirectory" onBlur="document.getElementById('newfirstletter').value=this.value.substring(0,1);document.getElementById('newdomain').value='http://'+this.value+'<?php echo str_replace('http://www','',$mymps_global[SiteUrl]).'/'; ?>';getpinyin(document.getElementById('newcityname').value);" name="citynew[directory]" class="text" type="text" value=""> <font color="red">*</font><div style="color:#666; margin-top:5px">��: <font style="text-decoration:underline">bj</font>��ֻ������ĸ\����\�»���,���������������ַ�,�����޷�����<br />
            <font color="red">��վ�����Ժ�,�������&nbsp; <b style="color:#006acd; text-decoration:underline"><?php echo $mymps_global['SiteUrl']?><?php echo $mymps_global['cfg_citiesdir']; ?>/bj/</b> &nbsp;�����ʴ˷�վ</font></div> </td>
          </tr>
          <tr bgcolor="#ffffff">
            <td valign="top">��վ����ȫƴ/Ӣ��ȫ�ƣ�</td>
            <td><input id="newcitypy" name="citynew[citypy]" class="text" type="text" value=""> <font color="red">*</font><div style="color:#666; margin-top:5px">��: <font style="text-decoration:underline">beijing</font>��ֻ������ĸ\����\�»���,���������������ַ�</div> </td>
          </tr>
          <tr bgcolor="#ffffff">
            <td valign="top">ƴ��/��������ĸ�� </td>
            <td><input id="newfirstletter" name="citynew[firstletter]" class="txt" type="text"> <font color="red">*</font><div style="color:#666; margin-top:5px">��: <font style="text-decoration:underline">b</font></div></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td valign="top">���������� </td>
            <td><input id="newdomain" name="citynew[domain]" class="text" type="text" value=""> 
             <div style="color:#666; margin-top:5px">ĩβ����ؽ�"<font color="red">/</font>"��
              ��: <font style="text-decoration:underline">http://beijing.mymps.com.cn/</font>
              <br /><font color="red">�������ö���������ʽ��������</font>
              <br />��д�����������������&nbsp; <b style="color:#006acd; text-decoration:underline">http://beijing.<?php echo str_replace( array("http://","www."),array("",""),$mymps_global['SiteUrl'] ); ?></b> &nbsp;�����ʴ˷�վ</div></td>
            </tr>
            <tr bgcolor="#ffffff">
              <td>��ͼ��ע��ʼ���꣺</td>
              <td><input name="citynew[mappoint]" value="" class="text" id="mappoint"/><input type="button" class="gray mini" value="��Ҫ��ע" onClick="javascript:setbg('��ͼ��ע',500,300,'../map.php?action=markpoint&width=500&height=230&title=default_map_point&cityname='+document.getElementById('newdirectory').value+'&p=')"/>
                <div style="color:#666; margin-top:5px; line-height:25px;">
                 <i>(1).</i>���޷�������ע���������<a href="config.php">��ͼ��ע�ӿ�</a>�����Ƿ�������ȷ<br />
                 <i>(2).</i>��ʹ��<b>51ditu</b>�ӿڣ�������ӵĳ���Ϊ���ڳ��У���ɲ�������ʼ��ע����(���ռ���)��ϵͳ���Զ�����<font color="red">(��Ҫ��)</font>
               </div></td>
             </tr>
             <tr bgcolor="#ffffff">
              <td >�������� </td>
              <td><input name="citynew[displayorder]" class="txt" type="text" value="<?=$db -> getOne("SELECT MAX(displayorder) FROM `{$db_mymps}city`")?>"></td>
            </tr>
            <tr bgcolor="#ffffff">
              <td >���ų��У� </td>
              <td><input name="citynew[ifhot]" class="checkbox" type="checkbox" value="1"></td>
            </tr>
            <tr class="firstr">
              <td colspan="5">
               SEO�Ż�����
             </td>
           </tr>
           <tr bgcolor="#ffffff">
            <td >��վ��ʾ����(title)�� </td>
            <td><input name="citynew[title]" class="text" type="text" value=""></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td >��վ�ؼ���(keywords)�� </td>
            <td><textarea name="citynew[keywords]" style="width:500px; height:100px"></textarea></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td >��վ����(description)�� </td>
            <td><textarea name="citynew[description]" style="width:500px; height:100px"></textarea></td>
          </tr>
        </table>
      </div>
      <center>
        <input type="submit" name="<?=CURSCRIPT?>_submit" value="�ύ" class="mymps large"/>
        &nbsp;&nbsp;
      </center>
    </form>
    <?php mymps_admin_tpl_global_foot();?>