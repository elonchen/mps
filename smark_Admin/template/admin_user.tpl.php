<?php include mymps_tpl('inc_head');?>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
  <div class="mpstopic-category">
    <div class="panel-tab">
      <ul class="clearfix tab-list">
        <li><a href="?do=user" class="current">����Ա�б�</a></li>
        <li><a href="?do=user&part=add">���ӹ���Ա</a></li>
      </ul>
      <?php if(!$admin_cityid){?>
      <ul style="float:right; text-align:right">
       <select name="cityid" onChange="location.href='?do=user&cityid='+(this.options[this.selectedIndex].value)">
        <option value="0">��վ</option>
        <?php echo get_cityoptions($cityid); ?>
      </select>
    </ul>
    <?php }?>
  </div>
</div>
</div>
<div id="<?=MPS_SOFTNAME?>">
  <table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
     <td colspan="2">���˵��</td>
   </tr>
   <tr bgcolor="#ffffff">
    <td id="menu_tip" colspan="2">
     <li>��վ����Ա��¼��̨��ֻ�ܹ������ڸ÷�վ�µ���Ϣ����</li>
   </td>
 </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
  <table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td align="center">������վ</td>
      <td align="center">��¼�û���</td>
      <td width="100" align="center">����</td>
      <td width="100" align="center">����</td>
      <td width="50" align="center">�û���</td>
      <td align="center">�ϴε�½</td>
      <td align="center">������</td>
    </tr>
    <?
    foreach($admin AS $row)
    {
      ?>
      <tr align="center" bgcolor="#ffffff">
        <td><b><?=$allcities[$row['cityid']]['cityname'] ? $allcities[$row['cityid']]['cityname'] : '��վ'?></b>&nbsp;</td>
        <td><?=$row[userid]?>&nbsp;</td>
        <td><?=$row[uname]?>&nbsp;</td>
        <td><?=$row[tname]?>&nbsp;</td>
        <td><?=$row[typename]?>&nbsp;</td>
        <td><em>ʱ�䣺<?=GetTime($row[logintime])?>&nbsp;��IP��<?=$row[loginip]?></em></td>
        <td>
         <a href='admin.php?do=user&part=edit&id=<?=$row[id]?>'><u>����</u></a> |
         <a href='admin.php?do=user&part=delete&id=<?=$row[id]?>' onClick="return confirm('��ȷ��Ҫɾ���ù���Ա���粻ȷ�����ȡ��')"><u>ɾ��</u></a>��
       </td>
     </tr>

     <?
   }
   ?>
 </table>
</div>
<?php mymps_admin_tpl_global_foot();?>