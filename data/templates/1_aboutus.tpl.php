<?php if(!defined('IN_MYMPS')) exit('Access Denied');
/*Smark
官方网站：http://www.it-works.com.cn*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/aboutus.css" />
<script src="<?=$mymps_global['SiteUrl']?>/template/global/noerr.js" type="text/javascript"></script>

</head>

<body class="<?=$mymps_global['cfg_tpl_dir']?> <?=$mymps_global['screen_search']?>"><script src="<?=$mymps_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<div class="header">
<div class="inner">
<div class="logo"><a href="<?=$mymps_global['SiteUrl']?>" target="_blank"><img src="<?=$mymps_global['SiteUrl']?><?=$mymps_global['SiteLogo']?>" title="<?=$mymps_global['SiteName']?>"></a></div>
<div class="nav">
<a href="<?=$about['aboutus_uri']?>" <? if($part == 'aboutus') { ?>class="current"<?php } ?>>关于我们</a>
<a href="<?=$about['announce_uri']?>" <? if($part == 'announce') { ?>class="current"<?php } ?>>网站公告</a>
<a href="<?=$about['faq_uri']?>" <? if($part == 'faq') { ?>class="current"<?php } ?>>帮助中心</a>
<a href="<?=$about['friendlink_uri']?>" <? if($part == 'friendlink') { ?>class="current"<?php } ?>>友情链接</a>
<a href="<?=$about['sitemap_uri']?>" <? if($part == 'sitemap') { ?>class="current"<?php } ?>>网站地图</a>
</div>
</div>
</div><div class="clear"></div>
<div class="cinner">
<div class="leftnav">
        <?php if(is_array($aboutus_all)){foreach($aboutus_all as $mymps) { ?><a href="<?=$mymps['uri']?>" <? if($mymps['id'] == $aboutus['id']) { ?>class="current"<?php } ?>><?=$mymps['typename']?></a>
            <?php }} ?>
</div>
<div class="clear15"></div>
<div class="rightcontent">
<?=$aboutus['content']?>
</div>
</div>
<div class="clear"></div><div class="footer">
&copy; <?=$mymps_global['SiteName']?> <a href="<?=$about['aboutus_uri']?>" target="_blank">关于我们</a> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$mymps_global['SiteBeian']?></a> <?=$mymps_global['SiteStat']?> 
<span class="none_<?=$mymps_mymps['debuginfo']?>">
<? if($cachetime) { ?>
This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } else { ?><?php $mtime = explode(' ', microtime());$totaltime = number_format(($mtime['1'] + $mtime['0'] - $mymps_starttime), 6); echo 'Processed in '.$totaltime.' second(s) , '.$db->query_num.' queries'; ?><?php } ?>
</span>
<span class="none">Powered by <strong><a href="http://www.it-works.com.cn" target="_blank">Smark</a></strong> <em><a href="http://www.it-works.com.cn" target="_blank"><?=MPS_VERSION?></a></em></span>
</div>
<p id="back-to-top"><a href="#top"><span></span></a></p>
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/scrolltop.js"></script></body>
</html>
