<?php include mymps_tpl('inc_head');?>
<form method="post" name="form1" action="?">
  <input name="cityid" value="<?php echo $cityid?>" type="hidden">
  <input name="cityedit[olddirectory]" value="<?php echo $city['directory']?>" type="hidden">
  <div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td colspan="2" align="left"><span><a href="area.php" style="text-decoration:underline">�����ӷ�վ����</a> &raquo; <?=$city['cityname']?></span></td>
      </tr>
      <tr>
        <td colspan="5" bgcolor="#f6ffdd">
          ���ڶ����վ,Ҫʹ�ö��������Ļ�,��Ҫ��������������͵���ǰ����������IP .�磺��*.mymps.com.cn��������������������*�ſ�ͷ��.һ�����ú�֮��,��Ҫ��������Ż���Ч.
        </td>
      </tr>
      <tr bgcolor="#ffffff">
        <td width="15%" valign="top">����ʡ��/ֱϽ�У� </td>
        <td>
          <select name="cityedit[provinceid]">
            <option value="0" <?php if($v['provinceid'] == 0) echo 'selected'; ?>>������</option>
            <?php if(is_array($province)){foreach($province as $k => $v){?>
            <option value="<?=$v[provinceid]?>" <?php if($v['provinceid'] == $city['provinceid']) echo 'selected'; ?>><?=$v[provincename]?></option>
            <?php }}?>
          </select></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td width="15%" valign="top">��վ�������� </td>
          <td><input name="cityedit[cityname]" class="text" type="text" value="<?=$city['cityname']?>">
            <font color="red">*</font>
            <div style="color:#666; margin-top:5px">��: ����</div></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td valign="top">��վ����ȫƴ/Ӣ��ȫ�ƣ�</td>
            <td><input name="cityedit[citypy]" class="text" type="text" value="<?=$city['citypy']?>"> <font color="red">*</font><div style="color:#666; margin-top:5px">��: <font style="text-decoration:underline">beijing</font><br />ֻ������ĸ\����\�»���,���������������ַ�</div> </td>
          </tr>
          <tr bgcolor="#ffffff">
            <td valign="top">ƴ��/��������ĸ�� </td>
            <td><input name="cityedit[firstletter]" class="txt" type="text" value="<?=$city['firstletter']?>"> 
              <font color="red">*</font>
              <div style="color:#666; margin-top:5px">��: b</div></td>
            </tr>
            <tr bgcolor="#ffffff">
              <td valign="top">Ŀ¼���ƣ� </td>
              <td><input name="cityedit[directory]" class="text" type="text" value="<?=$city['directory']?>"> <font color="red">*</font>
               <div style="color:#666; margin-top:5px">��: bj������ƴ������ĸ��<br />ֻ������ĸ\����\�»���,���������������ַ�,�����޷�����<br />
                <font color="red">��վ�����Ժ�,�������&nbsp; <b style="color:#006acd; text-decoration:underline"><?php echo $mymps_global['SiteUrl']?><?php echo $mymps_global['cfg_citiesdir']; ?>/bj/</b> &nbsp;�����ʴ˷�վ</font></div> </td>
              </tr>
              <tr bgcolor="#ffffff">
                <td valign="top">���������� </td>
                <td><input name="cityedit[domain]" class="text" type="text" value="<?=$city['domain']?>"> <font>ĩβ����ؽ�"/"</font><div style="color:#666; margin-top:5px">
                  ��: http://bj.mymps.com.cn/
                  <br />��������ö�������������Ŀ¼,������Ҫ���������ð󶨲�����Ҫ��������������������ָ��
                  <br /><font color="red">��д�����������������&nbsp; <b style="color:#006acd; text-decoration:underline">http://bj.mymps.com.cn/</b> &nbsp;�����ʴ˷�վ</font></div></td>
                </tr>
                <tr bgcolor="#ffffff">
                  <td>��ͼ��ע��ʼ���꣺</td>
                  <td><input name="cityedit[mappoint]" id="mappoint" type="text" class="text" value="<?=$city['mappoint']?>"/><input name="markmap" type="button" class="gray mini" value="��Ҫ��ע" onclick="javascript:setbg('��ͼ��ע',500,300,'../map.php?action=markpoint&width=500&height=230&title=default_map_point&p=<?=$city['mappoint']?>&cityname=<?=$city[citypy]?>')"/>
                    <div style="color:#666; margin-top:5px; line-height:25px;">
                     <i>(1).</i>���޷�������ע���������<a href="config.php">��ͼ��ע�ӿ�</a>�����Ƿ�������ȷ<br />
                     <i>(2).</i>��ʹ��<b>Ĭ��51ditu</b>�ӿڣ�������ӵĳ���Ϊ���ڳ��У���ɲ�������ʼ��ע����(���ռ���)��ϵͳ���Զ�����<font color="red">(��Ҫ��)</font>
                   </div></td>
                 </tr>
                 <tr bgcolor="#ffffff">
                  <td >�������� </td>
                  <td><input name="cityedit[displayorder]" class="txt" type="text" value="<?=$city['displayorder']?>"></td>
                </tr>
                <tr bgcolor="#ffffff">
                  <td >���ų��У� </td>
                  <td><input name="cityedit[ifhot]" class="checkbox" type="checkbox" value="1" <?php if($city['ifhot'] == 1) echo 'checked'; ?>></td>
                </tr>
                <tr class="firstr">
                  <td colspan="5">
                   SEO�Ż�����
                 </td>
               </tr>
               <tr bgcolor="#ffffff">
                <td >��վ��ʾ����(title)�� </td>
                <td><input name="cityedit[title]" class="text" type="text" value="<?=$city['title']?>"></td>
              </tr>
              <tr bgcolor="#ffffff">
                <td >��վ�ؼ���(keywords)�� </td>
                <td><textarea name="cityedit[keywords]" style="width:500px; height:100px"><?=$city['keywords']?></textarea></td>
              </tr>
              <tr bgcolor="#ffffff">
                <td >��վ����(description)�� </td>
                <td><textarea name="cityedit[description]" style="width:500px; height:100px"><?=$city['description']?></textarea></td>
              </tr>
            </table>
          </div>
          <center>
            <input type="submit" name="<?=CURSCRIPT?>_submit" value="�ύ" class="mymps large"/>
            &nbsp;&nbsp;
          </center>
        </form>
        <?php mymps_admin_tpl_global_foot();?>