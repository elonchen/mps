<?php include mymps_tpl('inc_head');?>
<style>
  a.letter{margin:1px 5px; font-weight:bold; font-size:14px; text-decoration:underline;}
</style>
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
<script type="text/javascript" src="js/vbm.js"></script>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
  <div class="mpstopic-category">
    <div class="panel-tab">
      <ul class="clearfix tab-list">
        <li><a href="?" class="current">�����ӷ�վ/����</a></li>
        <li><a href="province.php">ʡ��/ֱϽ�й���</a></li>
      </ul>
      <ul style="float:right; text-align:right">
        <form method="get" action="?">
         <select name="type">
          <option value="cityid" <?php if($type == 'cityid') echo 'selected'; ?>>��վ���</option>
          <option value="cityname" <?php if($type == 'cityname') echo 'selected'; ?>>��վ����</option>
          <option value="directory" <?php if($type == 'directory') echo 'selected'; ?>>���Ŀ¼��</option>
          <option value="provincename" <?php if($type == 'provincename') echo 'selected'; ?>>����ʡ��</option>
        </select> 
        
        <input name="keywords" type="text" class="text" style="width:100px;" value="<?=$keywords?>">    ÿҳ��ʾ��¼����<input name="showperpage" type="text" class="txt" value="<?=$showperpage ? $showperpage : ''?>">
        <input type="submit" value="�� ��" class="gray mini">
      </form>
    </ul>
  </div>
</div>
</div>

