<?php include mymps_tpl('inc_head');?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td>���˵��</td>
    <td style="text-align:right">
    <?php if(!$admin_cityid){?>
    ѡ���վ��<select name="cityid" onChange="location.href='?page=<?=$page?>&cityid='+(this.options[this.selectedIndex].value)">
       	<option value="0">��վ</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
    <?php }?>
    &nbsp;
    </td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip" colspan="2">
 <li>����ٱ�����ʾ����ҳ�ĵ�һ���Ҳ࣬��ʾ���µ�24���������ӣ�ÿ���������ֽ���5����������</li>
 <li>��������ѡΪֱ����ת������ҳ��ʱ��������ת�������ӵ�ַ</li>
 <li>��дվ�����ӣ���ȷ�����ӵ�ַ����http://</li>
    </td>
  </tr>
</table>
</div>
<form action="?part=service" method="post">
<input name="forward_url" value="<?=GetUrl()?>" type="hidden"/>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr style="font-weight:bold; background-color:#dff6ff">
      <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/> ɾ?</td>
	  <?php if(!$admin_cityid){?><td>������վ</td><?php }?>
      <td>��������(<font color="red">*</font>)</td>
      <td>����</td>
      <td>����URL��ַ(<font color="red">*</font>)</td>
      <td>��ʾ˳��</td>
      <td>����״̬</td>
    </tr>
    <?php foreach($lifebox as $k =>$value){?>
        <tr bgcolor="#ffffff">
          <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$value[id]?>' id="<?=$value[id]?>"></td>

		<?php if(!$admin_cityid){?>
		<td>
			<select name="edit[<?=$value[id]?>][cityid]">
				<option value="0">��վ</option>
				<?php echo get_cityoptions($value['cityid']); ?>
			</select>
        <?}else{?>
			<input name="edit[<?=$value[id]?>][cityid]" type="hidden" value="<?php echo $admin_cityid; ?>">
		</td>
		<?php }?> 
		
          <td bgcolor="white"><input class="text" name="edit[<?=$value[id]?>][lifename]" value="<?=$value[lifename]?>" />       
		  </td>
          
        <td><select name="edit[<?=$value[id]?>][typeid]">
      <?php echo get_servtype_options($value[typeid]);?>
      </select></td>
          <td bgcolor="white"><input class="text" value="<?=$value[lifeurl]?>" name="edit[<?=$value[id]?>][lifeurl]"/></td>
          <td ><input name="edit[<?=$value[id]?>][displayorder]" value="<?=$value[displayorder]?>" type="text" class="txt"/></td>
          <td bgcolor="white"><select name="edit[<?=$value[id]?>][if_view]"><?=get_ifview_options($value[if_view])?></select></td>
        </tr>
    <?}?>
   <tbody id="secqaabody" bgcolor="white">
   <tr align="center">
       <td>����:<a href="###" onclick="newnode = $('secqaabodyhidden').firstChild.cloneNode(true); $('secqaabody').appendChild(newnode)">[+]</a></td>
	  <?php if(!$admin_cityid){?>
	  <td bgcolor="white">
        <select name="newcityid[]">
       	<option value="0">��վ</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
        <?}else{?>
		<input name="newcityid[]" type="hidden" value="<?php echo $admin_cityid; ?>">
	  </td>
	  <?php }?>
      <td bgcolor="white"><input name="newlifename[]" value="" type="text" class="text"/></td>
      <td><select name="newtypeid[]"><?php echo get_servtype_options($typeid);?></select></td>
      <td bgcolor="white"><input name="newlifeurl[]" value="" type="text" class="text"/></td>
      <td><input name="newdisplayorder[]" value="0" type="text" class="txt"/></td>
      <td bgcolor="white"><select name="newif_view[]">
      <?=get_ifview_options(2)?>
      </select></td>
   </tr>
   </tbody>
   
   <tbody id="secqaabodyhidden" style="display:none">
       <tr align="center" bgcolor="white">
      <td align="center">&nbsp;</td>
	  <?php if(!$admin_cityid){?>
	  <td bgcolor="white">
        <select name="newcityid[]">
       	<option value="0">��վ</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
        <?}else{?>
		<input name="newcityid[]" type="hidden" value="<?php echo $admin_cityid; ?>">
	  </td>
	  <?php }?>
      <td bgcolor="white"><input name="newlifename[]" value="" type="text" class="text"/> </td>
      <td><select name="newtypeid[]"><?php echo get_servtype_options($typeid);?></select></td>
      <td bgcolor="white"><input name="newlifeurl[]" value="" type="text" class="text"/></td>
      <td><input name="newdisplayorder[]" value="0" type="text" class="txt"/></td>
      <td bgcolor="white"><select name="newif_view[]">
      <?=get_ifview_options(2)?>
      </select></td>
       </tr>
   </tbody>
</table>
</div>
<center>
<input class="mymps large" value="�� ��" name="<?=CURSCRIPT?>_submit" type="submit"> &nbsp;
</center>
</form>
<div class="pagination"><?php echo page2()?></div>  
<?php mymps_admin_tpl_global_foot();?>