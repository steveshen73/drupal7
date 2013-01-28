<?php
/*
= LuxCal user management page =

� Copyright 2009-2012  LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.

The LuxCal Web Calendar is free software: you can redistribute it and/or modify it under 
the terms of the GNU General Public License as published by the Free Software Foundation, 
either version 3 of the License, or (at your option) any later version.

The LuxCal Web Calendar is distributed in the hope that it will be useful, but WITHOUT 
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with the LuxCal 
Web Calendar. If not, see <http://www.gnu.org/licenses/>.
*/

//sanity check
if (!defined('LCC') or
		(isset($_REQUEST['uid']) and !preg_match('%^(add|\d{1,6})$%', $_REQUEST['uid'])) or
		(isset($_REQUEST['editUser']) and !preg_match('%^(y|n)$%', $_REQUEST['editUser'])) or
		(isset($_GET['delExe']) and !preg_match('%^\w$%', $_GET['delExe']))
	) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); }
		

//initialize
$adminLang = (file_exists('./lang/ai-'.strtolower($_SESSION['cL']).'.php')) ? $_SESSION['cL'] : "English";
require './lang/ai-'.strtolower($adminLang).'.php';

$uid = isset($_REQUEST["uid"]) ? $_REQUEST["uid"] : "";
$editUser = isset($_REQUEST["editUser"]) ? $_REQUEST["editUser"] : "";
$uname = isset($_POST["uname"]) ? trim($_POST["uname"]) : '';
$email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
$uiLanguage = isset($_POST["uiLanguage"]) ? $_POST["uiLanguage"] : '';
$bgrnd = isset($_POST['bgrnd']) ? $_POST['bgrnd'] : "";
$userRights = isset($_POST["userRights"]) ? $_POST["userRights"] : 0;
$privPost = ($userRights < 9) ? $userRights : 3; //3: max.
$privAdmin = ($userRights == 9) ? 1 : 0;

function showUsers() {
	global $ax;
	echo "<table class=\"fieldBox\">\n";
	echo '<tr><td class="legend">&nbsp;'.$ax['usr_list_of_users'].'&nbsp;</td></tr>'."\n";
	$rSet = dbQuery("SELECT * FROM [db]users WHERE status >= 0 ORDER BY IF(user_id = 1, user_id, user_name)");
	if (!$rSet) echo "Database Error.";
	else {
		echo '<tr><td><table class="uList">'."\n";
		echo '<tr><th>'.$ax['usr_name'].'</th><th>'.$ax['usr_email'].'</th><th>'.$ax['usr_rights'].'</th><th>'.$ax['usr_language'].'</th><th>'.$ax['usr_login_0'].'</th><th>'.$ax['usr_login_1'].'</th><th>'.$ax['usr_login_cnt']."</th><th></th></tr>\n";
		while ($row = mysql_fetch_assoc($rSet)) {
			$firstLoginD = ($row['login_0'] != '9999-00-00') ? IDtoDD($row['login_0']) : "";
			$lastLoginD = ($row['login_1'] != '9999-00-00') ? IDtoDD($row['login_1']) : "";
			$style = $row['color'] ?  " style=\"background-color:".$row['color'].";\"" : '';
			echo '<tr><td'.$style.'><b>'.$row['user_name'].'</b></td><td>'.$row['email'].'</td>';
			echo '<td>';
			if ($row['sedit'] == 1) { echo $ax['usr_admin']; }
			elseif ($row['privs'] == 0) { echo $ax['none']; }
			elseif ($row['privs'] == 1) { echo $ax['usr_view']; }
			elseif ($row['privs'] == 2) { echo $ax['usr_post_own']; }
			elseif ($row['privs'] == 3) { echo $ax['usr_post_all']; }
			echo '</td>';
			echo "<td>".ucfirst($row['language'])."</td>";
			echo "<td>".$firstLoginD."</td><td>".$lastLoginD."</td><td>".$row['login_cnt']."</td>";
			echo "<td>[<a href=\"index.php?editUser=y&amp;uid=".$row['user_id']."\">".$ax['usr_edit']."</a>]";
			if ($row['user_id'] > 2) echo "&nbsp;&nbsp;[<a href=\"index.php?delExe=y&amp;uid=".$row['user_id']."\">".$ax['usr_delete']."</a>]";
			echo "</td></tr>\n";
		}
		echo "</table></td></tr>\n";
	}
	echo "</table>\n";
	echo '<button class="noPrint" type="button" onclick="window.location=\'index.php?editUser=y&amp;uid=add\'">'.$ax['usr_add']."</button>\n";
}

