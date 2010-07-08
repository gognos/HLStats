<?php
/**
 * manage the teams
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

$teams = false;
// get the teams
$query = mysql_query("SELECT teamId, code, name, hidden
					FROM `".DB_PREFIX."_Teams`
					WHERE game='".mysql_escape_string($gc)."'
					ORDER BY code ASC");
if(mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$teams[] = $result;
	}
}

if(isset($_POST['sub']['saveTeam'])) {

	// del
	if(!empty($_POST['del'])) {
		foreach($_POST['del'] as $k=>$v) {
			$query = mysql_query("DELETE FROM `".DB_PREFIX."_Teams`
									WHERE `teamId` = '".mysql_escape_string($k)."'");
			unset($_POST['code'][$k]);
		}
	}

	// new
	if(!empty($_POST['code'])) {
		foreach($_POST['code'] as $k=>$v) {
			$c = trim($v);
			if(!empty($c)) {
				$name = trim($_POST['name'][$k]);

				$hide = 0;
				if(isset($_POST['hidden'][$k])) $hide = 1;

				$query = mysql_query("UPDATE `".DB_PREFIX."_Teams`
										SET `code` = '".mysql_escape_string($c)."',
											`name` = '".mysql_escape_string($name)."',
											`hidden` = '".mysql_escape_string($hide)."'
										WHERE `teamId` = '".mysql_escape_string($k)."'");
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
			$name = trim($_POST['newname']);

			$hide = 0;
			if(isset($_POST['newhidden'])) $hide = 1;

			$query = mysql_query("INSERT INTO `".DB_PREFIX."_Teams`
									SET `code` = '".mysql_escape_string($newOne)."',
										`name` = '".mysql_escape_string($name)."',
										`hidden` = '".mysql_escape_string($hide)."',
										`game` = '".mysql_escape_string($gc)."'");
			if($query === false) {
				$return['status'] = "1";
				$return['msg'] = l('Data could not be saved');
			}
		}
	}

	if($return === false) {
		header('Location: index.php?mode=admin&task=teams&gc='.$gc.'#teams');
	}
}

$rcol = "row-dark";

pageHeader(array(l("Admin"),l('Teams')), array(l("Admin")=>"index.php?mode=admin",l('Teams')=>''));
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
		<?php echo l("You can specify descriptive names for each game's team codes"); ?>
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
	<a name="teams"></a>
	<form method="post" action="">
		<table cellpadding="2" cellspacing="0" border="0" width="100%">
			<tr>
				<th><?php echo l('Team Code'); ?></th>
				<th><?php echo l('Team Name'); ?></th>
				<th><?php echo l('Hide Team'); ?></th>
				<th><?php echo l('Delete'); ?></th>
			</tr>
		<?php if(!empty($teams)) {
			foreach($teams as $t) {
		?>
			<tr>
				<td class="<?php echo toggleRowClass($rcol); ?>">
					<input type="text" name="code[<?php echo $t['teamId']; ?>]" value="<?php echo $t['code']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?>">
					<input type="text" name="name[<?php echo $t['teamId']; ?>]" value="<?php echo $t['name']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?>">
					<?php ($t['hidden'] == "1") ? $checked='checked="1"':$checked=''; ?>
					<input type="checkbox" name="hidden[<?php echo $t['teamId']; ?>]" value="1" <?php echo $checked; ?> />
				</td>
				<td class="<?php echo $rcol; ?>">
					<input type="checkbox" name="del[<?php echo $t['teamId']; ?>]" value="1" />
				</td>
			</tr>
		<?php
			}
		}
		?>
			<tr>
				<td class="<?php echo toggleRowClass($rcol); ?>">
					<?php echo l('new'); ?> <input type="text" name="newcode" value="" />
				</td>
				<td class="<?php echo $rcol; ?>">
					<input type="text" name="newname" value="" />
				</td>
				<td colspan="2" class="<?php echo $rcol; ?>">
					<input type="checkbox" name="newhidden" value="1" />
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right">
					<button type="submit" name="sub[saveTeam]" title="<?php echo l('Save'); ?>">
						<?php echo l('Save'); ?>
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
