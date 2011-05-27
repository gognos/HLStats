#
# HLstats Game Support file for Left 4 Dead 2
# ----------------------------------------------------
#
# If you want to insert this manually and not via the admin interface
# replace ++DB_PREFIX++ with the current table prefix !
# and import this into your hlstats database
 
#
# Game Definition
#
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('l4d2','Left 4 Dead 2','1','0');

#
# Awards
#
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'headshot', 'Brain Salad', 'headshot kills');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'killed_boomer', 'Stomach Upset', 'killed Boomers');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'killed_smoker', 'No Smoking Section', 'killed Smokers');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'killed_hunter', 'Hunter Punter', 'killed Hunters');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'killed_spitter', 'Spittle Splatter', 'Spitters Splated');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'killed_charger', 'Bumrush Thwarter', 'killed Chargers');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'killed_jockey', 'Hunter Punter', 'killed Jockeys');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('P', 'l4d2', 'killed_survivor', 'Dead Wreckening', 'downed Survivors');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'killed_tank', 'Tankbuster', 'killed Tanks');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'killed_witch', 'Inquisitor', 'killed Witches');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('P', 'l4d2', 'tongue_grab', 'Drag &amp; Drop', 'constricted Survivors');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'healed_teammate', 'Field Medic', 'healed Survivors');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('P', 'l4d2', 'pounce', 'Free to Fly', 'pounced Survivors');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'rescued_survivor', 'Ground Cover', 'rescued Survivors');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'revived_teammate', 'Helping Hand', 'revived Survivors');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('P', 'l4d2', 'vomit', 'Barf Bagged', 'vomited on Survivors');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'autoshotgun', 'Automation', 'kills with Auto Shotgun');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'boomer_claw', 'Boom!', 'kills with Boomer''s Claws');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'dual_pistols', 'Akimbo Assassin', 'kills with Dual Pistols');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'hunter_claw', 'Open Season', 'kills with Hunter''s Claws');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'hunting_rifle', 'Hawk Eye', 'kills with Hunting Rifle');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'inferno', 'Pyromaniac', 'cremated Infected');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'pipe_bomb', 'Pyrotechnician', 'blown up Infected');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'pistol', 'Ammo Saver', 'kills with Pistol');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'prop_minigun', 'No One Left Behind', 'kills with Mounted Machine Gun');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'pumpshotgun', 'Pump It!', 'kills with Pump Shotgun');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'rifle', 'Commando', 'kills with M16 Assault Rifle');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'smg', 'Safety First', 'kills with Uzi');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'smoker_claw', 'Chain Smoker', 'kills with Smoker''s Claws');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'tank_claw', 'Burger Tank', 'kills with Tank''s Claws');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'tank_rock', 'Rock Star', 'kills with Tank''s Rock');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'hunter_punter', 'Hunter Punter', 'hunter punts');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'protect_teammate', 'Protector', 'hunter punts');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'latency', 'Lowest Ping', 'ms average connection');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'defibrillated_teammate', 'Dr. Shocker', 'teammates defibrillated');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'used_adrenaline', 'Adrenaline Junkie', 'adrenaline shots used');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'jockey_ride', 'Going for a ride!', 'jockey rides');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'charger_pummel', 'Hulk Smash!', 'pummelings as a charger');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'bilebomb_tank', 'Green can''t be healthy..', 'tank bilebombs');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('O', 'l4d2', 'spitter_acidbath', 'Spit shine', 'spitter acid attacks');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'jockey_claw', 'Little Man Claws', 'kills with Jockey''s Claws');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'spitter_claw', 'Those nails could kill', 'kills with Spitter''s Claws');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'charger_claw', 'TAAN... What is this?!', 'kills with Charger''s Claws');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'first_aid_kit', 'Hi Dr. Nick!', 'kills with a First Aid Kit');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'grenade_launcher_projectile', 'Black Scottish Psyclops', 'kills with the Grenade Launcher');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'chainsaw', 'Slice and Dice', 'kills with the Chainsaw');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'fire_cracker_blast', 'Snap Crackle Pop', 'kills with fire crackers');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'pistol_magnum', 'Magnum', 'kills with the Magnum');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'rifle_ak47', 'AK-47', 'kills with the AK-47');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'rifle_desert', 'Combat Rifle', 'kills with the Combat Rifle');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'shotgun_chrome', 'Chrome Shotgun', 'kills with the Chrome Shotgun');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'shotgun_spas', 'Combat Shotgun', 'kills with the Combat Shotgun');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'smg_silenced', 'Uzi (Silenced)', 'kills with the Uzi (silenced)');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'sniper_military', 'Sniper Rifle', 'kills with the Sniper Rifle');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'baseball_bat', 'Batter Up!', 'kills with the Baseball Bat');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'cricket_bat', 'Cheerio.', 'kills with the Cricket Bat');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'crowbar', 'Crowbar', 'kills with the Crowbar');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'electric_guitar', 'Wayne''s world party on!', 'kills with the Electric Guitar');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'fireaxe', 'Fight fire with an axe', 'kills with the Fireaxe');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'frying_pan', 'BANG Headshot.', 'kills with the Frying Pan');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'katana', 'Katana', 'kills with the Katana');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'knife', 'Knife', 'kills with the Knife');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'machete', 'Machete', 'kills with the Machete');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'tonfa', 'Tonfa', 'kills with the Tonfa');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'melee', 'Fists of RAGGEE', 'melee kills');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'sniper_awp','AWP','kills with awp');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'smg_mp5','MP5 Navy','kills with mp5');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'sniper_scout','Scout Elite','kills with scout');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'rifle_sg552','SG 552','kills with sg552');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'gnome', 'GET OFF MY LAWN', 'gnome smash kills');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'golfclub', 'Golf Club', 'kills with the Golf Club');
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES ('W', 'l4d2', 'rifle_m60', 'M60', 'kills with M60');

#
# Actions
#

#
# Teams
#

#
# Roles
#


#
# Weapons
#