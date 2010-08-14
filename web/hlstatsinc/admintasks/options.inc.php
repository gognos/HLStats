<?php
/**
 * admin options file. manage the general options
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

// get the available styles
$styleFiles = glob("css/*.css");

$return = false;

if(isset($_POST['sub']['saveOptions'])) {
	$error = false;
	foreach($_POST['option'] as $k=>$v) {
		$v = trim($v);
		
		$query = mysql_query("UPDATE `".DB_PREFIX."_Options`
							SET `value` = '".mysql_escape_string($v)."'
							WHERE `keyname` = '".mysql_escape_string($k)."'");
		if($query !== true) {
			$return['msg'] = l('Could not save data');
			$return['status'] = "1";
			break;
		}
	}

	if($return === false) {
		$return['msg'] = l('Data saved');
		$return['status'] = "2";
		header('Location: index.php?mode=admin&task=options');
	}
}

pageHeader(array(l("Admin"),l('Options')), array(l("Admin")=>"index.php?mode=admin",l('Options')=>''));
?>

<div id="sidebar">
	<h1><?php echo l('Options'); ?></h1>
	<div class="left-box">
		<ul class="sidemenu">
			<li>
				<a href="<?php echo "index.php?mode=admin"; ?>"><?php echo l('Back to admin overview'); ?></a>
			</li>
		</ul>
	</div>
</div>
<div id="main">
	<h1><?php echo l('HLStats Options'); ?></h1>
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
		<h2><?php echo l('General'); ?></h2>
		<table cellpadding="2" cellspacing="0" border="0">
			<tr>
				<th width="220"><?php echo l("Site Name"); ?></th>
				<td>
					<input type="text" name="option[sitename]" size="40"
						value="<?php echo $g_options['sitename']; ?>" />
				</td>
			</tr>
			<tr>
				<th><?php echo l("Site URL"); ?></th>
				<td>
					<input type="text" name="option[siteurl]" size="40"
						value="<?php echo $g_options['siteurl']; ?>" />
				</td>
			</tr>
			<tr>
				<th><?php echo l("Contact URL"); ?></th>
				<td>
					<input type="text" name="option[contact]" size="40"
						value="<?php echo $g_options['contact']; ?>" /><br />
					<span class="small"><?php echo l('Can be an URL or even mailto:address'); ?></span>
				</td>
			</tr>
			<tr>
				<th><?php echo l("Hide Daily Awards"); ?></th>
				<td>
					<select name="option[hideAwards]">
						<option value="0" <?php if($g_options['hideAwards'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1" <?php if($g_options['hideAwards'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th><?php echo l("Hide News"); ?></th>
				<td>
					<select name="option[hideNews]">
						<option value="0" <?php if($g_options['hideNews'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1" <?php if($g_options['hideNews'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th><?php echo l("Show chart graphics"); ?></th>
				<td>
					<select name="option[showChart]">
						<option value="0" <?php if($g_options['showChart'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1" <?php if($g_options['showChart'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th><?php echo l("Allow the use of signatures"); ?></th>
				<td>
					<select name="option[allowSig]">
						<option value="0" <?php if($g_options['allowSig'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1" <?php if($g_options['allowSig'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th><?php echo l("Allow XML interface"); ?></th>
				<td>
					<select name="option[allowXML]">
						<option value="0" <?php if($g_options['allowXML'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1" <?php if($g_options['allowXML'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th><?php echo l("Default Language"); ?></th>
				<td>
					<select name="option[LANGUAGE]">
					<option value="en">EN</option>
					<?php
					$available_langs = glob(getcwd()."/lang/*.ini.php");
					foreach($available_langs as $available_lang) {
						$available_lang = str_replace(".ini.php",'',basename($available_lang));
						$selected = '';
						if($g_options['LANGUAGE'] === $available_lang) $selected="selected='1'";
						echo '<option value="'.$available_lang.'" '.$selected.'>'.strtoupper($available_lang)."</option>";
					}
					unset($available_langs,$available_lang);
					?>
				</select>
				</td>
			</tr>
		</table>
		<h2><?php echo l('System Settings'); ?></h2>
		<blockquote>
			<?php echo l('This settings are also used by the daemon (hlstats.pl). If you change these the daemon have to be stopped and started again !!'); ?>
		</blockquote>
		<table cellpadding="2" cellspacing="0" border="0">
			<tr>
				<th width="220">
					<?php echo l("Deletedays"); ?><br />
					<small>DELETEDAYS</small>
				</th>
				<td>
					<input type="text" size="4" name="option[DELETEDAYS]" value="<?php echo $g_options['DELETEDAYS']; ?>"> <?php echo l('Days'); ?><br />
					<small>
						<?php echo l('HLStats will automatically delete history events from the events tables when they are over this many days old.<br>This is important for performance reasons.<br>Set lower if you are logging a large number of game servers or find the load on the MySQL server is too high.<br>A value of 0 means no delete days'); ?>
					</small>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo l("Ignore BOT"); ?><br />
					<small>IGNOREBOTS</small>
				</th>
				<td>
					<select name="option[IGNOREBOTS]">
						<option value="0" <?php if($g_options['IGNOREBOTS'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1"<?php if($g_options['IGNOREBOTS'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select><br />
					<small>
						<?php echo l('Completly ignore anything which is identified as a BOT.'); ?>
					</small>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo l("Mode"); ?><br />
					<small>MODE</small>
				</th>
				<td>
					<select name="option[MODE]">
						<option value="Normal" <?php if($g_options['MODE'] === "Normal") echo 'selected="1"'; ?>><?php echo l('Normal(Internet)'); ?></option>
						<option value="LAN" <?php if($g_options['MODE'] === "LAN") echo 'selected="1"'; ?>><?php echo l('LAN'); ?></option>
						<option value="NameTrack" <?php if($g_options['MODE'] === "NameTrack") echo 'selected="1"'; ?>><?php echo l('NameTrack'); ?></option>
					</select><br />
					<small>
						<?php echo l('Sets the player-tracking mode'); ?>
						<?php echo l('Normal(Internet)'); ?> - <?php echo l('Recommended for public Internet server use'); ?>
						<?php echo l('NameTrack'); ?> - <?php echo l('Players will be tracked by nickname'); ?>
						<?php echo l('LAN'); ?> - <?php echo l('Players will be tracked by IP Address'); ?>
					</small>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo l("Country lookup"); ?><br />
					<small>USEGEOIP</small>
				</th>
				<td>
					<select name="option[USEGEOIP]">
						<option value="0" <?php if($g_options['USEGEOIP'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1"<?php if($g_options['USEGEOIP'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select><br />
					<small>
						<?php echo l('Use Maxmind GEO IP Database to get the country from each player. Please read the documentation how to achive this.'); ?>
					</small>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo l("Use Rcon"); ?><br />
					<small>RCON</small>
				</th>
				<td>
					<select name="option[RCON]">
						<option value="0" <?php if($g_options['RCON'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1"<?php if($g_options['RCON'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select><br />
					<small>
						<?php echo l('Allow HLStats to send Rcon commands to the game servers.'); ?>
					</small>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo l("Record Rcon"); ?><br />
					<small>RCONRECORD</small>
				</th>
				<td>
					<select name="option[RCONRECORD]">
						<option value="0" <?php if($g_options['RCONRECORD'] === "0") echo 'selected="1"'; ?>><?php echo l('No'); ?></option>
						<option value="1"<?php if($g_options['RCONRECORD'] === "1") echo 'selected="1"'; ?>><?php echo l('Yes'); ?></option>
					</select><br />
					<small>
						<?php echo l('Sets whether to record Rcon commands to the Admin event table'); ?>
					</small>
				</td>
			</tr>
		</table>
		<h2><?php echo l('Paths'); ?></h2>
		<table cellpadding="2" cellspacing="0" border="0">
			<tr>
				<th width="220"><?php echo l("Map Download URL"); ?></th>
				<td>
					<input type="text" name="option[map_dlurl]" size="40"
						value="<?php echo $g_options['map_dlurl']; ?>" /><br />
					<span class="small">eg. http://domain.tld/maps/%GAME%/%MAP%.zip</span><br />
					<span class="small">=&gt; http://domain.tld/maps/cstrike/nuke.zip</span><br />
				</td>
			</tr>
		</table>
		<h2><?php echo l('Preset Styles'); ?></h2>
		<table cellpadding="2" cellspacing="0" border="0">
			<tr>
				<th width="220"><?php echo l("Style"); ?></th>
				<td>
					<select name="option[style]">
						<?php
						foreach($styleFiles as $styleFile) {
							$sfile = str_replace('.css','',basename($styleFile));
							$selected='';
							if($g_options['style'] === $sfile) $selected='selected="1"';
							
							echo '<option ',$selected,' value="',$sfile,'">',$sfile,'</option>';
						}
						?>
					</select>
				</td>
			</tr>
		</table><br />
		<button type="submit" title="<?php echo l('Save'); ?>" name="sub[saveOptions]">
			<?php echo l('Save'); ?>
		</button>
	</form>
</div>
