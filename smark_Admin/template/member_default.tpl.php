<?php include mymps_tpl('inc_head');
$admindir = getcwdOL();
?>

<script language="javascript" src="js/vbm.js"></script>
<script type='text/javascript' src='js/calendar.js'></script>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
                <li><a href="member.php?if_corp=0" <? if($if_corp=='0'){?>class="current"<? }?>>���˻�Ա</a></li>
				<li><a href="member.php?if_corp=1" <? if($if_corp=='1'){?>class="current"<? }?>>�̼һ�Ա</a></li>
			</ul>
		</div>
	</div>
</div>

<form name='form1' method='post' action='member.php' onSubmit='return checkSubmit();'>
<input type='hidden' name='part' value='default'/>
<input name="url" type="hidden" value="<?=GetUrl()?>">
<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="30">ѡ��</td>
      <td width="30">���</td>
      <td>�û���</td>
      <td width="50">�����</td>
      <td width="50">�û���</td>
      <td>ע���IP</td>
      <td>ע��ʱ��</td>
      <td>�ϴε�¼</td>
      <td width="30">�༭</td>
    </tr>
    <tbody onmouseover="addMouseEvent(this);">
<?php if(is_array($member)){foreach($member AS $member){
if($admin_id != 1 && $member[userid] == 'admin'){}else{
?>
    <tr align="center" bgcolor="white">
      <td><input type='checkbox' name='id[]' value='<?=$member[id]?>' class='checkbox' id="<?=$member[id]?>"></td>
      <td><?=$member[id]?></td>
	  <td><?php if($member['if_corp'] == 1 && $member['ifindex'] == 2){ echo '[<a href="?ifindex=2&moreoptions=yes&if_corp=1&cityid='.$cityid.'#lists" style="color:red" title="��ҳ�Ƽ�">��ҳ</a>] ';}?><?php if($member['if_corp'] == 1 && $member['iflist'] == 2){ echo '[<a href="?iflist=2&moreoptions=yes&&if_corp=1&cityid='.$cityid.'#lists" style="color:#ff6600" title="�б��Ƽ�">�б�</a>] ';}?><a href="javascript:void(0);" onclick="
setbg('<?=MPS_SOFTNAME?>��Ա����',400,110,'../box.php?part=member&userid=<?=$member[userid]?>&admindir=<?=$admindir?>')"><?=$member[userid]?> <?php echo $member['if_corp'] ? $member['tname'] : ''; ?></a> <img align="absmiddle" title="����ֵ:<?=$member['credit']?>" alt="����ֵ:<?=$member['credit']?>" src="../images/credit/<?=$member[credits]?>.gif"> <?php if($member['per_certify'] == 1){?><img src="../images/person1.gif" align="absmiddle" title="��ͨ�����֤��֤"/><?php }?> <?php if($member['com_certify'] == 1){?><img src="../images/company1.gif" align="absmiddle" title="��ͨ��Ӫҵִ��֤��֤"/><?php }?></td>
	  <td><img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"> <?=$member[money_own]?></td>
      <td><?=$member[levelname]?><?php if(!empty($member['levelup_time'])){ echo '<br /><em style=color:red>����'.date("Y-m-d",$member['levelup_time']).'</em>';}?></td>
      <td><a href="
javascript:setbg('�鿴IP���ڵ�',400,110,'../box.php?part=iptoarea&ip=<?=$member[joinip]?>&admindir=<?=$admindir?>')" title="����鿴ע���"><?=$member[joinip]?></a></td>
      <td><em><?=GetTime($member[jointime])?></em></td>
      <td><em><?=GetTime($member[logintime])?></em></td>
      <td><a href="member.php?part=edit&id=<?=$member[id]?>">����</a></td>
    </tr>
<?php }}}?>
</tbody>
<tr bgcolor="#ffffff" height="28">
    <td style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/></td>
    <td colspan="10">
    <label for="delall">
	<b>תΪ-></b> <?php echo get_member_level_label(); ?> | <?php if($if_corp == '1'){?><label for="person"><input name="do_action" class="radio" id="person" value="person" type="radio">���˻�Ա</label><?}else{?><label for="corp"><input name="do_action" class="radio" id="corp" value="corp" type="radio">�̼һ�Ա</label><?php }?>
	  <hr style="height:1px; border:1px #c5d8e8 solid;"/><b>ͨ��-></b>
	  <label for="per_certify"><input type="radio" id="per_certify" value="per_certify" name="do_action">���֤��֤</label> <label for="com_certify"><input type="radio" id="com_certify" value="com_certify" name="do_action">Ӫҵִ����֤</label>
      <hr style="height:1px; border:1px #c5d8e8 solid;"/>
      <b>ɾ��-></b> <label for="delall"><input type="radio" value="delall" id="delall" name="do_action" class="radio">�û�Ա�Լ�����ȫ����Ϣ</label><?php if($if_corp == '1'){?> | <label for="delinfo"><input type="radio" value="delinfo" id="delinfo" name="do_action" class="radio">������Ϣ</label> <label for="deldoc"><input type="radio" value="deldoc" id="deldoc" name="do_action" class="radio">�ռ��ĵ�</label> <label for="delalbum"><input type="radio" value="delalbum" id="delalbum" name="do_action" class="radio">���</label> <label for="delcomment"><input type="radio" value="delcomment" id="delcomment" name="do_action" class="radio">���ѵ���</label><?php }?> <label for="delpm"><input type="radio" value="delpm" id="delpm" name="do_action" class="radio">����Ϣ</label>
	  <?php if($if_corp == 1){?>
	  <hr style="height:1px; border:1px #c5d8e8 solid;"/>
	  <b>��ʾ��-></b>
	  <label for="ifindex2"><input name="do_action" value="ifindex2" id="ifindex2" type="radio">��ҳ���ȵ�������</label>
	  <label for="ifindex1"><input name="do_action" value="ifindex1" id="ifindex1" type="radio">ȥ����ҳ�Ƽ�</label>
	  |
	  <label for="iflist2"><input name="do_action" value="iflist2" id="iflist2" type="radio">�����б�ҳ�Ƽ��̼�</label>
	  <label for="iflist1"><input name="do_action" value="iflist1" id="iflist1" type="radio">ȥ���б��Ƽ�</label>
	  <?php }?>
    </td>
