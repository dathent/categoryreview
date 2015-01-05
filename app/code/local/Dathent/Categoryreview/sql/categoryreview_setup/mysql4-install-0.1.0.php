<?php

$installer = $this;

$installer->startSetup();

$installer->run("
--
 DROP TABLE IF EXISTS {$this->getTable('categoryreview')};
CREATE TABLE {$this->getTable('categoryreview')} (
  `categoryreview_id` bigint(20) unsigned NOT NULL auto_increment,
  `catid` int(15) NOT NULL,
  `custid` varchar(255) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `status` tinyint(3) unsigned NOT NULL default '1',
  `name` varchar(255) NOT NULL,
  `product_rew` text NOT NULL,
  `shop_rew` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `visible_main` tinyint(3) unsigned NOT NULL default '2',
  PRIMARY KEY  (`categoryreview_id`),
  KEY `FK_REVIEW_STATUS` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 