<?php include mymps_tpl('inc_head');?>
<form method=post onSubmit="return chkform()" name="form" action="?part=add">
  <div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td colspan="2" align="left">���ӷ�վ�µĵ���</td>
      </tr>
      <tr bgcolor="#ffffff">
        <td width="15%">�������ƣ� </td>
        <td>
          <textarea rows="3" name="newarea[areaname]" cols="50"></textarea><br />
          <div style="margin-top:3px">֧�ֵ���������ӣ���������Կո����<br />
            <font color="red">����������1 ����2 ����3 ����4 ����5</font></div></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td >������վ�� </td>
            <td>
              <select name="newarea[cityid]">
                <?php if(is_array($city_area)){
                 foreach($city_area as $k => $v){
                  ?>
                  <option value="<?=$v['cityid']?>"><?=$v['firstletter']?>.<?=$v['cityname']?></option>
                  <?
                }   } else {
                 ?>
                 <option value="0" disabled="disabled">����δ�������з�վ,���ȴ������з�վ</option>
                 <?
               }
               ?>
             </select>
           </td>
         </tr>
         <tr bgcolor="#ffffff">
          <td >�������� </td>
          <td><input name="newarea[displayorder]" class="txt" type="text" value=""></td>
        </tr>
      </table>
    </div>
    <center>
      <input type="submit" name="<?=CURSCRIPT?>_submit" value="�ύ" class="mymps large"/>
      &nbsp;&nbsp;
    </center>
  </form>
  <?php mymps_admin_tpl_global_foot();?>