<div id="h0">

  <?php if(empty($cityid) && empty($areaid)){?>

  <form name="form_mymps" action="?part=list" method="post">
    <input name="url" type="hidden" value="<?=GetUrl()?>">
    <div id="<?=MPS_SOFTNAME?>">
      <table border="0" cellspacing="0" cellpadding="0" class="vbm">
        <tr class="firstr">
          <td width="40"><input name="chkall" type="checkbox" onclick="AllCheck('prefix', this.form, 'action')" class="checkbox" id="createdir"/></td>
          <td width="40">���</td>
          <td width="40">״̬</td>
          <td>��վ����</td>
          <td>���Ŀ¼</td>
          <td>����</td>
          <td width="80">����</td>
          <td>����</td>
        </tr>
        <?php 
        if(is_array($list)){
          foreach($list AS $area)
          {
            ?>
            <tr bgcolor="#ffffff">
              <a name="<?=$area[firstletter]?>"></a>
              <td width="40"><label><input name="actiondir[<?=$area[cityid]?>]" value="<?=$area[directory]?>" type="checkbox" class="checkbox" <?php if(empty($area[directory])) echo 'disabled';?>/></label></td>
              <td width="40"><?=$area[cityid]?></td>
              <td width="40"><?=$area[status]==1?'<font color=green>����</font>':'<font color=red>�ѹر�</font>'?></td>
              <td width="80" style="<?php if($area['ifhot'] == '1') echo 'color:red; text-decoration:underline'; ?>"><label><b><?=$area[cityname]?></b></label></td>
              <td align="left"><?=$mymps_global['cfg_citiesdir']?>/<?=$area[directory]?></td>
              <td align="left"><a href="<?=$area[domain] ? $area[domain] : $mymps_global['SiteUrl'].$mymps_global['cfg_citiesdir'].'/'.$area[directory]?>" target="_blank" style="text-decoration:underline"><?=$area[domain] ? $area[domain] : $mymps_global['SiteUrl'].$mymps_global['cfg_citiesdir'].'/'.$area[directory]?></a></td>
              <td width="40"><input name="updatecity_displayorder[<?=$area[cityid]?>]" value="<?=$area[displayorder]?>" class="txt" type="text"/></td>
              <td><a href="?part=list&cityid=<?=$area[cityid]?>">��������</a> / <a href="?part=edit&cityid=<?=$area[cityid]?>">�༭��վ</a> / <a onClick="if(!confirm('�ò�����ͬʱɾ���÷�վ�µĵ�����·�Σ�������Ϣ����Ա����棬�������ã���ȷ��Ҫɾ���÷�վ��'))return false;" href="?part=del&cityid=<?=$area[cityid]?>">ɾ����վ</a></td>
            </tr>
            <?
          }
        } else {
          ?>
          <tr bgcolor="#ffffff">
            <td colspan="10" bgcolor="#ffffff"><div class="nodata">���� <span><?php echo $curareaname?></span>û�������������ࡣ</div></td>
          </tr>
          <?}?>
          <tr bgcolor="#f5fbff">
            <td  colspan="9">
             <label for="action_delcity"><input onclick="javascript:alert('��ͬ��ɾ����վ�µ���Ϣ�����š��̼ҵ������Ҳ��ָܻ��������������')" type="radio" class="radio" id="action_delcity" name="action" value="delcity">ɾ����վ</label>
             <label for="action_deldir"><input type="radio" class="radio" id="action_deldir" name="action" value="deldir">ɾ����վĿ¼</label>
             <label for="action_mkdir"><input type="radio" class="radio" id="action_mkdir" name="action" value="mkdir">���ɷ�վĿ¼</label>
             <label for="action_open"><input type="radio" class="radio" id="action_open" name="action" value="open">������վ</label>
             <label for="action_close"><input type="radio" class="radio" id="action_close" name="action" value="close">�رշ�վ</label>
           </td>
         </tr>
         <tr bgcolor="white">
           <td colspan="9">
            <input name="<?=CURSCRIPT?>_submit" type="submit" value="�ύ" class="mymps large"/>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" value="ȫ����վ���ö�������&raquo;" class="gray mini" onclick="if(!confirm('�ò����������/������/VPS֧��'))return false;location.href='area.php?part=usedomain'" style="margin-left:90px;">
            <input type="button" value="ȫ����վȡ����������&raquo;" class="gray mini" onclick="location.href='area.php?part=usenodomain'" style="margin-left:10px;">
            <input type="button" value="һ������ȫ����վĿ¼ &raquo;" class="gray mini" onclick="location.href='area.php?part=makealldir'" style="margin-left:10px;">
            <input type="button" value="һ��ɾ��ȫ����վĿ¼ &raquo;" class="gray mini" onclick="location.href='area.php?part=delalldir'" style="margin-left:10px;">
          </td>
        </tr>
      </table>
    </div>
    <center></center>
  </form>
  <div class="pagination"><?=page2()?></div>

  <?php } elseif($areaid) {?>
  <div>
    ��ǰλ�ã�<span><a href="area.php">���з�վ</a> &raquo; <a href="?cityid=<?=$cityid?>"><?php echo $cityname; ?></a> &raquo; <?php echo $currentname; ?></span>
  </div>
  <div class="clear"></div>
  <form action="?" method="post">
    <input name="areaid" value="<?php echo $areaid; ?>" type="hidden">
    <input name="cityname" value="<?php echo $cityname; ?>" type="hidden" />
    <input name="cityid" value="<?php echo $cityid; ?>" type="hidden" />
    <div id="<?=MPS_SOFTNAME?>">
     <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td width="40"><label><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/>ɾ?</label></td>
        <td width="60%">�ֵ�/·����</td>
        <td>����</td>
      </tr>
      <?php 
      if($list){
        foreach($list AS $area)
        {
          ?>
          <tr bgcolor="#ffffff">
            <td width="40"><label><input type='checkbox' name='deletestreetid[]' value='<?=$area[streetid]?>' class='checkbox'></label></td>
            <td align="left"><input name="updatestreet_streetname[<?=$area[streetid]?>]" value="<?=$area[streetname]?>" class="txt" style="width:100px"> </td>
            <td><input name="updatestreet_displayorder[<?=$area[streetid]?>]" value="<?=$area[displayorder]?>" class="txt" type="text"/></td>
          </tr>
          <?
        }
      } else {
        ?>
        <tr bgcolor="#ffffff">
          <td colspan="5" bgcolor="#ffffff"><div class="nodata">���� <span><?php echo $currentname; ?></span>��δ��������ֵ�/·��<br />
            <br />����<a href="?cityid=<?=$cityid?>">��һ��</a></div></td>
          </tr>
          <?}?>
        </table>
      </div>
      <center><input name="<?=CURSCRIPT?>_submit" type="submit" value="�ύ" class="mymps large" onClick="if(!confirm('ɾ��������ͬ��ɾ������������Ľֵ�·�Σ���ȷ����Ҫ������'))return false;"/></center>
    </form>
    <div class="clear"></div>
    <form method="post" name="form" action="?">
      <input name="newstreet[areaid]" value="<?=$areaid?>" type="hidden">
      <input name="cityname" value="<?php echo $cityname; ?>" type="hidden" />
      <input name="cityid" value="<?php echo $cityid; ?>" type="hidden" />
      <div id="<?=MPS_SOFTNAME?>">
        <table border="0" cellspacing="0" cellpadding="0" class="vbm">
          <tr class="firstr">
            <td colspan="2" align="left">���� <span><?=$currentname?></span>�����µĽֵ�</td>
          </tr>
          <tr bgcolor="#ffffff">
            <td width="8%">�ֵ����ƣ� </td>
            <td>
              <textarea rows="3" name="newstreet[streetname]" cols="50"></textarea><br />
              <div style="margin-top:3px">֧�ֵֽ�������ӣ�����ֵ��Կո����<br />
                <font color="red">�������ֵ�1 �ֵ�2 �ֵ�3 �ֵ�4 �ֵ�5</font></div></td>
              </tr>
              <tr bgcolor="#ffffff">
                <td >�ֵ����� </td>
                <td><input name="newstreet[displayorder]" class="txt" type="text" value="0"></td>
              </tr>
            </table>
          </div>
          <center>
            <input type="submit" name="<?=CURSCRIPT?>_submit" value="�ύ" class="mymps large"/>
            &nbsp;&nbsp;
          </center>
        </form>
        <?php } elseif($cityid) {?>
        <div>��ǰλ�ã�<span><a href="area.php">���з�վ</a> &raquo; <?php echo $currentname; ?></span></div>
        <div class="clear"></div>
        <form action="?" method="post">
          <input name="cityid" value="<?=$cityid?>" type="hidden">
          <div id="<?=MPS_SOFTNAME?>">
            <table border="0" cellspacing="0" cellpadding="0" class="vbm">
              <tr class="firstr">
                <td width="5%"><label><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/>ɾ?</label></td>
                <td>����</td>
                <td>����</td>
                <td>����</td>
              </tr>
              <?php 
              if($list){
                foreach($list AS $area)
                {
                  ?>
                  <tr bgcolor="#ffffff">
                    <td><label><input type='checkbox' name='deleteareaid[]' value='<?=$area[areaid]?>' class='checkbox'></label></td>
                    <td align="left"><input name="updatearea_areaname[<?=$area[areaid]?>]" value="<?=$area[areaname]?>" class="txt" style="width:100px"> </td>
                    <td><input name="updatearea_displayorder[<?=$area[areaid]?>]" value="<?=$area[displayorder]?>" class="txt" type="text"/></td>
                    <td><a href="?part=list&areaid=<?=$area[areaid]?>&cityid=<?=$cityid?>&cityname=<?=$currentname?>">�����ֵ�/·��</a></td>
                  </tr>
                  <?
                }
              } else {
                ?>
                <tr bgcolor="#ffffff">
                  <td colspan="5" bgcolor="#ffffff"><div class="nodata">�ó��з�վ <span><?php echo $currentname; ?></span>��δ�����������<br />
                    <br />����<a href="area.php">��һ��</a></div></td>
                  </tr>
                  <?}?>
                </table>
              </div>
              <center><input name="<?=CURSCRIPT?>_submit" type="submit" value="�ύ" class="mymps large"/></center>
            </form>
            <div class="clear" style="margin-top:5px"></div>
            <form method=post name="form" action="?">
              <input name="newarea[cityid]" value="<?=$cityid?>" type="hidden">
              <div id="<?=MPS_SOFTNAME?>">
                <table border="0" cellspacing="0" cellpadding="0" class="vbm">
                  <tr class="firstr">
                    <td colspan="2" align="left">���� <span><?=$currentname?></span>��վ�µĵ���</td>
                  </tr>
                  <tr bgcolor="#ffffff">
                    <td width="8%">�������ƣ� </td>
                    <td>
                      <textarea rows="3" name="newarea[areaname]" cols="50"></textarea><br />
                      <div style="margin-top:3px">֧�ֵ���������ӣ���������Կո����<br />
                        <font color="red">����������1 ����2 ����3 ����4 ����5</font></div></td>
                      </tr>
                      <tr bgcolor="#ffffff">
                        <td >�������� </td>
                        <td><input name="newarea[displayorder]" class="txt" type="text" value="0"></td>
                      </tr>
                    </table>
                  </div>
                  <center>
                    <input type="submit" name="<?=CURSCRIPT?>_submit" value="�ύ" class="mymps large"/>
                    &nbsp;&nbsp;
                  </center>
                </form>
                <?php }?>
              </div>
              <?php mymps_admin_tpl_global_foot();?>