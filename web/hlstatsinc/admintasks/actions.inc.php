<?php
/**
 * manage the actions
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
$return = false;

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
	mysql_free_result($query);
}

// do we have a valid gc code?
if(empty($gc) || empty($check)) {
	exit('No game code given');
}

$actions = false;
// get the actions
$query = mysql_query("SELECT id, code, reward_player, reward_team,
						team, description, for_PlayerActions,
						for_PlayerPlayerActions,for_TeamActions,
						for_WorldActions
					FROM `".DB_PREFIX."_Actions`
					WHERE game='".mysql_escape_string($gc)."'
					ORDER BY code ASC");
if(mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$actions[] = $result;
	}
}
mysql_free_result($query);

// get the teams for this game
$teams = false;
$query = mysql_query("SELECT code,name FROM `".DB_PREFIX."_Teams`
						WHERE `game` = '".mysql_escape_string($gc)."'");
if(mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$teams[] = $result;
	}
}
mysql_free_result($query);

if(isset($_POST['sub']['saveActions'])) {

	if(!empty($_POST['del'])) {
		foreach($_POST['del'] as $k=>$v) {
			$query = mysql_query("DELETE FROM `".DB_PREFIX."_Actions`
									WHERE `id` = '".mysql_escape_string($k)."'");
			unset($_POST['code'][$k]);
		}
	}

	if(!empty($_POST['code'])) {
		foreach($_POST['code'] as $k=>$v) {
			$c = trim($v);
			if(!empty($c)) {
				$rp = trim($_POST['reward_player'][$k]);
				$rt = trim($_POST['reward_team'][$k]);
				$d = trim($_POST['description'][$k]);

				$fpa = 0;
				if(isset($_POST['for_PlayerActions'][$k])) $fpa = 1;
				$fppa = 0;
				if(isset($_POST['for_PlayerPlayerActions'][$k])) $fppa = 1;
				$fta = 0;
				if(isset($_POST['for_TeamActions'][$k])) $fta = 1;
				$fwa = 0;
				if(isset($_POST['for_WorldActions'][$k])) $fwa = 1;

				$query = mysql_query("UPDATE `".DB_PREFIX."_Actions`
										SET `code` = '".mysql_escape_string($c)."',
											reward_player = '".mysql_escape_string($rp)."',
											reward_team = '".mysql_escape_string($rt)."',
											team  = '".mysql_escape_string($_POST['team'][$k])."',
											description  = '".mysql_escape_string($d)."',
											for_PlayerActions  = '".mysql_escape_string($fpa)."',
											for_PlayerPlayerActions  = '".mysql_escape_string($fppa)."',
											for_TeamActions  = '".mysql_escape_string($fta)."',
											for_WorldActions = '".mysql_escape_string($fwa)."'
										WHERE `id` = '".mysql_escape_string($k)."'");
				if($query === false) {
					$return['status'] = "1";
					$return['msg'] = l('Data could not be saved');
				}
			}
		}
	}

	// add
	if(isset($_POST['newcode'])) {
		$newOne = trim($_POST['newcode']);
		if(!empty($newOne)) {
			$rp = trim($_POST['newreward_player']);
			$rt = trim($_POST['newreward_team']);
			$d = trim($_POST['newdescription']);

			$fpa = 0;
			if(isset($_POST['newfor_PlayerActions'])) $fpa = 1;
			$fppa = 0;
			if(isset($_POST['newfor_PlayerPlayerActions'])) $fppa = 1;
			$fta = 0;
			if(isset($_POST['newfor_TeamActions'])) $fta = 1;
			$fwa = 0;
			if(isset($_POST['newfor_WorldActions'])) $fwa = 1;

			$query = mysql_query("INSERT INTO `".DB_PREFIX."_Actions`
									SET `code` = '".mysql_escape_string($newOne)."',
										reward_player = '".mysql_escape_string($rp)."',
										reward_team = '".mysql_escape_string($rt)."',
										team  = '".mysql_escape_string($_POST['newteam'])."',
										description  = '".mysql_escape_string($d)."',
										for_PlayerActions  = '".mysql_escape_string($fpa)."',
										for_PlayerPlayerActions  = '".mysql_escape_string($fppa)."',
										for_TeamActions  = '".mysql_escape_string($fta)."',
										for_WorldActions = '".mysql_escape_string($fwa)."',
										game = '".mysql_escape_string($gc)."'
									");
			if($query === false) {
				$return['status'] = "1";
				$return['msg'] = l('Data could not be saved');
			}
		}
	}

	if($return === false) {
		header('Location: index.php?mode=admin&task=actions&gc='.$gc.'#actions');
	}
}


$rcol = "row-dark";

pageHeader(array(l("Admin"),l('Actions')), array(l("Admin")=>"index.php?mode=admin",l('Actions')=>''));
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
	<h1><?php echo l('Actions for '); ?>: <?php echo $servers[0]['gameName']; ?></h1>
	<p>
		<?php echo l('You can make an action map-specific by prepending the map name and an underscore to the Action Code'); ?>.<br  />
		<br />
		<?php echo l('For example, if the map'), " <b>rock2</b> ", l('has an action'), " <b>goalitem</b> ", l('then you can either make the action code just'); ?>
		<?php echo " <b>goalitem</b> ", l('(in which case it will match all maps) or you can make it'); ?>
		<?php echo " <b>rock2_goalitem</b> ", l('to match only on the "rock2" map'); ?>
	</p>
	<?php
		if(!empty($return)) {
			if($return['status'] === "1") {
				echo '<div class="error">',$return['msg'],'</div>';
			}
			elseif($return['status'] === "2") {
				echo '<div class="success">',$return['msg'],'</div>';
			}
		}
	?>
</div>
<div style="clear: both;">
	<a name="actions"></a>
	<?php if(!empty($actions)) { ?>
	<form method="post" action="">
		<table cellpadding="2" cellspacing="0" border="0" width="100%">
			<tr>
				<th class="small"><?php echo l('Action Code'); ?></th>
				<th class="small"><?php echo l('Player Action'); ?></th>
				<th class="small"><?php echo l('PlyrPlyr Action'); ?></th>
				<th class="small"><?php echo l('Team Action'); ?></th>
				<th class="small"><?php echo l('World Action'); ?></th>
				<th class="small"><?php echo l('Player Points Reward'); ?></th>
				<th class="small"><?php echo l('Team Points Reward'); ?></th>
				<th class="small"><?php echo l('Team'); ?></th>
				<th class="small"><?php echo l('Action Description'); ?></th>
				<th class="small"><?php echo l('Delete'); ?></th>
			</tr>
			<?php foreach($actions as $a) { ?>
			<tr>
				<td class="<?php echo toggleRowClass($rcol); ?> small">
					<input type="text" name="code[<?php echo $a['id']; ?>]" value="<?php echo $a['code']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<?php ($a['for_PlayerActions'] == "1") ? $checked='checked="1"':$checked=''; ?>
					<input type="checkbox" name="for_PlayerActions[<?php echo $a['id']; ?>]" value="1" <?php echo $checked; ?> />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<?php ($a['for_PlayerPlayerActions'] == "1") ? $checked='checked="1"':$checked=''; ?>
					<input type="checkbox" name="for_PlayerPlayerActions[<?php echo $a['id']; ?>]" value="1" <?php echo $checked; ?> />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<?php ($a['for_TeamActions'] == "1") ? $checked='checked="1"':$checked=''; ?>
					<input type="checkbox" name="for_TeamActions[<?php echo $a['id']; ?>]" value="1" <?php echo $checked; ?> />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<?php ($a['for_WorldActions'] == "1") ? $checked='checked="1"':$checked=''; ?>
					<input type="checkbox" name="for_WorldActions[<?php echo $a['id']; ?>]" value="1" <?php echo $checked; ?> />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="text" size="4" name="reward_player[<?php echo $a['id']; ?>]" value="<?php echo $a['reward_player']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="text" size="4" name="reward_team[<?php echo $a['id']; ?>]" value="<?php echo $a['reward_team']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<select name="team[<?php echo $a['id']; ?>]">
					<?php
					foreach($teams as $t) {
						($a['team'] == $t['code']) ? $selected='selected="1"':$selected='';
						echo '<option value="',$t['code'],'" '.$selected.'>',$t['name'],'</option>';
					}
					?>
					</select>
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="text" name="description[<?php echo $a['id']; ?>]" value="<?php echo $a['description']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="checkbox" name="del[<?php echo $a['id']; ?>]" value="1" />
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td class="<?php echo toggleRowClass($rcol); ?> small">
					<input type="text" name="newcode" value="" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="checkbox" name="new_for_PlayerActions" value="1" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="checkbox" name="newfor_PlayerPlayerActions" value="1"/>
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="checkbox" name="newfor_TeamActions" value="1" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="checkbox" name="newfor_WorldActions" value="1" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="text" size="4" name="newreward_player" value="" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<input type="text" size="4" name="newreward_team" value="" />
				</td>
				<td class="<?php echo $rcol; ?> small">
					<select name="newteam">
					<?php
					foreach($teams as $t) {
						echo '<option value="',$t['code'],'" >',$t['name'],'</option>';
					}
					?>
					</select>
				</td>
				<td class="<?php echo $rcol; ?> small" colspan="2">
					<input type="text" name="newdescription" value="" />
				</td>
			</tr>
			<tr>
				<td colspan="10" align="right">
					<button type="submit" name="sub[saveActions]" title="<?php echo l('Save'); ?>">
						<?php echo l('Save'); ?>
					</button>
				</td>
			</tr>
		</table>
	</form>
	<?php } ?>
</div>
