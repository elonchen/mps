<?php 
include mymps_tpl('inc_head_jq');
?>
<script type="text/javascript" src="../include/datepicker/datepicker.js"></script>
<link rel="stylesheet" href="../include/datepicker/ui.css">
<script language='javascript'>
$(function(){
	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();
});
</script>
<script language="javascript" src="js/vbm.js"></script>
<script language="javascript">
function check_sub(){
	if (document.form1.gname.value=="") {
		alert('����д�����');
		document.form1.gname.focus();
		return false;
	}
	if (document.form1.userid.value=="") {
		alert('����д�����Ļ�Ա�û���');
		document.form1.userid.focus();
		return false;
	}
	if (document.form1.gaddress.value=="") {
		alert('����д��ص㣡');
		document.form1.gaddress.focus();
		return false;
	}
	if (document.form1.meetdate.value=="") {
		alert('��ѡ�񼯺�ʱ�䣡');
		document.form1.meetdate.focus();
		return false;
	}
	if (document.form1.enddate.value=="") {
		alert('��ѡ�����ʱ�䣡');
		document.form1.enddate.focus();
		return false;
	}
	if (document.form1.des.value=="") {
		alert('����д���˵����');
		document.form1.des.focus();
		return false;
	}
	return true;
}
</script>
<style>
.vbm tr{ background:#ffffff}
.altbg1{ background-color:#f1f5f8}
.vbm span{ margin:0!important}
</style>
<form action="?part=edit&id=<?=$id?>" method="post" enctype="multipart/form-data" name="form1" onSubmit="return check_sub();">
<input name="pre_picture" value="<?=$edit['pre_picture']?>" type="hidden">
<input name="picture" value="<?=$edit['picture']?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
	<td colspan="2">������Ϣ</td>
</tr>
<tr>
    <td class="altbg1">�Ź�����:<font color="red">*</font></td>
    <td>
        <input type="text" name="gname" value="<?=$edit['gname']?>" class="text" />
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">�����̼��û���:<font color="red">*</font></td>
    <td width="75%">
        <input type="text" name="userid" id="userid" value="<?=$edit['userid']?>" class="text" style="background-color:#eee"/> <font color=red>�Ǳ�Ҫ�������޸�</font>
    </td>
</tr>
<tr>
    <td class="altbg1">�Ź�����:<font color="red">*</font></td>
    <td>
        <?php echo get_groupclass_select('cate_id',$edit['cate_id']); ?>
    </td>
</tr>
<tr>
    <td class="altbg1">��������:<font color="red">*</font></td>
    <td>
        <?php echo select_where('area','areaid',$edit['areaid'],$edit['cityid']); ?>
    </td>
</tr>
<tr>
    <td class="altbg1">��ص�:<font color="red">*</font></td>
    <td><input type="text" name="gaddress" value="<?=$edit['gaddress']?>" class="text" /></td>
</tr>
<tr>
    <td class="altbg1">����ʱ��:<font color="red">*</font></td>
    <td><input id="datepicker1" type="text" name="meetdate" readonly="readonly" value="<?=$meetdate?>" class="text" style="width:180px" /></td>
</tr>
<tr>
    <td class="altbg1">����ʱ��:<font color="red">*</font></td>
    <td><input id="datepicker2" type="text" name="enddate" readonly="readonly" value="<?=$enddate?>" class="text" style="width:180px" /></td>
</tr>
<tr>
    <td class="altbg1">����:<font color="red">*</font></td>
    <td><textarea name="des" style="height:60px; width:500px;"><?=de_textarea_post_change($edit['des'])?></textarea></td>
</tr>
<tr>
    <td class="altbg1">�����:<font color="red">*</font></td>
    <td><?php echo $acontent; ?></td>
</tr>
<tr class="firstr">
	<td colspan="2">Ԥ��ͼƬ</td>
</tr>
<tr>
    <td class="altbg1">�Ź�ͼƬ:</td>
    <td> 
    <?php
    echo "<img src=".$mymps_global[SiteUrl]."".$edit[pre_picture]." style='_margin-top:expression(( 180 - this.height ) / 2);' />\r\n";
    ?>
    </td>
</tr>
<tr>
    <td class="altbg1">����ͼƬ:</td>
    <td> 
    <input type="file" name="group_image" size="30">
    </td>
</tr>
<tr class="firstr">
	<td colspan="2">������Ϣ</td>
</tr>
<tr>
	<td class="altbg1">����˳��</td>
    <td>
    <input name="displayorder" class="txt" value="<?=$edit['displayorder']?>">
    <br><br>
    ��ֵԽ������Խ��ǰ
    </td>
</tr>
<tr>
	<td class="altbg1">��������</td>
    <td>
    <input name="signintotal" class="txt" value="<?=$edit['signintotal']?>">
    <br><br>
    ���Ļ������������ʾ���ɰ�����������������±������ֽ��ڴ˻������ۼ�
    </td>
</tr>
<tr>
	<td class="altbg1">״̬����</td>
    <td>
    <select name="glevel">
    	<?php foreach($glevel as $k => $v){?>
    	<option value="<?=$k?>" <?php if($edit['glevel'] == $k) echo 'selected style=\'background-color:#6eb00c; color:white!important;\''; ?>><?=$v?></option>
        <?php }?>
    </select><br><br>
    ���ͨ���������о���������������ˣ������������������ر���
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">�����ų�:</td>
    <td width="75%">
        <input type="text" name="mastername" id="mastername" value="<?=$edit['mastername']?>" class="text"/>
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">�ų�QQ:</td>
    <td width="75%">
        <input type="text" name="masterqq" id="masterqq" value="<?=$edit['masterqq']?>" class="text"/><br>
<br>�������ҳ�棬�ų��Աߵ�����QQ����

    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">���۵�ַ:</td>
    <td width="75%">
        <input type="text" name="commenturl" value="<?=$edit['commenturl']?>" class="text"/>
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">��˴λ���̼ҹ�ϵ:</td>
    <td width="75%">
        <input type="text" name="biztype" value="<?=$edit['biztype']?>" class="text"/> ���磺�������Ǻ���
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">��ע˵��:</td>
    <td width="75%">
        <textarea name="othercontent" style="width:300px; height:100px;"><?=$edit['othercontent']?></textarea>
    </td>
</tr>
</table>
</div>
<center><input type="submit" name="group_submit" value="�� ��" class="mymps large" /></center>
</form>
<?php mymps_admin_tpl_global_foot();?>