<?php include mymps_tpl('inc_head');?>
<form name="form_mymps" action="?part=list" method="post">
<input name="rename" value="1" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
		<tr class="firstr">
          <td colspan="2">�����л�ҳ��վ��������</td>
        </tr>
		<tr bgcolor="white">
			<td style="line-height:25px;" colspan="2">
			<label for="pinyin"><input name="cfg_cityshowtype" value="pinyin" type="radio" id="pinyin" <?php if($mymps_global['cfg_cityshowtype'] == 'pinyin') echo 'checked';?>>����վƴ������ĸ</label><br />
			<label for="province"><input name="cfg_cityshowtype" value="province" type="radio" id="province" <?php if($mymps_global['cfg_cityshowtype'] == 'province') echo 'checked';?>>����վ����ʡ��</label>
			</td>
		</tr>
    	<tr class="firstr">
          <td colspan="2">������״η�����վ��ҳ(<font style="text-decoration:underline"><?php echo $mymps_global['SiteUrl']; ?></font>)ʱ��</td>
        </tr>
		<tr bgcolor="white">
          <td style="line-height:25px;" colspan="2">
         <label for="home"><input name="cfg_redirectpage" class="radio" value="home" type="radio" id="home" onclick="document.getElementById('nonecity').style.display='none';document.getElementById('sitecity').style.display='none'" <?php if($mymps_global['cfg_redirectpage'] == 'home') echo 'checked';?>>��վ��ҳ</label> <br />
<i style="margin-left:20px"><?php echo $mymps_global['SiteUrl']; ?></i><br />
          <label for="viewercity"><input name="cfg_redirectpage" class="radio" value="viewercity" type="radio" id="viewercity" onclick="document.getElementById('nonecity').style.display='';document.getElementById('sitecity').style.display='none'">��������ڳ��еķ�վ��ҳ</label><br />
<div id="nonecity" style=" background-color:#f5f5f5; border:1px #eee solid; margin-top:5px; margin-bottom:5px; line-height:25px; padding-left:30px; <?php if(!in_array($mymps_global['cfg_redirectpage'],array('nchome','ncchangecity'))) echo 'display:none';?>">
  ���޶�Ӧ���з�վ��<br />
  <label for="nchome"><input name="cfg_redirectpage" class="radio" value="nchome" id="nchome" type="radio" <?php if($mymps_global['cfg_redirectpage'] == 'nchome') echo 'checked';?>>��վ��ҳ</label><br />
  <label for="ncchangecity"><input name="cfg_redirectpage" class="radio" value="ncchangecity" id="ncchangecity" type="radio" <?php if($mymps_global['cfg_redirectpage'] == 'ncchangecity') echo 'checked';?>>����ѡ��ҳ</label>
</div>
<i style="margin-left:20px">���������IP�Զ���ת�����ڳ��з�վ���磺http://beijing.mymps.com.cn</i><br />
          <label for="changecity"><input onclick="document.getElementById('nonecity').style.display='none';document.getElementById('sitecity').style.display='none'" name="cfg_redirectpage" class="radio" value="changecity" type="radio" id="changecity" <?php if($mymps_global['cfg_redirectpage'] == 'changecity') echo 'checked';?>>����ѡ��ҳ</label><br />
<i style="margin-left:20px"><?php echo $mymps_global['SiteUrl']?>/changecity.php</i><br />
		  <label for="citysite"><input onclick="document.getElementById('nonecity').style.display='none';document.getElementById('sitecity').style.display=''" class="radio" value="citysite" type="radio" id="citysite" name="cfg_redirectpage" <?php if(is_numeric($mymps_global['cfg_redirectpage'])) echo 'checked';?>>ǿ�Ʒ���ָ����վ��ҳ</label><br />
		  <div id="sitecity" style="<?php if(!is_numeric($mymps_global['cfg_redirectpage'])){?>display:none;<?php }?>  border-top:1px #eee solid; margin-top:5px; padding-top:10px; margin-bottom:5px; line-height:25px; padding-left:15px">
          
		  	<select name="cfg_redirectpagee">
			<?php echo get_cityoptions($mymps_global['cfg_redirectpage']); ?>
			</select>
		  </div>
        </td>
        </tr>
    	<tr class="firstr">
          <td colspan="2">���з�վ�ļ����Ŀ¼</td>
        </tr>
        <tr bgcolor="white">
          <td width="250" style="line-height:25px;"><input name="cfg_citiesdir" class="text" value="<?php echo $mymps_global['cfg_citiesdir'];?>"><br /><i>����:&nbsp;&nbsp;<b style="color:#006acd">/city</b>&nbsp;&nbsp;�����ա�</i>
