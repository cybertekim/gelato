<?php

$installer = $this;
$featuredTable = $this->getTable('featured');
$imageTable = $this->getTable('magik_featured_image');
$installer->startSetup();
$installer->run("
DROP TABLE IF EXISTS {$featuredTable};
CREATE TABLE {$featuredTable} (
  `no_of_images` int(2) default NULL,  
  `featured_id` int(11) unsigned NOT NULL auto_increment,
  `website_id` bigint( 25 ) default NULL ,
  `move` int(1) NOT NULL default '1',
  `type` int(1) NOT NULL default '1',
  `no_of_featured` int(2) NOT NULL default '3',
  `imagesize` varchar(100) default NULL,
   PRIMARY KEY (`featured_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$imageTable};
CREATE TABLE {$imageTable} (
  `id` bigint(20) NOT NULL auto_increment,
  `image_path` varchar(500) default NULL,
  `image_link` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO {$featuredTable} (move,type,no_of_featured) VALUES (1, 1, 1);
");

$installer->endSetup();
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$setup->addAttribute('catalog_product', 'featured', array(
        'group'             => 'General',
        'type'              => 'int',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Featured Product',
        'input'             => 'boolean',
        'class'             => '',
        'source'            => '',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => true,
        'default'           => '0',
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'unique'            => false,
        'apply_to'          => 'simple,configurable,virtual,bundle,downloadable',
        'is_configurable'   => false
    ));
?>
