<?php
/*
!!!!!!! THIS SCRIPT IS LAUNCHED WHEN UPGRADING TO A NEWER LUXCAL VERSION !!!!!!!

© Copyright 2009-2012 LuxSoft - www.LuxSoft.eu
*/

//sanity check
if (!defined('LCV')) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //lounch via script only

//init checks; if no db connection, connect using config.php
if ($dbPfix === false) { //no db connection
	//connect to database using config.php
	$link = mysql_connect($hn, $un, $pw) or die ("Could not connect to database, check database credentials in config.php");
	if (!mysql_select_db($db,$link)) die ("Could not select database $db");
	$dbHost = $hn;
	$dbUnam = $un;
	$dbPwrd = $pw;
	$dbName = $db;
	$dbPfix = $dbPrefix;
}

/*============================= start upgrading ==============================*/

/* ===== As of LuxCal 1.6 ===== */

//Update MySQL database structure and give administrator full rights
//Test for column 'post' - if found, rename it to 'privs' and drop column 'view'
$result = mysql_query("SELECT post FROM ".$dbPfix."users");
if ($result) { //column 'post' present - rename 'post' to 'privs'
	$altered = mysql_query("ALTER TABLE ".$dbPfix."users CHANGE post privs TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'");
	if ($altered) { 
		$result = mysql_query("ALTER TABLE ".$dbPfix."users DROP view");
		$result = mysql_query("UPDATE ".$dbPfix."users SET privs = 3 WHERE user_id = 2");
	}
}

/* ===== As of LuxCal 2.0 ===== */

