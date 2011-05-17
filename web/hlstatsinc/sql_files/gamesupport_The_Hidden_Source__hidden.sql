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

INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES
(NULL,'hidden', 'fn2000','FN2000 Assault Rifle',1.50),
(NULL,'hidden', 'p90','FN P90 Sub Machine Gun',2.00),
(NULL,'hidden', 'shotgun','Remington 870 MCS Shotgun',2.00),
(NULL,'hidden', 'fn303','FN303 Less Lethal Launcher',2.00),
(NULL,'hidden', 'pistol','FN FiveSeven Pistol',3.00),
(NULL,'hidden', 'pistol2','FNP-9 Pistol',3.00),
(NULL,'hidden', 'knife','Kabar D2 Knife',2.50),
(NULL,'hidden', 'grenade_projectile','Pipe Bomb',2.00),
(NULL,'hidden', 'physics','Physics',3.00);


# end of file
