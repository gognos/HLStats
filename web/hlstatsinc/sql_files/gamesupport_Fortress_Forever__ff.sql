#
# HLstats Game Support file for Fortress Forever
# ----------------------------------------------------
#
# If you want to insert this manually and not via the installer
# replace ++DB_PREFIX++ with the current table prefix !


#
# Game Definition
#
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('ff','Fortress Forever','1','0');


#
# Awards
#


#
# Player Actions
#
INSERT INTO `++DB_PREFIX++_Actions` VALUES(NULL, 'ff', 'headshot', 1, 0, '', 'Headshot Kill', '1', '0', '0', '0');


#
# Teams
#
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'ff','#FF_TEAM_RED','Red Team','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'ff','#FF_TEAM_BLUE','Blue Team','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'ff','#FF_TEAM_YELLOW','Yellow Team','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'ff','#FF_TEAM_GREEN','Green Team','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'ff','Red','Red Team','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'ff','Blue','Blue Team','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'ff','Attackers','Attackers','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'ff','Defenders','Defenders','0');



#
# Roles
#
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Scout','Scout','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Sniper','Sniper','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Soldier','Soldier','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Demoman','Demoman','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Medic','Medic','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','HWGuy','HWGuy','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Pyro','Pyro','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Spy','Spy','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Engineer','Engineer','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'ff','Civilian','Civilian','0');



#
# Weapons
#
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES
(NULL, 'ff', 'weapon_railgun', 'Railgun', 1.00),
(NULL, 'ff', 'weapon_tranq', 'Tranq Gun', 1.00),
(NULL, 'ff', 'weapon_medkit', 'Medkit', 1.00),
(NULL, 'ff', 'weapon_spanner', 'Spanner', 1.00),
(NULL, 'ff', 'weapon_crowbar', 'Crowbar', 1.00),
(NULL, 'ff', 'weapon_shotgun', 'Shotgun', 1.00),
(NULL, 'ff', 'grenade_napalm', 'Napalm Grenade', 1.00),
(NULL, 'ff', 'weapon_ic', 'IC', 1.00),
(NULL, 'ff', 'grenade_nail', 'Nail Grenade', 1.00),
(NULL, 'ff', 'weapon_supershotgun', 'Super Shotgun', 1.00),
(NULL, 'ff', 'weapon_supernailgun', 'Super Nailgun', 1.00),
(NULL, 'ff', 'weapon_sniperrifle', 'Sniper Rifle', 1.00),
(NULL, 'ff', 'weapon_rpg', 'Rocket Launcher', 1.00),
(NULL, 'ff', 'weapon_pipelauncher', 'Pipe Launcher', 1.00),
(NULL, 'ff', 'weapon_knife', 'Knife', 1.00),
(NULL, 'ff', 'weapon_grenadelauncher', 'Grenade Launcher', 1.00),
(NULL, 'ff', 'weapon_flamethrower', 'Flamethrower', 1.00),
(NULL, 'ff', 'Dispenser', 'Dispenser', 1.00),
(NULL, 'ff', 'weapon_autorifle', 'Auto Rifle', 1.00),
(NULL, 'ff', 'weapon_assaultcannon', 'Assault Cannon', 1.00),
(NULL, 'ff', 'SentryGun', 'Sentry Gun', 1.00),
(NULL, 'ff', 'grenade_normal', 'Frag Grenade', 1.00),
(NULL, 'ff', 'grenade_mirv', 'Mirv Grenade', 1.00),
(NULL, 'ff', 'grenade_emp', 'Emp Grenade', 1.00),
(NULL, 'ff', 'DETPACK', 'Detpack', 1.00),
(NULL, 'ff', 'weapon_umbrella','Umbrella', 10.00),
(NULL, 'ff', 'grenade_gas','Gas Grenade', 1.00),
(NULL, 'ff', 'weapon_tommygun', 'Tommygun', 1.00),
(NULL, 'ff', 'weapon_nailgun', 'Nailgun', 1.00);


# end of file
