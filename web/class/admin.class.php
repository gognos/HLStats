<?php
/**
 * chart class file. uses the pChart library
 * @package HLStats
 * @author Johannes 'Banana' Keßler
 */


/**
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

/**
 * the main admin class
 * @author banana
 * @package HLStats
 *
 */
class Admin {

	/**
	 * if we are logged in or not
	 * @var boolean
	 */
	private $_authStatus = false;

	/**
	 * load stuff and check if we are logged in
	 */
	public function __construct() {
		$this->_checkAuth();
	}

	/**
	 * true if we have a valid auth
	 * @return boolean
	 */
	public function getAuthStatus() {
		return $this->_authStatus;
	}

	public function doLogin($username,$pass) {
		$ret = false;

		if(!empty($username) && !empty($pass)) {
			$query = mysql_query("SELECT `username`,`password`
									FROM `".DB_PREFIX."_Users`
									WHERE `username` = '".mysql_escape_string($username)."'");
			if(mysql_num_rows($query) > 0) {
				// we have such user, now check pass
				$result = mysql_fetch_assoc($query);
				$lPass = md5($pass);
				if($result['password'] === $lPass) {
					// valid username and password
					// create auth code
					$authCode = sha1($_SERVER["REMOTE_ADDR"].$_SERVER['HTTP_USER_AGENT'].$lPass);
					$query = mysql_query("UPDATE `".DB_PREFIX."_Users`
											SET `authCode` = '".mysql_escape_string($authCode)."'
											WHERE `username` = '".mysql_escape_string($username)."'");
					if($query !== false) {
						$_SESSION['hlstatsAuth']['authCode'] = $authCode;
						$ret = true;
					}
				}
			}
		}

		return $ret;
	}

	/**
	 * check if the user is logged in
	 */
	private function _checkAuth() {
		if(isset($_SESSION['hlstatsAuth']['authCode'])) {
			$check = validateInput($_SESSION['hlstatsAuth']['authCode'],'nospace');
			if($check === true) {
				// check if we have such code into the db
				$userData = $this->_getSessionDataFromDB($_SESSION['hlstatsAuth']['authCode']);
				if($userData !== false) {
					// we have a valid user with valid authCode
					// re create the authcode with current data
					$authCode = sha1($_SERVER["REMOTE_ADDR"].$_SERVER['HTTP_USER_AGENT'].$userData['password']);
					if($authCode === $_SESSION['hlstatsAuth']['authCode']) {
						$this->_authStatus = true;
					}
				}
				else {
					$this->_logoutCleanUp($_SESSION['hlstatsAuth']['authCode']);
				}
			}
		}
	}

	/**
	 * load the session info from the db with the given auth code
	 */
	private function _getSessionDataFromDB($authCode) {
		$ret = false;

		$query = mysql_query("SELECT `username`,`password`
								FROM `".DB_PREFIX."_Users`
								WHERE `authCode` = '".mysql_escape_string($authCode)."'");
		if(mysql_num_rows($query) > 0) {
			$ret = mysql_fetch_assoc($query);
		}

		mysql_free_result($query);

		return $ret;
	}

	/**
	 * clean up at logout
	 */
	private function _logoutCleanUp() {
		unset($_SESSION['hlstatsAuth']);
	}
}
?>
