<?php include mymps_tpl('inc_head');?>
<form method=post onSubmit="return chkform()" name="form" action="?part=add">
  <div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td colspan="2" align="left">���ӵ����µĽֵ�</td>
      </tr>
      <tr bgcolor="#ffffff">
        <td width="15%">�ֵ����ƣ� </td>
        <td>
          <textarea rows="3" name="newstreet[streetname]" cols="50"></textarea><br />
          <div style="margin-top:3px">֧�ֵֽ�������ӣ�����ֵ��Կո����<br />
            <font color="red">�������ֵ�1 �ֵ�2 �ֵ�3 �ֵ�4 �ֵ�5</font></div></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td >���������� </td>
            <td>
              <select name="newstreet[areaid]">
                <?php if(is_array($city_area)){
                 foreach($city_area as $k => $v){
                  ?>
                  <optgroup label="<?=$v['firstletter']?>.<?=$v['cityname']?>">
                   <?php if(is_array($v['area'])){foreach($v['area'] as $t => $w){?>
                   <option value="<?=$w['areaid']?>"><?=$w['areaname']?></option>
                   <?php }}else {?>
                   <option value="0" disabled="disabled">����δ���ӷ�վ�������������ӷ�վ�µĵ���</option>
                   <?}?>
                 </optgroup>
                 <?
               }
             }else{
              ?>
              <option value="0" disabled="disabled">����δ������վ�����ȴ�����վ</option>
              <?php }?>
            </select>
          </td>
        </tr>
        <tr bgcolor="#ffffff">
          <td >�ֵ����� </td>
          <td><input name="newstreet[displayorder]" class="txt" type="text"></td>
        </tr>
      </table>
    </div>
    <center>
      <input type="submit" name="<?=CURSCRIPT?>_submit" value="�ύ" class="mymps large"/>
      &nbsp;&nbsp;
    </center>
  </form>
  <?php mymps_admin_tpl_global_foot();?>