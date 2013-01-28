<?php

//Time formatting

function ITtoDWT($time) { //convert hh:mm to time for the dw column
	global $set;
	return ($set['dateUSorEU']) ? substr($time,0,5) : date("g:iA", strtotime($time));
}

function ITtoDT($time,$format = -1) { //convert hh:mm(:ss) to display time
	global $set;
	if (!$time) { return ""; }
	if ($format < 0) { $format = $set['time24']; }
	return ($format) ? substr($time,0,5) : ($time == '24:00' ? '12:00AM' : date("g:iA", strtotime($time)));
}

function DTtoIT($time,$format = -1) { //convert Display Time to ISO Time hh:mm
	global $set;
	$time = trim($time);
	if (!$time) { return ""; }
	if ($format < 0) { $format = $set['time24']; }
	if ($format) {
		if (!preg_match("%^(0{0,1}[0-9]|1[0-9]|2[0-4])[:.][0-5][0-9]([:.][0-5][0-9]){0,1}$%",$time)) {
			return false;
		}
	} else {
		if (!preg_match("%^(0{0,1}[0-9]|1[0-2])[:.][0-5][0-9]\s*(a|A|p|P)(m|M)$%",$time)) {
			return false;
		}
	}
	$tStamp = strtotime($time);
	return ($tStamp < 1) ? false : date("H:i", $tStamp);
}


//Date formatting

function IDtoDD($date,$format = -1) { //convert yyyy mm dd to display date
	global $set;
	if (!$date) { return ""; }
	if ($format < 0) { $format = $set['dateFormat']; }
	switch ($format) {
	case 1: //dd mm yyyy
		return substr($date,8,2).$set['dateSep'].substr($date,5,2).$set['dateSep'].substr($date,0,4);
	case 2: //mm dd yyyy
		return substr($date,5,2).$set['dateSep'].substr($date,8,2).$set['dateSep'].substr($date,0,4);
	case 3: //yyyy mm dd
		return substr($date,0,4).$set['dateSep'].substr($date,5,2).$set['dateSep'].substr($date,8,2);
	}
}

function DDtoID($date,$format = -1) { //validate display date and convert to ISO date yyyy-mm-dd
	global $set;
	$date = trim($date);
	if (!$date) { return ""; }
	if ($format < 0) { $format = $set['dateFormat']; }
	switch ($format) {
	case 1: //dd mm yyyy
		if (!preg_match("%^(0{0,1}[1-9]|[1-2][0-9]|3[0-1])[\/\.-](0{0,1}[1-9]|1[0-2])[\/\.-]((?:19|20)[0-9]{2})$%",$date,$hits)) { return false; }
		if (!checkdate(intval($hits[2]),intval($hits[1]),intval($hits[3]))) { return false; }
		return $hits[3]."-".str_pad($hits[2], 2, "0", STR_PAD_LEFT)."-".str_pad($hits[1], 2, "0", STR_PAD_LEFT);
	case 2: //mm dd yyyy
		if (!preg_match("%^(0{0,1}[1-9]|1[0-2])[\/\.-](0{0,1}[1-9]|[1-2][0-9]|3[0-1])[\/\.-]((?:19|20)[0-9]{2})$%",$date,$hits)) { return false; }
		if (!checkdate(intval($hits[1]),intval($hits[2]),intval($hits[3]))) { return false; }
		return $hits[3]."-".str_pad($hits[1], 2, "0", STR_PAD_LEFT)."-".str_pad($hits[2], 2, "0", STR_PAD_LEFT);
	case 3: //yyyy mm dd
		if (!preg_match("%^((?:19|20)[0-9]{2})[\/\.-](0{0,1}[1-9]|1[0-2])[\/\.-](0{0,1}[1-9]|[1-2][0-9]|3[0-1])$%",$date,$hits)) { return false; }
		if (!checkdate(intval($hits[2]),intval($hits[3]),intval($hits[1]))) { return false; }
		return $hits[1]."-".str_pad($hits[2], 2, "0", STR_PAD_LEFT)."-".str_pad($hits[3], 2, "0", STR_PAD_LEFT);
	}
}

