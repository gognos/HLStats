<?php

/**
 * admin worldstats manage file
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

$_wsRegURL = "http://http://localhost/code/HLStats/web/worldstats/regapi.php";

$error = false;
$status = false;

if(isset($_POST['sub']['doRegister'])) {
	if(isset($_POST['reg']['register']) && $_POST['reg']['register'] === "1") {
		# we want to register
		if($g_options['registeredToWorldStats'] === "1") {
			$error = "You are already registered.<br />If you have problems <a href='http://forum.hlstats-community.org'>please contact</a>";
		}
		else {
			# we want to register.
			# first run the status request
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL,$_wsRegURL.'?id='.md5($_SERVER["SCRIPT_FILENAME"]));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			
			$do = curl_exec($ch);
			var_dump($do);
			
			curl_close($ch);
		}
	}
}

pageHeader(array(l("Admin"),l('Worldstats')), array(l("Admin")=>"index.php?mode=admin",l('Worldstats')=>''));
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
	<h1><?php echo l('Worldstats'); ?></h1>
	<p>
		To be a part of the <a href="http://www.hlstats-community.org/worldstats" target="_blank">HLStats Worldstats</a> 
		you need to "register" your HLStats installation and activate the xml interface.
	</p>
	<?php 
		if(!empty($error)) {
			echo '<div class="error">',$error,'</div>';
		}
		elseif(!empty($success)) {
			echo '<div class="success">',$success,'</div>';
		}
	?>
	<p>
		<form method="post" action="">
			<input type="checkbox" name="reg[register]" value="1" />&nbsp;Register your installation<br />
			<br />
			<button type="submit" name="sub[doRegister]" title="Do it">Do it</button>
		</form>
	</p>
</div>