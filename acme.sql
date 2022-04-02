CREATE TABLE `sl_site_language` (
                                    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
                                    `is_available` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否启用',
                                    `site_id` int NOT NULL COMMENT '站点',
                                    `language_id` int NOT NULL COMMENT '语言',
                                    `insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录插入时间',
                                    `last_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '记录更新时间',
                                    `is_del` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否删除',
                                    `is_default` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否为默认',
                                    `sort` int UNSIGNED NOT NULL DEFAULT '1' COMMENT '排序',
                                    PRIMARY KEY (`id`),
                                    KEY `idx_sitelang_uptime` (`last_update_time`)
                                    CONSTRAINT `FK_2F87D51A81E27D` FOREIGN KEY (`isco_group_id`) REFERENCES `isco_group` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 432 CHARSET = utf8mb3 COMMENT '语言与站点关系表'


