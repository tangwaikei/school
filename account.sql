
create table if not exists `account`(
	`id` mediumint(8) unsigned NOT NULL auto_increment primary key,
	`builder` varchar(30) NOT NULL,#发起人
	`department` varchar(50) NOT NULL,#发起部门
	`build_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, #发起时间
	`project_name` varchar(30) NOT NULL,#项目名称
	`fee_kind` varchar(20) NOT NULL,#费用类型
	`pre_money` decimal(8,3) NOT NULL, #预计金额
	`attachment_id` mediumint(8) unsigned NOT NULL,#附件号
	`content` varchar(500) NOT NULL,#内容简介
	`leading_suggestion`  varchar(200),#负责人意见
	`director_suggestion` varchar(200)#总监意见
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

create table if not exists `member`(
	`id` mediumint(8) unsigned NOT NULL auto_increment primary key,
	`username` varchar(32) CHARACTER SET utf8 NOT NULL,
	`password` varchar(32) NOT NULL,
	`email` varchar(64) CHARACTER SET utf8 NOT NULL,	
	`reg_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	`last_login_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

create table if NOT exists `member_group`(
	`mid` mediumint(8) unsigned NOT NULL,
	`gid` mediumint(8) unsigned NOT NULL,
	unique `m_g_id` (`mid`,`gid`),
	key `mid` (`mid`),
	key `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

create table if not exists `group`(
	`id` mediumint(8) unsigned NOT NULL auto_increment primary key,
	`title` varchar(32) NOT NULL,
	`status` tinyint(1) NOT NULL DEFAULT '1',
	`pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父ID'
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

create table if not exists `group_rule`(
	`rid` mediumint(8) unsigned NOT NULL,
	`gid` mediumint(8) unsigned NOT NULL,
	`level` tinyint(1) NOT NULL,
	`pid` mediumint(8) unsigned NOT NULL,
	key `rid` (`rid`),
	key `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

create table if not exists `rule`(
	`id` mediumint(8) unsigned NOT NULL auto_increment primary key,
	`name` char(80) NOT NULL DEFAULT '',
    `type` tinyint(1) NOT NULL DEFAULT '1',
    `status` tinyint(1) NOT NULL DEFAULT '1',
    `condition` char(100) NOT NULL DEFAULT '',
 	UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `file` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `original_name` varchar(32) NOT NULL,
  `file_name` varchar(32) NOT NULL,
  `file_size` int(10) NOT NULL,
  `file_type` varchar(16) DEFAULT NULL,
  `upload_time` varchar(27) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `think_news`(
   `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
   `click` mediumint(8) unsigned NOT NULL DEFAULT 0,#浏览数
   `title` varchar(128) NOT NULL,#标题
   `content` text NOT NULL,#内容
   `time`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, #发起时间
   `attachment_id` mediumint(8) unsigned NOT NULL,#附件序号
   PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;