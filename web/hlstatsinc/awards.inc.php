<?php
/**
 * awards history file
 * display the daily awards history
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

$rcol = "row-dark";
$awardsHistory['data'] = array();

$date = $g_options['awards_d_date'];

if (isset($_GET["date"])) {
	$check = validateInput($_GET['date'],'nospace');
	if($check === true) {
		$date = $_GET['date'];
	}
}
$tmptime = strtotime($date);
$awards_d_date = l(date('l',$tmptime)).' '.date('d.m.',$tmptime);

$query = mysql_query("SELECT ".DB_PREFIX."_Awards.name,
								".DB_PREFIX."_Awards.verb,
								".DB_PREFIX."_Awards_History.d_winner_id,
								".DB_PREFIX."_Awards_History.d_winner_count,
								".DB_PREFIX."_Players.lastName AS d_winner_name,
								".DB_PREFIX."_Awards_History.date
							FROM ".DB_PREFIX."_Awards_History
							LEFT JOIN ".DB_PREFIX."_Players ON ".DB_PREFIX."_Players.playerId = ".DB_PREFIX."_Awards_History.d_winner_id
							LEFT JOIN ".DB_PREFIX."_Awards ON ".DB_PREFIX."_Awards.awardId = ".DB_PREFIX."_Awards_History.fk_award_id
							WHERE ".DB_PREFIX."_Awards_History.game = '".mysql_escape_string($game)."'
								AND ".DB_PREFIX."_Awards_History.date = '".$date."'
							ORDER BY ".DB_PREFIX."_Awards.awardType DESC,
								".DB_PREFIX."_Awards.name ASC");
if (mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$awardsHistory['data'][] = $result;
	}
	unset($result);
}
mysql_free_result($query);

// get the dates for the date selection
$dateSelect = array();
$query = mysql_query("SELECT `date` FROM ".DB_PREFIX."_Awards_History
						WHERE game = '".mysql_escape_string($game)."'
						GROUP BY `date`");
if(mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$dateSelect[$result['date']] = $result['date'];
	}
	unset($result);
}
mysql_free_result($query);


pageHeader(
	array($gamename, l("Awards History")),
	array($gamename=>"index.php?game=$game", l("Awards History")=>"")
);
?>

<div id="sidebar">
	<h1><?php echo l('Options'); ?></h1>
	<div class="left-box">
		<ul class="sidemenu">
			<li>
				<a href="<?php echo "index.php?game=$game"; ?>"><?php echo l('Back to game overview'); ?></a>
			</li>
		</ul>
	</div>
	<h1><?php echo l('Game'); ?></h1>
	<div class="left-box">
		<img src="hlstatsimg/game-<?php echo $game; ?>-big.png" alt="<?php echo $game; ?>" title="<?php echo $game; ?>" width="100px" height="100px" />
	</div>
</div>
<div id="main">
	<h1><?php echo l("Awards History"),' ',l('for'),' ',$awards_d_date; ?></h1>
	<form method="get" action="index.php">
	<input type="hidden" name="mode" value="awards" />
	<input type="hidden" name="game" value="<?php echo $game; ?>" />
	<?php
if(!empty($dateSelect)) {
echo l('Date selection');
?>

	: <select name="date">
	<?php
		foreach($dateSelect as $ds) {
			$selected = '';
			if($date == $ds) $selected ='selected="1"';
			echo '<option value="',$ds,'" ',$selected,'>',$ds,'</option>';
		}
	?>
	</select>
	<button type="submit" title="<?php echo l('Show'); ?>">
		<?php echo l('Show'); ?>
	</button>
	</form>
<?php }	?>
	<table cellpadding="0" cellspacing="0" border="1" width="100%">
		<tr>
			<th width="200" class="<?php echo $rcol; ?>">
				<?php echo l('Name'); ?>
			</th>
			<th class="<?php echo $rcol; ?>">
				<?php echo l('Player'); ?>
			</th>
		</tr>
		<?php
		if(!empty($awardsHistory['data'])) {
			foreach($awardsHistory['data'] as $k=>$entry) {
				toggleRowClass($rcol);

				echo '<tr>',"\n";

				echo '<td class="',$rcol,'">';
				echo $entry['name'];
				echo '</td>',"\n";

				echo '<td class="',$rcol,'">';
				if($entry['d_winner_id']) {
					echo '<img src="hlstatsimg/player.gif" width="16" height="16" alt="player.gif">&nbsp;';
					echo '<a href="index.php?mode=playerinfo&amp;player=',$entry["d_winner_id"],'"><b>',htmlspecialchars($entry["d_winner_name"]),'</b></a>';
					echo '&nbsp;(',$entry["d_winner_count"],' ',htmlspecialchars($entry["verb"]),')';
				}
				else {
					echo '(',l('Nobody').')';
				}
				echo '</td>',"\n";

				echo '</tr>';
			}
		}
		else {
			echo '<tr><td colspan="3">',l('No data recorded'),'</td></tr>';
		}
		?>
	</table>
	<p><b><?php echo l('Note'); ?>:</b><br />
	<?php echo l('Award history cover only the last'),'&nbsp;',$g_options['DELETEDAYS'],' ',l('days')?>
	</p>
</div>
