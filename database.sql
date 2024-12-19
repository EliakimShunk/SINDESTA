CREATE TABLE IF NOT EXISTS `usr_usuario` (
    `usr_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `usr_username` varchar(45) COLLATE utf8mb3_unicode_ci NOT NULL,
    `usr_password` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `usr_is_admin` tinyint(1) NOT NULL,
    PRIMARY KEY (`usr_id`),
    UNIQUE KEY `usr_username_UNIQUE` (`usr_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE IF NOT EXISTS `flo_filiado` (
    `flo_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `flo_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `flo_cpf` varchar(14) COLLATE utf8mb3_unicode_ci NOT NULL,
    `flo_rg` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `flo_birthDate` DATETIME NOT NULL,
    `flo_company` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
    `flo_position` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
    `flo_status` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `flo_phone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
    `flo_cellphone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
    `flo_lastUpdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`flo_id`),
    UNIQUE KEY `flo_cpf_UNIQUE` (`flo_cpf`),
    UNIQUE KEY `flo_rg_UNIQUE` (`flo_rg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE IF NOT EXISTS `dpe_dependente` (
    `dpe_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `flo_id` BIGINT(20) UNSIGNED NOT NULL,
    `dpe_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `dpe_birthDate` DATETIME NOT NULL,
    `dpe_relationship` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    PRIMARY KEY (`dpe_id`),
    FOREIGN KEY (`flo_id`) REFERENCES `flo_filiado`(`flo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
