<?php if(!defined('IN_MYMPS')) exit('Access Denied');
/*Smark
�ٷ���վ��http://www.it-works.com.cn*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/post.css" />
<script src="<?=$mymps_global['SiteUrl']?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/jquery.autocomplete.min.js"></script> 
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/jquery.autocomplete.css" />
<script type="text/javascript">
var cates = [<?php $i=1; ?><?php if(is_array($categories)){foreach($categories as $mymps) { if($i >1) { ?>,<?php } ?>
{ name1: "<?=$mymps['dir_typename']?>",name: "<?=$mymps['catid']?>", to: "<?=$mymps['catname']?>" }<?php if(is_array($mymps['children'])){foreach($mymps['children'] as $w) { ?>,
{ name1: "<?=$w['dir_typename']?>",name: "<?=$w['catid']?>", to: "<?=$w['catname']?>" }
<?php }} ?><?php $i++; ?><?php }} ?><?php $i=NULL;unset($i); ?>]; 
$(function() {
$('#catname').autocomplete(cates, { 
max: 20, 
minChars: 0, 
width: 316, 
scrollHeight: 100,
matchContains: true, 
autoFill: false,
formatItem: function(row, i, max) { 
return row.to; 
}, 
formatMatch: function(row, i, max) { 
return row.name1 + row.name + row.to; 
}, 
formatResult: function(row) { 
return row.to; 
} 
}); 
}); 
</script>
<script type="text/javascript">
window.history.go(1);
</script>
</head>

<body class="<?=$mymps_global['cfg_tpl_dir']?> bodybg<?=$mymps_global['cfg_tpl_dir']?><?=$mymps_global['bodybg']?>"><div class="bartop">
<div class="barcenter">
<div class="barleft">
<ul class="barcity"><span><? if($city['cityname']) { ?><?=$city['cityname']?><?php } else { ?>��վ<?php } ?></span> [<a href="<?=$mymps_global['SiteUrl']?>/changecity.php">�л���վ</a>]</ul> 
<ul class="line"><u></u></ul>
<ul class="barcang"><a href="<?=$mymps_global['SiteUrl']?>/desktop.php" target="_blank" title="����Ҽ���ѡ��Ŀ�����Ϊ�������˿�ݷ�ʽ���浽���漴��">���浽����</a></ul>
<ul class="line"><u></u></ul>
<ul class="barpost"><a href="<?=$mymps_global['SiteUrl']?>/<?=$mymps_global['cfg_postfile']?>?cityid=<?=$cityid?>">���ٷ�����Ϣ</a></ul>
<ul class="line"><u></u></ul>
<ul class="bardel"><a href="<?=$mymps_global['SiteUrl']?>/delinfo.php" rel="nofollow">�޸�/ɾ����Ϣ</a></ul>
<ul class="line"><u></u></ul>
<ul class="barwap"><a href="<?=$mymps_global['SiteUrl']?>/mobile.php">�ֻ����</a></ul>
</div>
<div class="barright">
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/javascript.php?part=iflogin&cityid=<?=$city['cityid']?>"></script>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="mhead">
<div class="logo"><a href="<? echo $city['domain']?$city['domain']:$mymps_global['SiteUrl']; ?>" target="_blank"><img src="<?=$mymps_global['SiteUrl']?><?=$mymps_global['SiteLogo']?>" title="<?=$mymps_global['SiteName']?>"/></a></div>
<div class="font">
<span>
        <? if(CURSCRIPT == 'posthistory') { ?>������¼<?php } elseif(CURSCRIPT == 'space') { ?>�û�����<?php } elseif(CURSCRIPT == 'mobile') { ?>�ֻ���<?php } elseif(CURSCRIPT == 'login') { ?>�ʺ�����<?php } elseif(CURSCRIPT == 'delinfo') { ?>�޸�/ɾ����Ϣ<?php } elseif(CURSCRIPT == 'changecity') { ?>�л���վ<?php } else { ?>������Ϣ<?php } ?>
</span>
</div>
</div>
<div class="cleafix"></div><div class="body1000">
<div class="clear15"></div>
<div id="main" class="wrapper">
<div class="step1">
<span class="cur"><font class="number">1</font> ѡ����Ϣ����</span>
<span><font class="number">2</font> ��д��Ϣ����</span>
<span><font class="number">3</font> �����ɹ�</span>
</div>
<div id="fenlei2">
            <div class="minheight" id="ymenu-side"> 
               <ul class="ym-mainmnu">
               <?php if(is_array($categories)){foreach($categories as $k => $mymps) { ?>                    <li class="ym-tab">
                        <a href="#" class="black"><?=$mymps['catname']?></a>
                        <ul class="ym-submnu">
                            <?php if(is_array($mymps['children'])){foreach($mymps['children'] as $u => $w) { ?>                            <li><a href="?action=input&catid=<?=$w['catid']?>&cityid=<?=$city['cityid']?>"><?=$w['catname']?></a></li>
                            <?php }} ?>
                        </ul> 
                    </li>
                    <?php }} ?>
                </ul>
                <? if($catid > 0) { ?>
                <div class="clear"></div>
                <div class="backall"><a href="?action=input&cityid=<?=$city['cityid']?>">&laquo;����ѡ�����</a></div>
                <?php } ?>
            </div>
            <form action="?" method="get">
            <input name="cityid" value="<?=$cityid?>" type="hidden">
        	<div class="psearch">
                <div class="pshead"><em>������</em><input type="text" id="catname" name="catname" placeholder="������ؼ��ֲ�����Ҫ�����ķ���" class="pstxt" value=""><input type="button" value="�����Ƽ����" onclick="this.form.submit()" class="psbtn" id="btn_cateSearch">
                </div>
       		</div>
            </form>
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
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/scrolltop.js"></script></div>
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/post_select.js"></script> 
</body>
</html>