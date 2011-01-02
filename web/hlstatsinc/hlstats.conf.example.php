<?php
/**
 * example configuration file for web-interface
 * copy this file to hlstats.conf.php and set the options
 * @package HLStats
 * @author Johannes 'Banana' Keßler
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

///
/// Database Settings
///

/**
 * DB_NAME - The name of the database
 * @global string DB_NAME
 * @name DB_NAME
 */
define("DB_NAME", "hlstats");

/**
 * DB_USER - The username to connect to the database as
 * @global string DB_USER
 * @name DB_USER
 */
define("DB_USER", "user");

/**
 * DB_PASS - The password for DB_USER
 * @global string DB_PASS
 * @name DB_PASS
 */
define("DB_PASS", "test");

/**
 * DB_ADDR - The address of the database server, in host:port format.
 * 			(You might also try setting this to e.g. ":/tmp/mysql.sock" to
 * 			use a Unix domain socket, if your mysqld is on the same box as
 * 			your web server.)
 * @global string DB_ADDR
 * @name DB_ADDR
 */
define("DB_ADDR", "localhost");

/**
 * DB_PREFIX - The table prefix. Default is hlstats (the leading _ comes from the sql file)
 * @global string DB_PREFIX
 * @name DB_PREFIX
 */
define("DB_PREFIX", "hlstats");

/**
 * DB_PCONNECT - Set to 1 to use persistent database connections. Persistent
 * 			connections can give better performance, but may overload
 * 			the database server. Set to 0 to use non-persistent
 * 			connections.
 * @global string DB_PCONNECT
 * @name DB_PCONNECT
 */
define("DB_PCONNECT", 0);

?>
