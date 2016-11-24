<?php    

if (!defined('IN_MYMPS'))
{
    die('FORBIDDEN');
}
/*   
�������ƣ�inject_check()   
�������ã�����ύ��ֵ�ǲ��Ǻ���SQLע����ַ�����ֹע�䣬������������ȫ   
�Ρ�������$sql_str: �ύ�ı���   
�� �� ֵ�����ؼ������ture or false
*/   
function inject_check($sql_str) {    
  return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);    // ���й���    
}    
   
/*   
�������ƣ�verify()   
�������ã�У���ύ��ID��ֵ�Ƿ�Ϸ�
�Ρ�������$id: �ύ��IDֵ
�� �� ֵ�����ش�����ID
*/   
function verify($id=null,$type) {   
  if (inject_check($id)){ write_msg('',$global[SiteUrl].'/index.php');}    // ע���ж� 
  $id = intval ($id);
  $id = $id ? $id : $type;
  return  $id;    
}    
   
/*   
�������ƣ�mymps_str_check()
�������ã����ύ���ַ������й���
�Ρ�������$var: Ҫ������ַ���
�� �� ֵ�����ع��˺���ַ���
*/   
function mymps_str_check($str) {
  $str = trim($str);
  if (!get_magic_quotes_gpc()) {    // �ж�magic_quotes_gpc�Ƿ��    
    $str = addslashes($str);    // ���й���    
  }    
  //$str = str_replace("_", "\_", $str);    // �� '_'���˵�   
  $str = str_replace("%", "\%", $str);    // �� '%'���˵�    
   
  return $str;     
}    
   
/*   
�������ƣ�post_check()
�������ã����ύ�ı༭���ݽ��д���
�Ρ�������$post: Ҫ�ύ������   
�� �� ֵ��$post: ���ع��˺������
*/   
function mymps_post_check($post) {
  if (!get_magic_quotes_gpc()) {    // �ж�magic_quotes_gpc�Ƿ�Ϊ��    
    $post = addslashes($post);    // ����magic_quotes_gpcû�д򿪵�������ύ���ݵĹ���    
  }    
  $post = str_replace("_", "\_", $post);    // �� '_'���˵�    
  $post = str_replace("%", "\%", $post);    // �� '%'���˵�    
  $post = htmlspecialchars($post);    // html���ת��    
  $post=str_replace("\n","<br>",str_replace(" ","&nbsp;",$post));    // �س�ת�� 
   
  return $post;    
}    
?>