<?php include mymps_tpl('inc_head');?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
  <div class="mpstopic-category">
    <div class="panel-tab">
      <ul class="clearfix tab-list">
        <li><a href="?part=area_city_add">���ӵ�һ��վ</a></li>
        <li><a href="?part=area_city_add&action=batch" class="current">�������ӷ�վ</a></li>
      </ul>
    </div>
  </div>
</div>
<?php if($step == '2'){?>
<form name="form_mymps" action="?" method="post">
  <input name="step" value="2" type="hidden">
  <input name="batchnewprovinceid" value="<?php echo $batchnew[provinceid]; ?>" type="hidden">
  <div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td width="80">����ʡ��</td>
        <td width="80">��վ����</td>
        <td>����Ŀ¼��</td>
        <td>ȫƴ/Ӣ��ȫ��</td>
        <td>ƴ������ĸ</td>
        <td>��������</td>
        <td>��������</td>
        <td>���ų���</td>
      </tr>
      <?php if(is_array($array)) {foreach($array as $k => $v){?>
      <tr>
        <td><?php echo $provincename ? $provincename : '<font color=red>������</font>'; ?></td>
        <td><input name="batchnewcityname[]" value="<?php echo $v['cityname']; ?>" class="txt" type="text"/></td>
        <td><input name="batchnewdirectory[]" class="txt" type="text" value="<?php echo $v['directory']; ?>"></td>
        <td><input name="batchnewcitypy[]" class="text" type="text" value="<?php echo $v['citypy']; ?>"></td>
        <td><input name="batchnewfirstletter[]" class="txt" type="text" value="<?php echo $v['firstletter']; ?>"></td>
        <td><input name="batchnewdomain[]" class="text" type="text" value="<?php echo $v['domain']; ?>"></td>
        <td><input name="batchnewdisplayorder[]" class="txt" type="text" value="<?php echo $v['displayorder']; ?>"></td>
        <td><input name="batchnewifhot[]" type="checkbox" class="checkbox"></td>
      </tr>
      <?php }}?>
      <?php if($repeatwarning){?>
      <tr>
        <td colspan="8" bgcolor="#f6ffdd"><?php echo $repeatwarning; ?></td>
      </tr>
      <?php }?>
    </table>
  </div>
  <center><input type="button" onclick="history.go(-1);" value="< ����" class="gray large"/> &nbsp; <input name="<?=CURSCRIPT?>_submit" type="submit" value="��һ�� >" class="mymps large"/></center>
</form>
<?php }else{?>
<form method="post" name="form" action="?">
  <input name="step" value="1" type="hidden">
  <div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td colspan="2" align="left">�������з�վ</td>
      </tr>
      <tr bgcolor="#ffffff">
        <td width="15%" valign="top">����ʡ��/ֱϽ�У� </td>
        <td>
          <select name="batchnew[provinceid]">
            <option value="0">������</option>
            <?php if(is_array($province)){foreach($province as $k => $v){?>
            <option value="<?=$v[provinceid]?>"><?=$v[provincename]?></option>
            <?php }}?>
          </select></td>
        </tr>

        <tr bgcolor="#ffffff">
          <td width="15%" valign="top">��վ�������� </td>
          <td><textarea name="batchnew[cityname]" id="newcityname" style="width:400px; height:200px;"></textarea> <font color="red">*</font><div style="color:#666; margin-top:5px">�����վ���ÿո����������: ���� �Ϻ� ��� �ϲ� ����</div></td>
        </tr>
      </table>
    </div>
    <center>
      <input type="submit" name="<?=CURSCRIPT?>_submit" value="��һ��" class="mymps large"/>
      &nbsp;&nbsp;
    </center>
  </form>
  <?php }?>
  <?php mymps_admin_tpl_global_foot();?>