#
# HLstats Game Support file for Age of Chivalry
# ----------------------------------------------------
#
# If you want to insert this manually and not via the admin interface
# replace ++DB_PREFIX++ with the current table prefix !
# and import this into your hlstats database


#
# Game Definition
#
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('aoc','Age of Chivalry','1','0');


#
# Awards
#



#
# Player Actions
#
INSERT INTO `++DB_PREFIX++_Actions` VALUES(NULL, 'aoc', 'headshot', 1, 0, '', 'Headshot/Decapitate Kill', '1', '0', '0', '0');


#
# Teams
#
INSERT IGNORE INTO `++DB_PREFIX++_Team` VALUES (NULL,'aoc','The Mason Order','The Mason Order','0');
INSERT IGNORE INTO `++DB_PREFIX++_Team` VALUES (NULL,'aoc','Agathia Knights','Agathia Knights','0');
INSERT IGNORE INTO `++DB_PREFIX++_Team` VALUES (NULL,'aoc','Spectator','Spectator','0');


#
# Roles
#



#
# Weapons
#
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES
(NULL,'aoc', 'flamberge','Flamberge',1),
(NULL,'aoc', 'longsword','Longsword',1),
(NULL,'aoc', 'halberd','Knights Halberd',1),
(NULL,'aoc', 'dagger','Dual Daggers',1),
(NULL,'aoc', 'flamberge_kiteshield', 'Flamberge & Kite Shield', 1),
(NULL,'aoc', 'world','World',1),
(NULL,'aoc', 'chivalry','Chivalry',1),
(NULL,'aoc', 'sword2','Shortsword',1),
(NULL,'aoc', 'warhammer','Warhammer',1),
(NULL,'aoc', 'mace','Mace',1),
(NULL,'aoc', 'mace_buckler','Mace & Buckler',1),
(NULL,'aoc', 'sword01_evil_shield', 'Mason Broadsword & Shield', 1),
(NULL,'aoc', 'crossbow','Crossbow',1),
(NULL,'aoc', 'longbow','Longbow',1),
(NULL,'aoc', 'longsword_kiteshield', 'Longsword & Kite Shield', 1),
(NULL,'aoc', 'sword01_good_shield', 'Knights Broadsword & Shield', 1),
(NULL,'aoc', 'onehandaxe', 'Hatchet', 1),
(NULL,'aoc', 'doubleaxe','Battle Axe',1),
(NULL,'aoc', 'flail_evil_shield','Mason Flail & Shield',1),
(NULL,'aoc', 'flail_good_shield','Knights Flail & Shield',1),
(NULL,'aoc', 'thrown_spear', 'Javelin', 1),
(NULL,'aoc', 'spear_buckler', 'Knights Spear & Buckler', 1),
(NULL,'aoc', 'dagger2', 'Dagger', 1),
(NULL,'aoc', 'mtest', 'Footman Longsword', 1),
(NULL,'aoc', 'thrown_dagger2', 'Thrown Dagger', 1),
(NULL,'aoc', 'spear_buckler2', 'Mason Spear & Buckler', 1),
(NULL,'aoc', 'shortsword', 'Spiked Mace', 1),
(NULL,'aoc', 'spikedmace_buckler','Spiked Mace & Buckler',1),
(NULL,'aoc', 'evil_halberd', 'Mason Halberd', 1),
(NULL,'aoc', 'env_explosion', 'Fire', 1, 4, 0),
(NULL,'aoc', 'oilpot', 'Oil Pot', 1, 1, 0);


# end of file
