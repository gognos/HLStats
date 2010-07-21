<?php
/**
 * reset the stats for a game
 * @package HLStats
 * @author Johannes 'Banana' Keßler
 * @copyright Johannes 'Banana' Keßler
 */


/**
 *
 * Original development:
 * +
 * + HLStats - Real-time player and clan rankings and statistics for Half-Life
 * + http://sourceforge.net/projects/hlstats/
 * +
 * + Copyright (C) 2001  Simon Garner
 * +
 *
 * Additional development:
 * +
 * + UA HLStats Team
 * + http://www.unitedadmins.com
 * + 2004 - 2007
 * +
 *
 *
 * Current development:
 * +
 * + Johannes 'Banana' Keßler
 * + http://hlstats.sourceforge.net
 * + 2007 - 2010
 * +
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

$gc = false;
$check = false;
$return = false;

// get the game, without it we can not do anyting
if(isset($_GET['gc'])) {
	$gc = trim($_GET['gc']);
	$check = validateInput($gc,'nospace');
	if($check === true) {
		// load the game info
		$query = mysql_query("SELECT name
							FROM `".DB_PREFIX."_Games`
							WHERE code = '".mysql_escape_string($gc)."'");
		if(mysql_num_rows($query) > 0) {
			$result = mysql_fetch_assoc($query);
			$gName = $result['name'];
		}
		mysql_free_result($query);
	}
}

// do we have a valid gc code?
if(empty($gc) || empty($check)) {
	exit('No game code given');
}

// process the reset for this game
if (isset($_POST['sub']['reset'])) {

	// we need first the playids for this game
	$players = array();
	$query = mysql_query("SELECT playerId FROM ".DB_PREFIX."_Players WHERE game = '".$gc."'");
	while($result = mysql_fetch_assoc($query)) {
		$players[]= $result['playerId'];
	}
	if(empty($players)) {
		die("Fatal error: No players found for this game.");
	}
	$playerIdString = implode(",",$players);

	// get the servers for this game
	$serversArr = array();
	$query = mysql_query("SELECT serverId FROM ".DB_PREFIX."_Servers WHERE game = '".$gc."'");
	while($result = mysql_fetch_assoc($query)) {
		$serversArr[]= $result['serverId'];
	}
	if(empty($serversArr)) {
		die("Fatal error: No players found for this game.");
	}
	$serversArrString = implode(",",$serversArr);


	$query = mysql_query("SHOW TABLES LIKE '".DB_PREFIX."_Events_%'");
	if (mysql_num_rows($query) < 1) {
		die("Fatal error: No events tables found with query:<p><pre>$query</pre><p>
			There may be something wrong with your hlstats database or your version of MySQL.");
	}

	while (list($table) = mysql_fetch_array($query)) {
		$dbtables[] = $table;
	}

	array_push($dbtables,
		"".DB_PREFIX."_PlayerNames",
		"".DB_PREFIX."_PlayerUniqueIds",
		"".DB_PREFIX."_Players"
	);

	foreach ($dbtables as $dbt) {
		if($dbt == DB_PREFIX.'_Events_Frags' || $dbt == DB_PREFIX.'_Events_Teamkills') {
			if (mysql_query("DELETE FROM ".$dbt."
								WHERE killerId IN (".$playerIdString.")
									OR victimId IN (".$playerIdString.")")) {
				$return .= $dbt." OK<br />";
			}
			else {
				$return .= "Error for Table:".$dbt."<br />";
			}

		}
		elseif($dbt == DB_PREFIX.'_Events_Admin' || $dbt == DB_PREFIX.'_Events_Rcon') {
			if (mysql_query("DELETE FROM ".$dbt."
								WHERE serverId IN (".$serversArrString.")")) {
				$return .= $dbt." OK<br />";
			}
			else {
				$return .= "Error for Table:".$dbt."<br />";
			}
		}
		else {
			if (mysql_query("DELETE FROM ".$dbt."
								WHERE playerId IN (".$playerIdString.")")) {
				$return .= $dbt." OK<br />";
			}
			else {
				$return .= "Error for Table:".$dbt."<br />";
			}
		}
	}

	// now the tables which we can delete by gamecode
	$dbtablesGamecode [] = "".DB_PREFIX."_Clans";

	foreach ($dbtablesGamecode as $dbtGame) {
		if (mysql_query("DELETE FROM ".$dbtGame."
							WHERE game = '".$gc."'")) {

			$return .= $dbtGame." OK<br />";
		}
		else {
			$return .= "Error for Table:".$dbtGame."<br />";
		}
	}

	$return .= "Clearing awards ... <br />";
	if (mysql_query("UPDATE ".DB_PREFIX."_Awards SET d_winner_id=NULL, d_winner_count=NULL
				WHERE game = '".$gc."'")) {
		$return .= "Awards OK<br />";
	}
	else {
		$return .= "Error for Table: Awards<br />";
	}
}

pageHeader(array(l("Admin"),l('Servers')), array(l("Admin")=>"index.php?mode=admin",l('Reset Statistics')=>''));
?>
<div id="sidebar">
	<h1><?php echo l('Options'); ?></h1>
	<div class="left-box">
		<ul class="sidemenu">
			<li>
				<a href="index.php?mode=admin&task=gameoverview&code=<?php echo $gc; ?>"><?php echo l('Back to game overview'); ?></a>
			</li>
			<li>
				<a href="index.php?mode=admin"><?php echo l('Back to admin overview'); ?></a>
			</li>
		</ul>
	</div>
</div>
<div id="main">
	<h1><?php echo l('Reset Statistics for'); ?>: <?php echo $gName; ?></h1>
	<?php echo l('Are you sure you want to reset all statistics for game'); ?> <b><?php echo $gName; ?></b> ? <br />
	<br />
	<?php echo l('All players, clans and events will be deleted from the database'); ?>.<br />
	<?php echo l('(All other admin settings will be retained)'); ?><br />
	<br />
	<b><?php echo l('Note'); ?></b> <?php echo l('You should kill'); ?> <b>hlstats.pl</b>
	<?php echo l('before resetting the stats. You can restart it after they are reset'); ?>.<br />
	<br />
	<?php
	if(!empty($return)) {
		echo '<p>',$return,'</p>';
	}
	?>
	<form method="post" action="">
		<p align="center">
		<button type="submit" name="sub[reset]" title="<?php echo l('Reset'); ?>">
			<?php echo l('Reset'); ?>
		</button>
		</p>
	</form>
</div>