function editUser($uid) {
	global $ax, $set, $uiLanguage, $editUser, $uname, $email, $userRights, $bgrnd;
	echo '<form action="index.php" method="post">'."\n";
	echo '<input type="hidden" name="uid" id="uid" value="'.$uid.'"/>'."\n";
	echo '<input type="hidden" name="editUser" id="editUser" value="'.$editUser.'"/>'."\n";
	echo '<table class="fieldBox">'."\n";
	if ($uid != "add") {
		$rSet = dbQuery("SELECT * FROM [db]users WHERE user_id = $uid limit 1");
		if (mysql_num_rows($rSet) < 1) {
			echo "<p class=\"error\">".$ax['usr_not_found']."</p>\n";
		} else {
			$row = mysql_fetch_assoc($rSet);
			$uname = stripslashes($row['user_name']);
			$email = stripslashes($row['email']);
			$userRights = ($row['sedit']) ? 9 : $row['privs'];
			$uiLanguage = $row['language'];
			$bgrnd = $row['color'];
		}
		echo '<tr><td class="legend">&nbsp;'.$ax['usr_edit_user'].'&nbsp;</td></tr>'."\n";
		$pwNote = '<sup>*</sup>:<div style="font-size: .8em"><sup>*</sup> '.$ax['usr_if_changing_pw'].'</div>';
	} else {
		echo '<tr><td class="legend">&nbsp;'.$ax['usr_add'].'&nbsp;</td></tr>'."\n";
		$pwNote = ':';
	}
	if (!$uiLanguage) { $uiLanguage = $set['language']; }
	echo "<tr><td>\n";
	$style = ($bgrnd ? ' style="background-color:'.$bgrnd.';"' : '');
	echo '<table class="list">'."\n";
	echo '<tr><td>'.$ax['usr_name'].':</td><td><input type="text" id="uname" name="uname" size="30" value="'.$uname.'"'.$style."/></td></tr>\n";
	if ($uid != 1) { //not public access
		echo '<tr><td>'.$ax['usr_email'].':</td><td><input type="text" name="email" size="30" value="'.$email.'"/></td></tr>'."\n";
		echo '<tr><td>'.$ax['usr_password'].$pwNote.'</td><td><input type="password" name="new_pw" size="30"/></td></tr>'."\n";
	}
	echo '<tr><td>'.$ax['usr_rights'].":</td>";
	if ($uid == $_SESSION['uid'] or $uid == 2) {
		echo '<td>'.$ax['usr_admin_functions'].'<input type="hidden" name="userRights" id="userRights" value="'.$userRights.'"/></td>'."\n";
	} else {
		echo '<td><select name="userRights">'."\n";
			echo '<option value="0"'.($userRights == 0 ? ' selected="selected"' : '').'>'.$ax['usr_no_rights']."</option>\n";
			echo '<option value="1"'.($userRights == 1 ? ' selected="selected"' : '').'>'.$ax['usr_view_calendar']."</option>\n";
			echo '<option value="2"'.($userRights == 2 ? ' selected="selected"' : '').'>'.$ax['usr_post_events_own']."</option>\n";
			echo '<option value="3"'.($userRights == 3 ? ' selected="selected"' : '').'>'.$ax['usr_post_events_all']."</option>\n";
			echo '<option value="9"'.($userRights == 9 ? ' selected="selected"' : '').'>'.$ax['usr_admin_functions']."</option>\n";
		echo "</select></td>\n";
	}
	echo "</tr>\n";
	echo "<tr><td>".$ax['usr_ui_language'].":</td>\n";
	echo '<td><select name="uiLanguage">'."\n";
		$files = scandir("lang/");
		foreach ($files as $file) {
			if (substr($file, 0, 3) == "ui-") {
				$lang = strtolower(substr($file,3,-4));
				echo '<option value="'.$lang.'"'.(strtolower($uiLanguage) == $lang ? ' selected="selected"' : '').'>'.ucfirst($lang)."</option>\n";
			}
		}
	echo "</select></td></tr>\n";
	echo '<tr><td>'.$ax['usr_background'].':</td><td><input type="text" id="bgrnd" name="bgrnd" value="'.$bgrnd.'" size="8" maxlength="10"/><button class="noPrint" title="'.$ax['usr_select_color']."\" onclick=\"cPicker('bgrnd','uname','b');return false;\">&larr;</button></td></tr>\n";
	echo "</table></td></tr>\n";
	echo "</table>\n";
	if ($uid == "add") {
		echo '<input type="submit" name="addExe" value="'.$ax['usr_add_profile'].'"/>';
	} else {
		echo '<input type="submit" name="updExe" value="'.$ax['usr_upd_profile'].'"/>';
	}
	echo '&nbsp;&nbsp;&nbsp;<input type="submit" name="back" value="'.$ax['back'].'"/>'."\n";
	echo "</form>\n";
}

