<?php include mymps_tpl('inc_head'); ?>
<script type='text/javascript' src='js/vbm.js'></script>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
    <li><a href="?typename=��վ��ҳ" <?php if($typename=='��վ��ҳ') echo 'class="current"';?>>��վ��ҳ</a></li>
    <?php if(!$admin_cityid){?><li><a href="?typename=������ҳ" <?php if($typename=='������ҳ') echo 'class="current"';?>>������ҳ</a></li><?php }?>
            </ul>
			<?php if(!$admin_cityid){?>
            <ul style="float:right; text-align:right">
               <select name="cityid" onChange="location.href='?typename=<?=$typename?>&cityid='+(this.options[this.selectedIndex].value)">
       	<option value="0">��վ</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
            </ul>
            <?php }?>
        </div>
    </div>
</div>
<form method='post' action='?part=<?=$part?>'>
<input name="typename" value="<?=$typename?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
    <td width="60"><input name="checkall" type="checkbox" class="checkbox" id="checkall" onClick="CheckAll(this.form)"/> ɾ?</td>
    <td align="center">����ͼ·��</td>
    <td width="200" align="center">˵������</td>
    <td width="100" align="center">���ʱ��</td>
    <td width="100" align="center">˳��</td>
    <td width="100" align="center">�༭</td>
  </tr>
<?php foreach($row AS $row){?>
    <tr align="center" bgcolor="white">
    <td><input type='checkbox' name='delids[]' value='<?=$row[id]?>' class="checkbox" id="<?=$row[id]?>"></td>
    <td><a href='javascript:blocknone("pm_<?=$row[id]?>");'><?=$row[pre_image]?></a></td>
    <td><?=$row[words]?></td>
    <td><em><?=GetTime($row[pubdate])?></em></td>
    <td><input name="displayorder[<?=$row[id]?>]" value="<?=$row[focusorder]?>" class="txt"/></td>
    <td>
	  <a href='?part=edit&id=<?=$row[id]?>'>����</a>
    </td>
  </tr>
  <tr style="background-color:white; display:none" id="pm_<?=$row[id]?>">
    <td>&nbsp;</td>
    <td colspan="5"><img src="<?=$row[pre_image]?>"/></td>
    </tr>
    <? }?>
</table>
</div>
<center style='margin:10px'><input type="submit" value="�� ��"  class="mymps large" name="focus_submit"/> </center>
</form>
<div class="pagination"><?php echo page2(); ?></div>
<?php mymps_admin_tpl_global_foot();?>