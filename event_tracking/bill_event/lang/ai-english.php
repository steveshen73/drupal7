<?php
/*
= LuxCal event calendar admin interface language file =

This file has been produced by LuxSoft. Please send comments / improvements to rb@luxsoft.eu.

© Copyright 2009-2012  LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LAI","2.7.1");

/* -- Admin Interface texts -- */

$ax = array(

//general
"none" => "None",
"back" => "Back",
"close" => "Close",

//settings.php - fieldset headers + general
"set_general_settings" => "General",
"set_opanel_settings" => "Options Panel",
"set_user_settings" => "User Accounts",
"set_minical_settings" => "Mini Calendar (only relevant if mini calendar is used)",
"set_view_settings" => "Views",
"set_dt_settings" => "Dates/Times",
"set_save_settings" => "Save Settings",
"set_missing_invalid" => "missing or invalid settings (background highlighted)",
"set_settings_saved" => "Calendar settings saved",
"set_save_error" => "Database error - Saving calendar settings failed",
"hover_for_details" => "Hover over descriptions for details",
"enabled" => "enabled",
"disabled" => "disabled",
"no" => "no",
"yes" => "yes",
"or" => "or",
"minutes" => "minutes",
"pixels" => "pixels",
"no_way" => "You are not authorized to perform this action",

//settings.php - general settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"calendarTitle_label" => "Calendar title",
"calendarTitle_text" => "Displayed in the calendar\'s top bar and used in email notifications.",
"calendarUrl_label" => "Calendar URL",
"calendarUrl_text" => "The calendar\'s web site address.",
"calendarEmail_label" => "Calendar email address",
"calendarEmail_text" => "The email address used to send or receive notification emails.<br>Format: \'email\' or \'name&#8249;email&#8250;\'.",
"timeZone_label" => "Time zone",
"timeZone_text" => "The calendar\'s time zone, used to calculate the current time.",
"see" => "see",
"chgEmailList_label" => "Email destinations for changes",
"chgEmailList_text" => "Destination email addresses periodically receiving an email with calendar changes.<br>Email addresses separated by semicolons.<br>(requires a cron job)",
"chgNofDays_label" => "Days to look back for changes",
"chgNofDays_text" => "Number of days to look back for the summary of calendar changes.<br>If the number of days is set to 0 or if no cron job is running no summary of changes will be sent.<br>(requires a cron job)",
"notifSender_label" => "Sender of notification emails",
"notifSender_text" => "When the calendar sends reminder emails, the sender field of the email can contain either the calendar email address, or the email address of the user who created the event.<br>In case of the user email address, the receiver can reply to the email.",
"cronSummary_label" => "Admin cron job summary",
"cronSummary_text" => "Send a cron job summary to the calendar administrator.<br>Enabling is only useful if a cron job has been activated for the calendar.",
"details4All_label" => "Show event details to all users",
"details4All_text" => "If enabled: event details will be visible to the owner of the event and to all other users.<br>If disabled: event details will only be visible to the owner of the event and to users with \'post all\' rights. Other users with less rights will not see the event details.",
"rssFeed_label" => "RSS feed links",
"rssFeed_text" => "If enabled: For users with at least \'view\' rights an RSS feed link will be visible in the footer of the calendar and an RSS feed link will be added to the HTML head of the calendar pages.",
"eventExp_label" => "Event expiry days",
"eventExp_text" => "Number of days after the event due date when the event expires and will be automatically deleted.<br>If 0 or if no cron job is running, no events will be automatically deleted.<br>(requires a cron job)",
"cookieExp_label" => "'Remember me' cookie expiry days",
"cookieExp_text" => "Number of days before the cookie set by the \'Remember me\' option (during Log In) will expire.",
"calendar" => "calendar",
"user" => "user",

//settings.php - options panel settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"userMenu_label" => "User filter menu",
"userMenu_text" => "Display the user filter menu in the options panel.<br>This filter can be used to display only events created by one specific user.",
"catMenu_label" => "Category filter menu",
"catMenu_text" => "Display the event category filter menu in the options panel.<br>This filter can be used to display only events belonging to a specific event category.",
"langMenu_label" => "Language selection menu",
"langMenu_text" => "Display language selection menu in the options panel.<br>This menu can be used to select the user interface language.<br>(enabling only useful if several languages are installed)",
"defaultView_label" => "Default view on start-up",
"defaultView_text" => "Possible default views on calendar start-up are:<br>- Year<br>- Full Month<br>- Work Month *)<br>- Full Week<br>- Work Week *)<br>- Day<br>- Upcoming<br>- Changes<br>*) For work week days see on this page: Views - Work week days<br>Recommended choice: Month or Upcoming.",
"language_label" => "Default user interface language",
"language_text" => "The files ui-{language}.php, ai-{language}.php, ug-{language}.php and ug-layout.png must be present in the lang/ directory. {language} = selected user interface language. File names must be lower case!",

//settings.php - user account settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"selfReg_label" => "Self registration",
"selfReg_text" => "Allow users to register themselves for access to the calendar.",
"selfRegPrivs_label" => "Self registration rights",
"selfRegPrivs_text" => "Calendar access rights for self registered users.<br>- view: view only<br>- post-self: post events and edit own events<br>- post-all: post events and edit own and other\'s events",
"selfRegNot_label" => "Self registration notification",
"selfRegNot_text" => "Send a notification email to the calendar email address when a self-registation takes place.",
"view" => "view",
"post_own" => 'post own',
"post_all" => 'post all',
"maxNoLogin_label" => "Max. no. of days not logged in",
"maxNoLogin_text" => "If an account hasn\'t logged in for this many days it will be automatically deleted.<br>If this value is set to 0, user accounts will never be deleted.<br>(requires a cron job)",

//settings.php - mini calendar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"miniCalView_label" => "Mini calendar view",
"miniCalView_text" => "Possible views for the mini calendar are:<br>- Full Month<br>- Work Month *)<br>- Full Week<br>- Work Week *)<br>*) For work week days see on this page: Views - Work week days",
"miniCalPost_label" => "Mini calendar event posting",
"miniCalPost_text" => "If enabled users can:<br>- post new events in the mini calendar by clicking the top bar of a day cell<br>- edit/delete events by clicking an event square",
"miniCalHBox_label" => "Event details hover box",
"miniCalHBox_text" => "If enabled an overlay with event details will pop up when the user hovers an event square in the mini calendar",

//settings.php - view settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"yearStart_label" => "Start month in Year view",
"yearStart_text" => "If a start month has been specified (1 - 12), the calendar will in Year view always start with this month and the year of this first month will only change as of the first day of the same month in the next year.<br>The value 0 has a special meaning: the start month is based on the current date and will fall in the first row of months.",
"colsToShow_label" => "Columns to show in Year view",
"colsToShow_text" => "Number of months to display in each row in Year view.<br>Recommended choice: 3 or 4.",
"rowsToShow_label" => "Rows to show in Year view",
"rowsToShow_text" => "Number of rows of four months each to display in Year view.<br>Recommended choice: 4, which gives you 16 months to scroll through.",
"weeksToShow_label" => "Weeks to show in Month view",
"weeksToShow_text" => "Number of weeks to display in Month view.<br>Recommended choice: 10, which gives you 2.5 months to scroll through.<br>The value 0 has a special meaning: display exactly 1 month.",
"workWeekDays_label" => "Work week days",
"workWeekDays_text" => "Days to be shown in each week in Work Month view and Work Week view.<br>Enter the number of each day that should be visible. Valid day numbers:<br>1 = Monday<br>2 = Tuesday<br>....<br>7 = Sunday<br>e.g. 12345 : Monday - Friday",
"lookaheadDays_label" => "Days to look ahead",
"lookaheadDays_text" => "Number of days to look ahead for events in the Upcoming Events view, the Todo List and the RSS feeds.",
"dwStartHour_label" => "Start hour in Day/Week view",
"dwStartHour_text" => "Hour at which a normal day of events starts.<br>E.g., setting this value to 6 will avoid wasting space in Week/Day view for the quiet time between midnight and 6:00.",
"dwEndHour_label" => "End hour in Day/Week view",
"dwEndHour_text" => "Hour at which a normal day of events ends.<br>E.g., setting this value to 18 will avoid wasting space in Week/Day view for the quiet time between 18:00 and midnight.",
"dwTimeSlot_label" => "Time slot in Day/Week view",
"dwTimeSlot_text" => "Number of minutes for the time slot in Day/Week view.<br>This value, together with the Start hour and End hour (see above) will determine the number of rows in Day/Week view.",
"dwTsHeight_label" => "Time slot height",
"dwTsHeight_text" => "Number of pixels for the time slot in Day/Week view.",
"eventHBox_label" => "Event details hover box",
"eventHBox_text" => "If enabled an overlay with event details will pop up when the user hovers an event square in Year view or an event title in Month, Week or Day view.",
"weekNumber_label" => "Display week numbers",
"weekNumber_text" => "Displaying week numbers in Year, Month and Week view can be switched on or off",
"showAdEd_label" => "Show date added/edited of events",
"showAdEd_text" => "Show the date the event was added/edited and the user who added/edited the event in:<br>- the Upcoming view<br>- the Changes view<br>- the events on the Text Search page<br>- RSS feeds<br>- email notifications.",
"showCatName_label" => "Show category name",
"showCatName_text" => "Display the category name (in addition to the color-coded event title) in various views.",
"showLinkInMV_label" => "Show links in month view",
"showLinkInMV_text" => "Display URLs in the event description as a hyperlink in various views.",
"eventColor_label" => "Event colors based on",
"eventColor_text" => "Events in the various calendar views can be displayed in the color assigned to the user who created the event or the color of the event category.",
"owner_color" => "owner color",
"cat_color" => "category color",

//settings.php - date/time settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"dateFormat_label" => "Event date format",
"dateFormat_text" => "Format of event dates in the calendar views and input fields.",
"dateUSorEU_label" => "Calendar date/time format",
"dateUSorEU_text" => "Format of the dates and times in the headers of the calendar views.",
"dateSep_label" => "Date separator",
"dateSep_text" => "Date separator for dates in the calendar views and input fields.",
"time24_label" => "Time format (12 or 24-hour)",
"time24_text" => "Format of times in the calendar views and input fields.",
"weekStart_label" => "First day of the week",
"weekStart_text" => "A week can start with Sunday or Monday.",
"date_format_us" => "Monday, May 15, 2010 (US)",
"date_format_eu" => "Monday 15 May 2010",
"dot" => "dot",
"slash" => "slash",
"hyphen" => "hyphen",
"time_format_us" => "12-hour AM/PM",
"time_format_eu" => "24-hour",
"sunday" => "Sunday",
"monday" => "Monday",
"time_zones" => "TIME ZONES",
"dd_mm_yyyy" => "dd-mm-yyyy",
"mm_dd_yyyy" => "mm-dd-yyyy",
"yyyy_mm_dd" => "yyyy-mm-dd",

//login.php
"log_log_in" => "Log In",
"log_remember_me" => "Remember me",
"log_register" => "Register",
"log_change_my_data" => "Change my data",
"log_change" => "Change",
"log_un_or_em" => "Username or Email",
"log_un" => "Username",
"log_em" => "Email",
"log_pw" => "Password",
"log_new_un" => "New Username",
"log_new_em" => "New Email",
"log_new_pw" => "New Password",
"log_pw_msg" => "Here is your password to log in to",
"log_pw_subject_pre" => "Your",
"log_pw_subject_post" => "Password",
"log_npw_msg" => "Here is your new password to log in to",
"log_npw_subject_pre" => "Your New",
"log_npw_subject_post" => "Password",
"log_npw_sent" => "Your new password has been sent",
"log_registered" => "Registration successful - Your password has been sent to you via email",
"log_not_registered" => "Registration not successful",
"log_un_exists" => "Username already exists",
"log_em_exists" => "Email address already exists",
"log_un_invalid" => "Invalid username (min length 2: A-Z, a-z, 0-9, and _-.) ",
"log_em_invalid" => "Invalid email address",
"log_un_em_invalid" => "The username/email is not valid",
"log_un_em_pw_invalid" => "The username/email or password is not valid",
"log_no_un_em" => "Please enter your username/email",
"log_no_un" => "Please enter your username",
"log_no_em" => "Please enter your email address",
"log_no_pw" => "Please enter your password",
"log_no_rights" => "Login rejected: you have no view rights - Contact the administrator",
"log_send_new_pw" => "Send New Password",
"log_if_changing" => "Only if changing",
"log_no_new_data" => "No data to change",
"log_invalid_new_un" => "Invalid new username (min length 2: A-Z, a-z, 0-9, and _-.) ",
"log_new_un_exists" => "New username already exists",
"log_invalid_new_em" => "New email address invalid",
"log_new_em_exists" => "New email address already exists",
"log_ui_language" => "User interface language",
"log_new_reg" => "New user registration",
"log_date_time" => "Date / time",
"log_reload_retry" => "Time-out. Please close this window, reload the calendar and try again",

//categories.php
"cat_list" => "List of Categories",
"cat_edit" => "Edit",
"cat_delete" => "Delete",
"cat_add_new" => "Add New Category",
"cat_add" => "Add",
"cat_edit_cat" => "Edit Category",
"cat_name" => "Category name",
"cat_sequence" => "Sequence",
"cat_in_menu" => "in menu",
"cat_text_color" => "Text Color",
"cat_background" => "Background",
"cat_select_color" => "Select Color",
"cat_save" => "Save",
"cat_added" => "Category Added",
"cat_updated" => "Category Updated",
"cat_deleted" => "Category Deleted",
"cat_invalid_color" => "Color format invalid (#XXXXXX where X = HEX-value)",
"cat_not_added" => "Category Not Added",
"cat_not_updated" => "Category not updated",
"cat_not_deleted" => "Category not deleted",
"cat_nr" => "#",
"cat_repeat" => "Repeat",
"cat_every_day" => "every day",
"cat_every_week" => "every week",
"cat_every_month" => "every month",
"cat_every_year" => "every year",
"cat_public" => "Public",
"cat_check_mark" => "Check mark",
"cat_label" => "label",
"cat_mark" => "mark",
"cat_name_missing" => "Category name is missing",//<<
"cat_mark_label_missing" => "Check mark/label is missing",//<<

//users.php
"usr_list_of_users" => "List of Users",
"usr_name" => "Username",
"usr_email" => "Email",
"usr_password" => "Password",
"usr_rights" => "Rights",
"usr_language" => "Language",
"usr_ui_language" => "User interface language",
"usr_edit_user" => "Edit User Profile",
"usr_add" => "Add User",
"usr_edit" => "Edit",
"usr_delete" => "Delete",
"usr_view" => "View",
"usr_post_own" => "Post own",
"usr_post_all" => "Post all",
"usr_admin" => "Admin",
"usr_login_0" => "First login",
"usr_login_1" => "Last login",
"usr_login_cnt" => "Logins",
"usr_add_profile" => "Add Profile",
"usr_upd_profile" => "Update Profile",
"usr_not_found" => "User not found",
"usr_if_changing_pw" => "Only if changing the password",
"usr_admin_functions" => "Admin functions",
"usr_no_rights" => "No access rights",
"usr_view_calendar" => "View calendar",
"usr_post_events_own" => "Post + edit own events",
"usr_post_events_all" => "Post + edit all events",
"usr_pw_not_updated" => "Password not updated",
"usr_added" => "User added",
"usr_updated" => "User profile updated",
"usr_deleted" => "User deleted",
"usr_not_added" => "User not added",
"usr_not_updated" => "User not updated",
"usr_not_deleted" => "User not deleted",
"usr_cred_required" => "Username, Email and Password are required",
"usr_uname_exists" => "Username already exists",
"usr_email_exists" => "Email address already exists",
"usr_un_invalid" => "Invalid username (min length 2: A-Z, a-z, 0-9, and _-.) ",
"usr_em_invalid" => "Invalid email address",
"usr_cant_delete_yourself" => "You cannot delete yourself",
"usr_background" => "Background color",
"usr_select_color" => "Select Color",
"usr_invalid_color" => "Color format invalid (#XXXXXX where X = HEX-value)",

//database.php
"mdb_dbm_functions" => "Database Functions",
"mdb_noshow_tables" => "Cannot get table(s)",
"mdb_compact" => "Compact database",
"mdb_compact_table" => "Compact table",
"mdb_compact_error" => "Error",
"mdb_compact_done" => "Done",
"mdb_purge_done" => "Deleted events permanently purged from the database",
"mdb_repair" => "Check and repair database",
"mdb_check_table" => "Check table",
"mdb_ok" => "OK",
"mdb_nok" => "Not OK",
"mdb_nok_repair" => "Not OK, repair started",
"mdb_backup" => "Backup database",
"mdb_backup_table" => "Backup table",
"mdb_backup_done" => "Done",
"mdb_file_saved" => "Backup file saved on server.","mdb_file_name" => "File name:","mdb_start" => "Start",
"mdb_no_function_checked" => "No function(s) selected",
"mdb_write_error" => "Writing backup file failed<br>Check permissions of 'files/' directory",

//import/export.php
"iex_file" => "Selected file",
"iex_file_name" => "iCal file name",
"iex_file_description" => "iCal file description",
"iex_filters" => "Event Filters",
"iex_upload_ics" => "Upload iCal File",
"iex_create_ics" => "Create iCal File",
"iex_upload_csv" => "Upload CSV File",
"iex_upload_file" => "Upload File",
"iex_create_file" => "Create File",
"iex_download_file" => "Download File",
"iex_fields_sep_by" => "Fields separated by",
"iex_birthday_cat_id" => "Birthday category ID",
"iex_default_cat_id" => "Default category ID",
"iex_if_no_cat" => "if no category found",
"iex_import_events_from_date" => "Import events occurring as of",
"iex_see_insert" => "see instructions on the right",
"iex_no_file_name" => "File name missing",
"iex_inval_field_sep" => "invalid or no field separator",
"iex_no_begin_tag" => "invalid iCal file (BEGIN-tag missing)",
"iex_date_format" => "Event date format",
"iex_time_format" => "Event time format",
"iex_number_of_errors" => "Number of errors in list",
"iex_bgnd_highlighted" => "background highlighted",
"iex_verify_event_list" => "Verify Event List, correct errors and click",
"iex_add_events" => "Add Events to Database",
"iex_select_birthday_delete" => "Select Birthday and Delete check boxes as required",
"iex_select_delete_ignore" => "Select Delete check box to ignore event",
"iex_title" => "Title",
"iex_venue" => "Venue",
"iex_owner" => "Owner",
"iex_category" => "Category",
"iex_date" => "Date",
"iex_end_date" => "End date",
"iex_start_time" => "Start time",
"iex_end_time" => "End time",
"iex_description" => "Description",
"iex_birthday" => "Birthday",
"iex_delete" => "Delete",
"iex_events_added" => "events added",
"iex_events_dropped" => "events dropped (already present)",
"iex_db_error" => "Database error",
"iex_ics_file_error_on_line" => "iCal file error on line",
"iex_occurring_between" => "Occurring between",
"iex_changed_between" => "Added/modified between",
"iex_select_date" => "Select date",
"iex_select_start_date" => "Select start date",
"iex_select_end_date" => "Select end date",
"iex_all_cats" => "all categories",
"iex_all_users" => "all users",
"iex_no_events_found" => "No events found",
"iex_file_created" => "File created",
"iex_write error" => "Writing export file failed<br>Check permissions of 'files/' directory",

//lcalcron.php
"cro_sum_header" => "CRON JOB SUMMARY",
"cro_sum_trailer" => "END OF SUMMARY",

//eventchk.php
"evc_sum_title" => "EVENTS EXPIRED",
"evc_nr_deleted" => "Number of events deleted",

//notify.php
"not_sum_title" => "EMAIL REMINDERS",
"not_not_sent_to" => "Reminders sent to",
"not_no_not_dates_due" => "No notification dates due",
"not_all_day" => "All day",
"not_mailer" => "mailer",
"not_subject" => "Subject",
"not_event_due_in" => "The following event is due in",
"not_due_in" => "Due in",
"not_days" => "day(s)",
"not_date_time" => "Date / time",
"not_title" => "Title",
"not_sender" => "Sender",
"not_venue" => "Venue",
"not_description" => "Description",
"not_category" => "Category",
"not_status" => "Status",
"not_open_calendar" => "Open calendar",

//sendchg.php
"sch_sum_title" => "CALENDAR CHANGES",
"sch_nr_changes_last" => "Number of changes last",
"sch_report_sent_to" => "Report sent to",
"sch_no_report_sent" => "No report emailed",
"sch_days" => "day(s)",

//userchk.php
"usc_sum_title" => "USER ACCOUNTS EXPIRED",
"usc_nr_accounts_deleted" => "Number of accounts deleted",
"usc_no_accounts_deleted" => "No accounts deleted",

//explanations
"xpl_manage_db" =>
"<h4>Manage Database Instructions</h4>
<p>On this page the following functions can be selected:</p>
<h5>Check and repair database</h5>
<p>This function will scan the calendar tables and check for errors. If an error
is found, the error will be repaired, if possible.</p>
<p>If the calendar views don't show any problems, running this function once a 
year should be sufficient.</p>
<h5>Compact database</h5>
<p>When a user deletes an event, the event will be marked as 'deleted', but will 
not be removed from the database. The Compact Database function will permanently 
remove events deleted more than 30 days ago from the database and free the space 
occupied by these events.</p>
<h5>Back up database</h5>
<p>This function will create a backup of the full calendar database (tables, 
structure and contents) in .sql format. The backup will be saved in the 
<strong>files/</strong> directory with file name: 
<kbd>cal-backup-yyyymmdd-hhmmss.sql</kbd> (where 'yyyymmdd' = year, month, and 
day, and hhmmss = hour, minutes and seconds.</p>
<p>The database (structure and data) can be recreated with this file. 
<strong>phpMyAdmin</strong> is one of the more popular tools provided by web 
hosts to accomplish the import process.</p>",

"xpl_import_csv" =>
"<h4>CSV Import Instructions</h4>
<p>This form is used to import a CSV (Comma Separated Values) text file containing 
event data into the LuxCal Calendar</p>
<p>The order of columns in the CSV file must be: title, venue, category id (see 
below), date, end date, start time, end time and description. The first row of the 
CSV file, used for column headers, is ignored.</p>
<h5>Sample CSV files</h5>
<p>Sample CSV files (file extension .csv) can be found in the 'files/' directory 
of your LuxCal installation.</p>
<h5>Date and time format</h5>
<p>The selected event date format and event time format on the left must match the 
format of the dates and times in the uploaded CSV file.</p>
<h5>Table of Categories</h5>
<p>The calendar uses ID numbers to specify categories. The category IDs in the CSV 
file should correspond to the categories used in your calendar or be blank.</p>
<p>If in the next step you want to earmark events as 'birthday', the <strong>Birthday 
category ID</strong> must be set to the corresponding ID in the category list below.</p>
<br>
<p>For your calendar, the following categories have currently been defined:</p>",

"xpl_import_ical" =>
"<h4>iCalendar Import Instructions</h4>
<p>This form is used to import an <strong>iCalendar</strong> event file into 
the LuxCal Calendar.</p>
<p>The file contents must meet the [<u><a href='http://tools.ietf.org/html/rfc5545' 
target='_blank'>RFC5545 standard</a></u>] of the Internet Engineering Task Force.</p>
<p>Only events will be imported; other iCal components, like: To-Do, Journal, Free / 
Busy, Time zone and Alarm, will be ignored.</p>
<h5>Sample iCal files</h5>
<p>Sample iCalendar files (file extension .ics) can be found in the 'files/' 
directory of your LuxCal download.</p>
<h5>Table of Categories</h5>
<p>The calendar uses ID numbers to specify categories. The category IDs in the 
iCalendar file should correspond to the categories used in your calendar or be 
blank.</p>
<br>
<p>For your calendar, the following categories have currently been defined:</p>",

"xpl_export_ical" =>
"<h4>iCalendar Export Instructions</h4>
<p>This form is used to extract and export <strong>iCalendar</strong> events from 
the LuxCal Calendar.</p>
<p>Files will be created in the 'files/' directory on the server with the 
specified filename (no extension). (The filename extension is <b>.ics</b> and 
if not specified, the default filename is 'luxcal'.
Existing files in the 'files/' directory on the server with the same name will 
be overwritten by the new file.</p>
<p>The <b>iCal file description</b> (e.g. 'Meetings 2012') is optional. If 
entered, it will be added to the header of the exported iCal file.</p>
<p><b>Event filters</b>: The events to be extracted can be filtered by:</p>
<ul>
<li>event owner</li>
<li>event category</li>
<li>event start date</li>
<li>event added/last modified date</li>
</ul>
<p>Each filter is optional. A blank date means: no limit</p>
<br>
<p>The content of the file with extracted events will meet the 
[<u><a href='http://tools.ietf.org/html/rfc5545' target='_blank'>RFC5545 standard</a></u>] 
of the Internet Engineering Task Force.</p>
<p>When <b>downloading</b> the exported iCal file, the date and time will be 
added to the name of the downloaded file.</p>
<h5>Sample iCal files</h5>
<p>Sample iCalendar files (file extension .ics) can be found in the 'files/' 
directory of your LuxCal download.</p>"
);
?>