//Update database structure for advanced repeat capability
//Add to dates table: a_date (date added), m_date (date modified) and status (<0: deleted)
$result = mysql_query("SELECT r_type FROM ".$dbPfix."dates");
if (!$result) { //column 'r_type' not present, create 'repeat' fields
	//add columns for enhanced repeat + deleted field
	$altered = mysql_query("ALTER TABLE ".$dbPfix."dates 
		ADD r_type TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER e_time,
		ADD r_interval TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER r_type,
		CHANGE recur r_period TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
		ADD r_until DATE NOT NULL DEFAULT '9999-00-00' AFTER r_period,
		ADD a_date DATE NOT NULL DEFAULT '9999-00-00',
		ADD m_date DATE NOT NULL DEFAULT '9999-00-00',
		ADD status TINYINT(1) NOT NULL DEFAULT '0'
	");
	$altered = mysql_query("ALTER TABLE ".$dbPfix."events
		MODIFY not_mail VARCHAR(255) DEFAULT NULL
	");
	//copy previous repeat values
	$result = mysql_query("UPDATE ".$dbPfix."dates SET r_type = 1, r_interval = 1, r_until = e_date, e_date = '9999-00-00' WHERE r_period > 0");
}
//Add column to user table: language (user interface language)
$result = mysql_query("SELECT language FROM ".$dbPfix."users");
if (!$result) { //column 'language' not present; create it
	$altered = mysql_query("ALTER TABLE ".$dbPfix."users
		ADD language VARCHAR(32) DEFAULT NULL
	");
}

/* ===== As of LuxCal 2.1 ===== */

//Add to dates table: Primary key to optimize speed
$result = mysql_query("SELECT event_id FROM ".$dbPfix."dates");
if ($result !== false) { //table 'dates' existing
	$flags = mysql_field_flags($result, 0);
	if (strpos($flags, "primary_key") === false) {
		$altered = mysql_query("ALTER TABLE ".$dbPfix."dates
			ADD PRIMARY KEY (event_id)
		");
	}
}

/* ===== As of LuxCal 2.3 ===== */

//Add columns to users table: login_0 (first login), login_1 (last login) and login_cnt (number of logins)
$result = mysql_query("SELECT login_0 FROM ".$dbPfix."users");
if (!$result) { //column 'login_0' not present; create login_0 and login_1
	$altered = mysql_query("ALTER TABLE ".$dbPfix."users
		ADD login_0 DATE NOT NULL DEFAULT '9999-00-00' AFTER privs,
		ADD login_1 DATE NOT NULL DEFAULT '9999-00-00' AFTER login_0,
		ADD login_cnt INT(8) NOT NULL DEFAULT '0' AFTER login_1
	");
}

/* ===== As of LuxCal 2.4 ===== */

//Add columns to categories table: rpeat (4 = repeat every year), rss_feed (> 0 = include in rss_feeds)
$result = mysql_query("SELECT repeat FROM ".$dbPfix."categories");
if (!$result) { //column 'repeat' not present
	$altered = mysql_query("ALTER TABLE ".$dbPfix."categories
		ADD rpeat TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER sequence,
		ADD rss_feed TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER rpeat
	");
}
//Add column event_type to events table and change length not_mail field from 256 to 255
$result = mysql_query("SELECT event_type FROM ".$dbPfix."events");
if (!$result) { //column 'event_type' not present
	$altered = mysql_query("ALTER TABLE ".$dbPfix."events
		ADD event_type TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER event_id,
		MODIFY not_mail VARCHAR(255) DEFAULT NULL
	");
}
//Add column status to users table
$result = mysql_query("SELECT status FROM ".$dbPfix."users");
if (!$result) { //column 'status' not present
	$altered = mysql_query("ALTER TABLE ".$dbPfix."users
		ADD status TINYINT(1) NOT NULL DEFAULT '0' AFTER language
	");
}
//In table dates modify column notify: SIGNED and DEFAULT = -1
$result = mysql_query("DESCRIBE ".$dbPfix."dates");
if ($result !== false) { //table 'dates' existing
	while ($row = mysql_fetch_assoc($result)) {
		if ($row['Field'] == 'notify') {
			if ($row['Default'] == 0) {
				$altered = mysql_query("ALTER TABLE ".$dbPfix."dates
					MODIFY notify TINYINT(1) NOT NULL DEFAULT '-1'
				");
				//replace all values '0' by '-1'
				$result = mysql_query("UPDATE ".$dbPfix."dates SET notify = -1 WHERE notify = 0");
			}
			break;
		}
	}
}

/* ===== As of LuxCal 2.5 ===== */
//merge the events and the dates table into a single events table
//add fiels from dates table to events table
$result = mysql_query("SELECT status FROM ".$dbPfix."events");
if (!$result) { //column 'status' not present, so continue
	//add columns from dates table
	$altered = mysql_query("ALTER TABLE ".$dbPfix."events
		ADD editor VARCHAR(32) NOT NULL DEFAULT '' AFTER user_id,
		ADD	s_date DATE DEFAULT NULL AFTER private,
		ADD	e_date DATE NOT NULL DEFAULT '9999-00-00' AFTER s_date,
		ADD x_dates TEXT DEFAULT NULL AFTER e_date,
		ADD	s_time TIME DEFAULT NULL AFTER x_dates,
		ADD	e_time TIME NOT NULL DEFAULT '99:00:00' AFTER s_time,
		ADD	r_type TINYINT(1) unsigned NOT NULL DEFAULT '0' AFTER e_time,
		ADD	r_interval TINYINT(1) unsigned NOT NULL DEFAULT '0' AFTER r_type,
		ADD	r_period TINYINT(1) unsigned NOT NULL DEFAULT '0' AFTER r_interval,
		ADD	r_until DATE NOT NULL DEFAULT '9999-00-00' AFTER r_period,
		ADD	notify TINYINT(1) NOT NULL DEFAULT '-1' AFTER r_until,
		ADD	a_date DATE NOT NULL DEFAULT '9999-00-00' AFTER not_mail,
		ADD	m_date DATE NOT NULL DEFAULT '9999-00-00' AFTER a_date,
		ADD	status TINYINT(1) NOT NULL DEFAULT '0' AFTER m_date
	");
	if ($altered) { //columns added successfully
		//copy dates table columns to event table
		$result = mysql_query("UPDATE ".$dbPfix."events e,".$dbPfix."dates d
		SET e.s_date = d.s_date,
			e.e_date = d.e_date,
			e.s_time = d.s_time,
			e.e_time = d.e_time,
			e.r_type = d.r_type,
			e.r_interval = d.r_interval,
			e.r_period = d.r_period,
			e.r_until = d.r_until,
			e.notify = d.notify,
			e.a_date = d.a_date,
			e.m_date = d.m_date,
			e.status = d.status
		WHERE e.event_id = d.event_id
		");
		if ($result !== false) { //if copy successful, drop the dates table
			$result = mysql_query("DROP TABLE ".$dbPfix."dates");
		}
	}
}
//Test for column 'rss_feed' - if found, rename it to 'public'
$result = mysql_query("SELECT rss_feed FROM ".$dbPfix."categories");
if ($result) { //column 'rss_feed' present - rename it to 'public'
	$altered = mysql_query("ALTER TABLE ".$dbPfix."categories CHANGE rss_feed public TINYINT(1) UNSIGNED NOT NULL DEFAULT '1'");
}
//Add column color to users table
$result = mysql_query("SELECT color FROM ".$dbPfix."users");
if (!$result) { //column 'color' not present
	$altered = mysql_query("ALTER TABLE ".$dbPfix."users
		ADD color VARCHAR(10) DEFAULT NULL AFTER language
	");
}
//Add column status to categories table
$result = mysql_query("SELECT status FROM ".$dbPfix."categories");
if (!$result) { //column 'status' not present
	$altered = mysql_query("ALTER TABLE ".$dbPfix."categories
		ADD status TINYINT(1) NOT NULL DEFAULT '0' AFTER background
	");
}

/* ===== As of LuxCal 2.6 ===== */
//Add column r_month to events table
$result = mysql_query("SELECT r_month FROM ".$dbPfix."events");
if (!$result) { //column 'r_month' not present
	$altered = mysql_query("ALTER TABLE ".$dbPfix."events
		ADD	r_month TINYINT(1) unsigned NOT NULL DEFAULT '0' AFTER r_period
	");
}
//Add table [db]settings to database
$result = mysql_query("SHOW TABLES LIKE '".addcslashes($dbPfix,'_')."settings'");
if (mysql_num_rows($result) == 0) { //table [db]settings not existing
	$result = mysql_query("CREATE TABLE ".$dbPfix."settings (
		name varchar(15) NOT NULL DEFAULT '',
		value TEXT DEFAULT NULL,
		description TEXT DEFAULT NULL
		)");
}
//Add columns check1, check2, label1, label2 to categories table
$result = mysql_query("SELECT check1 FROM ".$dbPfix."categories");
if (!$result) { //column 'check1' not present
	$altered = mysql_query("ALTER TABLE ".$dbPfix."categories
			ADD check1 TINYINT(1) unsigned NOT NULL DEFAULT '0' after background,
			ADD label1 VARCHAR(40) NOT NULL DEFAULT 'approved' after check1,
			ADD mark1 VARCHAR(10) NOT NULL DEFAULT 'ok' after label1,
			ADD check2 TINYINT(1) unsigned NOT NULL DEFAULT '0' after mark1,
			ADD label2 VARCHAR(40) NOT NULL DEFAULT 'complete' after check2,
			ADD mark2 VARCHAR(10) NOT NULL DEFAULT '&#10003;' after label2
	");
}
//Add column checked to events table
$result = mysql_query("SELECT checked FROM ".$dbPfix."events");
if (!$result) { //column 'checked' not present
	$altered = mysql_query("ALTER TABLE ".$dbPfix."events
		ADD checked TEXT DEFAULT NULL AFTER private
	");
}

//Get calendar settings from db
$dbSet = getSettings(); //settings array

//if $dbSet empty, take setting from config.php
if (!isset($dbSet['calendarTitle'])) { $dbSet['calendarTitle'] = $calendarTitle ? $calendarTitle : 'LuxCal Calendar'; }
if (!isset($dbSet['calendarUrl'])) { $dbSet['calendarUrl'] = 'http://'.$_SERVER['SERVER_NAME'].rtrim(dirname($_SERVER["PHP_SELF"]),'/').'/'; }
if (!isset($dbSet['calendarEmail'])) { $dbSet['calendarEmail'] = $calendarEmail ? $calendarEmail : 'calendar@email.com'; }
if (!isset($dbSet['timeZone'])) { $dbSet['timeZone'] = $timeZone ? $timeZone : 'Europe/Amsterdam'; }
if (!isset($dbSet['chgEmailList'])) { $dbSet['chgEmailList'] = $chgEmailList ? $chgEmailList : ''; }
if (!isset($dbSet['chgNofDays'])) { $dbSet['chgNofDays'] = $chgNofDays ? $chgNofDays : 1; }
if (!isset($dbSet['notifSender'])) { $dbSet['notifSender'] = $notifSender ? $notifSender : 0; }
if (!isset($dbSet['adminCronSum'])) { $dbSet['adminCronSum'] = $adminCronSum ? $adminCronSum : 1; }
if (!isset($dbSet['details4All'])) { $dbSet['details4All'] = $details4All ? $details4All : 1; }
if (!isset($dbSet['rssFeed'])) { $dbSet['rssFeed'] = $rssFeed ? $rssFeed : 1; }
if (!isset($dbSet['eventExp'])) { $dbSet['eventExp'] = $eventExp ? $eventExp : 0; }
if (!isset($dbSet['cookieExp'])) { $dbSet['cookieExp'] = $cookieExp ? $cookieExp : 30; }
if (!isset($dbSet['userMenu'])) { $dbSet['userMenu'] = $userMenu ? $userMenu : 1; }
if (!isset($dbSet['catMenu'])) { $dbSet['catMenu'] = $catMenu ? $catMenu : 1; }
if (!isset($dbSet['langMenu'])) { $dbSet['langMenu'] = $langMenu ? $langMenu : 0; }
if (!isset($dbSet['defaultView'])) { $dbSet['defaultView'] = $defaultView ? $defaultView : 2; }
if (!isset($dbSet['language'])) { $dbSet['language'] = $language ? $language : "English"; }
if (!isset($dbSet['selfReg'])) { $dbSet['selfReg'] = $selfReg ? $selfReg : 0; }
if (!isset($dbSet['selfRegPrivs'])) { $dbSet['selfRegPrivs'] = $selfRegPrivs ? $selfRegPrivs : 1; }
if (!isset($dbSet['selfRegNot'])) { $dbSet['selfRegNot'] = $selfRegNot ? $selfRegNot : 0; }
if (!isset($dbSet['maxNoLogin'])) { $dbSet['maxNoLogin'] = $maxNoLogin ? $maxNoLogin : 0; }
if (!isset($dbSet['miniCalView'])) { $dbSet['miniCalView'] = $miniCalView ? $miniCalView : 1; }
if (!isset($dbSet['miniCalPost'])) { $dbSet['miniCalPost'] = $miniCalPost ? $miniCalPost : 0; }
if (!isset($dbSet['miniCalHBox'])) { $dbSet['miniCalHBox'] = $miniCalHBox ? $miniCalHBOx : 1; }
if (!isset($dbSet['yearStart'])) { $dbSet['yearStart'] = $yearStart ? $yearStart : 0; }
if (!isset($dbSet['colsToShow'])) { $dbSet['colsToShow'] = $colsToShow ? $colsToShow : 3; }
if (!isset($dbSet['rowsToShow'])) { $dbSet['rowsToShow'] = $rowsToShow ? $rowsToShow : 4; }
if (!isset($dbSet['weeksToShow'])) { $dbSet['weeksToShow'] = $weeksToShow ? $weeksToShow : 10; }
if (!isset($dbSet['workWeekDays'])) { $dbSet['workWeekDays'] = $workWeekDays ? $workWeekDays : '12345'; }
if (!isset($dbSet['lookaheadDays'])) { $dbSet['lookaheadDays'] = $lookaheadDays ? $lookaheadDays : 14; }
if (!isset($dbSet['dwStartHour'])) { $dbSet['dwStartHour'] = $dwStartHour ? $dwStartHour : 6; }
if (!isset($dbSet['dwEndHour'])) { $dbSet['dwEndHour'] = $dwEndHour ? $dwEndHour : 18; }
if (!isset($dbSet['dwTimeSlot'])) { $dbSet['dwTimeSlot'] = $dwTimeSlot ? $dwTimeSlot : 30; }
if (!isset($dbSet['dwTsHeight'])) { $dbSet['dwTsHeight'] = $dwTsHeight ? $dwTsHeight : 20; }
if (!isset($dbSet['eventHBox'])) { $dbSet['eventHBox'] = $eventHBox ? $eventHBox : 1; }
if (!isset($dbSet['weekNumber'])) { $dbSet['weekNumber'] = $weekNumber ? $weekNumber : 1; }
if (!isset($dbSet['showAdEd'])) { $dbSet['showAdEd'] = $showAdEd ? $showAdEd : 1; }
if (!isset($dbSet['showCatName'])) { $dbSet['showCatName'] = $showCatName ? $showCatName : 1; }
if (!isset($dbSet['showLinkInMV'])) { $dbSet['showLinkInMV'] = $showLinkInMV ? $showLinkInMV : 1; }
if (!isset($dbSet['eventColor'])) { $dbSet['eventColor'] = $eventColor ? $eventColor : 1; }
if (!isset($dbSet['dateFormat'])) { $dbSet['dateFormat'] = $dateFormat ? $dateFormat : 1; }
if (!isset($dbSet['dateUSorEU'])) { $dbSet['dateUSorEU'] = $dateUSorEU ? $dateUSorEU : 1; }
if (!isset($dbSet['dateSep'])) { $dbSet['dateSep'] = $dateSep ? $dateSep : "."; }
if (!isset($dbSet['time24'])) { $dbSet['time24'] = $time24 ? $time24 : 1; }
if (!isset($dbSet['weekStart'])) { $dbSet['weekStart'] = $weekStart ? $weekStart : 1; }

//Get / encrypt db credentials
if (file_exists('./lcaldbc.dat')) {
	list(,,$dbc) = file('./lcaldbc.dat', FILE_IGNORE_NEW_LINES); //encrypted db credentials
} else {
	$dbc = ciph(serialize(array($dbHost, $dbName, $dbUnam, $dbPwrd, $dbPfix))); //encrypt db credentials
}

//Save version and db creds to lcaldbc.dat
$dbcHdr = "LuxCal\n".LCV."\n";
if (file_put_contents('./lcaldbc.dat',$dbcHdr.$dbc) == false) {
	exit('Unable to write the file lcaldbc.dat to disk. Check the permissions of the calendar root directory (should be 755).');
}
//chmod('./lcaldbc.dat', 0600); //invisible to visitors

//Delete possible settings from database
$result = mysql_query("DELETE FROM ".$dbPfix."settings");
if ($result === false) {
	exit('Error: Unable to reset settings in database. Check database credentials.');
}

//Save calendar settings to database
$result = mysql_query("INSERT INTO ".$dbPfix."settings VALUES
	('calendarTitle','".mysql_real_escape_string($dbSet['calendarTitle'])."','Calendar title displayed in the top bar'),
	('calendarUrl','".mysql_real_escape_string($dbSet['calendarUrl'])."','Calendar location (URL)'),
	('calendarEmail','".mysql_real_escape_string($dbSet['calendarEmail'])."','Sender in and receiver of email notifications'),
	('timeZone','".mysql_real_escape_string($dbSet['timeZone'])."','Calendar time zone'),
	('chgEmailList','".mysql_real_escape_string($dbSet['chgEmailList'])."','Destin. email addresses for calendar changes'),
	('chgNofDays','".$dbSet['chgNofDays']."','Number of days to look back for calendar changes'),
	('notifSender','".$dbSet['notifSender']."','Sender of notification emails (0:calendar 1:user)'),
	('adminCronSum','".$dbSet['adminCronSum']."','Send cron job summary to admin (0:no, 1:yes)'),
	('details4All','".$dbSet['details4All']."','Show event details to all users (0:disabled 1:enabled)'),
	('rssFeed','".$dbSet['rssFeed']."','Display RSS feed links in footer and HTML head (0:disabled 1:enabled)'),
	('eventExp','".$dbSet['eventExp']."','Number of days after due when an event expires / can be deleted (0:never)'),
	('cookieExp','".$dbSet['cookieExp']."','Number of days before a Remember Me cookie expires'),
	('userMenu','".$dbSet['userMenu']."','Display user filter menu'),
	('catMenu','".$dbSet['catMenu']."','Display category filter menu'),
	('langMenu','".$dbSet['langMenu']."','Display ui-language selection menu'),
	('defaultView','".$dbSet['defaultView']."','Calendar view at start-up (1:year, 2:month, 3:work month, 4:week, 5:work week 6:day, 7:upcoming, 8:changes)'),
	('language','".$dbSet['language']."','Default user interface language'),
	('selfReg','".$dbSet['selfReg']."','Self-registration (0:disabled, 1:enabled)'),
	('selfRegPrivs','".$dbSet['selfRegPrivs']."','Self-reg rights (1:view, 2:post self, 3:post all)'),
	('selfRegNot','".$dbSet['selfRegNot']."','User self-reg notification to admin (0:disabled, 1:enabled)'),
	('maxNoLogin','".$dbSet['maxNoLogin']."','Number of days not logged in, before deleting user account (0:never delete)'),
	('miniCalView','".$dbSet['miniCalView']."','Mini calendar view (1:full month, 2:work month)'),
	('miniCalPost','".$dbSet['miniCalPost']."','Mini calendar event posting (0:disabled, 1:enabled)'),
	('miniCalHBox','".$dbSet['miniCalHBox']."','Mini calendar event hover box (0:disabled, 1:enabled)'),
	('yearStart','".$dbSet['yearStart']."','Start month in year view (1-12 or 0, 0:current month)'),
	('colsToShow','".$dbSet['colsToShow']."','Number of months to show per row in year view'),
	('rowsToShow','".$dbSet['rowsToShow']."','Number of rows to show in year view'),
	('weeksToShow','".$dbSet['weeksToShow']."','Number of weeks to show in month view'),
	('workWeekDays','".$dbSet['workWeekDays']."','Days to show in work weeks (1:mo - 7:su)'),
	('lookaheadDays','".$dbSet['lookaheadDays']."','Days to look ahead in upcoming view, todo list and RSS feeds'),
	('dwStartHour','".$dbSet['dwStartHour']."','Day/week view start hour'),
	('dwEndHour','".$dbSet['dwEndHour']."','Day/week view end hour'),
	('dwTimeSlot','".$dbSet['dwTimeSlot']."','Day/week time slot in minutes'),
	('dwTsHeight','".$dbSet['dwTsHeight']."','Day/week time slot height in pixels'),
	('eventHBox','".$dbSet['eventHBox']."','Event details hover box (0:disabled, 1:enabled)'),
	('weekNumber','".$dbSet['weekNumber']."','Week numbers on(1) or off(0)'),
	('showAdEd','".$dbSet['showAdEd']."','Show date/user added/edited (0:no, 1:yes)'),
	('showCatName','".$dbSet['showCatName']."','Show cat name in various views (0:no, 1:yes)'),
	('showLinkInMV','".$dbSet['showLinkInMV']."','Show URL-links in month view (0:no, 1:yes)'),
	('eventColor','".$dbSet['eventColor']."','Event colors (0:user color, 1:cat color)'),
	('dateFormat','".$dbSet['dateFormat']."','Event date format (1:dd-mm-yyyy, 2:mm-dd-yyyy, 3:yyyy-mm-dd)'),
	('dateUSorEU','".$dbSet['dateUSorEU']."','Calendar date format (0:Monday, May 14, 2012, 1:Monday 14 May 2012)'),
	('dateSep','".$dbSet['dateSep']."','Date separator (. - or /)'),
	('time24','".$dbSet['time24']."','Time format (0:12-hour am/pm, 1:24-hour)'),
	('weekStart','".$dbSet['weekStart']."','Week starts on Sunday(0) or Monday(1)')
");
if ($result === false) { exit('Error: Unable to save settings in database. Check database credentials.'); }
if (isset($_SESSION['settings'])) { unset($_SESSION['settings']); } //force retrieve of settings
if (file_exists('./config.php')) {
	rename('config.php', 'config-backup.php');
	echo '<script type="text/javascript">alert ("The calendar has been upgraded.\nThe file \'config.php\' has been renamed to \'config-backup.php\' and is not used any more."); window.location.reload();</script>';
} else {
	echo '<script type="text/javascript">alert ("The calendar has been upgraded."); window.location.reload();</script>';
}
exit;
?>
