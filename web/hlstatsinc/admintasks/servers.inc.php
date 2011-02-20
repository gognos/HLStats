<?php
/**
 * manage the server for a game
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
 * + 2007 - 2011
 * +
 *
 * This program is free software is licensed under the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * 
 * You should have received a copy of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 * along with this program; if not, visit http://hlstats-community.org/License.html
 *
 */

$gc = false;
$check = false;

// get the game, without it we can not do anyting
if(isset($_GET['gc'])) {
	$gc = trim($_GET['gc']);
	$check = validateInput($gc,'nospace');
	if($check === true) {
		// load the game info
		$query = mysql_query("SELECT name
							FROM `".DB_PREFIX."_Games`
							WHERE code = '".mysql_real_escape_string($gc)."'");
		if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
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

$return = false;
if(isset($_POST['sub']['saveServer'])) {
	// delete
	if(!empty($_POST['del'])) {
		foreach($_POST['del'] as $k=>$v) {
			$query = mysql_query("DELETE FROM `".DB_PREFIX."_Servers`
									WHERE `serverId` = '".mysql_real_escape_string($k)."'");
			if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
			unset($_POST['server'][$k]);
		}
	}

	// update
	if(!empty($_POST['server']) && !empty($_POST['port'])) {
		// update given patterns
		foreach($_POST['server'] as $k=>$v) {
			$v = trim($v);
			if(!empty($v) && isset($_POST['port'][$k]) && isset($_POST['name'][$k])) {
				$query = mysql_query("UPDATE `".DB_PREFIX."_Servers`
										SET `address` = '".mysql_real_escape_string($v)."',
											`port` = '".mysql_real_escape_string(trim($_POST['port'][$k]))."',
											`name` = '".mysql_real_escape_string(trim($_POST['name'][$k]))."',
											`game` = '".mysql_real_escape_string($gc)."',
											`publicaddress` = '".mysql_real_escape_string(trim($_POST['pub'][$k]))."',
											`statusurl` = '".mysql_real_escape_string(trim($_POST['stat'][$k]))."',
											`rcon_password` = '".mysql_real_escape_string(trim($_POST['rcon'][$k]))."'
										WHERE `serverId` = '".mysql_real_escape_string($k)."'");
				if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
				if($query === false) {
					$return['status'] = "1";
					$return['msg'] = l('Data could not be updated');
				}
			}
		}
	}

	// add
	if(isset($_POST['newIP'])) {
		$newOne = trim($_POST['newIP']);
		if(!empty($newOne) && !empty($_POST['newport']) && !empty($_POST['newname'])) {
			$query = mysql_query("INSERT INTO `".DB_PREFIX."_Servers`
									SET `address` = '".mysql_real_escape_string(trim($_POST['newIP']))."',
										`port` = '".mysql_real_escape_string(trim($_POST['newport']))."',
										`name` = '".mysql_real_escape_string(trim($_POST['newname']))."',
										`publicaddress` = '".mysql_real_escape_string(trim($_POST['newpub']))."',
										`statusurl` = '".mysql_real_escape_string(trim($_POST['newstat']))."',
										`rcon_password` = '".mysql_real_escape_string(trim($_POST['newrcon']))."',
										`game` = '".mysql_real_escape_string($gc)."'");
			if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
			if($query === false) {
				$return['status'] = "1";
				$return['msg'] = l('Data could not be saved');
			}
		}
	}

	if($return === false) {
		header('Location: index.php?mode=admin&task=servers&gc='.$gc);
	}
}

$servers = array();
// load the servers
$query = mysql_query("SELECT s.serverId, s.address, s.port,
						s.name AS serverName,
						s.publicaddress, s.statusurl,
						s.rcon_password,
						g.name AS gameName
					FROM `".DB_PREFIX."_Servers` AS s
					LEFT JOIN `".DB_PREFIX."_Games` AS g ON g.code = s.game
					WHERE s.game = '".mysql_real_escape_string($gc)."'
					ORDER BY address ASC, port ASC");
if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
if(mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$servers[] = $result;
	}
}

$rcol = "row-dark";

pageHeader(array(l("Admin"),l('Servers')), array(l("Admin")=>"index.php?mode=admin",l('Servers')=>''));
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
	<h1><?php echo l('Servers for'); ?>: <?php echo $gName; ?></h1>
	<p>
		<?php echo l('Enter the addresses of all servers that you want to accept data from'); ?>
	</p>
	<p>
		<?php echo l('HLStats can use Rcon to give feedback to users when they'); ?>
		<a href="index.php?mode=help#set"><?php echo l('update their profile'); ?></a>
		<?php echo l('if you enable Rcon support in hlstats.conf and specify an Rcon Password for each server'); ?>.
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
	<form method="post" action="">
		<table cellpadding="2" cellspacing="0" border="0" width="100%">
			<tr>
				<th>&nbsp;</th>
				<th><?php echo l('Required'); ?></th>
				<th><?php echo l('Optional'); ?></th>
				<th><?php echo l('Delete'); ?></th>
			</tr>
		<?php foreach($servers as $s) { ?>
			<tr>
				<td class="<?php echo toggleRowClass($rcol); ?>" valign="top">
					<img src="hlstatsimg/server.gif" alt="<?php echo l('Server'); ?>" />
				</td>
				<td class="<?php echo ($rcol); ?>" valign="top">
					<b><?php echo l('IP Address'); ?> :</b><br />
					<input type="text" name="server[<?php echo $s['serverId']; ?>]" value="<?php echo $s['address']; ?>" /><br />
					<b><?php echo l('Port'); ?> :</b><br />
					<input size="5" type="text" name="port[<?php echo $s['serverId']; ?>]" value="<?php echo $s['port']; ?>" /><br />
					<b><?php echo l('Server Name'); ?> :</b><br />
					<input size="25" type="text" name="name[<?php echo $s['serverId']; ?>]" value="<?php echo $s['serverName']; ?>" />
				</td>
				<td class="<?php echo ($rcol); ?>" valign="top">
					<?php echo l('Rcon Password'); ?> :<br />
					<input type="text" name="rcon[<?php echo $s['serverId']; ?>]" value="<?php echo $s['rcon_password']; ?>" /><br />
					<?php echo l('Public Address'); ?> :<br />
					<input type="text" name="pub[<?php echo $s['serverId']; ?>]" value="<?php echo $s['publicaddress']; ?>" /><br />
					<?php echo l('Status URL'); ?> :<br />
					<input type="text" name="stat[<?php echo $s['serverId']; ?>]" value="<?php echo $s['statusurl']; ?>" />
				</td>
				<td align="center" class="<?php echo ($rcol); ?>" valign="top" width="30">
					<input type="checkbox" name="del[<?php echo $s['serverId']; ?>]" value="yes" />
				</td>
			</tr>
		<?php } ?>
			<tr>
				<td class="<?php echo toggleRowClass($rcol); ?>" valign="top">
					<img src="hlstatsimg/server.gif" alt="<?php echo l('Server'); ?>" /><br />
					<?php echo l('new'); ?>
				</td>
				<td class="<?php echo ($rcol); ?>" valign="top">
					<b><?php echo l('IP Address'); ?> :</b><br />
					<input type="text" name="newIP" value="" /><br />
					<b><?php echo l('Port'); ?> :</b><br />
					<input size="5" type="text" name="newport" value="" /><br />
					<b><?php echo l('Server Name'); ?> :</b><br />
					<input size="25" type="text" name="newname" value="" />
				</td>
				<td class="<?php echo ($rcol); ?>">
					<?php echo l('Rcon Password'); ?> :<br />
					<input type="text" name="newrcon" value="" /><br />
					<?php echo l('Public Address'); ?> :<br />
					<input type="text" name="newpub" value="" /><br />
					<?php echo l('Status URL'); ?> :<br />
					<input type="text" name="newstat" value="" />
				</td>
				<td class="<?php echo ($rcol); ?>">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4" align="right">
					<button type="submit" name="sub[saveServer]" title="<?php echo l('Save'); ?>">
						<?php echo l('Save'); ?>
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
