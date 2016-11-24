DROP TABLE IF EXISTS `my_coupon_category`;
CREATE TABLE IF NOT EXISTS `my_coupon_category` (
  `cate_id` smallint(3) NOT NULL auto_increment,
  `cate_name` varchar(100) NOT NULL,
  `cate_view` tinyint(1) NOT NULL default '1',
  `cate_order` smallint(3) NOT NULL default '0',
  PRIMARY KEY  (`cate_id`)
) TYPE=MYISAM AUTO_INCREMENT=15 ;

INSERT INTO `my_coupon_category` (`cate_id`, `cate_name`, `cate_view`, `cate_order`) VALUES (9, '��ʳ', 1, 1),
(10, '����', 1, 2),
(11, 'Ů��', 1, 3),
(12, '����', 1, 4),
(13, '��Ӱ', 1, 5),
(14, '����', 1, 6);