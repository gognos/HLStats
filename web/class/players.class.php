<?php
/**
 * players class file
 * @package HLStats
 * @author Johannes 'Banana' Keßler
 */

/**
 * Original development:
 *
 * + HLStats - Real-time player and clan rankings and statistics for Half-Life
 * + http://sourceforge.net/projects/hlstats/
 * + Copyright (C) 2001  Simon Garner
 *
 *
 * Additional development:
 *
 * + UA HLStats Team
 * + http://www.unitedadmins.com
 * + 2004 - 2007
 *
 *
 *
 * Current development:
 *
 * + Johannes 'Banana' Keßler
 * + http://hlstats.sourceforge.net
 * + 2007 - 2010
 *
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

/**
 * all information about the players for a given game
 * @package HLStats
 */
class Players {

	/**
	 * the current game
	 *
	 * @var string The game
	 */
	private $_game = false;

	/**
	 * the options for queries
	 *
	 * @var array The options
	 */
	private $_option = array();

	/**
	 * the system options
	 *
	 * @var array The system options
	 */
	private $g_options = array();

	/**
	 * set some vars and the game. Game code check is already done
	 *
	 * @param string $game The current game
	 */
	public function __construct($game) {
		if(!empty($game)) {
			$this->_game = $game;
		}
		else {
			throw new Exception("Game is missing for Players.class");
		}

		// set default values
		$this->setOption('page',1);
		$this->setOption('minkills','1');

		global $g_options;
		$this->g_options = $g_options;
	}

	/**
	 * set the options
	 *
	 * @param string $key The key/name for this option
	 * @param string $value The value for this option
	 */
	public function setOption($key,$value) {
		$this->_option[$key] = $value;
	}

	/**
	 * return for the given key the value
	 *
	 * @param string $key The key for the wanted value
	 *
	 * @return string The valuefor given key
	 */
	public function getOption($key) {
		$ret = false;

		if(isset($this->_option[$key])) {
			$ret = $this->_option[$key];
		}

		return $ret;
	}

	/**
	 * get the players for the current game
	 * for the players overview page
	 *
	 * @return array The players
	 */
	public function getPlayersOveriew() {
		$ret['data'] = array();
		$ret['pages'] = false;

		// construct the query with the given options
		$queryStr = "SELECT SQL_CALC_FOUND_ROWS
				t1.playerId,
				t1.lastName,
				t1.skill,
				t1.oldSkill,
				t1.kills,
				t1.deaths,
				t1.active,
				IFNULL(t1.kills/t1.deaths,0) AS kpd,
				DATE(t1.lastUpdate) AS lastUpdate,
				t2.uniqueId
			FROM
				".DB_PREFIX."_Players as t1
			INNER JOIN ".DB_PREFIX."_PlayerUniqueIds as t2 ON t1.playerId = t2.playerId";

		$queryStr .= " WHERE
				t1.game='".mysql_escape_string($this->_game)."'
				AND t1.hideranking=0
				AND t1.kills >= '".mysql_escape_string($this->_option['minkills'])."'";

		// should we show all the players or not
		if(isset($this->_option['showall']) && $this->_option['showall'] === "1") {
			$queryStr .= " ";
		}
		else {
			$queryStr .= " AND t1.active = '1'";
		}

		if(isset($this->_option['showToday']) && $this->_option['showToday'] === "1") {
			// should we show only players from today
			$queryStr .= " HAVING lastUpdate = '".date('Y-m-d')."'";
		}


		// should we hide the bots
		if($this->_option['showBots'] === "0") {
			$queryStr .= " AND t2.uniqueID not like 'BOT:%'";
		}

		$queryStr .= " ORDER BY ";
		if(!empty($this->_option['sort']) && !empty($this->_option['sortorder'])) {
			$queryStr .= " ".$this->_option['sort']." ".$this->_option['sortorder']."";
		}
		//$queryStr .=" ,t1.lastName ASC";

		// calculate the limit
		if($this->_option['page'] === 1) {
			$queryStr .=" LIMIT 0,50";
		}
		else {
			$start = 50*($this->_option['page']-1);
			$queryStr .=" LIMIT ".$start.",50";
		}

		$query = mysql_query($queryStr);
		if(mysql_num_rows($query) > 0) {
			while($result = mysql_fetch_assoc($query)) {
				$result['kpd'] = number_format($result['kpd'],2,'.','');
				$result['lastName'] = makeSavePlayerName($result['lastName']);

				$result['isBot'] = 0;
				if(strstr($result['uniqueId'],'BOT:')) {
					$result['isBot'] = 1;
				}

				$pl[$result['playerId']] = $result;
			}
			$ret['data'] = $pl;
		}

		// get the max count for pagination
		$query = mysql_query("SELECT FOUND_ROWS() AS 'rows'");
		$result = mysql_fetch_assoc($query);
		$ret['pages'] = (int)ceil($result['rows']/50);

		return $ret;
	}

	/**
	 * get the player count per day
	 *
	 * @return array
	 */
	public function getPlayerCountPerDay() {
		//$data['connect'] = array();
		//$data['disconnect'] = array();
		$data = array();

		$queryStr = "SELECT `playerId`,
								DATE(lastUpdate) AS lastUpdate
								FROM `".DB_PREFIX."_Players`
								WHERE `game` = '".mysql_escape_string($this->_game)."'";

		if($this->g_options['DELETEDAYS'] !== "0") {
			$startTime = time()-(86400*$this->g_options['DELETEDAYS']);
			$startDay = date("Y-m-d",$startTime);
			$queryStr .= " HAVING lastUpdate > '".$startDay."'";
		}

		$query = mysql_query($queryStr);
		if(mysql_num_rows($query) > 0) {
			while ($result = mysql_fetch_assoc($query)) {
				// we group by day
				$data[$result['lastUpdate']][] = $result['playerId'];
			}
		}
		mysql_free_result($query);

		return $data;
	}

	/**
	 * get the most time online
	 *
	 * @todo To complete
	 *
	 * @return array The data
	 */
	public function getMostTimeOnline() {
		exit('not wroking yet');
		$data = array();

		$query = mysql_query("SELECT ".DB_PREFIX."_Events_StatsmeTime.*,
					TIME_TO_SEC(".DB_PREFIX."_Events_StatsmeTime.time) as tTime
					FROM ".DB_PREFIX."_Events_StatsmeTime
					LEFT JOIN ".DB_PREFIX."_Servers
						ON ".DB_PREFIX."_Servers.serverId=".DB_PREFIX."_Events_StatsmeTime.serverId
					WHERE ".DB_PREFIX."_Servers.game='".mysql_escape_string($this->_game)."'");

		while($result = mysql_fetch_assoc($query)) {
			$onlineArr[$result['playerId']][] = $result;
		}
		mysql_free_result($query);
	}
}
?>
