#
# HLStats Database Upgrade file
# -----------------------------
#
# REPLACE #DB_PREFIX# WITH YOUR CURRENT HLSTATS PREFIX eg. hlstats
#
# To upgrade an existing HLStats 1.61 database to version 1.62, type:
#
#   mysql hlstats_db_name < upgrade_from_1.61.sql
#
#

ALTER TABLE `#DB_PREFIX#_Players` ADD `sykpe` varchar(128) NULL DEFAULT NULL  AFTER `steamprofile`;
ALTER TABLE `#DB_PREFIX#_Players` DROP `lastUpdate`;

