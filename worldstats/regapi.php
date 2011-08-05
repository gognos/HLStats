<?php

/**
 * game overview file
 * display an overview for one game and display the awards
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

define('DEBUG',true);
define('LOCAL',false);

# utf-8 encoding
mb_http_output('UTF-8');
mb_internal_encoding('UTF-8');

date_default_timezone_set('Europe/Berlin');

// do not display errors in live version
if(DEBUG === true) {
	error_reporting(-1);
	ini_set('error_reporting',-1);
	ini_set('display_errors',"1");
}
else {
	error_reporting(-1);
	ini_set('error_reporting',-1);
	ini_set('display_errors',"0");
}

# db connection
require('./db-conf.inc.php');
$db_con = mysql_connect(DB_HOST,DB_USER,DB_PASS) OR die('Can not connect');
$db_sel = mysql_select_db(DB_NAME,$db_con) OR die('Can not connect');
mysql_query("SET character set utf8");
mysql_query("SET NAMES utf8");

# load the registerd sites
$regSites = array();
/*
$query = mysql_query("SELECT id, siteHash, game
						FROM `".DB_PREFIX."_ws_sites`");
if(mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$regSites[$result['id']] = $result;
	}
}
*/

$method = $_SERVER['REQUEST_METHOD'];

$return = '';

switch($method) {
	case 'POST':
	case 'PUT':
	case 'DELETE':
	case 'HEAD':
		echo '';
		exit();
	break;

	case 'OPTIONS':
		header("Allow: GET, HEAD, OPTIONS, POST");
		exit();
	break;

	case 'GET':
	default:
		if(!isset($_GET['id'])) exit('Missing argument: ID');
		if(!isset($_GET['games'])) exit('Missing argument: GAMES');
		
		$gamesStr = filter_input(INPUT_GET,'games',FILTER_SANITIZE_ENCODED);
		$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_ENCODED);
		
		if(!empty($id) && !empty($gamesStr)) {
			if(strstr(",",$gamesStr)) {
				$games = explode($gamesStr);
			}
			else {
				$games[] = $gamesStr;
			}
			
			foreach($games as $g) {
				# check if we have thise site/game
				$query = mysql_query("SELECT id FROM `".DB_PREFIX."_ws_sites`
										WHERE `siteHash` = '".mysql_real_escape_string($id)."'
											AND `game` = '".mysql_real_escape_string($g)."'");
			}
						
		}
}

header('Content-type: text/xml; charset=UTF-8');
echo $return;

?>