</td>
          <td bgcolor="#ffffff" style="border-left:1px #eee solid;">
          <div style="line-height:25px;">
          <b style="color:red">�Ա���(beijing)Ϊ����</b><br />
<i>(1).</i>����дΪ<font color="#006acd">/city</font>��������վ�ļ����Ŀ¼��Ϊ<font color="#006acd">/city/beijing</font>�����ʸ÷�վʱ����վ·��Ϊ<font color="#006acd"><?=$mymps_global['SiteUrl']?>/city/beijing/</font><br /><i>(2).</i>�����գ�������վ�ļ����Ŀ¼Ϊ<font color="#006acd">/beijing</font>�����ʸ÷�վʱ����վ·��Ϊ<font color="#006acd"><?=$mymps_global['SiteUrl']?>/beijing/</font><br />
<b style="color:red">����˵����</b><br />����վ���Ŀ¼����ʱ������վĿ¼��������ϵͳĿ¼�ظ�<br />
<?php 
foreach($mympsdirectory as $k){
	echo ' <font color="#006acd">/'.$k.'</font> ';
}
?>
		   </div>
           </td>
        </tr>
    	<tr class="firstr">
          <td colspan="2">��վģʽ�£�ѡ������ģ������Ϊ��ʱ�Զ�������վ����</td>
        </tr>
        <tr bgcolor="white">
          <td style="line-height:25px">
          <?php
          if($mymps_global['cfg_independency']){
          	$independency = explode(',',$mymps_global['cfg_independency']);
          } else {
		  	$independency = array();
		  }
          ?>
		  <select name="independency[]" multiple="multiple" style="width:220px; height:105px;">
		  	<option value="advertisement" <?php if(in_array('advertisement',$independency)) echo 'selected'; ?>>��� /advertisement</option>
			<option value="focus" <?php if(in_array('focus',$independency)) echo 'selected'; ?>>����ͼ /focus</option>
			<option value="announce" <?php if(in_array('announce',$independency)) echo 'selected'; ?>>���� /announce</option>
			<option value="friendlink" <?php if(in_array('friendlink',$independency)) echo 'selected'; ?>>�������� /friendlink</option>
			<option value="telephone" <?php if(in_array('telephone',$independency)) echo 'selected'; ?>>����绰 /telephone</option>
			<option value="lifebox" <?php if(in_array('lifebox',$independency)) echo 'selected'; ?>>�ٱ��� /lifebox</option>
		  </select>
          </td>
          <td bgcolor="#ffffff" valign="top" style="border-left:1px #eee solid;">
          <div style="line-height:25px;">
          <b style="color:red">���˵����</b><br />
          <i>(1).</i>��վ���ڸ���վ�����ݲ�����ܵ��¸���ģ���������ʾΪ��<br />
		  <i>(2).</i>ѡ��󣬷�վ�¸�ģ������Ϊ��ʱ���Զ�������վ����<br />
		  <i>(3).</i>�ύ�ɹ�����δ��ʱ��Ч����<a style="text-decoration:underline" href="config.php?part=cache_sys">ǰ�����������ϵͳ����</a>
          </div>
		  </td>
        </tr>
    </table>
</div>
<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="�ύ" class="mymps large"/></center>
</form>
<?php mymps_admin_tpl_global_foot();?>