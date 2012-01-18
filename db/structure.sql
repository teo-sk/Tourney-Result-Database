
-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'tourneys'
-- table containing tourney definitions
-- ---

DROP TABLE IF EXISTS `tourneys`;
        
CREATE TABLE `tourneys` (
  `id` INTEGER(4) NULL AUTO_INCREMENT DEFAULT NULL,
  `title` VARCHAR(255) NOT NULL,
  `buy_in` DECIMAL(8) NULL,
  `entrants` INTEGER(4) NOT NULL,
  PRIMARY KEY (`id`)
) COMMENT 'table containing tourney definitions';

-- ---
-- Table 'tourney_payouts'
-- cross table defining relations between tourneys and payouts
-- ---

DROP TABLE IF EXISTS `tourney_payouts`;
        
CREATE TABLE `tourney_payouts` (
  `tourney` INTEGER(4) NOT NULL,
  `payout` INTEGER(4) NOT NULL,
  PRIMARY KEY (`payout`)
) COMMENT 'cross table defining relations between tourneys and payouts';

-- ---
-- Table 'payouts'
-- table containing payout definitions
-- ---

DROP TABLE IF EXISTS `payouts`;
        
CREATE TABLE `payouts` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `place` INTEGER NOT NULL DEFAULT 0 COMMENT '0 for knockout bounty',
  `amount` DECIMAL(8) NOT NULL,
  PRIMARY KEY (`id`)
) COMMENT 'table containing payout definitions';

-- ---
-- Table 'entries'
-- entries in a tournament
-- ---

DROP TABLE IF EXISTS `entries`;
        
CREATE TABLE `entries` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `tourney` INTEGER(4) NOT NULL DEFAULT NULL,
  `place` INTEGER(2) NULL DEFAULT NULL,
  `knockouts` INTEGER(4) NULL DEFAULT NULL,
  `date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) COMMENT 'entries in a tournament';

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `tourney_payouts` ADD FOREIGN KEY (tourney) REFERENCES `tourneys` (`id`);
ALTER TABLE `tourney_payouts` ADD FOREIGN KEY (payout) REFERENCES `payouts` (`id`);
ALTER TABLE `entries` ADD FOREIGN KEY (tourney) REFERENCES `tourneys` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `tourneys` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tourney_payouts` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `payouts` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `entries` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `tourneys` (`id`,`title`,`buy_in`,`entrants`) VALUES
-- ('','','','');
-- INSERT INTO `tourney_payouts` (`tourney`,`payout`) VALUES
-- ('','');
-- INSERT INTO `payouts` (`id`,`place`,`amount`) VALUES
-- ('','','');
-- INSERT INTO `entries` (`id`,`tourney`,`place`,`knockouts`,`date_added`) VALUES
-- ('','','','','');
