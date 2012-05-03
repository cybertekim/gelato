<?php
$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$installer->getTable('easyslide')};
CREATE TABLE {$installer->getTable('easyslide')} (
  `easyslide_id` int(11) unsigned NOT NULL auto_increment,
  `identifier` varchar(64) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `width` int(5) NOT NULL default 100,
  `height` int(5) NOT NULL default 100,
  `duration` DECIMAL(3,1) NOT NULL default 0.5,
  `frequency`DECIMAL(3,1) NOT NULL default 3.0,
  `autoglide` tinyint(1) NOT NULL default 1,
  `controls_type` enum('number', 'arrow') NOT NULL default 'number',
  `status` tinyint(1) NOT NULL default 1,
  `created_time` datetime NULL,
  `modified_time` datetime NULL,
  PRIMARY KEY (`easyslide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS {$installer->getTable('easyslide_slides')};
CREATE TABLE {$installer->getTable('easyslide_slides')} (
  `slide_id` int(11) unsigned NOT NULL auto_increment,
  `slider_id` int(11) unsigned NOT NULL,
  `description` text NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `target` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `sort_order` tinyint NOT NULL default 50,
  `is_enabled` tinyint(1) NOT NULL default '1',
  PRIMARY KEY (`slide_id`),
  CONSTRAINT `FK_easyslide_slides_slider_id` FOREIGN KEY (`slider_id`) REFERENCES {$installer->getTable('easyslide')} (`easyslide_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


");

$installer->endSetup();
