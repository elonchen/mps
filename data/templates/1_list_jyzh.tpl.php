<?php if(!defined('IN_MYMPS')) exit('Access Denied');
/*Smark
�ٷ���վ��http://www.it-works.com.cn*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<script src="<?=$mymps_global['SiteUrl']?>/template/default/js/uaredirect.js" type="text/javascript"></script>
<script type="text/javascript">uaredirect("<?=$mymps_global['SiteUrl']?>/m/index.php?mod=category&catid=<?=$catid?>&cityid=<?=$cityid?>");</script>
<meta name="keywords" content="<?=$cat['keywords']?>" />
<meta name="description" content="<?=$cat['description']?>" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/style.head_<?=$mymps_global['head_style']?>.css" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/category.css" />
<link rel="stylesheet" href="<?=$mymps_global['SiteUrl']?>/template/default/css/pagination2.css" />
<script src="<?=$mymps_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global['SiteUrl']?>/template/default/js/hover_bg.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global['cfg_tpl_dir']?> <?=$mymps_global['screen_cat']?> bodybg<?=$mymps_global['cfg_tpl_dir']?><?=$mymps_global['bodybg']?>"><div class="bartop floater">
<div class="barcenter">
<div class="barleft">
<ul class="barcity"><span><? if($city['cityname']) { ?><?=$city['cityname']?><?php } else { ?>��վ<?php } ?></span> [<a href="<?=$mymps_global['SiteUrl']?>/changecity.php">�л���վ</a>]</ul> 
<ul class="line"><u></u></ul>
<ul class="barcang"><a href="<?=$mymps_global['SiteUrl']?>/desktop.php" target="_blank" title="����Ҽ���ѡ��Ŀ�����Ϊ�������˿�ݷ�ʽ���浽���漴��">���浽����</a></ul>
<ul class="line"><u></u></ul>
<ul class="barpost"><a href="<?=$mymps_global['SiteUrl']?>/<?=$mymps_global['cfg_postfile']?>?cityid=<?=$cityid?>&catid=<? echo $catid?$catid:$info['catid']; ?>" rel="nofollow">���ٷ�����Ϣ</a></ul>
<ul class="line"><u></u></ul>
<ul class="bardel"><a href="<?=$mymps_global['SiteUrl']?>/delinfo.php" rel="nofollow">�޸�/ɾ����Ϣ</a></ul>
<ul class="line"><u></u></ul>
<ul class="barwap"><a href="<?=$mymps_global['SiteUrl']?>/mobile.php" target="_blank">�ֻ����</a></ul>
</div>
<div class="barright">
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/javascript.php?part=iflogin&cityid=<?=$city['cityid']?>"></script>
</div>
</div>
</div>
<div class="clear"></div>
<div class="logosearchtel">
<!--���������濪ʼ-->
<div id="ad_topbanner"></div>
<!--�������������-->
<div class="weblogo"><a href="<?=$city['domain']?>"><img src="<?=$mymps_global['SiteUrl']?><?=$mymps_global['SiteLogo']?>" title="<?=$mymps_global['SiteName']?>" border="0"/></a></div>
<div class="postedit">
<a href="<?=$mymps_global['SiteUrl']?>/<?=$mymps_global['cfg_postfile']?>?cityid=<?=$cityid?>&catid=<? echo $catid?$catid:$info['catid']; ?>" class="post" rel="nofollow">��ѷ�����Ϣ</a>
</div>
<div class="websearch">
<div class="sch_t_frm">
<form method="get" action="<?=$mymps_global['SiteUrl']?>/search.php?" id="searchForm" target="_blank">
<input name="cityid" value="<?=$city['cityid']?>" type="hidden">
<div class="sch_ct">
<input type="text" class="topsearchinput" name="keywords" id="searchheader" onmouseover="hiddennotice('searchheader');" x-webkit-speech lang="zh-CN"/>
</div>
<div>
<input type="submit" value="�� ��" class="btn-normal"/>
</div>
</form>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="daohang">
<ul>
<li><a href="<?=$city['domain']?>" id="index">��ҳ</a></li>
        <?php $navurl_header = mymps_get_navurl('header',15); ?>        <?php if(is_array($navurl_header)){foreach($navurl_header as $k => $mymps) { ?><li><a <? if($mymps['flag'] == $cat['catid'] || $mymps['flag'] == $cat['parentid']) { ?>class="current"<?php } ?> target="<?=$mymps['target']?>" id="<?=$mymps['flag']?>" href="<? if($mymps['flag'] != 'outlink' && $mymps['flag'] != 'news') { ?><?=$city['domain']?><?php } ?><?=$mymps['url']?>"><font color="<?=$mymps['color']?>"><?=$mymps['title']?></font><sup class="<?=$mymps['ico']?>"></sup></a></li>
<?php }} ?>
</ul>
</div><?php $navurl_head = mymps_get_navurl('head',20); if($navurl_head) { ?>
<div class="subsearch">
<ul><?php $i = 1; ?>    <?php if(is_array($navurl_head)){foreach($navurl_head as $k => $mymps) { ?>    <li class="n<?=$i?>"><a href="<?=$mymps['url']?>" style="color:<?=$mymps['color']?>" target="<?=$mymps['target']?>" title="<?=$mymps['title']?>"><?=$mymps['title']?><sup class="<?=$mymps['ico']?>"></sup></a></li>
    <?php $i = $i+1; ?>    <?php }} ?>
</ul>
</div>
<?php } ?>
<div class="clearfix"></div>
<!--ͷ��ͨ����濪ʼ-->
<div id="ad_header"></div>
<!--ͷ��ͨ��������-->
<div class="clearfix"></div><div class="body1000">
<div class="clear"></div>
<div class="location">
<?=$location?>
</div>
<div class="clear"></div>
<div class="wrapper"><div id="select">
<? if($cat_list) { ?>
<dl class='fore' id='select-brand'>
<dt>��Ŀ���ࣺ</dt>
<dd>
<div class='content'>
    <?php if(is_array($cat_list)){foreach($cat_list as $mymps) { ?><div><a href="<?=$city['domain']?><?=$mymps['uri']?>" <? if($mymps['catid'] == $cat['catid']) { ?>class="curr"<?php } ?> title="<?=$city['cityname']?><?=$mymps['catname']?>">����</a></div>
        <?php if(is_array($mymps['children'])){foreach($mymps['children'] as $w) { ?><div><a href="<?=$city['domain']?><?=$w['uri']?>" <? if($w['catid'] == $cat['catid']) { ?>class="curr"<?php } ?> title="<?=$city['cityname']?><?=$w['catname']?>"><?=$w['catname']?></a></div>
        <?php }} ?>
<?php }} ?>
</div>
</dd>
</dl>
    <?php } ?>
    <?php if(is_array($mymps_extra_model)){foreach($mymps_extra_model as $mymps) { ?><dl>
<dt><?=$mymps['title']?>��</dt>
<dd>
    <?php if(is_array($mymps['list'])){foreach($mymps['list'] as $w) { ?><div><a href="<?=$city['domain']?><?=$w['uri']?>" <? if($w['select'] == 1) { ?>class="curr"<?php } ?>><?=$w['name']?></a></div>
<?php }} ?>
    </dd>
</dl>
<?php }} ?>
    <? if($area_list) { ?>
<dl>
<dt>������ң�</dt>
<dd>
    <?php if(is_array($area_list)){foreach($area_list as $mymps) { ?><div><a href="<?=$city['domain']?><?=$mymps['uri']?>" <? if($mymps['select'] == 1) { ?>class="curr"<?php } ?>><?=$mymps['areaname']?></a></div>
<?php }} ?>
</dd>
</dl>
<?php } ?>
    <? if($street_list) { ?>
<dl>
<dt></dt>
<dd>
        <?php if(is_array($street_list)){foreach($street_list as $mymps) { ?><div><a href="<?=$city['domain']?><?=$mymps['uri']?>" <? if($mymps['select'] == 1) { ?>class="curr"<?php } ?>><?=$mymps['streetname']?></a></div>
<?php }} ?>
</dd>
</dl>
<?php } ?>
    <? if(!$cityid && $hotcities) { ?>
<dl>
<dt>���ŷ�վ</dt>
<dd>
<div><a href="#" class="curr">����</a></div>
        <?php if(is_array($hotcities)){foreach($hotcities as $mymps) { ?><div><a href="<?=$mymps['domain']?><?=$cat['caturi']?>"><?=$mymps['cityname']?></a></div>
<?php }} ?>
<div><a href="<?=$mymps_global['SiteUrl']?>/changecity.php">���� &raquo;</a></div>
</dd>
</dl>
<?php } ?>
<dl class="lastdl">
<form method="get" action="<?=$mymps_global['SiteUrl']?>/search.php?" target="_blank">
<input name="cityid" value="<?=$city['cityid']?>" type="hidden">
<input name="mod" value="information" type="hidden">
<input name="catid" value="<?=$cat['catid']?>" type="hidden">
<input name="areaid" value="<?=$areaid?>" type="hidden">
<input name="streetid" value="<?=$streetid?>" type="hidden">
<input name="keywords" type="text" value="" class="searchinput" id="searchbody" onmouseover="hiddennotice('searchbody');"/>
<input type="submit" value="�ѱ���" class="<?=$mymps_global['head_style']?>_searchsubmit" />
</form>
</dl>
</div></div>

<div class="clear"></div>
<div class="<?=$mymps_global['head_style']?>_listhd">
<div class="listhdleft">
<div><a href="#" class="currentr"><span></span><?=$cat['catname']?>��Ϣ</a></div>
</div>
<div class="listhdcenter">
��Ϣ������<span><?=$rows_num?></span> ����֪�����ö���������Ϣ��ʹ�ɽ������5����
</div>
<div class="listhdright">
<a href="<?=$mymps_global['SiteUrl']?>/<?=$mymps_global['cfg_postfile']?>?catid=<?=$cat['catid']?>&cityid=<?=$city['cityid']?>" target="_blank">��ѷ���<?=$city['cityname']?><?=$cat['catname']?>��Ϣ>></a>
</div>
</div>
<div class="clear5"></div>
<div style="body1000;">
<div id="ad_intercatdiv"></div>
<div class="infolists">
<div class="list_jyzh">
<div id="ad_interlistad_top"></div>
<ul><?php if(is_array($info_list)){foreach($info_list as $mymps) { ?><div class="hover <? if($mymps['upgrade_type']>1) { ?>ding<?php } ?>">
<span class="lfaceimg"><a href='<?=$mymps['uri']?>' target='_blank' class='media-cap'><img src='<? if(!$mymps['img_path']) { ?><?=$mymps_global['SiteUrl']?>/images/nophoto.gif<?php } else { ?><?=$mymps_global['SiteUrl']?><?=$mymps['img_path']?><?php } ?>' title='<?=$mymps['title']?>'></a></span>
<span class="lsex"><?=$mymps['sex']?>&nbsp;</span>
<span class="ltitlevalue"><br />
<a href="<?=$mymps['uri']?>" target="_blank"  style="<? if($mymps['ifred'] == 1) { ?>color:red;<?php } ?> <? if($mymps['ifbold'] == 1) { ?>font-weight:bold;<?php } ?>"><?=$mymps['title']?></a><? if($mymps['img_count']) { ?><span class="img_count"><?=$mymps['img_count']?>ͼ</span><?php } if($mymps['info_level'] == 2) { ?><span class="tuijian">�Ƽ�</span><?php } if($mymps['certify'] == 1) { ?><span class="certify">��֤</span><?php } ?><font class="area">(<?=$mymps['areaname']?>)</font> <br />
<?=$mymps['age']?> / <?=$mymps['jobs']?>
</span>
<span class="ltime"><? echo get_format_time($mymps['begintime']); ?></span>
</div>
<?php }} ?>
</ul>
<div id="ad_interlistad_bottom"></div>
</div>
<div class="clear"></div>
<div class="pagination2"><?=$pageview?></div>
<div class="clear"></div>
<div class="totalpost"><a href="<?=$mymps_global['SiteUrl']?>/<?=$mymps_global['cfg_postfile']?>?catid=<?=$cat['catid']?>" target="_blank">���Ϸ���һ��<?=$city['cityname']?><?=$cat['catname']?>��Ϣ&raquo;</a></div>
</div>
</div><div class="clear"></div>
<div class="colorfoot">
    <? if($hotcities) { ?>
    <div class="cateintro relate">
    <div class="introleft"><?=$cat['catname']?>��ط�վ</div>
    <div class="introright">
    <?php if(is_array($hotcities)){foreach($hotcities as $mymps) { ?>    <a href='<?=$mymps['domain']?><?=$cat['caturi']?>' target="_blank"><?=$mymps['cityname']?><?=$cat['catname']?></a>
    <?php }} ?>
    </div>
    </div>
    <?php } ?>
    <div class="clearfix"></div>
    <div class="cateintro">
        <div class="introleft"><?=$city['cityname']?><?=$cat['catname']?>Ƶ��</div>
        <div class="introright"><?=$city['cityname']?><?=$cat['catname']?>Ƶ��Ϊ���ṩ<?=$city['cityname']?><?=$cat['catname']?>��Ϣ���ڴ��д���<?=$city['cityname']?><?=$cat['catname']?>��Ϣ����ѡ����������Ѳ鿴�ͷ���<?=$city['cityname']?><?=$cat['catname']?>��Ϣ��</div>
    </div>
    <? if($friendlink) { ?>
    <div class="clearfix"></div>
    <div class="cateintro">
    <div class="introleft">��������</div>
    <div class="introflink">
    <?php if(is_array($friendlink)){foreach($friendlink as $mymps) { ?>    <a href='<?=$mymps['url']?>' target='_blank'><?=$mymps['name']?></a>
    <?php }} ?>
    <a href="<?=$city['domain']?><?=$about['friendlink_uri']?>" target="_blank">����</a>
    </div>
    </div>
    <?php } ?>
</div><div class="footsearch <?=$mymps_global['head_style']?>">
<ul>
<form method="get" action="<?=$mymps_global['SiteUrl']?>/search.php?" name="footsearch" target="_blank">
<input name="cityid" value="<?=$city['cityid']?>" type="hidden">
<input name="mod" value="information" type="hidden">
<input name="keywords" type="text" class="footsearch_input" id="searchfooter" onmouseover="hiddennotice('searchfooter');" x-webkit-speech lang="zh-CN">
<input type="submit" value="��Ϣ��������" class="footsearch_submit">
<input type="button" onclick="window.open('<?=$mymps_global['SiteUrl']?>/<?=$mymps_global['cfg_postfile']?>?cityid=<?=$city['cityid']?>')" class="footsearch_post" value="��ѷ�����Ϣ">
</form>
</ul>
</div>
<div class="clear"></div>
<!-- ҳβͨ����濪ʼ-->
<div id="ad_footerbanner"></div>
<!-- ҳβͨ��������-->
<!--��洦���ֿ�ʼ-->
<? if($advertisement['type']['floatad'] || $advertisement['type']['couplead']) { ?>
<div align="left"  style="clear: both;">
    <script src="<?=$mymps_global['SiteUrl']?>/template/global/floatadv.js" type="text/javascript"></script>
<? if($advertisement['type']['couplead']) { ?>
    <script type="text/javascript">
<?=$adveritems[$advertisement['type']['couplead']['0']]?>theFloaters.play();
    </script>
    <?php } ?>
    <? if($advertisement['type']['floatad']) { ?>
    <script type="text/javascript">
        <?=$adveritems[$advertisement['type']['floatad']['0']]?>theFloaters.play();
    </script>
    <?php } ?>
</div>
<?php } ?>
<div style="display: none" id="ad_none">
<!--ͷ��ͨ�����-->
<? if($advertisement['type']['headerbanner']) { ?>
<div class="header" id="ad_header_none"><?php $countheaderbanner = count($advertisement['type']['headerbanner']);$i=1; ?><?php if(is_array($advertisement['type']['headerbanner'])){foreach($advertisement['type']['headerbanner'] as $mymps) { if($adveritems[$mymps]) { ?><div class="headerbanner" <? if($countheaderbanner == $i) { ?>style="margin-right:0;"<?php } ?>><?=$adveritems[$mymps]?></div><?php } ?><?php $i=$i+1; ?><?php }} ?>
</div>
<?php } ?>
<!--��ҳ�������--><?php if(is_array($advertisement['type']['indexcatad'])){foreach($advertisement['type']['indexcatad'] as $k => $mymps) { ?><div class="indexcatad" id="ad_indexcatad_<?=$k?>_none"><?=$adveritems[$mymps['0']]?></div>
<?php }} ?>
<!--��Ŀ��Ϣ�б����-->
<? if($advertisement['type']['interlistad']['top']) { ?>
<div id="ad_interlistad_top_none">
<ul class="interlistdiv"><?php if(is_array($advertisement['type']['interlistad']['top'])){foreach($advertisement['type']['interlistad']['top'] as $mymps) { if($adveritems[$mymps]) { ?><li class="hover"><?=$adveritems[$mymps]?></li><?php } ?>
<?php }} ?>
</ul>
</div>
<?php } if($advertisement['type']['interlistad']['bottom']) { ?>
<div id="ad_interlistad_bottom_none">
<ul class="interlistdiv"><?php if(is_array($advertisement['type']['interlistad']['bottom'])){foreach($advertisement['type']['interlistad']['bottom'] as $mymps) { if($adveritems[$mymps]) { ?><li class="hover"><?=$adveritems[$mymps]?></li><?php } ?>
<?php }} ?>
</ul>
</div>
<?php } ?>
<!--��Ŀ��߹��-->
<? if($advertisement['type']['intercatad']) { ?>
<div class="intercatdiv" id="ad_intercatdiv_none"><?php if(is_array($advertisement['type']['intercatad'])){foreach($advertisement['type']['intercatad'] as $mymps) { ?><div class="intercatad"><?=$adveritems[$mymps]?></div>
<?php }} ?>
</div>
<?php } if($advertisement['type']['topbanner']) { ?>
<div class="topbanner" id="ad_topbanner_none"><?php if(is_array($advertisement['type']['topbanner'])){foreach($advertisement['type']['topbanner'] as $mymps) { ?><div class="topbannerad"><?=$adveritems[$mymps]?></div>
<?php }} ?>
</div>
<?php } if($advertisement['type']['footerbanner']) { ?>
<div class="footerbanner" id="ad_footerbanner_none"><?php if(is_array($advertisement['type']['footerbanner'])){foreach($advertisement['type']['footerbanner'] as $mymps) { ?><div class="footerbannerad"><?=$adveritems[$mymps]?></div>
<?php }} ?>
</div>
<?php } ?>
</div>
<!--��洦���ֽ���-->
<div class="footabout"><?php $navurl_foot = mymps_get_navurl('foot',30); ?><?php $counturlnav = count($navurl_foot);$i=1; ?>    <?php if(is_array($navurl_foot)){foreach($navurl_foot as $k => $mymps) { ?><a <? if($counturlnav == $i) { ?>class="backnone"<?php } ?> href="<?=$mymps['url']?>" style="color:<?=$mymps['color']?>" target="<?=$mymps['target']?>"><?=$mymps['title']?><sup class="<?=$mymps['ico']?>"></sup></a><?php $i=$i+1; ?>    <?php }} ?>
</div>
<div class="debuginfo none_<?=$mymps_mymps['debuginfo']?>">
Powered by <i><strong><a href="https://www.it-works.com.cn" target="_blank">Smark</a></strong></i> <em><a href="https://www.it-works.com.cn" target="_blank"><?=MPS_VERSION?></a></em> <?=$mymps_global['SiteStat']?> 
<? if($cachetime) { ?>
This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } else { ?><?php $mtime = explode(' ', microtime());$totaltime = number_format(($mtime['1'] + $mtime['0'] - $mymps_starttime), 6); echo 'Processed in '.$totaltime.' second(s) , '.$db->query_num.' queries'; ?><?php } ?>
</div>
<div class="footcopyright">
&copy; <?=$mymps_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$mymps_global['SiteBeian']?></a>
</div>
<p id="back-to-top"><a href="#top"><span></span></a></p>
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/addiv.js"></script>
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/selectoption.js"></script>
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/js/scrolltop.js"></script></div>
</body>
</html>