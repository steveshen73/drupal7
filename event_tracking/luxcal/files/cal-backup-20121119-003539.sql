DROP TABLE categories;

CREATE TABLE `categories` (
  `category_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `sequence` int(2) unsigned NOT NULL DEFAULT '1',
  `rpeat` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `public` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `color` varchar(10) DEFAULT NULL,
  `background` varchar(10) DEFAULT NULL,
  `check1` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `label1` varchar(40) NOT NULL DEFAULT 'approved',
  `mark1` varchar(10) NOT NULL DEFAULT 'ok',
  `check2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `label2` varchar(40) NOT NULL DEFAULT 'complete',
  `mark2` varchar(10) NOT NULL DEFAULT '&#10003;',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO categories VALUES("1","no cat","1","0","1","","","0","approved","ok","0","complete","&#10003;","0");

DROP TABLE events;

CREATE TABLE `events` (
  `event_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `event_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(64) DEFAULT NULL,
  `description` text,
  `category_id` int(4) unsigned NOT NULL DEFAULT '1',
  `venue` varchar(64) DEFAULT NULL,
  `user_id` int(6) unsigned DEFAULT NULL,
  `editor` varchar(32) NOT NULL DEFAULT '',
  `private` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked` text,
  `s_date` date DEFAULT NULL,
  `e_date` date NOT NULL DEFAULT '9999-00-00',
  `x_dates` text,
  `s_time` time DEFAULT NULL,
  `e_time` time NOT NULL DEFAULT '99:00:00',
  `r_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `r_interval` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `r_period` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `r_month` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `r_until` date NOT NULL DEFAULT '9999-00-00',
  `notify` tinyint(1) NOT NULL DEFAULT '-1',
  `not_mail` varchar(255) DEFAULT NULL,
  `a_date` date NOT NULL DEFAULT '9999-00-00',
  `m_date` date NOT NULL DEFAULT '9999-00-00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE settings;

CREATE TABLE `settings` (
  `name` varchar(15) NOT NULL DEFAULT '',
  `value` text,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO settings VALUES("calendarTitle","Bill.com Web Calendar","Calendar title displayed in the top bar");
INSERT INTO settings VALUES("calendarUrl","http://localhost/event_tracking/luxcal/","Calendar location (URL)");
INSERT INTO settings VALUES("calendarEmail","steveshen73@gmail.com","Sender in and receiver of email notifications");
INSERT INTO settings VALUES("timeZone","America/Los_Angeles","Calendar time zone");
INSERT INTO settings VALUES("chgEmailList","","Destin. email addresses for calendar changes");
INSERT INTO settings VALUES("chgNofDays","1","Number of days to look back for calendar changes");
INSERT INTO settings VALUES("notifSender","0","Sender of notification emails (0:calendar 1:user)");
INSERT INTO settings VALUES("adminCronSum","1","Send cron job summary to admin (0:no, 1:yes)");
INSERT INTO settings VALUES("details4All","1","Show event details to all users (0:disabled 1:enabled)");
INSERT INTO settings VALUES("rssFeed","1","Display RSS feed links in footer and HTML head (0:disabled 1:enabled)");
INSERT INTO settings VALUES("eventExp","0","Number of days after due when an event expires / can be deleted (0:never)");
INSERT INTO settings VALUES("cookieExp","30","Number of days before a Remember Me cookie expires");
INSERT INTO settings VALUES("userMenu","0","Display user filter menu");
INSERT INTO settings VALUES("catMenu","1","Display category filter menu");
INSERT INTO settings VALUES("langMenu","0","Display ui-language selection menu");
INSERT INTO settings VALUES("defaultView","2","Calendar view at start-up (1:year, 2:month, 3:work month, 4:week, 5:work week 6:day, 7:upcoming, 8:changes)");
INSERT INTO settings VALUES("language","english","Default user interface language");
INSERT INTO settings VALUES("selfReg","0","Self-registration (0:disabled, 1:enabled)");
INSERT INTO settings VALUES("selfRegPrivs","1","Self-reg rights (1:view, 2:post self, 3:post all)");
INSERT INTO settings VALUES("selfRegNot","0","User self-reg notification to admin (0:disabled, 1:enabled)");
INSERT INTO settings VALUES("maxNoLogin","0","Number of days not logged in, before deleting user account (0:never delete)");
INSERT INTO settings VALUES("miniCalView","1","Mini calendar view (1:full month, 2:work month)");
INSERT INTO settings VALUES("miniCalPost","0","Mini calendar event posting (0:disabled, 1:enabled)");
INSERT INTO settings VALUES("miniCalHBox","1","Mini calendar event hover box (0:disabled, 1:enabled)");
INSERT INTO settings VALUES("yearStart","0","Start month in year view (1-12 or 0, 0:current month)");
INSERT INTO settings VALUES("colsToShow","3","Number of months to show per row in year view");
INSERT INTO settings VALUES("rowsToShow","4","Number of rows to show in year view");
INSERT INTO settings VALUES("weeksToShow","10","Number of weeks to show in month view");
INSERT INTO settings VALUES("workWeekDays","12345","Days to show in work weeks (1:mo - 7:su)");
INSERT INTO settings VALUES("lookaheadDays","14","Days to look ahead in upcoming view, todo list and RSS feeds");
INSERT INTO settings VALUES("dwStartHour","6","Day/week view start hour");
INSERT INTO settings VALUES("dwEndHour","18","Day/week view end hour");
INSERT INTO settings VALUES("dwTimeSlot","30","Day/week time slot in minutes");
INSERT INTO settings VALUES("dwTsHeight","20","Day/week time slot height in pixels");
INSERT INTO settings VALUES("eventHBox","1","Event details hover box (0:disabled, 1:enabled)");
INSERT INTO settings VALUES("weekNumber","1","Week numbers on(1) or off(0)");
INSERT INTO settings VALUES("showAdEd","1","Show event owner (0:no, 1:yes)");
INSERT INTO settings VALUES("showCatName","1","Show cat name in various views (0:no, 1:yes)");
INSERT INTO settings VALUES("showLinkInMV","1","Show URL-links in month view (0:no, 1:yes)");
INSERT INTO settings VALUES("eventColor","1","Event colors (0:user color, 1:cat color)");
INSERT INTO settings VALUES("dateFormat","1","Event date format (1:dd-mm-yyyy, 2:mm-dd-yyyy, 3:yyyy-mm-dd)");
INSERT INTO settings VALUES("dateUSorEU","1","Calendar date format (0:Monday, May 14, 2012, 1:Monday 14 May 2012)");
INSERT INTO settings VALUES("dateSep",".","Date separator (. - or /)");
INSERT INTO settings VALUES("time24","1","Time format (0:12-hour am/pm, 1:24-hour)");
INSERT INTO settings VALUES("weekStart","1","Week starts on Sunday(0) or Monday(1)");

DROP TABLE users;

CREATE TABLE `users` (
  `user_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `temp_password` varchar(32) DEFAULT NULL,
  `email` varchar(64) NOT NULL DEFAULT '',
  `sedit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `privs` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `login_0` date NOT NULL DEFAULT '9999-00-00',
  `login_1` date NOT NULL DEFAULT '9999-00-00',
  `login_cnt` int(8) NOT NULL DEFAULT '0',
  `language` varchar(32) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("1","Public Access","",""," ","0","1","9999-00-00","9999-00-00","0","","","0");
INSERT INTO users VALUES("2","steve shen","ecd9c2f44592eed0afd3de41478cb62b","","steveshen73@gmail.com","1","3","2012-11-19","2012-11-19","1","","","0");

