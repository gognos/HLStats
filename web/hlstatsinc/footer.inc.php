<?php
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
 * + 2007 - 2009
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


/*
 * HLStats Page Footer
 * This file will be inserted at the end of every page generated by HLStats.
 * This file can contain PHP code.
 */
?>
<br>
<table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr align="right">
	<td>
		<form action="<?php echo $_SERVER['PHP_SELF'];
					if(count($_GET) > 0) {
						foreach($_GET as $mode_name => $mode_var) {
							if(!empty($mode_var)) {
								echo '?'.$mode_name.'='.$mode_var;
							}
						}
				       } ?>" method="post">
			<select size="1" name="lang_custom">
				<?php
				global $current_lang;
				$available_langs = glob(getcwd()."/lang/*.ini.php");
				$available_langs[] = "en";
				echo '<option value='.$GLOBALS['current_lang'].'>'.$GLOBALS['current_lang'].'</option>';
				foreach($available_langs as $available_lang) {
					$available_lang = ereg_replace("(.*lang[/\\])|.ini.php", "", $available_lang);
					if($available_lang !== $current_lang) {
						echo '<option value='.$available_lang.'>'.$available_lang."\n</option>";
					}
				}
				?>
			</select>
			<input type="hidden" name="change_lang" value="1" />
			<input type="submit" name="submit" value="change language" />
		</form>
	</td>
</tr>
</table>
<center>
<?php echo $g_options["font_small"]; ?>
	<?php echo l('Generated in real-time by'); ?> <a href="http://www.hlstats-community.org">HLStats</a> <?php echo VERSION; ?> &nbsp;&nbsp;&nbsp; [<a href="<?php echo $g_options["scripturl"]; ?>?mode=admin">Admin</a>]
<?php
	if(isset($_COOKIE["authusername"]) && $_COOKIE['authusername'] != "") {
		echo '&nbsp;[<a href="hlstats.php?logout=1">',l('Logout'),'</a>]';
	}
?>
<?php echo $g_options["fontend_small"]; ?><br><br>
</center>
</body>
</html>