function makeD($date,$format,$m3 = '') { //make long date
	global $set, $months, $months_m, $wkDays, $wkDays_l;
	$d = ltrim(substr($date, 8, 2),"0");
	$mN = ltrim(substr($date, 5, 2),"0");
	$m = ($m3 == 'm3') ? $months_m[$mN - 1] : $months[$mN - 1];
	$y = substr($date, 0, 4);
	switch ($format) {
	case 1: //Dec... 9 / 9 dec...
		return ($set['dateUSorEU']) ? $d.' '.$m : $m.' '.$d;
	case 2: //Dec... 9, 2010 / 9 dec... 2010
		return ($set['dateUSorEU']) ? $d.' '.$m.' '.$y : $m.' '.$d.', '.$y;
	case 3: //Dec... 2010 / dec... 2010
		return ($set['dateUSorEU']) ? $m.' '.$y : $m.' '.$y;
	case 4: //Monday, Dec... 9 / monday 9 dec...
		$wd = $wkDays[date("N", mktime(0,0,0,substr($date,5,2),substr($date,8,2),substr($date,0,4)))];
		return ($set['dateUSorEU']) ? $wd.' '.$d.' '.$m : $wd.', '.$m.' '.$d;
	case 5: //Mon, Dec 9 / mon 9 dec
		$wd = $wkDays_l[date("N", mktime(0,0,0,substr($date,5,2),substr($date,8,2),substr($date,0,4)))];
		return ($set['dateUSorEU']) ? $wd.' '.$d.' '.$m : $wd.', '.$m.' '.$d;
	case 6: //Monday, Dec... 9, 2010 / monday 9 dec... 2010
		$wd = $wkDays[date("N", mktime(0,0,0,substr($date,5,2),substr($date,8,2),substr($date,0,4)))];
		return ($set['dateUSorEU']) ? $wd.' '.$d.' '.$m.' '.$y : $wd.', '.$m.' '.$d.', '.$y;
	}
}


//Connect to database and define LCC
function dbConnect() {
	if (list(,$lcc,$dbc) = file('./lcaldbc.dat',FILE_IGNORE_NEW_LINES)) { //get version + db creds
		define("LCC",$lcc);
		list($dbHost,$dbName,$dbUnam,$dbPwrd,$dbPfix) = unserialize(ciph($dbc,1));
		$link = mysql_connect($dbHost, $dbUnam, $dbPwrd);
		if (!$link) { exit("Could not connect to the MySQL server"); }
		if (!mysql_select_db($dbName,$link)) { exit("Could not select the database"); }
		//mysql_set_charset('utf8',$link); //support non-Latin char sets
		return $dbPfix; //return db table prefix
	} else {
		return false; //no db credentials
	}
}


//Get settings from database
function getSettings() {
	$set = array(); //init
	$rSet = dbQuery("SELECT name, value FROM [db]settings");
	if (!$rSet) { exit("Error: Could not retrieve calendar settings from the database"); }
	while ($row = mysql_fetch_assoc($rSet)) {
		$set[$row['name']] = is_numeric($row['value']) ? intval($row['value']) : stripslashes($row['value']);
	}
	return $set; //array with settings
}


//Database querying
function dbQuery($q) {
	global $dbPfix;
	$q = str_replace ("[db]", $dbPfix, $q) ; //add database prefix
	$rSet = mysql_query($q);
	if ($rSet === false) {
		file_put_contents("./logs/mysql.log", date(DATE_ATOM)."\nScript name: ".htmlentities($_SERVER['PHP_SELF'])."\nMySQL error: ".mysql_error()."\nQuery string: $q\n\n" , FILE_APPEND); exit("SQL error. See 'logs/mysql.log'");
	}
	return $rSet; //result set
}


