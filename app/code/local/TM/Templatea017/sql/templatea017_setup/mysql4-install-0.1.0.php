<?php
$installer = $this;
$connection = $installer->getConnection();
$tableConfig = $installer->getTable('core/config_data');
$select = $connection->select()
   ->from($tableConfig, array('value'))
   ->where('path = ?', 'web/unsecure/base_url');

$baseUrl = $connection->fetchOne($select);
$installer->startSetup();

$installer->run("

INSERT INTO {$installer->getTable('easyslide')} (`easyslide_id`, `identifier`, `title`, `width`, `height`, `duration`, `frequency`, `autoglide`, `controls_type`, `status`, `created_time`, `modified_time`) VALUES 
(10017, 'default_a017', 'Default a017', 950, 159, 0.5, 4.0, 1, 'number', 1, '2010-03-09 11:02:40', NULL);

INSERT INTO {$installer->getTable('easyslide_slides')} (`slider_id`, `description`, `url`, `target`, `image`, `sort_order`, `is_enabled`) VALUES 
(10017, '', '".$baseUrl."media/easyslide/a017slider2.jpg', '/', 'Default Slide 2', 20, 1),
(10017, '', '".$baseUrl."media/easyslide/a017slider1.jpg', '/', 'Default Slide 1', 10, 1),
(10017, '', '".$baseUrl."media/easyslide/a017slider5.jpg', '/', 'Default Slide 5', 50, 1),
(10017, '', '".$baseUrl."media/easyslide/a017slider4.jpg', '/', 'Default Slide 4', 40, 1),
(10017, '', '".$baseUrl."media/easyslide/a017slider3.jpg', '/', 'Default Slide 3', 30, 1);

");

$installer->endSetup();
