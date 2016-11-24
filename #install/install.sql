DROP TABLE IF EXISTS `my_about`;
CREATE TABLE IF NOT EXISTS `my_about` (
  `id` int(5) NOT NULL auto_increment,
  `typename` char(25) NOT NULL,
  `content` mediumtext NOT NULL,
  `displayorder` smallint(3) NOT NULL,
  `pubdate` int(10) NOT NULL,
  `dir_type` tinyint(1) NOT NULL,
  `dir_typename` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


INSERT INTO `my_about` (`id`, `typename`, `content`, `displayorder`, `pubdate`, `dir_type`, `dir_typename`) VALUES (1, '��վ���', '��������д��վ��飬��д��ɺ󱣴��ύ����', 1, 0, 2, 'wangzhanjianjie'),
(2, '������', '��������д��������д��ɺ󱣴��ύ����', 2, 1263483208, 4, 'advertisement'),
(3, '��ϵ����', '��������д��ϵ��ʽ����д��ɺ󱣴��ύ����', 3, 0, 4, 'contactus');


DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE IF NOT EXISTS `my_admin` (
  `id` int(10) NOT NULL auto_increment,
  `userid` char(30) NOT NULL default '',
  `pwd` char(32) NOT NULL default '',
  `uname` char(20) NOT NULL default '',
  `tname` char(30) NOT NULL default '',
  `email` char(30) NOT NULL default '',
  `typeid` smallint(5) NOT NULL default '0',
  `logintime` int(10) NOT NULL default '0',
  `loginip` varchar(20) NOT NULL default '',
  `cityid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_province`;
CREATE TABLE IF NOT EXISTS `my_province` (
  `provinceid` smallint(6) NOT NULL auto_increment,
  `provincename` varchar(32) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  PRIMARY KEY  (`provinceid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_city`;
CREATE TABLE IF NOT EXISTS `my_city` (
  `cityid` mediumint(6) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `provinceid` smallint(6) NOT NULL,
  `cityname` varchar(32) NOT NULL,
  `citypy` varchar(100) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `firstletter` varchar(1) NOT NULL,
  `mappoint` varchar(100) NOT NULL,
  `ifhot` tinyint(1) NOT NULL DEFAULT '0',
  `domain` varchar(150) NOT NULL,
  `title` varchar(100) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`cityid`),
  KEY `displayorder` (`displayorder`),
  KEY `provinceid` (`provinceid`),
  KEY `status` (`status`)
) TYPE=MyISM;

DROP TABLE IF EXISTS `my_area`;
CREATE TABLE IF NOT EXISTS `my_area` (
  `areaid` mediumint(6) NOT NULL auto_increment,
  `areaname` varchar(32) NOT NULL,
  `cityid` int(11) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  PRIMARY KEY  (`areaid`),
  KEY `cityid` (`cityid`)
) TYPE=MyISM;

DROP TABLE IF EXISTS `my_street`;
CREATE TABLE IF NOT EXISTS `my_street` (
  `streetid` mediumint(6) NOT NULL auto_increment,
  `streetname` varchar(32) NOT NULL,
  `areaid` int(11) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  PRIMARY KEY  (`streetid`),
  KEY `areaid` (`areaid`)
) TYPE=MyISM;

DROP TABLE IF EXISTS `my_admin_record_action`;
CREATE TABLE IF NOT EXISTS `my_admin_record_action` (
  `id` int(11) NOT NULL auto_increment,
  `adminid` char(30) NOT NULL,
  `pubdate` int(10) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `action` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_admin_record_login`;
CREATE TABLE IF NOT EXISTS `my_admin_record_login` (
  `id` int(11) NOT NULL auto_increment,
  `adminid` char(32) NOT NULL,
  `adminpwd` char(30) NOT NULL,
  `pubdate` int(10) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `result` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_admin_type`;
CREATE TABLE IF NOT EXISTS `my_admin_type` (
  `id` smallint(5) NOT NULL auto_increment,
  `typename` varchar(30) NOT NULL,
  `ifsystem` tinyint(1) NOT NULL,
  `purviews` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


INSERT INTO `my_admin_type` (`id`, `typename`, `ifsystem`, `purviews`) VALUES (1, '��������Ա', 1, 'purview_����ͼ�б�,purview_�ϴ�����ͼ,purview_��Ŀ����,purview_�ѷ�������,purview_��������,purview_�������,purview_������������,purview_��������,purview_��������,purview_���ӵ���,purview_����ٱ���,purview_����绰,purview_������Ϣ,purview_ɾ���ظ�,purview_��������,purview_��Ϣ����,purview_��Ϣ�ٱ�,purview_ģ�͹���,purview_�ֶι���,purview_���˻�Ա,purview_�̼һ�Ա,purview_���ӻ�Ա,purview_��Ա������,purview_ʵ����֤,purview_��Ա�ĵ�,purview_վ�ڶ���Ϣ,purview_ģ�����,purview_��Ա��¼��¼,purview_��Ա֧����¼,purview_��Ա���Ѽ�¼,purview_��Ϣ����,purview_��ӷ���,purview_�ѽ���վ,purview_��ӷ�վ,purview_��ӵ���,purview_���·��,purview_�̼ҷ���,purview_���ӷ���,purview_�û��б�,purview_�û���,purview_�����¼,purview_���ݿⱸ��,purview_���ݿ⻹ԭ,purview_���ݿ�ά��,purview_ϵͳ����,purview_��վ����,purview_ģ�����,purview_SEOα��̬,purview_��֤���˵���,purview_�������õȼ�,purview_��������,purview_�Ż���ʦ,purview_������������,purview_��������,purview_�ֻ���������,purview_�Ѱ�װ���,purview_�Ż�ȯ����,purview_���ϴ��Ż�ȯ,purview_�Ź�����,purview_�ѷ����Ź�,purview_��������,purview_���Ź���,purview_�������,purview_��������,purview_��Ʒ����,purview_��Ʒ����,purview_��������,purview_�ʼ�������,purview_�ʼ�ģ��,purview_�ʼ����ͼ�¼,purview_����֧���ӿ�,purview_������λ,purview_��Ϣ���ݵ���,purview_���Ͻӿ�����');

DROP TABLE IF EXISTS `my_advertisement`;
CREATE TABLE IF NOT EXISTS `my_advertisement` (
  `advid` mediumint(8) NOT NULL auto_increment,
  `available` tinyint(1) NOT NULL default '0',
  `type` varchar(50) NOT NULL default '0',
  `displayorder` tinyint(3) NOT NULL default '0',
  `title` varchar(50) NOT NULL default '',
  `targets` mediumtext NOT NULL,
  `parameters` mediumtext NOT NULL,
  `code` mediumtext NOT NULL,
  `starttime` int(10) NOT NULL default '0',
  `endtime` int(10) NOT NULL default '0',
  `cityid` mediumint(5) NOT NULL,
  PRIMARY KEY  (`advid`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_announce`;
CREATE TABLE IF NOT EXISTS `my_announce` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `redirecturl` varchar(250) NOT NULL,
  `titlecolor` char(10) NOT NULL,
  `content` mediumtext NOT NULL,
  `author` varchar(20) NOT NULL,
  `pubdate` int(10) NOT NULL,
  `begintime` int(10) NOT NULL,
  `endtime` int(10) NOT NULL,
  `hits` int(11) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_badwords`;
CREATE TABLE IF NOT EXISTS `my_badwords` (
  `words` mediumtext NOT NULL,
  `view` varchar(100) NOT NULL,
  `ifcheck` tinyint(1) NOT NULL
) TYPE=MyISAM;

INSERT INTO `my_badwords` (`words`, `view`, `ifcheck`) VALUES ('���齻��', '**', 1);

DROP TABLE IF EXISTS `my_cache`;
CREATE TABLE IF NOT EXISTS `my_cache` (
  `id` smallint(3) NOT NULL auto_increment,
  `page` varchar(20) NOT NULL,
  `time` int(10) NOT NULL,
  `open` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `my_cache` (`id`, `page`, `time`, `open`) VALUES (1, 'site', 0, 0),
(2, 'info', 0, 0),
(3, 'list', 0, 0),
(4, 'aboutus', 0, 0),
(5, 'announce', 0, 0),
(6, 'faq', 0, 0),
(7, 'friendlink', 0, 0),
(8, 'guestbook', 0, 0);

DROP TABLE IF EXISTS `my_category`;
CREATE TABLE IF NOT EXISTS `my_category` (
  `catid` mediumint(6) NOT NULL AUTO_INCREMENT,
  `if_view` tinyint(1) NOT NULL DEFAULT '1',
  `color` char(10) NOT NULL,
  `catname` varchar(32) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `usecoin` mediumint(8) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `modid` smallint(5) NOT NULL,
  `catorder` smallint(6) NOT NULL,
  `if_upimg` tinyint(1) NOT NULL DEFAULT '1',
  `if_mappoint` tinyint(1) NOT NULL DEFAULT '0',
  `dir_type` tinyint(1) NOT NULL,
  `dir_typename` varchar(100) NOT NULL,
  `template` varchar(20) NOT NULL DEFAULT 'list',
  `template_info` varchar(20) NOT NULL DEFAULT 'info',
  `html_dir` varchar(200) NOT NULL,
  `htmlpath` varchar(200) NOT NULL,
  PRIMARY KEY (`catid`),
  KEY `parentid` (`parentid`),
  KEY `catname` (`catname`),
  KEY `catorder` (`catorder`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_certification`;
CREATE TABLE IF NOT EXISTS `my_certification` (
  `id` int(11) NOT NULL auto_increment,
  `typeid` tinyint(1) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `img_path` varchar(250) NOT NULL,
  `pubtime` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_channel`;
CREATE TABLE IF NOT EXISTS `my_channel` (
  `catid` mediumint(6) NOT NULL auto_increment,
  `if_view` tinyint(1) NOT NULL default '1',
  `color` char(10) NOT NULL,
  `catname` varchar(32) NOT NULL,
  `title` varchar(250) NOT NULL,
  `keywords` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `parentid` int(11) default NULL,
  `catorder` smallint(6) NOT NULL,
  `dir_type` tinyint(1) NOT NULL,
  `dir_typename` varchar(100) NOT NULL,
  `html_dir` varchar(200) NOT NULL,
  `htmlpath` varchar(200) NOT NULL,
  PRIMARY KEY  (`catid`),
  KEY `parentid` (`parentid`),
  KEY `catname` (`catname`),
  KEY `catorder` (`catorder`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_checkanswer`;
CREATE TABLE IF NOT EXISTS `my_checkanswer` (
  `id` smallint(3) NOT NULL auto_increment,
  `question` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_comment`;
CREATE TABLE IF NOT EXISTS `my_comment` (
  `id` int(8) NOT NULL auto_increment,
  `userid` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `pubtime` int(10) NOT NULL,
  `ip` char(16) NOT NULL,
  `comment_level` tinyint(1) NOT NULL,
  `typeid` int(8) NOT NULL,
  `type` varchar(50) NOT NULL default 'information',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `typeid` (`typeid`,`comment_level`,`type`),
  KEY `comment_level` (`comment_level`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_config`;
CREATE TABLE IF NOT EXISTS `my_config` (
  `description` varchar(100) NOT NULL,
  `value` mediumtext NOT NULL,
  `type` varchar(10) NOT NULL default 'config',
  KEY `type` (`type`),
  KEY `description` (`description`)
) TYPE=MyISAM;

INSERT INTO `my_config` (`description`, `value`, `type`) VALUES
('latestbackup', '1423028736', 'database'),
('whenpost', '', 'checkanswe'),
('whenregister', '', 'checkanswe'),
('jsdateformat', 'Y/m/d', 'jswizard'),
('jscachelife', '0', 'jswizard'),
('jsstatus', '1', 'jswizard'),
('levelup_notice', '�������ƽ��Ա�������ܹ����ϴ����̱���bannerͼƬ�����л�ʹ�ø���ĵ���ģ���񣬲�ӵ�и���������Ŀ�Ĳ���Ȩ�ޡ�', 'levelup'),
('smtp_mail', '', 'mail'),
('credit_set', 'a:1:{s:4:"rank";a:15:{i:1;i:10;i:2;i:20;i:3;i:40;i:4;i:70;i:5;i:120;i:6;i:200;i:7;i:400;i:8;i:700;i:9;i:1200;i:10;i:1800;i:11;i:2600;i:12;i:4000;i:13;i:10000;i:14;i:30000;i:15;i:60000;}}', 'credit_sco'),
('score', 'a:1:{s:4:"rank";a:8:{s:8:"register";s:3:"+10";s:5:"login";s:2:"+2";s:11:"information";s:2:"+2";s:6:"coupon";s:2:"+2";s:5:"group";s:2:"+2";s:5:"goods";s:2:"+2";s:11:"com_certify";s:3:"+10";s:11:"per_certify";s:3:"+10";}}', 'credit_sco'),
('credit', 'a:1:{s:4:"rank";a:3:{s:11:"com_certify";s:3:"+50";s:11:"per_certify";s:3:"+50";s:11:"coin_credit";s:3:"+10";}}', 'credit_sco'),
('number', '4', 'authcode'),
('insidelink', 'a:1:{s:7:"forward";a:5:{s:11:"information";s:1:"1";s:4:"news";s:1:"1";s:5:"goods";s:1:"1";s:5:"group";s:1:"1";s:6:"coupon";s:1:"1";}}', 'insidelink'),
('comment', 'a:3:{s:11:"information";s:1:"2";s:4:"news";s:1:"2";s:5:"store";s:1:"2";}', 'comment'),
('jsrefdomains', '', 'jswizard'),
('mail_pass', '', 'mail'),
('callback', '', 'qqlogin'),
('mobile', 'a:8:{s:11:"allowmobile";s:1:"1";s:10:"changecity";s:1:"1";s:11:"autorefresh";s:1:"1";s:8:"register";s:1:"1";s:4:"post";s:1:"1";s:8:"authcode";s:1:"0";s:18:"mobiletopicperpage";s:2:"10";s:12:"mobiledomain";s:0:"";}', 'mobile'),
('close', '3', 'authcode'),
('incline', '30', 'authcode'),
('distort', '2', 'authcode'),
('cfg_cityshowtype', 'pinyin', 'config'),
('cfg_if_nonmember_info', '1', 'config'),
('appkey', '', 'qqlogin'),
('cfg_if_info_verify', '0', 'config'),
('cfg_postfile', 'publish.php', 'config'),
('screen_cat', 'full', 'config'),
('cfg_upimg_watermark_position', '9', 'config'),
('cfg_upimg_watermark_diaphaneity', '60', 'config'),
('cfg_upimg_watermark_size', '12', 'config'),
('cfg_upimg_watermark_color', '#FFFFFF', 'config'),
('cfg_upimg_watermark_text', 'http://www.mymps.com.cn', 'config'),
('cfg_upimg_watermark_img', '', 'config'),
('cfg_upimg_watermark_height', '50', 'config'),
('cfg_upimg_watermark_width', '180', 'config'),
('seo_force_news', 'active', 'seo'),
('mobile', 'a:6:{s:11:"allowmobile";s:1:"1";s:11:"autorefresh";s:1:"1";s:8:"register";s:1:"1";s:8:"authcode";s:1:"1";s:18:"mobiletopicperpage";s:2:"10";s:12:"mobiledomain";s:0:"";}', 'mobile'),
('tpl_set', 'a:15:{s:7:"banmian";s:7:"classic";s:8:"smp_cats";a:4:{s:5:"first";a:2:{i:0;s:1:"1";i:1;s:1:"6";}s:6:"second";a:3:{i:0;s:1:"3";i:1;s:1:"2";i:2;s:2:"10";}s:5:"third";a:3:{i:0;s:1:"4";i:1;s:1:"5";i:2;s:1:"7";}s:6:"fourth";a:3:{i:0;s:1:"8";i:1;s:1:"9";i:2;s:3:"244";}}s:9:"showstyle";a:11:{i:3;s:1:"2";i:1;s:1:"2";i:2;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";i:7;s:1:"2";i:8;s:1:"2";i:9;s:1:"3";i:10;s:1:"3";i:244;s:1:"3";}s:7:"classic";a:1:{s:4:"cats";s:2:"10";}s:6:"portal";a:10:{s:6:"ershou";s:1:"1";s:9:"ershoumod";s:1:"2";s:6:"zufang";s:2:"41";s:9:"zufangmod";s:2:"23";s:10:"ershoufang";s:2:"43";s:13:"ershoufangmod";s:2:"22";s:7:"zhaopin";s:1:"4";s:10:"zhaopinmod";s:1:"7";s:6:"jianli";s:1:"6";s:9:"jianlimod";s:1:"9";}s:7:"portali";a:4:{s:9:"mini_rent";s:9:"mini_rent";s:7:"acreage";s:7:"acreage";s:6:"prices";s:6:"prices";s:7:"company";s:7:"company";}s:12:"indextopinfo";s:1:"5";s:7:"newinfo";s:1:"0";s:8:"announce";s:1:"6";s:3:"faq";s:1:"8";s:4:"news";s:1:"8";s:11:"foreachinfo";s:1:"5";s:5:"goods";s:2:"10";s:9:"telephone";s:2:"12";s:7:"lifebox";s:2:"24";}', 'tpl'),
('mail_user', '', 'mail'),
('smtp_serverport', '25', 'mail'),
('cfg_independency', 'advertisement,topnav,focus,announce,friendlink,telephone,lifebox', 'config'),
('bodybg', '1', 'config'),
('cfg_citiesdir', '/city', 'config'),
('cfg_redirectpage', 'nchome', 'config'),
('seo_force_info', 'active', 'seo'),
('seo_force_category', 'active', 'seo'),
('cfg_upimg_watermark', '1', 'config'),
('screen_index', 'standard', 'config'),
('cfg_upimg_size', '500', 'config'),
('cfg_upimg_type', 'png,jpg,gif,jpeg', 'config'),
('cfg_score_fee', '10', 'config'),
('seo_force_about', 'active', 'seo'),
('seo_htmlext', '', 'seo'),
('seo_htmlnewsdir', '', 'seo'),
('cfg_affiliate_score', '5', 'config'),
('cfg_pay_min', '5', 'config'),
('cfg_member_perpost_consume', '0', 'config'),
('cfg_coin_fee', '1', 'config'),
('cfg_if_affiliate', '1', 'config'),
('seo_htmldir', '', 'seo'),
('seo_description', '{city}��վ����', 'seo'),
('cfg_member_reg_content', '�𾴵�{username},���Ѿ�ע���Ϊ{sitename}�Ļ�Ա,�����ڷ�������ʱ,���ص��ط��ɷ��档\r\n�������ʲô���ʿ�����ϵ����Ա��\r\n\r\n\r\n{sitename}\r\n{time}', 'config'),
('cfg_member_reg_title', '{username},����,��л����ע��,���Ķ��������ݡ�', 'config'),
('cfg_forbidden_reg_ip', '', 'config'),
('cfg_member_regplace', '', 'config'),
('cfg_if_corp', '1', 'config'),
('cfg_if_member_log_in', '1', 'config'),
('cfg_if_member_register', '1', 'config'),
('seo_keywords', '{city}��վ�ؼ���', 'seo'),
('seo_sitename', '{city}��վ����', 'seo'),
('seo_force_yp', 'active', 'seo'),
('seo_force_space', 'active', 'seo'),
('seo_force_store', 'active', 'seo'),
('seo_html_make', '', 'seo'),
('cfg_tpl_dir', 'blue', 'config'),
('cfg_member_verify', '1', 'config'),
('cfg_member_logfile', 'member.php', 'config'),
('cfg_backup_dir', '/backup', 'config'),
('cfg_raquo', '&gt;', 'config'),
('cfg_page_line', '15', 'config'),
('cfg_list_page_line', '15', 'config'),
('cfg_site_open_reason', '', 'config'),
('cfg_authcodefile', 'randcode.php', 'config'),
('cfg_if_site_open', '1', 'config'),
('SiteStat', '', 'config'),
('SiteLogo', '/logo.gif', 'config'),
('SiteBeian', '', 'config'),
('SiteTel', '', 'config'),
('SiteEmail', 'business@live.it', 'config'),
('SiteQQ', '', 'config'),
('SiteUrl', 'http://www.mayicms.test', 'config'),
('SiteName', '�ҵ���վ', 'config'),
('snow', '', 'authcode'),
('line', '1', 'authcode'),
('post', '1', 'authcode'),
('type', 'engber', 'authcode'),
('smtp_server', '', 'mail'),
('mail_service', 'no', 'mail'),
('noise', '10', 'authcode'),
('forgetpass', '1', 'authcode'),
('register', '1', 'authcode'),
('login', '1', 'authcode'),
('screen_info', 'full', 'config'),
('screen_search', 'full', 'config'),
('head_style', 'new', 'config'),
('cfg_member_upgrade_top', '2', 'config'),
('cfg_member_upgrade_list_top', '2', 'config'),
('cfg_member_upgrade_index_top', '4', 'config'),
('cfg_member_info_red', '1', 'config'),
('cfg_member_info_bold', '1', 'config'),
('cfg_member_info_refresh', '1', 'config'),
('cfg_post_editor', '0', 'config'),
('cfg_info_if_img', '0', 'config'),
('cfg_info_if_gq', '0', 'config'),
('cfg_allow_post_area', '', 'config'),
('cfg_disallow_post_tel', '', 'config'),
('cfg_forbidden_post_ip', '', 'config'),
('cfg_if_post_othercity', '0', 'config'),
('cfg_upimg_number', '4', 'config'),
('cfg_if_nonmember_info_box', '0', 'config'),
('cfg_nonmember_perday_post', '10', 'config'),
('mapapi', 'http://api.map.baidu.com/api?v=1.4', 'config'),
('mapflag', 'baidu', 'config'),
('mapapi_charset', '', 'config'),
('mapview_level', '14', 'config'),
('open', '0', 'qqlogin'),
('appid', '', 'qqlogin');

DROP TABLE IF EXISTS `my_corp`;
CREATE TABLE IF NOT EXISTS `my_corp` (
  `corpid` mediumint(6) NOT NULL auto_increment,
  `corpname` varchar(32) NOT NULL,
  `parentid` int(11) NOT NULL,
  `corporder` smallint(6) NOT NULL,
  PRIMARY KEY  (`corpid`),
  KEY `areaname` (`corpname`),
  KEY `parentid` (`parentid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_coupon`;
CREATE TABLE IF NOT EXISTS `my_coupon` (
  `id` mediumint(8) NOT NULL auto_increment,
  `cate_id` smallint(5) NOT NULL default '0',
  `areaid` smallint(5) NOT NULL default '0',
  `userid` varchar(30) NOT NULL,
  `pre_picture` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL default '',
  `begindate` int(10) NOT NULL default '0',
  `enddate` int(10) NOT NULL default '0',
  `title` varchar(100) NOT NULL,
  `des` varchar(50) NOT NULL default '',
  `content` mediumtext NOT NULL,
  `ctype` enum('�ۿ�ȯ','�ּ�ȯ') NOT NULL default '�ۿ�ȯ',
  `sup` varchar(3) NOT NULL,
  `prints` mediumint(8) NOT NULL default '0',
  `comments` mediumint(8) NOT NULL default '0',
  `grade` smallint(5) NOT NULL default '1',
  `flag` tinyint(1) NOT NULL default '1',
  `dateline` int(10) NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '1',
  `hit` int(10) NOT NULL default '0',
  `qq` int(8) NOT NULL,
  `web_address` char(100) NOT NULL,
  `qq_qun` int(8) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  `streetid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cate_id` (`cate_id`),
  KEY `areaid` (`areaid`),
  KEY `userid` (`userid`),
  KEY `status` (`status`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_coupon_category`;
CREATE TABLE IF NOT EXISTS `my_coupon_category` (
  `cate_id` smallint(3) NOT NULL auto_increment,
  `cate_name` varchar(100) NOT NULL,
  `cate_view` tinyint(1) NOT NULL default '1',
  `cate_order` smallint(3) NOT NULL default '0',
  PRIMARY KEY  (`cate_id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_crons`;
CREATE TABLE IF NOT EXISTS `my_crons` (
  `cronid` smallint(6) NOT NULL auto_increment,
  `name` char(50) NOT NULL default '',
  `lastrun` int(10) NOT NULL default '0',
  `nextrun` int(10) NOT NULL default '0',
  `day` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`cronid`),
  KEY `nextrun` (`nextrun`)
) TYPE=MyISAM;

INSERT INTO `my_crons` (`cronid`, `name`, `lastrun`, `nextrun`, `day`) VALUES (1, 'information', 1379925248, 1379952000, 1),
(2, 'advertisement', 1379925248, 1379952000, 1),
(3, 'levelup', 1379925248, 1379952000, 1);

DROP TABLE IF EXISTS `my_faq`;
CREATE TABLE IF NOT EXISTS `my_faq` (
  `id` tinyint(5) NOT NULL auto_increment,
  `typeid` tinyint(5) NOT NULL,
  `title` char(100) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `my_faq` (`id`, `typeid`, `title`, `content`) VALUES (2, 5, '��γ�Ϊ��վ��ע���û���', 'ע����ʵ�ܼ򵥣�ֻҪ����������ʾ������ɡ� <br />\r\n<br />\r\n1��������վ��ҳ��������Ͻǡ�ע�ᡱ��ť�� <br />\r\n<br />\r\n2�����뵽��ע�ᡱҳ�棬������ʾ��Ϣ����д�����ǳơ����롢����֮�󣬵����ע�ᡱ���ɡ� <br />\r\n<br />\r\n3�������Ҫ������Ϣ���ڻ�Ա�����У�����ֱ�ӵ����������ѷ�����Ϣ����ť�������Ͻǵġ���ѷ�����Ϣ��ͼ�ꡣ <br />\r\n<br />'),
(3, 5, '�ǳ���ʲô�ã����Ը�����', '1���ǳ������½������ͨ��֤��ÿ���˶�����һ��Ψһ��ʶ���ǳƣ�����������ÿһ����Ϣ��Ҳ����ʾ�������������ڱ���վ��ݵı�־��Ŀǰ����վ�ϵ��ǳ�(�˺�)�ǲ������޸ĵġ������û�ע��ʱ��ѡ����ϲ�������μǵ��˺š� <br />\r\n<br />\r\n2���ǳ��ǲ��ܹ��޸ĵģ��ͺ�����ʵ�����������һ���� <br />\r\n<br />\r\n3���ǳƽ�������ȹ��ڱ���վ�Ŀ���ÿһ�졣 <br />'),
(4, 5, '��ô��¼��Ա�������ģ�', '��ע���Ϊ����վ�û�����Ϳ���ʹ���˺�(���ǳ�)��¼��Ա���������ˣ�����������������ϸ��������ɣ� <br />\r\n<br />\r\n1�����뱾����ҳ����������Ͻǡ���¼�� <br />\r\n<br />\r\n2�����������ǳ������룬�������¼���� <br />\r\n<br />\r\n3����ϲ����½�ɹ�������Է�����Ϣ�������Ϣ�����㿪�ġ� <br />\r\n<br />'),
(6, 5, '�ҵ�������������ô�죿', '������������˺����룬���ģ�������ͨ���������¼��������ٵ�¼ҳ��,�����ҳ����С���еġ��������� ��Ҫ�һء���ť��á�<br />\r\n<br />\r\n1�����뵽�һ�����ҳ���,��������������ܱ�����ôֱ����ҳ���������ܱ�������𰸱���һء� <br />\r\n<br />\r\n2�������û�������ܱ�����Ҳ������ϵ�ͷ������������롣'),
(7, 2, '�ڱ�վ������ϢҪ�շ���', '1����վ��һ����ѵ�������Ϣ����ƽ̨�� <br /><br />2������Ϊ�����ͨ�û��ṩ������ѷ���������Ϣ�ķ���'),
(22, 4, '������֤����', 'һ����֤Ŀ�� <br /><br />������֤�������������֤���̼�Ӫҵִ����֤������վ�Ƴ�������֤��Ϊ�淶��վ�������򣬽��������������١�Υ���Ȳ�����Ϣ�������Ϣ��ʵ������Ŷȣ�Ҳ��һ���̶��ϱ�֤��֤�û�����Ϣ�������ڷ���֤�û�����Ϣ���������û���ѯʹ����Ϣ�����ģ����û�һ�����õĳ������罻��������ͬʱ���Դ�������Υ����ϢҲ���кܴ���������������ݣ�ÿλ��֤����û�Ӧ������������Ϣ���г��źͷ������Ρ� <br /><br />������֤���� <br /><br />�û���Ը�������֤��ԭ�� <br />1. ���������֤��һ�����ֻ֤����֤һ���û������û����ϴ���ʵ�ĸ���������ϣ� <br />2. �̼�Ӫҵִ����֤�й�˾��������Ӫҵִ������ȫһ�£���������˲��ǹ�˾���������ˣ�������ί���飬��д�����ϴ����֤��ɫԭ��ɨ����� <br /><br />������֤��ʽ <br /><br />1. �������룬�봫�����֤����Ӫҵִ�ո�ӡ�� <br />2. �������룬����д�����֤��Ϣ��ͬʱ�ϴ���ɫԭ��ɨ����� <br />���б���վ�û����������ʹ����֤������֤���̼򵥣�ͨ����֤������ʵ�Ժͳ��Ŷȣ�����ѻ��������ֵ����������֤�û���ݱ�ʶ ��ͬʱ����������Ϣ�������Ѹ���չʾ�뷴������Ϣ�����չʾ���б�ҳ&ldquo;�����û�ר��&rdquo;�� <br /><br /><br />�ġ���֤��˱�׼ <br /><br />1.���������֤��һ�����ֻ֤����֤һ���û������̼�Ӫҵִ����֤�й�˾��������Ӫҵִ������ȫһ�£���������˲��ǹ�˾���������ˣ�������ί���飬��д�����ϴ����֤��ɫԭ��ɨ����� <br /><br />2. ��֤ʱ�˺ű�����ʹ�� <br />���ύ�������֤ԭ����ӡ���ͻ��ڸ�ӡ�������ͨ����ʹ���˺ŷ��������Ҹ����֤����������֤��ȷ���˺Ű�ȫ�� <br /><br /><br />3. ��ʵ�����ϵı��ܳ�ŵ <br />ͨ����֤���ʵ�����Ͻ�����ȡ������ģ�����վ����������ʵ���������֤�������Ϣ���ϣ���ȡ�ϸ�ı��ܴ�ʩ�������ṫ�������ṩ����������������κ������������� <br /><br /><br />�塢��֤�û����� <br /><br />1. ��֤����̼��û��뱣֤��Ϣ����ʵ�ԣ���������١�Υ����������Ϣ��Ҫ���ذ�淢����Ϣ�����ڱ��û�Ͷ�ߵ��̼ң�����Ա�������������ȡ���桢ȡ���̼��ʸ񡢴���˻�������˺ŵȴ�����ʽ����������߽�����û�׷������̼ҷ������Ρ� <br /><br />2. ���̼�֮��Ҫ�����ദ��������ڮ�١�á�����������Ϊ������Ա���̼������������ͨ��վ�ڶ���Ϣ��������Ҿ����ܵ�������ƽ��顣���ڶ��⹥����Ϊ����������׹�����������Ա������ڲ�ȡ���澯�桢ȡ���̼��ʸ񡢴���˻�������˺ŵȴ�����ʽ��'),
(23, 2, 'Ϊʲô�ҵ���Ϣ�ǡ�����ˡ���', '<div>Ϊ�˱�֤��վ����Ϣ���������ǶԲ�����Ϣ�����ˡ�����ˡ�״̬��������ˡ�����Ϣ�����¼����������������������������Ǳ༭���ἰʱ���� <br />\r\n<br />\r\n1��Ϊ�˱�֤��վ�ϵľ��������Ϣ�Ϸ����淶�����ǻ��ں�̨���ùؼ��ֵ����εĹ��ܣ���������Ϣ����Υ��������Υ��������Դ��ײ��š��������ˡ�������������ݣ�ϵͳ�����������Ϣ�Զ����롰����ˡ����С� <br />\r\n<br />\r\n2�����������Ϣ�ظ������������ϡ���ϵ��ʽΪ��ء���Ϣȱ�ٹؼ����ݵ�����£�Ҳ��ᱻ��վ���롰����ˡ����С� <br />\r\n<br />\r\n3��������ϵ��ʽ��֮ǰ�������˺�ʹ�÷�������Ϣ����ô������ϢҲ���Զ����롰����ˡ�״̬�У������������������������ϵ���ǽ���ȷ�ϣ��Ա�������ʹ��������ϵ��ʽ�� <br />\r\n<br />\r\n4����Ȼ����������ḻ��Ҳ������ĳЩ�������������Ե����ݷ���ʱͬ����������������δ�ܽ�����������뱾վ�ͷ�ȡ����ϵ�� <br />\r\n<br />\r\n5�� ������ˡ�����Ϣ24Сʱ�ڻ�����꣬ͨ����˺����Ϣ�ṫ��������ûͨ����˵���Ϣ�������롰����վ����</div>'),
(24, 1, '�ö����ļ�����ʽ��', '<p>\r\n	�ö���3����ʽ�������ö���С���ö�����ҳ�ö���\r\n</p>\r\n<p>\r\n	�����ö�������С�������ö���Ϣ�����Բ��÷�����Ϣ��ҳ����ʽ��\r\n</p>\r\n<p>\r\n	С���ö�������С�������ö���Ϣ�����Բ��÷�����Ϣ��ҳ����ʽ��\r\n</p>\r\n<p>\r\n	��ҳ�ö���������ҳ�ö���Ϣ�����Բ��÷�����Ϣ��ҳ����ʽ��\r\n</p>'),
(25, 1, '�ö���ʲô�ô���', '<p>\r\n	��Ϣ�ö��󣬾��ܹ������ױ�������˹�ע������Ϊ�����������Ϣʱ�����������ǰ�����ݣ�������������Ϣ����Ч�Ծ͵õ��˱��ϡ��ö���Ϣ��õĹ�ע����ͨ��Ϣ��20����\r\n</p>'),
(26, 1, '�ö���ʲô��', '<p>\r\n	��Ϣ�ö��Ǳ�վΪ�û��ṩ����ֵ���񣬶��Լ��Ѿ������ɹ�����Ϣ����������ϵ��վ������Ա��ѯ�ö�ҵ���ö������Ϣ�ͻ��ڸ������б�ҳ�г�ʱ�䴦�ڿ�ǰ�Ĺ̶�λ�ã�������Ŀͼ�� \r\n���ö���Ϣ�������û������ע��������Ϊ���µ����ӷ�������ʹ�������ӱ�������ߣ��������޷�����ע����\r\n</p>'),
(27, 1, 'ˢ����ʲô��', 'ˢ����Ϣ�൱�����������Ϣ���·���һ�Σ���Ϣ���ٴ��ŵ�������б�ҳ��Ŀ�ǰλ�á�&nbsp;<br />'),
(28, 2, 'Ϊʲô�ҷ���������Ϣ��', '<p>\r\n	<strong>Ϊ��Ӫ�����õ������Χ�������˺ŷ���������Ϣ���ߵ�¼���ˣ�����������ԭ��<br />\r\n<br />\r\n</strong> \r\n</p>\r\n1�����Ǹ���ÿ�������������˷������������Ѿ��ڸ÷����´ﵽ�˷����������ޣ� <br />\r\n<p>\r\n	<br />\r\n</p>\r\n2��Ϊʲô�ҷ�����Ϣʱ��ʾ�ҡ���Ϣ�ڰ����Ƿ��ʡ��� <br />\r\n�Ƿ�����ָ��˾�����ء����ܲ��š������ṩ�Ĵʻ�����Ҳ�Ҫ����Υ����Ϣ����д�����һ�·������ݱ���������Ϊ��<br />\r\n<p>\r\n	<br />\r\n</p>\r\n3��Ϊʲô��Ϣ�����ɹ�����ʾ������С��� <br />\r\n���з�������Ϣ�������Ƚ���������ȹ�����Ա���ͨ����ŻῪ�ų�������վ�����Ա��24Сʱ�ڻ��ṩ������˽����<br />\r\n<p>\r\n	<br />\r\n</p>\r\n4��Ϊʲô������Ϣʱ��ʾ�ҡ�������Ϣ̫��Ƶ������ <br />\r\nΪ�˷�ֹ�����û��Ķ��ⷢ����Ϊ�����ǶԷ����ٶȽ��������ƣ���ʱ��������΢��Ϣһ���ٷ����� <br />\r\n<p>\r\n	<br />\r\n</p>\r\n5��Ϊʲô������Ϣʱ��ʾ�� ����Ϣ�ظ����� <br />\r\n��ͬ����Ϣ�������ظ��������������ڷ���ʱ����Ϣ�����޸ġ���������ѡ�����û������еġ�ˢ�¡������淢���� <br />\r\n<p>\r\n	<br />\r\n</p>\r\n6��Ϊʲô�ҷ����������ӣ���ô�����������棩�� <br />\r\n����������������ʱ�����Գ�����������IE��ʱ�ļ������������ѡ�������: <br />\r\n1. �������������ť�޷�Ӧ��<br />\r\n2. �������������ť�󣬰�ťΪ��ɫ��ҳ�治��ת��<br />\r\n3. ��ʾ���Է���0����Ϣ��<br />\r\n4. �޷��ϴ�ͼƬ�����·���������Ϣ <br />'),
(29, 6, '���������վ', '<p>\r\n	<strong>ʲô�ǵ�����վ��</strong><br />\r\n������վͨ��αװ��Ϊ������վ���Ա����̵���Щ�����������Ͻ��ײ����������û��������� \r\nΪ����վ����ȡ�������ύ���˺ź�������Ϣ����һ��ͨ�������ʼ������������ʼ���һ������αװ�����ӽ��ռ�������������վ������ͨ \r\n����Ϣ�����������վ���ӵ���Ϊ���ջ��û���������վ�С�\r\n</p>\r\n<p>\r\n	<strong>������վ�ĳ���������</strong><br />\r\n������վ��ҳ������ʵ��վ������ȫһ�£�Ҫ��������ύ�˺ź����롣һ����˵������ \r\nվ�ṹ�ܼ򵥣�ֻ��һ���򼸸�ҳ�棬URL����ʵ��վ��ϸ΢��𣬵�������ģ�һ����˵��������Ա��ıȽ϶ࡣ<br />\r\n����ʵ�Ĺ�����վ \r\nΪwww.icbc.com.cn����Թ��еĵ�����վ���п���Ϊwww.1cbc.com.cn��<br />\r\n��ʵ���Ա����̵���ַΪhttp://www.taobao.com/������Ա� \r\n�ĵ�����վ���п����� \r\nhttp://list.taobao.com/<br />\r\nhttp://ship.36165279taobao.com/<br />\r\nhttp://taobao.gegecn.com.cn<br />\r\nhttp://taobao0.com<br />\r\nhttp://w \r\nww.taobaoxaq.com.cn/<br />\r\nhttp://www.Taobaveng.cn<br />\r\nhttp://www.paokn.com/taobao<br />\r\nhttp://www.teobao.com<br />\r\nhttp://www.taoob \r\nao.com<br />\r\nhttp://taobaoa.w31.100dns.com/<br />\r\nhttp://www.taobaoy.com<br />\r\nhttp://taobao-hb.cn/<br />\r\nӦ���ر�С���ɲ��淶����ĸ�� \r\n����ɵ�CN����ַ����ý�ֹ���������JavaScript��ActiveX���룬��Ҫ��һЩ��̫�˽����վ��\r\n</p>\r\n<p>\r\n	<strong>��η�ֹ��ƭ</strong><br />\r\n������Щ����ֱ�����ӵ��Ա�������ַ�ģ����˵�¼��֧��������ҳ�����������ģ����������ӵ� \r\n����Ա���ַ�������̼Ҿ��������˹˿Ͷ��Ա����������Σ�ͨ���ڹٷ���ע����ʽ�����꣬����QQ�����˿͵�¼������ͬ�ļ��Ա������� \r\nַ����ȡ�˿͵�֧�����˺������벢�������ƻ�������������������ܶ࣬�����������Ѵ�ҵ��ǣ��Ա����׵ı任��ʽ���ֶ����������� \r\n���й��ɵģ�ǰ׺���ǡ�taobao����ֻ�ں�׺����СС���𣬻����෴���˿��粻����ȶԺ��ѿ��������������������Ա��������м��� \r\n������ʵ��վ������������Ƶ���Ҫ�Ա����׵���վ�����������ṩ�Ա��ĵ������ƣ�Ȼ���http://www.taobao.com/�����ʵ���Ա�������á��������������Ա�����������ף���Ϊ����������ʶ������Ա��Ĺ��ܣ�����ַ����ʾ��ȫ���ٵĻ�����ʾ��롣\r\n</p>'),
(30, 6, '����ƭ���ַ�����', '<div>\r\n	<h3>\r\n		ƭ�ӵĻ����ֶ�\r\n	</h3>\r\n	<p>\r\n		һֱ����������ƭ�Ӳ���������䲻�����ڣ����ǻ�������ҩ�ķ����������������Ϣͨ����ƭ�ӵ���ϸ�о���Ϊ����û��ܽ�һЩ������ �Ķ�����\r\n	</p>\r\n	<p>\r\n		<strong>1��</strong>������Ʒ���ԡ�����XXXX,�۸�XXX������ļ�Q���ġ���Щ���Ӵ�Ҷ�ҪС������һ�£�������Щ���ӳ����۵��� \r\nƷ�۸񶼻�������ϱ�����࣬��͵������ˣ���Ҫ̰ͼС���ˣ�̰��� ʧ��\r\n	</p>\r\n	<p>\r\n		<strong>2��</strong>ƭ��ͨ��������֧�ֵ�������ֻ���ȴ���������Ʒ���ᵽ֧�������߲ƻ�ͨʲô�ĵ����������˵�����ã���ʱ \r\n���Ҫע���ˣ�������Ѱ��һ̨��Ҳ��Ҫ�������ţ�������һ�µ�������<br />\r\n�ҵ���Ʒ����Ҫ�����Լ�������Ǯ��Ҫ��\r\n	</p>\r\n	<p>\r\n		<strong>3��</strong>ĳЩƭ�ӵ��ַ���һ���ߣ���ʵҲһ�۾��ܿ����ģ�����������ȷʵ������Ʒ�������������������ֻ�������ն����Ȱ���Ʒ����Ƭ����������Ȼ�󾲵ȴ����ϵ������׵�ʱ��Ҫ���ȿ�һ�룬Ȼ��˵�����Ʒ�ʸ��㣬û�������ٰ�����һ���Ǯ�� \r\n�Ĵ�����������������»��ˣ���Ҫ��Ϊ�Լ���Ȩ�����˱��ϣ���һ���Լ���ʲô������԰ɣ����Ǳ�ƭ��ȫ�������Ǳ�ƭ��һ�룡\r\n	</p>\r\n	<p>\r\n		<strong>4��</strong>����Ʒ��������Ʒ������ƭ��Ҳ��������ϵķ�����Ȼ��˵���׷�ʽ��ʱ��ȻҲ������õ�����֧��������Ҫ�� \r\n����Ʒ���ȿ�оͻ�˵���Դ��ͬʱ����Ʒ�ʼĳ�ȥ�����Ҫ����<br />\r\n����ʼĹ�˾�����ˣ��������ַ���ȷʵ���У�ֻ���ϵ����� Ӧ�ò���ܶ��~\r\n	</p>\r\n	<p>\r\n		<strong>5��</strong>����һ�־���ƭ��˵��ݹ�˾���յ�ҵ����Ҳ�ǲ����ŵģ�����Ŀ�ݹ�˾����û������ҵ��\r\n	</p>\r\n	<h3>\r\n		��ʵ�õķ�ƭ����\r\n	</h3>\r\n	<p>\r\n		<strong>1��</strong>���һ��Ҫ���潻�ף�������õĽ��׷�ʽ��ƭ����ʵ��֪�����������һ���ط��ģ�����ƭ��һ��������Ҫ���ɽ��ף������������������һ�£��������������ϵģ���ʵ�������� \r\n֪���㲻���ܸ������ɽ��ף�Ȼ�󻹻�������û����������ʲô�� ���Ǳߣ��мǣ����������ģ�ֱ�����ڰɡ�\r\n	</p>\r\n	<p>\r\n		<strong>2��</strong>����һ��Ҫ�õ�����֧��ƽ̨��������Ҷ��б��ϣ���֧�ֵ������Ļ��߲��ܼ��潻�׵ľ͸�����Ҫ��ᣬ������ \r\n�Ұɣ���϶���ƭ�ӡ�\r\n	</p>\r\n	<p>\r\n		<strong>3��</strong>�ڽ���ǰ����Ȱٶ�һ�¶Է���QQ��������ֻ����룬������һ�㶼����ƭ�ӵ���Ϣ�ġ�\r\n	</p>\r\n	<p>\r\n		<strong>4��</strong>��Ҫ�ͶԷ��ĵĿ��ľͳ��ֵ��ܶ��������Լ������棬�е�ƭ�Ӿͻ���������ս���������������������������� \r\n��������������һ��Ҫ��ס�������ڽ��ף��������ڽ����ѣ�ʱ��Ҫ���� ����ڵ�һλ����ȫ���ײ���Ӳ����\r\n	</p>\r\n	<p>\r\n		<strong>5��</strong>��Ҫ��Ϊ��Уѧ���Ͳ�����ƭ�ӣ����ںܶ�ƭ�Ӷ��Ǵ�ѧ���أ�����С�Ľ�����\r\n	</p>\r\n	<p>\r\n		<strong>5��</strong>�ʵݷ�ʽһ��Ҫ��������ʵݹ�˾������EMS��˳�ᡢ��ͨ�ȵȡ�\r\n	</p>\r\n	<p>\r\n		<strong>6��</strong>������������Ʒ��Ȼ�鷳�������ǳ����潻֮����ȫ�Ľ��׷�������ΪҪ�߷��ɳ�������һ������ʱ���ϵ� \r\n���󣬵�һ���мǣ������Ų��ᱻƭ��\r\n	</p>\r\n</div>'),
(31, 6, '��������ƭָ��', '<div>\r\n	�ʼ����ż�����<br />\r\n<br />\r\n1.����թƭˣ���� \r\n��֤�ֻ�͵����<br />\r\nͻȻ�յ�����ϵͳ������˵��֤�ֻ�����δ��֤��Ҫ��֤��Ҫ�ظ��˻�������û���Ҫע���ˣ������������Ϣ�ǲ��ᷢ���κ�Ҫ���û��ظ��˻�������Ķ��ŵġ�<br />\r\n<br />\r\n2.�ؼۻ�Ʊ����� \r\nת����Ǯ��ԭ��<br />\r\n���Ŵ��˴�Ļ�����������ؼۻ�Ʊ����Ȼ��Ϊ�������Ŵʻ㣬���ٻ�Ʊ����Ҳӭ���� \r\n�Լ��ġ����������������ӳ��Գ����ۿ����������߶�Ʊ��ƭȡǮ�ƣ�����ֱ����ȡ�û��������˻������롣��ҪΪ̰ͼһ��С���˵��¼� \r\n��ʧ��Ǯ�ƣ�Ҳ�򲻵��ؼҹ�������š�ͨ��֤����Ϊ�˴�ҿ��Կ�����ֵĹ�һ����������꣬���Ҷ��ע���ˡ�<br />\r\n<br />\r\n3.˭˵�˺����쳣 \r\nԭ��ƭ�������<br />\r\n��������ƭ�ӶԻ�����Խ��Խ��Ϥ����������ʽ������ð�仯���������Ϣ���ͻ����͵����ʼ�����һ \r\n�������ӣ����Ҳ�Ҫ����Ҫ������д�������˻��������Щ�ʼ��������������Ϣ�ǲ���Ҫ�������ʼ�����д��Щ��Ϣ�ģ���Щ����ƭ�ӵ��ʼ���ֻҪ \r\n����д��ȥ�ͻᱻ�Ǹ�������ʼ������޸���������ģ��˻������Ŀͻ�����Ҫע���ˡ�<br />\r\n<br />\r\n4.������䱻���� \r\n�н���թҪ���<br />\r\n�����������Ϣ������û������ʼ����û�ȥ�μ���ν �ġ��񻶡������Դ��Ҫע�������ʼ���Ŷ��\r\n</div>'),
(32, 2, '�绰��ð��', '<div>\r\n	���ṩ��ð�õģ���Ϣ��š�ð�ú��룩����ϵ��վ������Ա��\r\n</div>'),
(33, 2, '��Ҫɾ����Ϣ', '<p>\r\n	<span style="font-family:����;">1���ڶ���������޸�</span><span>/</span><span style="font-family:����;">ɾ����Ϣ����</span>\r\n</p>\r\n<p>\r\n	<span style="font-family:����;">2����¼</span><span style="font-family:����;">�û����ģ��ҷ�������Ϣ�ڣ�������ѡ���޸ġ�ɾ����ˢ�µȲ�����</span>\r\n</p>'),
(34, 2, '��ϢΪʲô����ʾ��', '<div>\r\n	1�������Ϣ�������дʻ㡢�����ַ��������Ƶ����ݣ�����Ҫ������Ա���ͨ������ܹ�����ʾ�����ʱ��Ϊ24Сʱ֮�ڣ���\r\n</div>\r\n<div>\r\n</div>\r\n<div>\r\n	2����Ϣ״̬�����ƣ�������Ϣ��Ҫ���޸����ƺ���ܹ���չʾ������Ҫ���޸�������Ϣ����ͨ����վ������Ա��˳ɹ��󣬲��ܹ���չʾ�����ʱ��Ϊ24Сʱ֮�ڣ���\r\n</div>\r\n<div>\r\n</div>\r\n<div>\r\n	3���޸Ĺ�����Ϣʱ�����µ����б��е�λ�ò���䡣�������Ϣ�ٴ��ŵ�������б�ҳ��Ŀ�ǰλ�ã������Ե����ˢ�¡���\r\n</div>');

DROP TABLE IF EXISTS `my_faq_type`;
CREATE TABLE IF NOT EXISTS `my_faq_type` (
  `id` tinyint(5) NOT NULL auto_increment,
  `typename` char(50) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `my_faq_type` (`id`, `typename`) VALUES (1, '�ö���ˢ��'),
(2, '��Ϣ������ɾ��'),
(4, '��֤����'),
(5, '�û�ע�����¼'),
(6, '��ƭ��ʶ');

DROP TABLE IF EXISTS `my_flink`;
CREATE TABLE IF NOT EXISTS `my_flink` (
  `id` smallint(5) NOT NULL auto_increment,
  `catid` mediumint(6) NOT NULL DEFAULT '0',
  `ifindex` tinyint(1) NOT NULL default '1',
  `url` varchar(200) NOT NULL,
  `webname` char(30) NOT NULL default '',
  `weblogo` char(250) NOT NULL default '',
  `dayip` char(20) NOT NULL,
  `pr` smallint(1) NOT NULL,
  `msg` char(200) NOT NULL default '',
  `name` varchar(10) NOT NULL,
  `qq` varchar(11) NOT NULL,
  `email` char(50) NOT NULL default '',
  `typeid` smallint(5) NOT NULL default '0',
  `ischeck` smallint(1) NOT NULL default '1',
  `ordernumber` int(8) NOT NULL,
  `createtime` int(10) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ordernumber` (`ordernumber`),
  KEY `ischeck` (`ischeck`),
  KEY `weblogo` (`weblogo`),
  KEY `ifindex` (`ifindex`),
  KEY `catid` (`catid`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_flink_type`;
CREATE TABLE IF NOT EXISTS `my_flink_type` (
  `id` mediumint(8) NOT NULL auto_increment,
  `typename` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `my_flink_type` (`id`, `typename`) VALUES (1, '�Ż���վ'),
(2, '������Ϣ'),
(4, '��̳����'),
(8, '�������');

DROP TABLE IF EXISTS `my_focus`;
CREATE TABLE IF NOT EXISTS `my_focus` (
  `id` smallint(5) NOT NULL auto_increment,
  `image` varchar(100) NOT NULL,
  `pre_image` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `words` varchar(50) NOT NULL,
  `pubdate` int(11) NOT NULL,
  `focusorder` smallint(5) NOT NULL,
  `typename` enum('��վ��ҳ','������ҳ') NOT NULL default '��վ��ҳ',
  `cityid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `image` (`image`),
  KEY `url` (`url`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_goods`;
CREATE TABLE IF NOT EXISTS `my_goods` (
  `goodsid` int(10) NOT NULL auto_increment,
  `goodsbh` varchar(11) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `goodsname` varchar(100) NOT NULL,
  `catid` smallint(3) NOT NULL,
  `oldprice` varchar(8) NOT NULL,
  `nowprice` varchar(8) NOT NULL,
  `huoyuan` tinyint(1) NOT NULL,
  `gift` varchar(100) NOT NULL,
  `oicq` varchar(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `picture` varchar(255) NOT NULL,
  `pre_picture` varchar(255) NOT NULL,
  `rushi` tinyint(1) NOT NULL,
  `tuihuan` tinyint(1) NOT NULL,
  `jiayi` tinyint(1) NOT NULL,
  `weixiu` tinyint(1) NOT NULL,
  `fahuo` tinyint(1) NOT NULL,
  `zhengpin` tinyint(1) NOT NULL,
  `tuijian` tinyint(1) NOT NULL,
  `cuxiao` tinyint(1) NOT NULL,
  `remai` tinyint(1) NOT NULL,
  `baozhang` tinyint(1) NOT NULL,
  `onsale` tinyint(1) NOT NULL default '1',
  `hit` int(10) NOT NULL,
  `dateline` int(10) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  `streetid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`goodsid`),
  KEY `userid` (`userid`,`catid`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_goods_category`;
CREATE TABLE IF NOT EXISTS `my_goods_category` (
  `catid` mediumint(6) NOT NULL auto_increment,
  `if_view` tinyint(1) NOT NULL default '1',
  `color` char(10) NOT NULL,
  `catname` varchar(32) NOT NULL,
  `title` varchar(250) NOT NULL,
  `keywords` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `parentid` int(11) default NULL,
  `catorder` smallint(6) NOT NULL,
  PRIMARY KEY  (`catid`),
  KEY `parentid` (`parentid`),
  KEY `catname` (`catname`),
  KEY `catorder` (`catorder`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_goods_order`;
CREATE TABLE IF NOT EXISTS `my_goods_order` (
  `id` int(10) NOT NULL auto_increment,
  `goodsid` int(10) NOT NULL,
  `ordernum` smallint(5) NOT NULL,
  `oname` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `qq` varchar(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `goodsid` (`goodsid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_group`;
CREATE TABLE IF NOT EXISTS `my_group` (
  `groupid` int(10) NOT NULL auto_increment,
  `userid` varchar(50) NOT NULL,
  `gname` varchar(250) NOT NULL,
  `cate_id` smallint(3) NOT NULL,
  `areaid` smallint(5) NOT NULL,
  `dateline` int(10) NOT NULL,
  `displayorder` int(10) NOT NULL,
  `signintotal` smallint(5) NOT NULL default '0',
  `glevel` tinyint(1) NOT NULL default '0',
  `message` varchar(250) NOT NULL,
  `gaddress` varchar(250) NOT NULL,
  `meetdate` int(10) NOT NULL,
  `enddate` int(10) NOT NULL,
  `mastername` varchar(100) NOT NULL,
  `masterqq` int(11) NOT NULL,
  `des` varchar(250) NOT NULL,
  `content` mediumtext NOT NULL,
  `picture` varchar(255) NOT NULL,
  `pre_picture` varchar(255) NOT NULL,
  `commenturl` varchar(100) NOT NULL,
  `biztype` varchar(100) NOT NULL,
  `othercontent` mediumtext NOT NULL,
  `web_address` char(100) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  `streetid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`groupid`),
  KEY `areaid` (`areaid`),
  KEY `cate_id` (`cate_id`),
  KEY `userid` (`userid`),
  KEY `glevel` (`glevel`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_group_category`;
CREATE TABLE IF NOT EXISTS `my_group_category` (
  `cate_id` smallint(3) NOT NULL auto_increment,
  `cate_name` varchar(100) NOT NULL,
  `cate_view` tinyint(1) NOT NULL default '1',
  `cate_order` smallint(3) NOT NULL default '0',
  PRIMARY KEY  (`cate_id`)
) TYPE=MyISAM;

INSERT INTO `my_group_category` (`cate_id`, `cate_name`, `cate_view`, `cate_order`) VALUES (1, '�Ҿ���', 1, 1),
(2, '������', 1, 2),
(3, '����', 1, 3),
(4, '������', 1, 4),
(5, '��¿��', 1, 5),
(6, 'ĸӤ��', 1, 6),
(9, '����', 1, 7);

DROP TABLE IF EXISTS `my_group_signin`;
CREATE TABLE IF NOT EXISTS `my_group_signin` (
  `signid` int(10) NOT NULL auto_increment,
  `sname` varchar(100) NOT NULL,
  `sex` enum('��','Ů') NOT NULL,
  `age` varchar(50) NOT NULL,
  `groupid` int(10) NOT NULL,
  `qqmsn` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `dateline` int(10) NOT NULL,
  `totalnumber` smallint(5) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `signinip` varchar(20) NOT NULL,
  `message` varchar(250) NOT NULL,
  PRIMARY KEY  (`signid`),
  KEY `groupid` (`groupid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_info_img`;
CREATE TABLE IF NOT EXISTS `my_info_img` (
  `id` int(10) NOT NULL auto_increment,
  `image_id` tinyint(1) NOT NULL,
  `path` varchar(250) NOT NULL,
  `prepath` varchar(250) NOT NULL,
  `infoid` int(11) NOT NULL,
  `uptime` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `infoid` (`infoid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_info_report`;
CREATE TABLE IF NOT EXISTS `my_info_report` (
  `id` int(8) NOT NULL auto_increment,
  `infoid` int(8) NOT NULL,
  `infotitle` char(50) NOT NULL,
  `report_type` smallint(3) NOT NULL,
  `content` varchar(255) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `pubtime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_info_typemodels`;
CREATE TABLE IF NOT EXISTS `my_info_typemodels` (
  `id` smallint(6) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `displayorder` tinyint(3) NOT NULL default '0',
  `type` tinyint(1) NOT NULL default '0',
  `options` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_info_typeoptions`;
CREATE TABLE IF NOT EXISTS `my_info_typeoptions` (
  `optionid` smallint(6) NOT NULL auto_increment,
  `classid` smallint(6) NOT NULL default '0',
  `displayorder` tinyint(3) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `identifier` varchar(40) NOT NULL default '',
  `type` varchar(20) NOT NULL default '',
  `rules` mediumtext NOT NULL,
  `available` char(2) NOT NULL,
  `required` char(2) NOT NULL,
  `search` char(2) NOT NULL,
  PRIMARY KEY  (`optionid`),
  KEY `classid` (`classid`),
  KEY `available` (`available`),
  KEY `search` (`search`),
  KEY `displayorder` (`displayorder`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_information`;
CREATE TABLE IF NOT EXISTS `my_information` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(30) NOT NULL,
  `catid` int(8) NOT NULL,
  `begintime` int(11) NOT NULL,
  `activetime` smallint(3) NOT NULL,
  `endtime` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `userid` varchar(30) NOT NULL,
  `contact_who` char(10) NOT NULL,
  `qq` char(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `hit` int(10) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL,
  `manage_pwd` char(32) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `ip2area` varchar(32) NOT NULL,
  `info_level` tinyint(1) NOT NULL,
  `img_path` varchar(200) NOT NULL,
  `img_count` smallint(3) NOT NULL default '0',
  `upgrade_type` tinyint(1) NOT NULL default '1',
  `upgrade_time` int(10) NOT NULL,
  `upgrade_type_list` tinyint(1) NOT NULL default '1',
  `upgrade_time_list` int(10) NOT NULL,
  `ifred` tinyint(1) NOT NULL default '0',
  `ifbold` tinyint(1) NOT NULL default '0',
  `certify` tinyint(1) NOT NULL default '0',
  `catname` varchar(32) NOT NULL,
  `dir_typename` varchar(100) NOT NULL,
  `upgrade_type_index` tinyint(1) NOT NULL,
  `upgrade_time_index` int(10) NOT NULL,
  `mappoint` varchar(100) NOT NULL,
  `latitude` DECIMAL( 20, 17 ) NOT NULL,
  `longitude` DECIMAL( 20, 17 ) NOT NULL,
  `web_address` char(100) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  `areaid` int(8) NOT NULL,
  `streetid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`,`info_level`,`cityid`),
  KEY `userid` (`userid`),
  KEY `ifred` (`ifred`),
  KEY `ifbold` (`ifbold`),
  KEY `tel` (`tel`),
  KEY `begintime` (`begintime`,`info_level`,`id`),
  KEY `upgrade_type` (`upgrade_type`,`begintime`,`id`),
  KEY `upgrade_type_list` (`upgrade_type_list`,`begintime`,`id`),
  KEY `upgrade_type_index` (`upgrade_type_index`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_insidelink`;
CREATE TABLE IF NOT EXISTS `my_insidelink` (
  `id` mediumint(8) NOT NULL auto_increment,
  `word` char(16) NOT NULL,
  `url` char(60) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_jswizard`;
CREATE TABLE IF NOT EXISTS `my_jswizard` (
  `id` smallint(5) NOT NULL auto_increment,
  `flag` varchar(50) NOT NULL,
  `customtype` char(8) NOT NULL,
  `parameter` mediumtext NOT NULL,
  `edittime` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `flag` (`flag`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_lifebox`;
CREATE TABLE IF NOT EXISTS `my_lifebox` (
  `id` smallint(4) NOT NULL auto_increment,
  `typeid` tinyint(1) NOT NULL default '2',
  `lifename` varchar(50) NOT NULL,
  `lifeurl` varchar(200) NOT NULL,
  `if_view` tinyint(1) NOT NULL,
  `displayorder` smallint(3) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `displayorder` (`displayorder`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_mail_sendlist`;
CREATE TABLE IF NOT EXISTS `my_mail_sendlist` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `template_id` varchar(50) NOT NULL,
  `email_content` mediumtext NOT NULL,
  `error` tinyint(1) NOT NULL DEFAULT '0',
  `email_subject` varchar(200) NOT NULL,
  `last_send` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_mail_template`;
CREATE TABLE IF NOT EXISTS `my_mail_template` (
  `template_id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `is_sys` tinyint(1) NOT NULL DEFAULT '1',
  `template_code` varchar(30) NOT NULL DEFAULT '',
  `is_html` tinyint(1) NOT NULL DEFAULT '0',
  `template_subject` varchar(200) NOT NULL DEFAULT '',
  `template_content` mediumtext NOT NULL,
  `last_modify` int(10) NOT NULL DEFAULT '0',
  `last_send` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`template_id`),
  UNIQUE KEY `template_code` (`template_code`)
) TYPE=MyISAM;

INSERT INTO `my_mail_template` (`template_id`, `is_sys`, `template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`, `last_send`) VALUES
(1, 1, 'findpwd', 1, '�һ������ʼ�', '�װ����û� {$user_name} ���ã�\r\n\r\n���Ѿ��������������õĲ����������������ӣ����޷�����Ѵ����Ӹ���ճ����������򿪣�:\r\n\r\n{$reset_email}\r\n\r\n��ȷ���������������ò��������ʼ�Ϊϵͳ����������ظ��ʼ���\r\n\r\n{$site_name}\r\n{$send_date}', 1407235479, 0),
(2, 1, 'validate', 1, '���û��ʼ���֤', '{$user_name}���ã�\r\n\r\n����ʼ��� {$site_name} ���͵ġ����յ�����ʼ���Ϊ����֤��ע���ʼ���ַ�Ƿ���Ч��������Ѿ�ͨ����֤�ˣ����������ʼ���\r\n\r\n������������(���߸��Ƶ����������)����֤����ʼ���ַ:\r\n{$validate_email}\r\n\r\n{$site_name}\r\n{$send_date}', 1429947607, 0);

DROP TABLE IF EXISTS `my_member`;
CREATE TABLE IF NOT EXISTS `my_member` (
  `id` mediumint(8) NOT NULL auto_increment,
  `userid` varchar(20) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `userpwd` char(36) NOT NULL,
  `catid` varchar(250) NOT NULL,
  `areaid` char(8) NOT NULL,
  `cname` varchar(40) NOT NULL,
  `tname` varchar(100) NOT NULL,
  `introduce` mediumtext NOT NULL,
  `sex` enum('��','Ů') NOT NULL default '��',
  `tel` varchar(30) NOT NULL default '',
  `address` varchar(50) NOT NULL default '',
  `busway` mediumtext NOT NULL,
  `mappoint` varchar(100) NOT NULL,
  `qq` char(12) NOT NULL,
  `msn` char(50) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `template` char(250) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `prelogo` varchar(250) NOT NULL,
  `banner` varchar(250) NOT NULL,
  `safequestion` char(25) NOT NULL,
  `safeanswer` char(25) NOT NULL,
  `levelid` smallint(3) NOT NULL default '1',
  `money_own` mediumint(8) NOT NULL default '0',
  `credit` int(10) NOT NULL default '0',
  `credits` smallint(2) NOT NULL default '1',
  `score` int(10) NOT NULL default '0',
  `joinip` char(16) NOT NULL,
  `loginip` char(16) NOT NULL,
  `jointime` int(10) NOT NULL,
  `logintime` int(10) NOT NULL,
  `web` char(50) NOT NULL,
  `per_certify` tinyint(1) NOT NULL default '0',
  `com_certify` tinyint(1) NOT NULL default '0',
  `if_corp` tinyint(1) NOT NULL default '0',
  `ifindex` tinyint(1) NOT NULL default '1',
  `iflist` tinyint(1) NOT NULL default '1',
  `mobile` varchar(20) NOT NULL,
  `levelup_time` int(10) NOT NULL,
  `hit` int(10) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  `streetid` mediumint(6) NOT NULL,
  `qdtime` INT( 10 ) NOT NULL,
  `status` TINYINT( 1 ) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `areaid` (`areaid`),
  KEY `catid` (`catid`),
  KEY `levelid` (`levelid`),
  KEY `if_corp` (`if_corp`),
  KEY `jointime` (`jointime`),
  KEY `ifindex` (`ifindex`),
  KEY `iflist` (`iflist`),
  KEY `openid` (`openid`),
  KEY `cityid` (`cityid`),
  KEY `status` (`status`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_member_album`;
CREATE TABLE IF NOT EXISTS `my_member_album` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `path` varchar(250) NOT NULL,
  `prepath` varchar(250) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `pubtime` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_member_category`;
CREATE TABLE IF NOT EXISTS `my_member_category` (
  `id` int(11) NOT NULL auto_increment,
  `userid` varchar(20) NOT NULL,
  `catid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `catid` (`catid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_member_comment`;
CREATE TABLE IF NOT EXISTS `my_member_comment` (
  `id` int(10) NOT NULL auto_increment,
  `userid` varchar(20) NOT NULL,
  `fromuser` varchar(20) NOT NULL,
  `face` varchar(250) NOT NULL,
  `pubtime` int(10) NOT NULL default '0',
  `quality` tinyint(1) NOT NULL,
  `service` tinyint(1) NOT NULL,
  `environment` tinyint(1) NOT NULL,
  `price` tinyint(1) NOT NULL,
  `avgprice` varchar(20) NOT NULL,
  `enjoy` tinyint(1) NOT NULL,
  `content` mediumtext,
  `reply` mediumtext NOT NULL,
  `retime` int(10) NOT NULL,
  `commentlevel` tinyint(1) NOT NULL default '1',
  `flower` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `enjoy` (`enjoy`),
  KEY `fromuser` (`fromuser`),
  KEY `commentlevel` (`commentlevel`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_member_docu`;
CREATE TABLE IF NOT EXISTS `my_member_docu` (
  `id` int(11) NOT NULL auto_increment,
  `typeid` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `content` mediumtext NOT NULL,
  `hit` int(10) NOT NULL default '0',
  `imgpath` varchar(250) NOT NULL,
  `pre_imgpath` varchar(250) NOT NULL,
  `pubtime` int(10) NOT NULL,
  `if_check` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_member_docutype`;
CREATE TABLE IF NOT EXISTS `my_member_docutype` (
  `typeid` int(11) NOT NULL auto_increment,
  `typename` varchar(100) NOT NULL,
  `arrid` tinyint(1) NOT NULL default '1',
  `ifview` tinyint(1) NOT NULL default '1',
  `displayorder` int(5) NOT NULL,
  PRIMARY KEY  (`typeid`)
) TYPE=MyISAM;

INSERT INTO `my_member_docutype` (`typeid`, `typename`, `arrid`, `ifview`, `displayorder`) VALUES (1, '�̼���Ѷ', 1, 2, 1),
(2, '�Żݴ���', 1, 2, 2);

DROP TABLE IF EXISTS `my_member_level`;
CREATE TABLE IF NOT EXISTS `my_member_level` (
  `id` tinyint(5) NOT NULL auto_increment,
  `levelname` varchar(30) NOT NULL,
  `ifsystem` tinyint(1) NOT NULL,
  `purviews` varchar(250) NOT NULL,
  `money_own` mediumint(8) NOT NULL,
  `perday_maxpost` smallint(5) NOT NULL,
  `allow_tpl` mediumtext NOT NULL,
  `member_contact` tinyint(1) NOT NULL default '1',
  `signin_notice` tinyint(1) NOT NULL default '0',
  `signin_del` tinyint(1) NOT NULL default '1',
  `signin_view` tinyint(1) NOT NULL default '1',
  `moneysettings` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `my_member_level` (`id`, `levelname`, `ifsystem`, `purviews`, `money_own`, `perday_maxpost`, `allow_tpl`, `member_contact`, `signin_notice`, `signin_del`, `signin_view`, `moneysettings`) VALUES (1, '������·', 1, 'purview_info,purview_pm,purview_base,purview_avatar,purview_levelup,purview_certify,purview_pay,purview_password,purview_shop,purview_album,purview_comment,purview_document,purview_coupon,purview_group,purview_goods ', 5, 5, 'blue', 1, 0, 0, 0, 'a:2:{s:6:"ifopen";a:4:{s:5:"month";s:1:"1";s:8:"halfyear";s:1:"1";s:4:"year";s:1:"1";s:7:"forever";s:1:"1";}s:5:"money";a:4:{s:5:"month";s:2:"30";s:8:"halfyear";s:0:"";s:4:"year";s:0:"";s:7:"forever";s:0:"";}}'),
(2, '��ͨ��Ա', 1, 'purview_avatar,purview_info,purview_shoucang,purview_base,purview_certify,purview_pm,purview_levelup,purview_pay,purview_password,purview_shop,purview_album,purview_comment,purview_document,purview_coupon,purview_group,purview_goods,purview_banner', 0, 100, 'blue,green', 1, 0, 0, 0, 'a:2:{s:6:"ifopen";a:3:{s:5:"month";s:1:"1";s:8:"halfyear";s:1:"1";s:7:"forever";s:1:"1";}s:5:"money";a:4:{s:5:"month";s:5:"20000";s:8:"halfyear";s:6:"300000";s:4:"year";s:7:"1000000";s:7:"forever";s:7:"2000000";}}'),
(3, '�ƽ��Ա', 0, 'purview_avatar,purview_info,purview_shoucang,purview_base,purview_certify,purview_pm,purview_levelup,purview_pay,purview_password,purview_shop,purview_album,purview_comment,purview_document,purview_coupon,purview_group,purview_goods,purview_banner', 0, 100, 'blue,orange,green', 1, 0, 0, 0, 'a:2:{s:6:"ifopen";a:4:{s:5:"month";s:1:"1";s:8:"halfyear";s:1:"1";s:4:"year";s:1:"1";s:7:"forever";s:1:"1";}s:5:"money";a:4:{s:5:"month";s:1:"1";s:8:"halfyear";s:1:"2";s:4:"year";s:1:"3";s:7:"forever";s:1:"4";}}');

DROP TABLE IF EXISTS `my_member_pm`;
CREATE TABLE IF NOT EXISTS `my_member_pm` (
  `id` smallint(10) NOT NULL auto_increment,
  `fromuser` varchar(50) NOT NULL,
  `touser` varchar(50) NOT NULL,
  `pubtime` int(10) NOT NULL default '0',
  `retime` int(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `retitle` varchar(250) NOT NULL,
  `content` mediumtext,
  `recontent` mediumtext NOT NULL,
  `if_read` tinyint(1) NOT NULL default '0',
  `if_sys` tinyint(1) NOT NULL,
  `if_del` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `fromuser` (`fromuser`),
  KEY `touser` (`touser`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_member_record_login`;
CREATE TABLE IF NOT EXISTS `my_member_record_login` (
 `id` int(11) NOT NULL auto_increment,
  `userid` char(32) NOT NULL,
  `userpwd` char(30) NOT NULL,
  `pubdate` int(10) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `ip2area` varchar(32) NOT NULL,
  `browser` varchar(20) NOT NULL,
  `port` varchar(20) NOT NULL,
  `os` varchar(20) NOT NULL,
  `outdate` int(10) NOT NULL,
  `result` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_member_record_use`;
CREATE TABLE IF NOT EXISTS `my_member_record_use` (
  `id` int(8) NOT NULL auto_increment,
  `userid` char(50) NOT NULL,
  `paycost` char(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `pubtime` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `pubtime` (`pubtime`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_member_tpl`;
CREATE TABLE IF NOT EXISTS `my_member_tpl` (
  `id` smallint(3) NOT NULL auto_increment,
  `if_view` tinyint(1) NOT NULL default '2',
  `tpl_name` varchar(250) NOT NULL,
  `tpl_path` varchar(250) NOT NULL,
  `displayorder` int(5) NOT NULL,
  `edittime` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `my_member_tpl` (`id`, `if_view`, `tpl_name`, `tpl_path`, `displayorder`, `edittime`) VALUES (1, 2, '��ɫ����', 'blue', 1, 1273410326),
(2, 2, '�Ⱥ�����', 'orange', 2, 1273410338),
(4, 2, '��ɫ����', 'green', 4, 1273410646);

DROP TABLE IF EXISTS `my_navurl`;
CREATE TABLE IF NOT EXISTS `my_navurl` (
  `id` mediumint(6) NOT NULL auto_increment,
  `url` char(250) NOT NULL,
  `color` varchar(7) NOT NULL,
  `flag` varchar(50) NOT NULL,
  `ico` varchar(20) NOT NULL,
  `target` varchar(10) NOT NULL,
  `title` char(250) NOT NULL,
  `typeid` smallint(5) NOT NULL default '0',
  `isview` smallint(1) NOT NULL default '1',
  `displayorder` int(5) NOT NULL,
  `createtime` int(10) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `typeid` (`typeid`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_news`;
CREATE TABLE IF NOT EXISTS `my_news` (
  `id` int(10) NOT NULL auto_increment,
  `iscommend` tinyint(1) NOT NULL default '0',
  `isfocus` varchar(10) NOT NULL,
  `isbold` tinyint(1) NOT NULL default '0',
  `isjump` tinyint(1) NOT NULL default '0',
  `redirect_url` varchar(250) NOT NULL,
  `title` varchar(30) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `catid` int(8) NOT NULL,
  `begintime` int(11) NOT NULL,
  `introduction` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `author` varchar(30) NOT NULL,
  `source` varchar(100) NOT NULL,
  `hit` int(10) NOT NULL default '0',
  `perhit` int(10) NOT NULL default '1',
  `imgpath` varchar(100) NOT NULL default '0',
  `html_path` varchar(100) NOT NULL,
  `cityid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`),
  KEY `imgpath` (`imgpath`),
  KEY `begintime` (`begintime`),
  KEY `hit` (`hit`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_payapi`;
CREATE TABLE IF NOT EXISTS `my_payapi` (
  `payid` smallint(6) NOT NULL auto_increment,
  `paytype` varchar(20) NOT NULL default '',
  `buytype` tinyint(1) NOT NULL default '1',
  `myorder` tinyint(4) NOT NULL default '0',
  `payfee` varchar(10) NOT NULL default '',
  `payuser` varchar(60) NOT NULL default '',
  `partner` varchar(60) NOT NULL default '',
  `paykey` varchar(120) NOT NULL default '',
  `paylogo` varchar(200) NOT NULL default '',
  `paysay` mediumtext NOT NULL,
  `payname` varchar(120) NOT NULL default '',
  `isclose` tinyint(1) NOT NULL default '0',
  `payemail` varchar(120) NOT NULL default '',
  PRIMARY KEY  (`payid`),
  UNIQUE KEY `paytype` (`paytype`)
) TYPE=MyISAM;

INSERT INTO `my_payapi` (`payid`, `paytype`, `buytype`, `myorder`, `payfee`, `payuser`, `partner`, `paykey`, `paylogo`, `paysay`, `payname`, `isclose`, `payemail`) VALUES (1, 'tenpay', 1, 0, '0', '', '', '', '', '            <b>�Ƹ�ͨ��www.tenpay.com�� - ��Ѷ��������֧��ƽ̨��ͨ������Ȩ����ȫ��֤��֧�ָ�����������֧����</b>            ', '�Ƹ�ͨ', 0, ''),
(2, 'chinabank', 1, 1, '0', '', '', '', '', '�����������й��������С��������С��й��������С�ũҵ���С��������е���ʮ�ҽ��ڻ������Э�顣ȫ��֧��ȫ��19�����е����ÿ�����ǿ�ʵ������֧��������ַ��http://www.chinabank.com.cn��', '��������', 0, ''),
(3, 'alipay', 1, 0, '', '', '', '', '', '                ֧������վ(www.alipay.com) �ǹ����Ƚ�������֧��ƽ̨��                ', '֧�����ӿ�', 0, '');

DROP TABLE IF EXISTS `my_payrecord`;
CREATE TABLE IF NOT EXISTS `my_payrecord` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `userid` varchar(30) NOT NULL,
  `orderid` varchar(50) NOT NULL default '',
  `money` varchar(20) NOT NULL default '',
  `paybz` varchar(10) NOT NULL default '',
  `type` varchar(12) NOT NULL default '',
  `payip` varchar(20) NOT NULL default '',
  `ifadd` TINYINT(1) NOT NULL DEFAULT  '0',
  `posttime` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `orderid` (`orderid`),
  KEY `ifadd` (`ifadd`),
  KEY `posttime` (`posttime`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_plugin`;
CREATE TABLE IF NOT EXISTS `my_plugin` (
  `id` smallint(5) NOT NULL auto_increment,
  `flag` varchar(30) NOT NULL default '',
  `iscore` tinyint(1) NOT NULL default '0',
  `name` varchar(60) NOT NULL default '',
  `directory` varchar(100) NOT NULL default '',
  `disable` tinyint(1) NOT NULL default '0',
  `config` mediumtext NOT NULL,
  `version` varchar(60) NOT NULL default '',
  `releasetime` int(10) NOT NULL,
  `author` varchar(255) NOT NULL default '',
  `introduce` mediumtext NOT NULL,
  `siteurl` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `copyright` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `my_plugin` (`id`, `flag`, `iscore`, `name`, `directory`, `disable`, `config`, `version`, `releasetime`, `author`, `introduce`, `siteurl`, `email`, `copyright`) VALUES (1, 'coupon', 0, '�Ż�ȯ', 'coupon', 0, 'a:4:{s:8:"seotitle";s:16:"{city}�Ż�ȯ����";s:11:"seokeywords";s:18:"{city}�Ż�ȯ�ؼ���";s:14:"seodescription";s:16:"{city}�Ż�ȯ����";s:9:"adminmenu";s:60:"�Ż�ȯ����=coupon_category.php\r\n���ϴ��Ż�ȯ=coupon_list.php";}', '1.0', 1278232105, 'steven', '�����Ż�ȯ���', 'http://www.mymps.com.cn', 'business@live.it', 'Mymps Dev.'),
(2, 'group', 0, '�Ź�', 'group', 0, 'a:4:{s:8:"seotitle";s:18:"{city}�Ź������";s:11:"seokeywords";s:20:"{city}�Ź���ؼ���";s:14:"seodescription";s:18:"{city}�Ź������";s:9:"adminmenu";s:81:"�Ź�����=group_category.php\r\n�ѷ����Ź�=group_list.php\r\n��������=group_signin.php";}', '1.0', 1278232105, 'steven', '�Ź�����', 'http://www.mymps.com.cn', 'business@live.it', 'MyDev.'),
(3, 'news', 0, '������Ѷ', '-', 0, 'a:4:{s:8:"seotitle";s:18:"{city}����ģ�����";s:11:"seokeywords";s:20:"{city}����ģ��ؼ���";s:14:"seodescription";s:18:"{city}����ģ������";s:9:"adminmenu";s:66:"���Ź���=news.php\r\n�������=channel.php\r\n��������=news_comment.php";}', '2.0', 1278232105, 'steven', '��վ���Ų��', 'http://www.mymps.com.cn', 'business@live.it', 'MyDev.'),
(4, 'goods', 0, '��Ʒ', 'goods', 0, 'a:7:{s:8:"seotitle";s:14:"{city}��Ʒ����";s:11:"seokeywords";s:16:"{city}��Ʒ�ؼ���";s:14:"seodescription";s:14:"{city}��Ʒ����";s:9:"adminmenu";s:78:"��Ʒ����=goods_category.php\r\n��Ʒ����=goods_list.php\r\n��������=goods_order.php";s:5:"quhuo";s:555:"1.��ͨ����ͻ����� \r\n  ����ȫ��800������У��˷�5Ԫ/����\r\n2.�Ӽ�����ͻ����� \r\n  ֧�ֱ���������Ϻ������ݡ����ڡ��ȷ����޵��ط����������˷�10Ԫ/���� \r\n3.Բͨ��� \r\n  �����������˷�10Ԫ/�� \r\n4.��ͨ�ʵ� \r\n  ��½�������˷�5Ԫ/������������29Ԫ���˷� \r\n  �۰ĵ������˷�Ϊ��Ʒԭ���ܽ���30%�����20Ԫ \r\n  ����������˷�Ϊ��Ʒԭ���ܽ���50%�����50Ԫ \r\n5.�����ؿ�ר��(EMS) \r\n  �����������˷�Ϊ�����ܽ���20%�����16Ԫ \r\n  ��½�����������˷�Ϊ�����ܽ���40%�����20Ԫ \r\n  �۰�̨�������˷�Ϊ�����ܽ���50%�����45Ԫ \r\n6.���� \r\n  ֧���û��������ᣬ�����˷ѡ�";s:6:"fukuan";s:150:"���渶��\r\n���ڽ��ס��ͻ����š�ԤԼ���׾��ɵ��渶��\r\n\r\n����ת��\r\n��ͨ����ת�˷�ʽ�����ָ���˺���\r\n\r\n���ϻ��\r\n��ͨ����ת�˷�ʽ�����ָ���˺���";s:7:"service";s:1240:"�ۺ����ο����ģ�\r\n1�������������������ࡢ�ֻ���������ʼǱ���̨ʽ�����ҵ�����Ʒ��Ϊ�˱�֤���ܳ���������������ṩ���ۺ��޷��񣬲������Ƿ���Ҫ���߷�Ʊ�����Ƕ����浥Ϊ�����ߣ���Ʊ����Ĭ��Ϊ����������Ʒȫ�ƣ�ͬʱ��֧���޸ķ�Ʊ���ݡ������Ϊ�����ߵķ�Ʊ���ݺ�������Ʒ���Ʋ����������޷����ޣ���վ�Ų�����\r\n \r\n2���˻�ʱ�ṩ��Ʊԭ������1000Ԫ�ֽ�֧���Ķ��������˻��������ֽ�\r\n \r\n3�������ࡢ�ֻ���������ʼǱ���̨ʽ�����ҵ硢��ӡ����ɨ���ǡ�һ���������GPS����Ʒ�������Ʒ�����������⣬�������е����������ۺ�������Ľ��м�⣬�����ݼ�ⱨ�棨������Щ���������ۺ���������޷��ṩ��ⱨ��ģ����ṩά�޼��鵥�ݣ��������ⱨ��ȷ�������������⣬Ȼ�󽫼�ⱨ�桢������Ʒ��������װ������һ��������˾�����˻������������������ʧ�����ǽ��޷�Ϊ������\r\n \r\n4��������ʯ���ƽ��ֱ��鱦���μ������������Ʒ������������Ҽ�����ʯ�������ĳ��ߵļ���֤��ġ����������ⲻ�����˻������ͻ����յ���Ʒ֮�����Է�Ʊ����Ϊ׼��3�����ڣ���������������⣬�����е����ص������ල����-�鱦��ʯ�����������Ľ��м�⣬�����ⱨ��ȷ�������������⣬���뱾վ�ۺ������ϵ�����˻������ˡ��˻���ʱ��������ؽ���ⱨ�桢��Ʒ�����װ���ڴ�����������֤�顢˵�������ͬ��Ʒһ���˻ء����а�װ�����ȱʧ���۳�����Ʒ5%���ۼ۷ѣ����и��������ȱʧ�۳�����Ʒ10-15%���ۼ۷ѡ�";}', '1.0', 1309753960, 'steven', '��Ʒ���', 'http://www.mymps.com.cn', 'business@live.it', 'MyDev.');

DROP TABLE IF EXISTS `my_shoucang`;
CREATE TABLE IF NOT EXISTS `my_shoucang` (
  `id` int(10) NOT NULL auto_increment,
  `infoid` int(10) NOT NULL,
  `title` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `intime` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_telephone`;
CREATE TABLE IF NOT EXISTS `my_telephone` (
  `id` smallint(4) NOT NULL auto_increment,
  `telname` varchar(50) NOT NULL,
  `telnumber` varchar(50) NOT NULL,
  `color` char(10) NOT NULL,
  `if_bold` tinyint(1) NOT NULL default '0',
  `displayorder` smallint(5) NOT NULL,
  `if_view` tinyint(1) NOT NULL default '1',
  `cityid` mediumint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `displayorder` (`displayorder`),
  KEY `cityid` (`cityid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_template`;
CREATE TABLE IF NOT EXISTS `my_template` (
  `filepath` varchar(250) NOT NULL,
  `content` longtext NOT NULL
) TYPE=MyISAM;

DROP TABLE IF EXISTS `my_upload`;
CREATE TABLE IF NOT EXISTS `my_upload` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `width` varchar(10) NOT NULL default '',
  `height` varchar(10) NOT NULL default '',
  `playtime` varchar(10) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `newsid` int(11) NOT NULL default '0',
  `uptime` int(11) NOT NULL default '0',
  `adminid` int(11) NOT NULL default '0',
  `memberid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `memberid` (`memberid`,`filesize`,`newsid`)
) TYPE=MyISAM ;