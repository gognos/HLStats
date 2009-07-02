#
# HLstats Game Support file for Team Fortress 2
# ----------------------------------------------------
#
# If you want to insert this manually and not via the installer
# replace ++DB_PREFIX++ with the current table prefix !


#
# Game Definition
#
INSERT IGNORE INTO ++DB_PREFIX++_Games VALUES ('tf2','Team Fortress 2','1','0');


#
# Awards
#
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','fireaxe','Axe Man','murders with fireaxe',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','bat','Playin Baseball','bats',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','tf_projectile_rocket','Rocketeer','kills with rocket',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','shotgun_hwg','HWGuy Extraordinaire','ownings with ac',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','sniperrifle','Red Dot Special','snipings',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','flamethrower','Fire Man','roastings',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','shovel','Diggin a hole','kills with shovel',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','axtinguisher','Axtinguisher','kills with axtinguisher',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','backburner','Backburner','kills with backburner',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','axtinguisher','Backstabber','backstab kills',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','kill_assist','Best Backup','kill assist',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','blutsauger','Blutsauger','kills with blutsauger',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','bonesaw','Doctor\'s Certificate','kills with bonesaw',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','bottle','Drunken Brawler','kills with bottle',NULL,NULL);
INSERT IGNORE INTO ++DB_PREFIX++_Awards VALUES (NULL,'W','tf2','wrench','Mr. Fix-it','kills with wrench',NULL,NULL);


#
# Player Actions
#
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'builtobject_OBJ_ATTACHMENT_SAPPER', 1, 0, '', 'Built Object - Attachment Sapper', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'builtobject_OBJ_DISPENSER', 5, 0, '', 'Built Object - Dispenser', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'builtobject_OBJ_SENTRYGUN', 5, 0, '', 'Built Object - Sentrygun', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'builtobject_OBJ_TELEPORTER_ENTRANCE', 2, 0, '', 'Built Object - Teleporter Entrance', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'builtobject_OBJ_TELEPORTER_EXIT', 2, 0, '', 'Built Object - Teleporter Exit', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'captureblocked', 5, 2, '', 'Capture Blocked', '1', '0', '1', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'chargedeployed', 5, 0, '', 'Ubercharge', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'domination', 5, 0, '', 'Domination', '0', '1', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'flagevent_captured', 2, 0, '', 'Flagevent - Captured', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'flagevent_defended', 2, 0, '', 'Flagevent - Defended', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'flagevent_dropped', -2, 0, '', 'Flagevent - Dropped', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'flagevent_picked_up', 2, 0, '', 'Flagevent - Picked Up', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'killedobject_OBJ_ATTACHMENT_SAPPER', 2, 0, '', 'Killed Object - Attachment Sapper', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'killedobject_OBJ_DISPENSER', 5, 0, '', 'Killed Object - Dispenser', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'killedobject_OBJ_SENTRYGUN', 5, 0, '', 'Killed Object - Sentrygun', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'killedobject_OBJ_SPY', 2, 0, '', 'Killed Object - Spy', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'killedobject_OBJ_TELEPORTER_ENTRANCE', 2, 0, '', 'Killed Object - Teleporter Entrance', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'killedobject_OBJ_TELEPORTER_EXIT', 2, 0, '', 'Killed Object - Teleporter Exit', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'kill_assist', 2, 0, '', 'Kill Assist', '0', '1', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'kill_assist_medic', 4, 0, '', 'Kill Assist - Medic', '1', '0', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'Mini_Round_Win_Blue', 0, 2, 'Blue', 'Mini-Round Win - Team Blue', '0', '0', '0', '1');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'Mini_Round_Win_Red', 0, 2, 'Red', 'Mini-Round Win - Team Red', '0', '0', '0', '1');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'pointcaptured', 5, 2, '', 'Point Captured', '1', '0', '1', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'revenge', 5, 0, '', 'Revenge', '0', '1', '0', '0');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'Round_Win_Blue', 0, 10, 'Blue', 'Round Win - Team Blue', '0', '0', '1', '1');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'Round_Win_Red', 0, 10, 'Red', 'Round Win - Team Red', '0', '0', '1', '1');
INSERT INTO ++DB_PREFIX++_Actions VALUES(NULL, 'tf2', 'hurt_firstblood', '5', '0', '', 'Firstblod', '1', '0', '0', '0');


#
# Teams
#
INSERT IGNORE INTO ++DB_PREFIX++_Teams VALUES (NULL,'tf2','Blue','Blue','0');
INSERT IGNORE INTO ++DB_PREFIX++_Teams VALUES (NULL,'tf2','Red','Red','0');
INSERT IGNORE INTO ++DB_PREFIX++_Teams VALUES (NULL,'tf2','SPECTATOR','Spectator','0');


#
# Roles
#
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','scout','Scout','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','sniper','Sniper','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','soldier','Soldier','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','demoman','Demo Man','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','medic','Medic','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','HWGuy','HWGuy','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','heavyweapons','Heavy Weapons','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','pyro','Pyro','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','spy','Spy','0');
INSERT IGNORE INTO ++DB_PREFIX++_Roles VALUES (NULL,'tf2','engineer','Engineer','0');


#
# Weapons
#
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','bat','Baseball Bat',2.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','bonesaw','Medical Saw',3.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','bottle','Whiskey Bottle',3.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','club','Club',3.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','fireaxe','Fire Axe',3.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','fists','Fists',3.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','flamethrower','Flamethrower',1.80);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','minigun','Minigun',1.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','knife','Knife',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','pistol','9MM Pistol',2.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','pistol_scout','Pistol Scout',2.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','player','Player',1.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','revolver','Revolver',2.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','scattergun','Scattergun',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','shotgun_hwg','Heavy Shotgun',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','shotgun_primary','Shotgun Primary',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','shotgun_pyr','Shotgun Pyro',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','shotgun_soldier','Shotgun Soldier',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','shovel','Shovel',3.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','smg','SMG',1.80);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','sniperrifle','Sniper Rifle',1.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','tf_projectile_pipe','Impact Grenade Launcher',1.30);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','tf_projectile_pipe_remote','Remote Grenade Launcher',1.40);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','tf_projectile_rocket','Rocket Launcher',1.20);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','world','World',1.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','wrench','Wrench',3.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','syringegun_medic','Syringe Gun',1.80);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','obj_sentrygun','Sentry Gun',1.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','obj_sentrygun2','Sentry Gun Level 2',0.90);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','obj_sentrygun3','Sentry Gun Level 3',0.80);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','deflect_sticky','Deflect Sticky',4.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','deflect_rocket','Deflect Rocket',4.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','deflect_promode','Deflect Promode',4.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','deflect_flare','Deflect Flare',4.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','taunt_pyro','Taunt Pyro',4.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','ubersaw','Ubersaw',2.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','axtinguisher','Axtinguisher',2.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','flaregun','Flare Gun',2.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','blutsauger','Blutsauger',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','backburner','Backburner',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','natascha','Natascha',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','gloves','Gloves',1.50);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','taunt_heavy','Heavy taunt',5.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','taunt_scout','Scout Taunt Kill',5.00);
INSERT IGNORE INTO ++DB_PREFIX++_Weapons VALUES (NULL,'tf2','bat_wood','The Sandman',2.00);

# end of file