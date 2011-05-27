#
# HLstats Game Support file for The Hidden: Source
# ----------------------------------------------------
#
# If you want to insert this manually and not via the installer
# replace ++DB_PREFIX++ with the current table prefix !


#
# Game Definition
#
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('hidden','The Hidden: Source','1','0');


#
# Awards
#
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'fn2000', 'FN2000 Assault Rifle', 'kills with FN2000 Assault Rifle');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'p90', 'FN P90 Sub Machine Gun', 'kills with FN P90 Sub Machine Gun');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'shotgun', 'Remington 870 MCS Shotgun', 'kills with Remington 870 MCS Shotgun');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'fn303', 'FN303 Less Lethal Launcher', 'kills with FN303 Less Lethal Launcher');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'pistol', 'FN FiveSeven Pistol', 'kills with FN FiveSeven Pistol');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'pistol2', 'FNP-9 Pistol', 'kills with FNP-9 Pistol');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'knife', 'Kabar D2 Knife', 'kills with Kabar D2 Knife');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'grenade_projectile', 'Pipe Bomb', 'kills with Pipe Bomb');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden', 'physics', 'Physics', 'kills with Physics');
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('W', 'hidden','latency','Best Latency','ms average connection');

#
# Player Actions
#



#
# Teams
#
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'hidden','Hidden','Subject 617','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'hidden','IRIS','I.R.I.S.','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'hidden','Spectator','Spectator','0');


#
# Roles
#


#
# Weapons
#

INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'fn2000','FN2000 Assault Rifle',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'p90','FN P90 Sub Machine Gun',2.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'shotgun','Remington 870 MCS Shotgun',2.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'fn303','FN303 Less Lethal Launcher',2.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'pistol','FN FiveSeven Pistol',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'pistol2','FNP-9 Pistol',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'knife','Kabar D2 Knife',2.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'grenade_projectile','Pipe Bomb',2.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'hidden', 'physics','Physics',3.00);


# end of file