</tr>
</table>
</div>
<center>
<input type="submit" value="�� ��" class="mymps large"/></center>
</form>
<div class="pagination"><?=page2()?></div>
<div class="clear"></div>
<form action="member.php" method="get">
<input type='hidden' name='part' value='default'/>
<input name="if_corp" value="<?=$if_corp?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">��������������<?php echo $if_corp == '0' ? '���˻�Ա' : '�̼һ�Ա'; ?></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">�û���(UserID)</td>
    <td>&nbsp;<input name="userid" class="text" value="<?php echo $userid; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%"><?php echo $if_corp == '1' ? '�̼�����' : '�û�����'; ?></td>
    <td>&nbsp;<input name="tname" class="text" value="<?php echo $tname; ?>"></td>
  </tr>
<tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">�����û���</td>
    <td>&nbsp;<?php echo get_member_level($levelid);?></td>
  </tr>
  <tr>
<?php if($if_corp == '1'){?>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">���ڷ���</td>
    <td>&nbsp;<?=get_member_cat($catid,false)?></td>
  </tr>
  <?php if(!$admin_cityid){?>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">������վ����</td>
    <td>&nbsp;<select name="cityid">
    <option value="">>���з�վ</option>
    <?php echo get_cityoptions($cityid); ?>
    </select></td>
  </tr>
  <? }else{ ?>
  <input name="cityid" value="<?php echo $admin_cityid?>" type="hidden" />
  <? }?>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">�Ƿ��Ƽ���ʾ</td>
    <td>&nbsp;<select name="tuijian">
    <option value="all" <?php if($tuijian == 'all'){?>selected="selected"<?php }?>>ȫ���̼�</option>
	<option value="index" <?php if($tuijian == 'index'){?>selected="selected"<?php }?>>��ҳ�Ƽ��̼�</option>
	<option value="list" <?php if($tuijian == 'list'){?>selected="selected"<?php }?>>�����б�ҳ�Ƽ��̼�</option>
    </select></td>
  </tr>
  <?php }?>
  <tr>
  	<td style="background-color:#fff; text-align:right" colspan="2"><label for="moreoptions"><input name="moreoptions" value="yes" type="checkbox" class="checkbox" onclick="blocknone('showtbody');" id="moreoptions" <?php if($moreoptions == 'yes') echo 'checked'?>>����ѡ��</label></td>
  </tr>
  <tbody id="showtbody" <?php if($moreoptions != 'yes'){?>style="display:none"<?php }?>>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">��� ����:</td>
    <td>&nbsp;<input name="moneylower" class="txt" value="<?php echo $moneylower; ?>"> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">��� ����:</td>
    <td>&nbsp;<input name="moneyhigher" class="txt" value="<?php echo $moneyhigher; ?>"> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">ע��IP��ͷ (ͨ��� "*" �� "127.0.*.*"(��������)):</td>
    <td>&nbsp;<input name="regip" class="text" value="<?php echo $regip; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">�ϴη���IP��ͷ (ͨ��� "*" �� "127.0.*.*"(��������)):</td>
    <td>&nbsp;<input name="lastip" class="text" value="<?php echo $lastip; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">ע����������(��д��ʽ��yy-mm-dd):</td>
    <td>&nbsp;<input name="regdatebefore" style="width:100px;" class="txt" value="<?php echo $regdatebefore; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">ע����������(��д��ʽ��yy-mm-dd):</td>
    <td>&nbsp;<input name="regdateafter" style="width:100px;" class="txt" value="<?php echo $regdateafter; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">������ʱ������(��д��ʽ��yy-mm-dd):</td>
    <td>&nbsp;<input name="lastvisitbefore" style="width:100px;" class="txt" value="<?php echo $lastvisitbefore; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">������ʱ������(��д��ʽ��yy-mm-dd):</td>
    <td>&nbsp;<input name="lastvisitafter" style="width:100px;"  class="txt" value="<?php echo $lastvisitafter; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  </tbody>
</table>
</div>
<center><input type="submit" value="�� ��" class="mymps large" /></center>
<div class="clear" style="margin-bottom:5px"></div>
</form>
<?=mymps_admin_tpl_global_foot();?>