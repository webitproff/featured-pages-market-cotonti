-- file featuredpagesmarket.install.sql


CREATE TABLE IF NOT EXISTS `cot_featured_pag_mrkt` (
  `fartc_id` int unsigned NOT NULL auto_increment,
  `fartc_from_id` int unsigned NOT NULL default '0',
  `fartc_to_id` int unsigned NOT NULL default '0',
  `fartc_order` tinyint unsigned NOT NULL default '0',
  PRIMARY KEY (`fartc_id`),
  UNIQUE KEY `unique_pair` (`fartc_from_id`,`fartc_to_id`),
  KEY `idx_from` (`fartc_from_id`),
  KEY `idx_to` (`fartc_to_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;