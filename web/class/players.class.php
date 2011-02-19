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
 * + 2007 - 2011
 *
 * This program is free software is licensed under the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * 
 * You should have received a copy of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 * along with this program; if not, visit http://hlstats-community.org/License.html
 *
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
	 * get the top player for this game
	 * @todo: right now sorted by skill. Future could be other sorting stuff
	 *
	 * @return array The playerinformation
	 */
	public function topPlayer() {
		$ret = false;
		
		$queryStr = "SELECT t1.playerId AS playerId,
						t1.lastName AS lastName,
						t1.isBot AS isBot
					FROM ".DB_PREFIX."_Players AS t1
					WHERE t1.game= '".mysql_real_escape_string($this->_game)."'
					AND t1.hideranking = 0";

			if($this->g_options['IGNOREBOTS'] === "1") {
				$queryStr .= " AND t1.isBot = 0";
			}
			
			$queryStr .= " ORDER BY t1.skill DESC LIMIT 1";
		
		$query = mysql_query($queryStr);
		if(!empty($query) && mysql_num_rows($query) > 0) {
			$ret = mysql_fetch_assoc($query);
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
				t1.isBot,
				IFNULL(t1.kills/t1.deaths,0) AS kpd,
				DATE(t1.lastUpdate) AS lastUpdate
			FROM ".DB_PREFIX."_Players as t1";

		$queryStr .= " WHERE
				t1.game='".mysql_real_escape_string($this->_game)."'
				AND t1.hideranking=0
				AND t1.kills >= '".mysql_real_escape_string($this->_option['minkills'])."'";

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
			$queryStr .= " AND t1.isBot = 0";
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
		$data = array();

		$queryStr = "SELECT `t1`.`playerId`,
						DATE(t1.lastUpdate) AS lastUpdate
						FROM `".DB_PREFIX."_Players` AS t1
						INNER JOIN ".DB_PREFIX."_PlayerUniqueIds as t2 ON t1.playerId = t2.playerId
						WHERE `t1`.`game` = '".mysql_real_escape_string($this->_game)."'";

		// should we show all the players or not
		if(isset($this->_option['showall']) && $this->_option['showall'] === "1") {
			$queryStr .= " ";
		}
		else {
			$queryStr .= " AND t1.active = '1'";
		}
		
		// should we hide the bots
		if($this->_option['showBots'] === "0") { # this is not the config setting, it is the link setting
			$queryStr .= " AND `t2`.`uniqueID` not like 'BOT:%'";
		}

		if(isset($this->_option['showToday']) && $this->_option['showToday'] === "1") {
			// should we show only players from today
			$queryStr .= " HAVING lastUpdate = '".date('Y-m-d')."'";
		}
		elseif($this->g_options['DELETEDAYS'] !== "0") {
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
					WHERE ".DB_PREFIX."_Servers.game='".mysql_real_escape_string($this->_game)."'");

		while($result = mysql_fetch_assoc($query)) {
			$onlineArr[$result['playerId']][] = $result;
		}
		mysql_free_result($query);
	}
}
?>
