<?php if(!defined('IN_MYMPS')) exit('Access Denied');
/*Smark
�ٷ���վ��http://www.it-works.com.cn*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<link rel="shortcut icon" href="<?=$mymps_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/aboutus.css" />
<script src="<?=$mymps_global['SiteUrl']?>/template/global/noerr.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/postlink.js"></script>
<title><?=$page_title?></title>
</head>

<body class="<?=$mymps_global['cfg_tpl_dir']?> <?=$mymps_global['screen_search']?>"><script src="<?=$mymps_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<div class="header">
<div class="inner">
<div class="logo"><a href="<?=$mymps_global['SiteUrl']?>" target="_blank"><img src="<?=$mymps_global['SiteUrl']?><?=$mymps_global['SiteLogo']?>" title="<?=$mymps_global['SiteName']?>"></a></div>
<div class="nav">
<a href="<?=$about['aboutus_uri']?>" <? if($part == 'aboutus') { ?>class="current"<?php } ?>>��������</a>
<a href="<?=$about['announce_uri']?>" <? if($part == 'announce') { ?>class="current"<?php } ?>>��վ����</a>
<a href="<?=$about['faq_uri']?>" <? if($part == 'faq') { ?>class="current"<?php } ?>>��������</a>
<a href="<?=$about['friendlink_uri']?>" <? if($part == 'friendlink') { ?>class="current"<?php } ?>>��������</a>
<a href="<?=$about['sitemap_uri']?>" <? if($part == 'sitemap') { ?>class="current"<?php } ?>>��վ��ͼ</a>
</div>
</div>
</div><div class="clear"></div>
<div class="friendlink">
<div class="links">
        <?php if(is_array($flink)){foreach($flink as $k => $mymps) { ?><div class="link">
<div class="tit"><?=$mymps['typename']?></div>
<div class="clear"></div>
<div class="imgcont"><?php if(is_array($mymps['imglink'])){foreach($mymps['imglink'] as $w) { ?><a href="<?=$w['url']?>" target="_blank"><img alt="" src="<?=$w['weblogo']?>"></a>
<?php }} ?>
<div class="clearfix"></div>
</div>
<div class="cont"><?php if(is_array($mymps['txtlink'])){foreach($mymps['txtlink'] as $r) { ?><a href="<?=$r['url']?>"><?=$r['webname']?></a>
<?php }} ?>
</div>
</div>
<div class="clear"></div>
<?php }} ?>
<div class="link">
<div class="tit">���벽��</div>
<div class="clear"></div>
<div class="contt">
1�������ڹ���վ����<?=$mymps_global['SiteName']?>���������ӣ�<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>�������֣�<?=$mymps_global['SiteName']?></b> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>���ӵ�ַ��<?=$mymps_global['SiteUrl']?></b><br />
2���������Ӻ������·���д������Ϣ�� <br />
3���Ѿ���ͨ��վ�������������ݽ��������ϱ�վ��������Ҫ�����վ��������Ա��˺󣬿�����ʾ�ڴ���������ҳ��
</div> 
</div>
<div class="clear15"></div>
<div class="link">
<div class="tit">�ύ����</div>
<div class="clear"></div>
<div class="contt">
<form name="form1" action="<?=$mymps_global['SiteUrl']?>/about.php?" method="post" onSubmit="return submitForm();">
                    <input name="action" value="dopost" type="hidden">
<input name="cityid" value="<?=$city['cityid']?>" type="hidden">
                    <table cellpadding="0" cellspacing="0" class="link_table">
<tr>
<td>
��վ���ͣ�
</td>
<td style="height:34px;">
<select name="typeid"><? echo webtype_option(); ?></select>
</td>
</tr>
<tr>
<td>
��վ���ƣ�
</td>
<td style="height:34px;">
<input name="webname" type="text" style="width:350px"/></td>
</tr>
<tr>
<td>
��&nbsp;&nbsp;&nbsp;&nbsp;ַ��
</td>
<td style="height:34px;">
<input id="url" name="url" type="text" value="http://"  style="width:350px"/></td>
</tr>
 <tr>
<td>
ͼƬ��ַ��
</td>
   <td style="height:34px;">
<input id="weblogo" name="weblogo" type="text" value="http://"  style="width:350px"/></td>
</tr>
<tr>
<td height="35">
�������䣺
</td>
<td>
<input id="email" name="email" type="text"  style="width:350px"/></td>
</tr>
<tr>
<td width="61" valign="top">
��վ���ܣ�
</td>
<td width="348" valign="top" style=" padding-bottom:5px; padding-top:5px;">
<textarea id="msg" name="msg" style="width:352px; height:100px;"></textarea></td>
</tr>
<tr>
<td height="35">
��֤�룺
</td>
<td style="height:34px;">
<input type="text" name="checkcode" class="text" style="width:70px"/> 
                            </td>
</tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td><img src="<?=$mymps_global['SiteUrl']?>/<?=$mymps_global['cfg_authcodefile']?>" alt="�����壬����ˢ��" class="authcode" align="absmiddle" onClick="this.src=this.src+'?'"/></td>
                        </tr>
<tr>
<td>&nbsp;

</td>
<td height="45" align="left" valign="middle">
<input type="submit" name="about_submit" class="submit" value="�ύ����"/>
</td>
</tr>
</table>
</form>
</div>
</div>
</div>
</div>
<div class="clear"></div><div class="footer">
&copy; <?=$mymps_global['SiteName']?> <a href="<?=$about['aboutus_uri']?>" target="_blank">��������</a> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$mymps_global['SiteBeian']?></a> <?=$mymps_global['SiteStat']?> 
<span class="none_<?=$mymps_mymps['debuginfo']?>">
<? if($cachetime) { ?>
This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } else { ?><?php $mtime = explode(' ', microtime());$totaltime = number_format(($mtime['1'] + $mtime['0'] - $mymps_starttime), 6); echo 'Processed in '.$totaltime.' second(s) , '.$db->query_num.' queries'; ?><?php } ?>
</span>
<span class="none">Powered by <strong><a href="http://www.it-works.com.cn" target="_blank">Smark</a></strong> <em><a href="http://www.it-works.com.cn" target="_blank"><?=MPS_VERSION?></a></em></span>
</div>
<p id="back-to-top"><a href="#top"><span></span></a></p>
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/scrolltop.js"></script></body>
</html>