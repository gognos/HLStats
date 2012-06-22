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
 * + 2007 - 2012
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
// db class and options
$DB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if($DB->connect_errno) {
	var_dump($DB->connect_error);
	die('Could not connect to the MySQL Server. Check your configuration.');	
}
$DB->query("SET NAMES utf8");
$DB->query("SET collation_connection = 'utf8_unicode_ci'");
$DB->set_charset("utf8");

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

$return = array();

switch($method) {
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

	case 'POST':
		# used to register new entries

		if(!isset($_GET['id'])) exit('Missing argument: ID');
		if(!isset($_POST['payload'])) exit('Missing argument: payload');
		#if(!isset($_POST['requestURL'])) exit('Missing argument: requestURL');

		$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_ENCODED);
		#$requestURL = filter_input(INPUT_POST,'requestURL',FILTER_SANITIZE_ENCODED);
		#$payload = filter_input(INPUT_POST,'payload',FILTER_SANITIZE_ENCODED);

		$payload = json_decode($_POST['payload'],true);

		if($payload !== false) {
			$gamesToAdd = $payload['games'];
			$requestURL = $payload['requestURL'];

			if(!empty($gamesToAdd)) {
				$query = $DB->query("SELECT id FROM `".DB_PREFIX."_ws_sites`
								WHERE `siteHash` = '".$DB->real_escape_string(md5($requestURL))."'
								AND `game` IN ('".implode("','", $gamesToAdd)."')");
				if($query->num_rows === 1) {
					# site/game already there
					var_dump("already there");
				}
				else {
					# not registered yet
					foreach($gamesToAdd as $_game) {
						$query = $DB->query("INSERT INTO `".DB_PREFIX."_ws_sites` SET
											`siteHash` = '".$DB->real_escape_string(md5($requestURL))."',
											`siteURL` = '".$DB->real_escape_string($requestURL)."',
											`game` = '".$DB->real_escape_string($_game)."',
											`regDate` = '".date("Y-m-d H:i:s")."',
											`valid` = 0");
						var_dump($DB->error);
					}
				}
			}
		}
		exit();
		
		var_dump($_POST);
		var_dump($_GET);
	break;

	case 'GET':
	default:
		if(!isset($_GET['id'])) exit('Missing argument: ID');
		if(!isset($_GET['games'])) exit('Missing argument: GAMES');
		
		$gamesStr = filter_input(INPUT_GET,'games',FILTER_SANITIZE_ENCODED);
		$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_ENCODED);
		
		if(!empty($id) && !empty($gamesStr)) {
			if(strstr($gamesStr,"__")) {
				$games = explode("__",$gamesStr);
			}
			else {
				$games[] = $gamesStr;
			}
			
			foreach($games as $g) {
				# check if we have this site/game
				$query = $DB->query("SELECT id FROM `".DB_PREFIX."_ws_sites`
										WHERE `siteHash` = '".$DB->real_escape_string($id)."'
											AND `game` = '".$DB->real_escape_string($g)."'");
				if($query->num_rows > 0) {
					$return[$id][$g] = "yes";
				}
				else {
					$return[$id][$g] = "no";
				}
			}
			#$return = trim($return,"");		
		}
}

# return json code
header('Content-type: text/xml; charset=UTF-8');
echo json_encode($return);
exit();
?>
