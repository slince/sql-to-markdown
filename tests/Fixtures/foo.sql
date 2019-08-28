CREATE TABLE `hello_sql_to_markdown` (
  `id` int unsigned NOT NULL AUTO_INCREMENT default '0' COMMENT 'primary',
  `foo` decimal (20, 2) unsigned NOT NULL default '0' COMMENT 'foo field',
  `bar` decimal (20, 2) unsigned NOT NULL default '0' COMMENT 'foo field',
  PRIMARY KEY (`id`),
  KEY `idx_billno` (`billno`,`opera_status`),
) ENGINE=InnoDB AUTO_INCREMENT=2367038934 DEFAULT CHARSET=utf8mb4 COMMENT='Demo table schema';