function validPar($key,$value) {
	switch ($key) {
	case 'cP': return preg_match('%^\d{1,2}$%', $value) ? true : false;
	case 'cL': return preg_match('%^[a-zA-Z]{1,12}$%', $value) ? true : false;
	case 'cC': return (is_array($value) and ctype_digit(implode($value))) ? true : false;
	case 'cU': return (is_array($value) and ctype_digit(implode($value))) ? true : false;
	case 'cD': return preg_match('%^\d{4}-\d{2}-\d{2}$%', $value) ? true : false;
	case 'newD': return preg_match('%^\d{2,4}.\d{2}.\d{2,4}$%', $value) ? true : false;
	case 'hdr': return preg_match('%^(0|1)$%', $value) ? true : false;
	case 'luxcal': return preg_match('%^a:2:{.{15,60};}$%', trim($value)) ? true : false;
	case 'bake': return preg_match('%^-?1$%', $value) ? true : false;
	}
	return true;
}


//Cipher a string
function ciph($s,$n=0) {
	$splits = str_split($s);
	foreach ($splits as &$ch) { //lc:F uc:C
		$c = ord($ch);
		if ($c == 58-($n*26)) { $ch = chr(32+($n*26)); }
		$ch = ($c >= 97 and $c <= 122) ? chr(($c-82-($n*4))%26+97) : (($c >= 65 and $c <= 90) ? chr(($c-53+($n*2))%26+65) : $ch);
	}
	return implode($splits);
}


//Check for mobile browser
function isMobile() {
//echo $_SERVER['HTTP_USER_AGENT'];
	$mobBrowser = '0';
	$allHttp = isset($_SERVER['ALL_HTTP']) ? strtolower($_SERVER['ALL_HTTP']) : '';
	$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$mobileAgents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda','xda-'
	);

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i',$userAgent)) {
		$mobBrowser++;
	} elseif ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false)) {
		$mobBrowser++;
	} elseif (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
		$mobBrowser++;
	} elseif (isset($_SERVER['HTTP_PROFILE'])) {
		$mobBrowser++;
	} elseif (in_array((substr($userAgent,0,4)),$mobileAgents)) {
		$mobBrowser++;
	} elseif (strpos($allHttp,'operamini') !== false) {
		$mobBrowser++;
	}
	if (strpos($userAgent,'windows') !== false) { //reset all if on Windows
		$mobBrowser = 0;
	} elseif (strpos($userAgent,'iemobile') !== false) {
		$mobBrowser++;
	} elseif (strpos($userAgent,'windows phone') !== false) { //WP7 is Windows too, but followed by 'phone'
		$mobBrowser++;
	}
	return ($mobBrowser > 0) ? 1 : 0;
}

function sendMail($subject,$message,$emlList,$senderId=0) {
	global $set;
	$count = 0;
	$sentTo = '';
	if ($senderId) { //sender is user
		$rSet = dbQuery("SELECT user_name, email FROM [db]users WHERE user_id = $senderId limit 1");
		$row = mysql_fetch_assoc($rSet);
		$senderName = stripslashes($row['user_name']);
		$senderMail = stripslashes($row['email']);
	} else { //sender is calendar
		$senderName = $set['calendarTitle'];
		$senderMail = $set['calendarEmail'];
	}
	$headers = 'MIME-Version: 1.0'."\n".'Content-type: text/html; charset=utf-8'."\n"."From: \"".$senderName."\" <".$senderMail.">";
	$notList = explode(";", $emlList);
	$addressList = array();
	foreach ($notList as $emlAorL) { //create email address list
		if (strpos($emlAorL,'@')) { //email address
			$addressList[] = $emlAorL;
		} else { //email list
			$emlAorL .= strpos($emlAorL,'.') ? '' : '.txt';
			if (file_exists("./emlists/$emlAorL")) {
				$addressList = array_merge($addressList,file("./emlists/$emlAorL", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
			}
		}
	}
	foreach ($addressList as $emlAddress) { //send emails
		$emlAddress = trim($emlAddress);
		if (preg_match("/^\D\w*?(\.{0,1}(\w|-)+?){0,2}@((\w|-){2,}\.){1,4}\D{2,4}$/", $emlAddress)) { //valid email address
			if (mail($emlAddress, $subject, $message, $headers)) {
				$sentTo .= ++$count.'. '.str_replace("@","[at]",$emlAddress)."\n";
			}
		}
	}
	return $sentTo;
}
?>