function addUser() { //add user account
	global $uid, $privAdmin, $privPost, $editUser, $uiLanguage, $ax, $uname, $email, $bgrnd;

	do {
		if ($bgrnd and !preg_match("/^#[0-9A-Fa-f]{6}$/", $bgrnd)) { $msg = $ax['usr_invalid_color']; break; }
		$new_pw = isset($_POST["new_pw"]) ? $_POST["new_pw"] : "";
		if (!$uname or !$email or !$new_pw) { $msg = $ax['usr_cred_required']; break; }
		if (!preg_match("/^[\w\s\._-]{2,}$/", $uname)) { $msg = $ax['usr_un_invalid']; break; }
		if (!preg_match("/^\D\w*?(\.{0,1}(\w|-)+?){0,2}@((\w|-){2,}\.){1,4}\D{2,4}$/", $email)) { $msg = $ax['usr_em_invalid']; break; }
		$rSet = dbQuery("SELECT user_name FROM [db]users WHERE user_name = '".mysql_real_escape_string($uname)."' AND status >= 0");
		if (mysql_num_rows($rSet) > 0) { $msg = $ax['usr_uname_exists']; break; }
		$rSet = dbQuery("SELECT email FROM [db]users WHERE email = '".mysql_real_escape_string($email)."' AND status >= 0");
		if (mysql_num_rows($rSet) > 0) { $msg = $ax['usr_email_exists']; break; }
		$password = md5($new_pw);
		$result = dbQuery("INSERT INTO [db]users VALUES (NULL,'".mysql_real_escape_string($uname)."','$password',DEFAULT,'".mysql_real_escape_string($email)."',$privAdmin,$privPost,DEFAULT,DEFAULT,DEFAULT,'$uiLanguage','$bgrnd',DEFAULT)");
		if (!$result) { $msg = "Database Error: ".$ax['usr_not_added']; break; }
		$uid = mysql_insert_id();
		$msg = $ax['usr_added'];
		$editUser = 'n';
	} while (false);
	return $msg;
}

function updateUser() { //update user account
	global $uid, $privAdmin, $privPost, $editUser, $uiLanguage, $ax, $uname, $email, $bgrnd;

	do {
		if ($bgrnd and !preg_match("/^#[0-9A-Fa-f]{6}$/", $bgrnd)) { $msg = $ax['usr_invalid_color']; break; }
		if (!preg_match("/^[\w\s\._-]{2,}$/", $uname)) { $msg = $ax['usr_un_invalid']; break; }
		if ($uid > 1) { //not Public User
			if (!preg_match("/^\D\w*?(\.{0,1}(\w|-)+?){0,2}@((\w|-){2,}\.){1,4}\D{2,4}$/", $email)) { $msg = $ax['usr_em_invalid']; break; }
		}
		$new_pw = isset($_POST["new_pw"]) ? $_POST["new_pw"] : "";
		if ($new_pw) {
			$password = md5($new_pw);
			$result = dbQuery("UPDATE [db]users SET password = '$password' WHERE user_id ='$uid'");
			if (!$result) { $msg = "Database Error: ".$ax['usr_pw_not_updated']; break; }
		}
		$result = dbQuery("UPDATE [db]users SET user_name = '".mysql_real_escape_string($uname)."', email = '".mysql_real_escape_string($email)."', sedit = $privAdmin, privs = $privPost, language = '$uiLanguage', color = '$bgrnd' WHERE user_id = $uid");
		if (!$result) { $msg .= "Database Error: ".$ax['usr_not_updated']; break; }
		$msg = $ax['usr_updated'];
		$editUser = 'n';
	} while (false);
	return $msg;
}

function deleteUser() { //delete user account
	global $uid, $ax;
	
	do {
		if ($uid == $_SESSION['uid']) { $msg = $ax['usr_cant_delete_yourself']; break; }
		$result = dbQuery("UPDATE [db]users SET status = -1 WHERE user_id = $uid");
		if (!$result) { $msg = "Database Error: ".$ax['usr_not_deleted']; break; }
		$msg = $ax['usr_deleted'];
	} while (false);
	return $msg;
}

//Control logic
if ($admin) {
	$msg = '';
	if (isset($_POST['addExe'])) {
		$msg = addUser();
	} elseif (isset($_POST['updExe'])) {
		$msg = updateUser();
	} elseif (isset($_GET['delExe'])) {
		$msg = deleteUser();
	}
	echo '<p class="error">'.$msg."</p>\n";
	echo "<div class=\"scrollBoxAd\">\n";
	echo "<div class=\"centerBox\">\n";
	if ($editUser != 'y' or isset($_POST["back"])) {
		showUsers();
	} else {
		editUser($uid);
	}
	echo "</div>\n</div>\n";
} else {
	echo "<p class=\"error\">".$ax['no_way']."</p>\n";
}
?>
