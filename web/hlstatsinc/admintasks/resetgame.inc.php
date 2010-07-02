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
$servers = false;
// get the game, without it we can no do anyting
if(isset($_GET['gc'])) {
	$gc = trim($_GET['gc']);
	$check = validateInput($gc,'nospace');
	if($check === true) {
		// load the server
		$query = mysql_query("SELECT s.serverId, s.address, s.port,
								s.name AS serverName,
								s.publicaddress, s.statusurl,
								s.rcon_password, s.defaultMap,
								g.name AS gameName
							FROM `".DB_PREFIX."_Servers` AS s
							LEFT JOIN `".DB_PREFIX."_Games` AS g ON g.code = s.game
							WHERE s.game = '".mysql_escape_string($gc)."'
							ORDER BY address ASC, port ASC");
		if(mysql_num_rows($query) > 0) {
			while($result = mysql_fetch_assoc($query)) {
				$servers[] = $result;
			}
		}
	}
}

// do we have a valid gc code?
if(empty($gc) || empty($check)) {
	exit('No game code given');
}

	// process the reset for this game
	if (isset($_POST['submitReset'])) {
		/*

		// we need first the playids for this game
		$players = array();
		$query = mysql_query("SELECT playerId FROM ".DB_PREFIX."_Players WHERE game = '".$gamecode."'");
		while($result = mysql_fetch_assoc($query)) {
			$players[]= $result['playerId'];
		}
		if(empty($players)) {
			die("Fatal error: No players found for this game.");
		}
		$playerIdString = implode(",",$players);

		// get the servers for this game
		$serversArr = array();
		$query = mysql_query("SELECT serverId FROM ".DB_PREFIX."_Servers WHERE game = '".$gamecode."'");
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

		echo "<ul>\n";
		foreach ($dbtables as $dbt) {
			echo "<li>$dbt ... ";
			if($dbt == DB_PREFIX.'_Events_Frags' || $dbt == DB_PREFIX.'_Events_Teamkills') {
				if (mysql_query("DELETE FROM ".$dbt."
									WHERE killerId IN (".$playerIdString.")
										OR victimId IN (".$playerIdString.")")) {
					echo "OK\n";
				}
				else {
					echo "Error for Table:".$dbt."\n";
				}

			}
			elseif($dbt == DB_PREFIX.'_Events_Admin' || $dbt == DB_PREFIX.'_Events_Rcon') {
				if (mysql_query("DELETE FROM ".$dbt."
									WHERE serverId IN (".$serversArrString.")")) {
					echo "OK\n";
				}
				else {
					echo "Error for Table:".$dbt."\n";
				}
			}
			else {
				if (mysql_query("DELETE FROM ".$dbt."
									WHERE playerId IN (".$playerIdString.")")) {
					echo "OK\n";
				}
				else {
					echo "Error for Table:".$dbt."\n";
				}
			}
		}

		// now the tables which we can delete by gamecode
		$dbtablesGamecode [] = "".DB_PREFIX."_Clans";

		foreach ($dbtablesGamecode as $dbtGame) {
			echo "<li>$dbtGame ... ";
			if (mysql_query("DELETE FROM ".$dbtGame."
								WHERE game = '".$gamecode."'")) {

				echo "OK\n";
			}
			else {
				echo "Error for Table:".$dbtGame."\n";
			}
		}

		echo "<li>Clearing awards ... ";
		mysql_query("UPDATE ".DB_PREFIX."_Awards SET d_winner_id=NULL, d_winner_count=NULL
					WHERE game = '".$gamecode."'");
		echo "OK\n";

		echo "</ul>\n";

		echo l("Done"),"<p>";
		*/
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
	<h1><?php echo l('Reset Statistics for '); ?>: <?php echo $servers[0]['gameName']; ?></h1>
	<?php echo l('Are you sure you want to reset all statistics for game'); ?> <b><?php echo $servers[0]['gameName'];?></b> ? <br />
	<br />
	<?php echo l('All players, clans and events will be deleted from the database'); ?>.<br />
	<?php echo l('(All other admin settings will be retained)'); ?><br />
	<br />
	<b><?php echo l('Note'); ?></b> <?php echo l('You should kill'); ?> <b>hlstats.pl</b>
	<?php echo l('before resetting the stats. You can restart it after they are reset'); ?>.<br />
	<br />
	<form method="post" action="">
		<p align="center">
		<button type="submit" name="sub[reset]" title="<?php echo l('Reset'); ?>">
			<?php echo l('Reset'); ?>
		</button>
		</p>
	</form>
</div>
