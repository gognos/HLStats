#
# HLstats Game Support file for Counter-Strike: Global Offensive
# --------------------------------------------------------------
#
# If you want to insert this manually and not via the admin interface
# replace ++DB_PREFIX++ with the current table prefix !
# and import this into your hlstats database

#
# Game Definition
#
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('csgo','Counter-Strike: Global Offensive','1','0');

#
# Awards
#
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES (NULL,'O','csgo','Defused_The_Bomb','Top Defuser','bomb defusions',NULL,NULL);

#
# Player Actions
#
INSERT IGNORE INTO `++DB_PREFIX++_Actions` VALUES (NULL,'csgo','Begin_Bomb_Defuse_Without_Kit',0,0,'CT','Start Defusing the Bomb Without a Defuse Kit','1','0','0','0');

#
# Team Actions
#
INSERT IGNORE INTO `++DB_PREFIX++_Actions` VALUES (NULL,'csgo','CTs_Win',0,2,'CT','All Terrorists eliminated','0','0','1','0');

#
# Teams
#
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'csgo','TERRORIST','Terrorist','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'csgo','CT','Counter-Terrorist','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'csgo','SPECTATOR','Spectator','0');

#
# Roles
#
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'csgo','scout','Scout','0');

#
# Weapons
#
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','knife','Knife',2.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','inferno','Incendiary Grenade',1.80);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','hegrenade','High Explosive Grenade',1.80);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','p250','P250',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','mac10','MAC-10',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','fiveseven','FN Five-Seven',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','mp9','MP9',1.40);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','hkp2000','P2000',1.40);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','glock','Glock-18',1.40);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','elite','Dual Berretta Elites',1.40);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','sawedoff','Sawed-Off',1.30);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','nova','Nova',1.30);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','mp7','MP7',1.30);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','mag7','MAG-7',1.30);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','bizon','PP-Bizon',1.30);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','ump45','H&K UMP45',1.30);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','tec9','Tec-9',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','p90','FN P90',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','deagle','Desert Eagle',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','xm1014','XM1014',1.10);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','ssg08','SSG 08',1.10);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','galilar','Galil AR',1.10);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','galil','Galil',1.10);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','taser','Zeus x27',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','sg553','SG 553',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','negev','Negev',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','m4a1','M4A4',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','m249','M249 PARA Light Machine Gun',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','awp','AWP',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','aug','Steyr Aug',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','ak47','Kalashnikov AK-47',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','scar20','Scar-20',0.80);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'csgo','g3sg1','H&K G3/SG1 Sniper Rifle',0.80);

