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

$page = 1;
if (isset($_GET["page"])) {
	$check = validateInput($_GET['page'],'digit');
	if($check === true) {
		$page = $_GET['page'];
	}
}
$awards_d_date = "None";
$queryAwards = mysql_query("SELECT ".DB_PREFIX."_Awards.name,
								".DB_PREFIX."_Awards.verb,
								".DB_PREFIX."_Awards_History.d_winner_id,
								".DB_PREFIX."_Awards_History.d_winner_count,
								".DB_PREFIX."_Players.lastName AS d_winner_name
							FROM ".DB_PREFIX."_Awards_History
							LEFT JOIN ".DB_PREFIX."_Players ON ".DB_PREFIX."_Players.playerId = ".DB_PREFIX."_Awards_History.d_winner_id
							LEFT JOIN ".DB_PREFIX."_Awards ON ".DB_PREFIX."_Awards.awardId = ".DB_PREFIX."_Awards_History.fk_award_id
							WHERE ".DB_PREFIX."_Awards_History.game = '".mysql_escape_string($game)."'
								AND ".DB_PREFIX."_Awards_History.date = '".$g_options['awards_d_date']."'
							ORDER BY ".DB_PREFIX."_Awards.awardType DESC,
								".DB_PREFIX."_Awards.name ASC");
if (mysql_num_rows($queryAwards) > 0) {
		$tmptime = strtotime($g_options['awards_d_date']);
		$awards_d_date = date('l d.m.',$tmptime);
		while($result = mysql_fetch_assoc($queryAwards)) {
			$awardsHistory['data'][] = $result;
		}
	}
}

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
</div>
<div id="main">
	<h1><?php echo l("Awards History"); ?></h1>
	<table cellpadding="0" cellspacing="0" border="1" width="100%">
		<tr>
			<th class="<?php echo $rcol; ?>">
				<a href="index.php?<?php echo makeQueryString(array('sort'=>'name','sortorder'=>$newSort)); ?>">
					<?php echo l('Team'); ?>
				</a>
				<?php if($sort == "name") { ?>
				<img src="hlstatsimg/<?php echo $sortorder; ?>.gif" alt="Sorting" width="7" height="7" />
				<?php } ?>
			</th>
			<th class="<?php echo $rcol; ?>">
				<a href="index.php?<?php echo makeQueryString(array('sort'=>'teamcount','sortorder'=>$newSort)); ?>">
					<?php echo l('Selected'); ?>
				</a>
				<?php if($sort == "teamcount") { ?>
				<img src="hlstatsimg/<?php echo $sortorder; ?>.gif" alt="Sorting" width="7" height="7" />
				<?php } ?>
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
				echo $entry['teamcount'];
				echo '</td>',"\n";

				echo '</tr>';
			}
		}
		else {
			echo '<tr><td colspan="3">',l('No data recorded'),'</td></tr>';
		}
		?>
	</table>
</div>
