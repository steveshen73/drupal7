<?php
/*
= LuxCal event calendar on-line user guide =

Ins Deutsche übersetzt von Ulrich Krause.
2011-05-15 - aktualisiert von Alfred Bruckner - letztes Update 27.3.2012

© Copyright 2009-2012 LuxSoft - www.LuxSoft.eu
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

//LuxCal ug language file version
define("LUG","2.7.1");

?>
<div class="floatR">
<img src="lang/ug-layout.png" alt="LuxCal page layout"/><br>
a: Titelzeile&nbsp;&nbsp;b: Navigationszeile&nbsp;&nbsp;c: Kalender&nbsp;&nbsp;d: Tag
</div>
<br>
<div  style="margin:0 20px">
<h4>Inhaltsverzeichnis</h4>
<ol>
<li><p><a href="#ov">Übersicht</a></p></li>
<li><p><a href="#li">Einloggen</a></p></li>
<li><p><a href="#co">Kalenderoptionen</a></p></li>
<li><p><a href="#cv">Kalenderansichten</a></p></li>
<li><p><a href="#ts">Text Suche</a></p></li>
<?php if ($privs > 1) { //if post rights ?>
<li><p><a href="#ae">Termine hinzufügen, bearbeiten und löschen</a></p></li>
<?php } ?>
<li><p><a href="#lo">Ausloggen</a></p></li>
<?php if ($admin) { //if administrator ?>
<li><p><a href="#ca">Kalenderadministration</a></p></li>
<?php } ?>
<li><p><a href="#al">Über LuxCal</a></p></li>
</ol>
</div>
<div class="help">
<br>
<ol>
<li id="ov"><h4>Übersicht</h4>
<p>Der LuxCal Kalender läuft auf einem Webserver und wird über einen Webbrowser ausgeführt und konfiguriert. Die oberste Zeile, die Titelzeile, zeigt den Kalendernamen, das Datum und den Namen des momentanen Benutzers.
Direkt unterhalb erscheint die Navigationszeile mit verschiedenen ausklappbaren Menüs und den Links zur Navigation sowie dem Ein- bzw. Ausloggen, hinzufügen von Terminen und den Administratorfunktionen. Welche Menüs angezeigt und ausgewählt werden können hängt von der jeweiligen Berechtigung ab. Unterhalb der Navigationszeile werden die verschiedenen Kalenderansichten dargestellt.</p>
<br></li>
<li id="li"><h4>Einloggen</h4>
<p>Falls der Kalender vom Administrator für öffentlichen Zugriff (Öffentliche Ansicht) konfiguriert wurde entfällt das Einloggen.
Ansonsten klickt man auf "Einloggen" auf der rechten oberen Menüleiste. Es erscheint ein Anmeldemenü zur Eingabe des Benutzernamens oder der Emailadresse (nur eines von beiden wird benötigt) sowie dem Passwort welches man vom Administrator erhalten hat. Nach Eingabe der Parameter auf das darunterliegende
"Einloggen" klicken. Wenn man  "Automatisch Einloggen" vor dem Einloggen aktiviert, wird man beim nächsten Aufruf der Kalenders automatisch eingeloggt. Hat man sein Passwort vergessen, klickt man auf "Einloggen" und danach auf den Link "Sende neues Passwort".
Man kann seine Emailadresse und das Passwort ändern, indem man auf der rechten Seite eine neue Emailadresse und ein neues Passwort eingibt.
Hat der Administrator Leserechte für die "Öffentliche Ansicht" vergeben, kann der Kalender ohne Einloggen eingesehen werden.</p>
<br></li>
<li id="co"><h4>Kalenderoptionen</h4>
<p>Durch klicken auf die Optionen Schaltfläche öffnet sich ein Dialog zur Einstellung der Anzeige Optionen. Es können folgende Optionen ausgewählt werden:</p>
<ul style="margin:0 20px">
<li><p>Die Kalender Darstellung (Jahr, Monat, Woche, Tag, Anstehend oder Änderungen).</p></li>
<li><p>Ein Filter basierend auf den Ersteller der Termine. Ein oder mehrere Benutzer Namen können ausgewählt werden.</p></li>
<li><p>Ein Filter basierend auf der Termin Kategorie. Ein oder mehrere Kategorien können ausgewählt werden.</p></li>
<li><p>Die Sprache der Kalenderoberfläche.</p></li>
</ul>
<p>Anmerkung: Ob die Terminfilter und die Anzeige zur Auswahl der Sprache angezeigt wird kann vom Administrator einzeln konfiguriert werden.</p>
<br></li>
<li id="cv"><h4>Kalenderansichten</h4>
<p>In allen Ansichten werden durch überfahren mit dem Mauszeiger (sog. mouseover) nähere Details des Termins angezeigt. Für private Termine wird die Hintergrundfarbe der Popup-Box hellgrün In der "Anstehend" Ansicht führen eventuell im Feld "Beschreibung" angegebene URL's zu den dazugehörigen Webseiten.</p>
<?php if ($privs > 1) { //if post rights ?>
Mit den korrekten Rechten ist folgendes möglich:
<ul style="margin:0 20px">
<li><p>In allen Ansichten öffnet sich durch Anklicken des Termins ein Fenster um diesen Termin anzuschauen, zu bearbeiten oder zu löschen.</p></li>
<li><p>In der Jahres- und Monatsansicht kann ein Termin durch Klicken auf das gewünschte Tagesdatum hinzugefügt werden.</p></li>
<li><p>In der Wochen- und Tagesansicht kann ein Termin durch Ziehen der Maus über eine bestimmte Zeitspanne (Termindauer) hinzugefügt werden.</p></li>
</ul>
<p>Um einen Termin zu ändern kann man durch Anklicken des Eintrages Zeit und/oder Datum anpassen.</p>
<p>Wenn vom Administrator eine oder zwei Chaeckboxen für Kategorien aktiviert wurden, können diese aktiviert oder deaktiviert werden. Das kann dazu bemutzt werden um z.B. Termine als "geprüft" oder "beendet" zu kennzeichnen.</p>
<?php } ?>
<br></li>
<li id="ts"><h4>Text Suche</h4>
<p>Durch betätigen der Schaltfläche mit dem Dreieckes auf der rechten Seite der Navigationsleiste gelangt man zur Text Suche. Auf dieser Seite kann die Text Suche definiert werden. Diese Seite enthält eine ausführliche Anleitung.</p>
<br></li>
<?php if ($privs > 1) { //if post rights ?>
<li id="ae"><h4>Termine hinzufügen, löschen und bearbeiten</h4>
<p>Termine hinzufügen, bearbeiten und löschen wird in dem "Terminfenster" durchgeführt, das auf mehrere Weisen, wie anschließend erklärt, geöffnet werden kann.</p>
<br><h5>a. Termine hinzufügen</h5>
<p>Termine können auf verschiedene Arten hinzugefügt werden:</p>
<ul style="margin:0 20px">
<li><p>Durch klicken auf die "Termin hinzufügen" Schaltfläche in der Navigationsleiste</p></li>
<li><p>Durch klicken auf den oberen Teil des betreffenden Tages in der Jahres- oder Monatsansicht</p></li>
<li><p>Durch ziehen der Maus über die gewünschte Dauer des Termins in der Wochen- oder Tagesansicht</p></li>
</ul>
<p>Jede dieser Möglichkeiten öffnet ein Terminfenster zur Eingabe der Termindaten. Bestimmte Felder sind je nach der oben gewählten Art schon vorausgefüllt.</p>
<h6>Titel, Ort, Kategorie, Beschreibung und Privat Felder</h6>
<p>Der Titel, Ort und Beschreibung sind optional. Wählt man eine Kategorie wird dieser Termin farblich passend unterlegt. Ort und Beschreibung werden in den Ansichten durch Überfahren mit dem Mauszeiger sichtbar. Private Termine sind nur für sich selbst und keiner anderen Benutzer sichtbar.</p>
<p>URLs welche in der Terminbeschreibung eingegeben sind, werden automatisch zu Hyperlinks konvertiert. Diese können in der „Monatsansicht“, den „Anstehende Termine“ sowie den Erinnerungsemails angewählt werden. </p>
<h6>Datum, Zeit und Wiederholung Felder</h6>
<p>Hier können das Datum und die Zeiten eingetragen werden. Wird ein "Ganztags" Termin gewählt können keine Zeiten eingetragen werden. Das Enddatum ist optional und wird für mehrtägige Termine verwendet. Datum und Zeit kann entweder von Hand eingetragen werden oder über den sich öffnenden Minikalender und den Zeitvorgaben gewählt werden. Anschließend an die Datum und Zeit Felder können Termine über ein weiteres Eingabefenster als wiederholend definiert werden. Das Fenster öffnet sich durch Klicken auf die "Ändern" Schaltfläche. In diesem Fall wird der Termin vom eingetragenen Start- bis hin zum Enddatum turnusmäßig wiederholt. Bleibt das Enddatum leer wiederholt sich der Termin für immer was z.B. für Geburtstage nützlich ist.</p>
<h6>Benachrichtigungseinrichtung Felder</h6>
<p>Hier kann man über eine sog. Erinnerungsfunktion durch Eintragen von einer oder mehreren Emailadressen eine Erinnerungsmail an die betreffende(n) Person(en) senden. Hierzu kann man die Tage im Voraus bestimmen und am Tag des Termins wird zusätzlich noch eine Erinnerungsmail versendet. Wenn 0 Tage angegeben wird, wird nur am Tag des Termins ein Email verschickt. Dies gilt auch jedes Mal für sich wiederholende Termine.</p>
<p>Das Email Feld kann Email Adressen und/oder den Namen (ohne Dateierweiterung) einer vordefinierten Email Liste enthalten. Alle Einträge werden durch ein Semikolon getrennt. Die vordefinierte Email Liste ist eine Text Datei (Dateierweiterung .txt) im "emlists/" Verzeichnis mit einer Email Adresse pro Zeile. Der Dateiname darf kein "@" Zeichen enthalten.</p>
<p>Nach Fertigstellung der Eintragungen auf "Hinzufügen" klicken.</p>
<br>
<h5>b. Termine bearbeiten und löschen</h5>
<p>In jeder Kalenderansicht kann ein Termin durch Anklicken angesehen, bearbeitet, dupliziert oder gelöscht werden. Abhängig von den Zugriffsrechten kann man eigene, alle, oder sogar Termine anderer Benutzer sehen, bearbeiten, duplizieren und löschen. Für eine Beschreibung der Felder siehe oben - "Termin hinzufügen".
Unten im "Termin bearbeiten" Fenster hat man durch die Schaltflächen die Möglichkeit einen geänderten Termin zu speichern, als neuen Termin zu speichern (um z.B. einen Termin auf ein neues Datum zu kopieren) oder den Termin zu löschen.
<strong> ACHTUNG: "Termin löschen", löscht diesen ohne vorherige Warnung oder Nachfrage. Löschen eines sich wiederholenden Termins löscht die ganze Serie.</strong></p>
<br></li>
<?php } ?>
<li id="lo"><h4>Ausloggen</h4>
<p>Um den Kalender zu verlassen klickt man auf "Ausloggen" auf der rechten oberen Menuleiste. Wenn man ohne Ausloggen den Kalender verlässt, kann es vorkommen, dass dieser beim nächsten Mal eingeloggt startet. </p>
<br></li>
<?php if ($admin) { //administrator only ?>
<li id="ca"><h4>Kalenderadministration</h4>
<p>- Die folgenden Eigenschaften verlangen Administrationsrechte -</p>
<p>Wenn sich ein Benutzer mit Administrationsrechten einloggt erscheint auf der rechten Seite in der Navigationsleiste das Administrationsmenu.
Über dieses Menü sind folgende Adminfunktionen verfügbar:</p>
<br>
<h5>a. Einstellungen</h5>
<p>Dieses Fenster zeigt die gegenwärtigen Kalender-Einstellungen, die geändert werden können. Alle möglichen Einstellungen werden auf dieser Seite durch Überfahren mit dem Mauszeiger erklärt.</p>
<br>
<h5>b. Kategorien</h5>
<p>Das Hinzufügen von Kategorien in verschiedenen Farben (nicht zwingend notwendig) kann die Ansicht des Kalenders übersichtlicher gestalten. Beispiele von möglichen Kategorien sind "Urlaub", "Stammtisch", "Geburtstage", "Wichtig", usw.
Über das Auswählen von "Kategorien" im Administrationsmenü erhält man eine Liste aller Kategorien und der Möglichkeit, "neue Kategorien hinzufügen" oder vorhandene Kategorien zu bearbeiten bzw. zu löschen. Die anfängliche Installation hat eine Defaultkategorie. Das Bearbeiten bzw. Löschen von bereits vorhandenen Kategorien erfolgt ebenfalls über das Administrationsmenu. Die Reihenfolge der Anzeige erfolgt über die vergebene Reihenfolgennummer. Mit den Feldern "Text Farbe" und "Hintergrund" kann man die Farben der Kategorien, wie sie im Kalender angezeigt werden sollen, wählen.</p>
<p>Es kann eine Wiederholung konfiguriert werden. Termine in dieser Kategorie werden wie gewählt automatisch wiederholt.<br>Mit der Checkbox "Öffentlich" können Termine für den öffentlichen Benutzer (nicht eingeloggt) verborgen und vom RSS Feed ausgeschlossen werden.</p>
<p>Eine oder zwei Check Boxen, die vor den Termin Titeln dieser Kategorie angezeigt werden, können aktiviert werden. Der Benutzer kann dadurch z.B. Termine als "geprüft" oder "beendet" kennzeichnen.</p>
<p>Löscht man eine Kategorie werden alle ihr zugehörigen Daten in der Defaultkategorie angezeigt.</p>
<br>
<h5>c. Benutzer</h5>
<p>Über diese Seite werden Benutzerkonten angezeigt, hinzugefügt und bearbeitet. Zwei Hauptparameter können eingestellt werden: Name / E-Mail / Kennwort des Benutzers und dessen Zugriffsrechte. Mögliche Rechte sind: "Keine Rechte", "Kalender anzeigen", "Erstelle, bearbeite eigene Termine", "Erstelle, bearbeite alle Termine" und "Administrator Funktionen". Weitere Informationen über die Rechte erhält man bei öffnen des Fensters "Benutzer hinzufügen". Wenn vom Benutzer gewünscht, muss dessen gültige Emailadresse eingetragen werden um ihm Ankündigungen von Fälligkeitstagen und Terminen per Email zu senden.</p>
<p>Wenn "Eigene Anmeldung" aktiviert ist, können sich Benutzer über das Web Interface selbst für die Kalenderbenützung registrieren. Über die Einstellungen kann der Administrator die "Eigene Anmeldung" konfigurieren und die Zugriffsrechte für selbst angemeldete Benutzer wählen.</p>
<p>Bei einem Kalender ohne öffentlichem Zugriff (Öffentliche Ansicht) müssen sich die Benutzer mit ihrem Benutzernamen oder E-Mail und Kennwort einloggen. Abhängig vom Typ des Benutzers können an einen Benutzer verschiedene Zugriffsrechte vergeben werden.</p>
<p>Für jeden Benutzer kann eine Sprache für die Benutzerschnittstelle voreingestellt werden. Wenn keine Sprache gewählt wurde, wird die in den Kalendereinstellungen gewählte Sprache verwendet.</p>
<br>
<h5>d. Datenbank</h5>
<p>Die Datenbank Seite erlaubt dem Administrator folgende Funktionen auszuführen:</p>
<ul>
<li>Prüfen und Reparieren der Datenbank um Fehler in den Tabellen zu finden und sie zu reparieren.</li>
<li>Datenbank komprimieren um unbenutzten Speicherplatz freizugeben und Overhead zu vermeiden. Diese Funktion löscht vor länger als 30 Tagen gelöschte Termine endgültig.</li>
<li>Datenbank Backup, um ein Backup für eine allfällige Wiederherstellung der Tabellenstruktur und Inhalte zu erstellen.</li>
</ul>
<p>Die erste Funktion "Prüfen und reparieren" braucht nur aufgerufen zu werden, falls die Kalenderanzeige nicht korrekt ist. Die zweite Funktion "Komprimieren" könnte jährlich aufgerufen werden um die Datenbank zu komprimieren. Die dritte Funktion "Backup" sollte öfters verwendet werden, abhängig von der Häufigkeit der Änderungen der Termine.</p>
<br>
<h5>e. CSV Datei importieren</h5>
<p>Diese Funktion kann verwendet werden um in den LuxCal Kalender Termindaten zu importieren welche von anderen Kalendern (z.B. Microsoft Outlook) exportiert worden sind. Weitere Informationen findet man auf der CSV Import Seite.</p>
<br>
<h5>f. iCal Datei Import</h5>
<p>Diese Funktion kann verwendet werden um Termine von iCal Dateien (Dateierweiterung .ics) in den Kalender zu importieren. Weitere Informationen findet man auf der iCal Import Seite. Nur Termine die mit dem LuxCal Kalender kompatibel sind, können importiert erden, wie z.B.: To-Do, Journal, Frei / Gebucht. Zeitzone und Alarm werden ignoriert.</p>
<br>
<h5>g. iCal Datei Export</h5>
<p>Diese Funktion kann verwendet werden um Termine von iCal Dateien (Dateierweiterung .ics) in den Kalender zu exportieren. Weitere Informationen findet man auf der iCal Import Seite.</p>
<br></li>
<?php } ?>
<li id="al"><h4>Über LuxCal</h4>
<p>Programmiert von: <b>Roel B.</b>&nbsp;&nbsp;&nbsp;&nbsp;Webseite und Forum: <b><a href="http://www.luxsoft.eu/" target="_blank">www.luxsoft.eu/</a></b></p>
<p>LuxCal ist freie Software und darf unter Einhaltung der <b><a href="http://www.luxsoft.eu/index.php?pge=gnugpl" target="_blank">GNU General Public License</a></b> verbreitet und verändert werden.</p>
<br></li>
</ol>
</div>