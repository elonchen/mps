<?php include mymps_tpl('inc_head');?>
<div id="<?=MPS_SOFTNAME?>">
  <table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
     <td colspan="2">������ʾ</td>
   </tr>
   <tr bgcolor="#ffffff">
    <td id="menu_tip">
      <li>�����ķ�����֧��mail������������Ϣ����ѯ��Ŀռ��ṩ�̣������ǽ�����ʹ��ϵͳ��mail����</li>
      <li>�����ķ�������֧��mail������ʱ����Ҳ����ѡ��SMTP��Ϊ�ʼ���������</li>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
  <table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
     <td colspan="2">����֧��SMTP��������SMTP��ַ</td>
   </tr>
   <tr bgcolor="#ffffff">
    <td id="menu_tip">
      <li> <span>qq����</span>=> SMTP.qq.com<font color="red">(�Ƽ�)</font>&nbsp;&nbsp;&nbsp;<span>163����</span> => SMTP.163.com&nbsp;&nbsp;&nbsp;<span>188����</span> => SMTP.188.com&nbsp;&nbsp;&nbsp;</li>
    </td>
  </tr>
</table>
</div>
<form method="post" action="mail.php?part=<?=$part?>">
  <div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr"><td colspan="2">�����ʼ�����������</td></tr>
      <tr bgcolor="#ffffff">
        <td width="25%">
          �ʼ�����:  &nbsp;&nbsp;
        </td>
        <td>
          <label for="mail"><input name="mail_service" type="radio" class="radio" id="mail" value="mail" onclick='document.getElementById("smtp_div").style.display = "none";document.getElementById("mail_div").style.display = "";' <?php if($mail_config[mail_service] != 'smtp'){?>checked="checked"<?}?>>���÷��������õ�mail����</label> 
          <label for="smtp"><input class="radio" name="mail_service" type="radio" id="smtp" value="smtp" onclick='document.getElementById("smtp_div").style.display = "";document.getElementById("mail_div").style.display = "none";' <?php if($mail_config[mail_service] == 'smtp'){?>checked="checked"<?}?>>����������SMTP����</label>
          <label for="no"><input class="radio" name="mail_service" type="radio" id="no" value="no" onclick='document.getElementById("smtp_div").style.display = "none";document.getElementById("mail_div").style.display = "none";' <?php if($mail_config[mail_service] == 'no'){?>checked="checked"<?}?>>�������ʼ�����</label>
        </td>
      </tr>
      <tbody id="smtp_div" <?php if($mail_config[mail_service] != 'smtp'){?> style="display:none"<?}?>>
        <!--<tr bgcolor="#ffffff">
        <td>
        �ʼ��������Ƿ�Ҫ��SSL��������
        </td>
        <td>
        <label for="0"><input type="radio" name="ssl" value="0" id="0" class="radio" checked="checked">��</label>
        <label for="1"><input type="radio" class="radio" name="ssl" value="1" id="1" onclick="return confirm('�˹���Ҫ������php����֧��OpenSSLģ��, �����Ҫʹ�ô˹��ܣ�����ϵ���Ŀռ���ȷ��֧�ִ�ģ��');">��</label>
        </td>
      </tr>-->
      <tr bgcolor="#ffffff">
        <td>
          SMTP��������ַ
        </td>
        <td>
          <input class="text" type="text" name="smtp_server" value="<?=$mail_config[smtp_server]?>">
          <div style="color:#666; margin-top:5px">��Ҫ��������ʺ�֧��SMTP��������SMTP.qq.com</div></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>
            SMTP�������˿�
          </td>
          <td><input class="text" type="text" name="smtp_serverport" value="<?php echo $mail_config[smtp_serverport] ? $mail_config[smtp_serverport] : 25;?>"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>
            SMTP���������û�����
          </td>
          <td><input class="text" type="text" name="smtp_mail" value="<?=$mail_config[smtp_mail]?>"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>
            ���������ʺ�
          </td>
          <td><input class="text" type="text" name="mail_user" value="<?=$mail_config[mail_user]?>"></td>
        </tr>
        <tr bgcolor="#ffffff">
          <td>
            ������������
          </td>
          <td><input class="text" type="password" name="mail_pass" value="<?=$mail_config[mail_pass]?>"></td>
        </tr>
      </tbody>
    </table>
  </div>
  <center><input type="submit" value="�� ��" class="mymps large" name="mail_submit"/>  </center>
</form>
<div class="clear" style="height:10px;"></div>
<form method="post" action="mail.php?part=test">
  <div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr"><td colspan="2">�����ʼ�����</td></tr>
      <tr bgcolor="#ffffff">
        <td width="25%">
          �Է��ʼ���ַ
        </td>
        <td><input class="text" type="text" name="test_mail" value=""></td>
      </tr>
    </table>
  </div>
  <center><input type="submit" value="�� ��" class="mymps large" name="mail_submit"/>  </center>
</form>
<?php mymps_admin_tpl_global_foot();?>