SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `events`;
CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COLLATE utf8_unicode_ci COMMENT '(DC2Type:guid)', playhead INT UNSIGNED NOT NULL, payload LONGTEXT NOT NULL COLLATE utf8_unicode_ci, metadata LONGTEXT NOT NULL COLLATE utf8_unicode_ci, recorded_on VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_5387574AD17F50A634B91FA9 (uuid, playhead), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

DROP TABLE IF EXISTS `users_checked_in`;
CREATE TABLE `users_checked_in` (
  `buildingId` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `occurredAt` datetime NOT NULL
) ENGINE='InnoDB' COLLATE 'latin1_general_ci';
