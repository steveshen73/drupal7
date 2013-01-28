<?php
/*
= LuxCal event calendar on-line user guide =

Oversatt til norsk av Ove Almåsbakk. Kommentarer, forbedringsforslag osv kan sendes til ovealmasbakk@yahoo.no

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
<div  class="floatR">
<img src="lang/ug-layout.png" alt="LuxCal page layout"/><br>
a: titelbjælk&nbsp;&nbsp;b: navigationsbjælk&nbsp;&nbsp;c: kalender&nbsp;&nbsp;d: dag
</div>
<br>
<div  style="margin:0 20px">
<h4>Indholdsfortegnelse</h4>
<ol>
<li><p><a href="#ov">Oversikt</a></p></li>
<li><p><a href="#li">Logge på</a></p></li>
<li><p><a href="#ae">Legge til begivenhet</a></p></li>
<li><p><a href="#ee">Editere / slette begivenhet</a></p></li>
<li><p><a href="#co">Kalenderoptions</a></p></li>
<li><p><a href="#cv">Kalendertyper</a></p></li>
<li><p><a href="#ts">Text Search</a></p></li>
<li><p><a href="#lo">Logge av</a></p></li>
<li><p><a href="#ca">Kalender administrasjon</a></p></li>
<li><p><a href="#al">About LuxCal</a></p></li>
</ol>
</div>
<div class="help">
<br>
<ol>
<li id="ov"><h4>Oversikt</h4>
<p>LuxCal kalenderen kjører på en webserver og kan ses og administreres via din webbrowser.</p>
<p>Titelbaren viser kalenderens titel, datoen og navnet på den aktuelle bruker.
Like under titelbaren finnes navigasjonsbaren med flere drop-down menyer og linker til og navigere med, til og logge på og av, legge til en begivenhet og velge administratorfunksjoner. Hvilke menyer og linker, som vises, avhenger av brukerens rettigheter.
Under navigasjonbaren vises de forskellige kalendertypene</p>
<br></li>
<li id="li"><h4>Logge på</h4>
<p>For og bruke kalenderen logg på i høyre side av navigasjonsbaren. Dermed kommer du til login-skærmen. Indtast dit brugernavn eller din email-adresse (en af de to) og det password, som du fik fra administratoren og klok så på Log ind. If you select "Remember me" before clicking Log In, next times you launch the calendar you will be automatically logged in. Hvis du har glemt dit password, klik på Log ind og derefter på linket for at få tilsendt et nyt password.</p>
<p>Du kan endre din email-adresse og ditt password ved og taste ditt brukernavn/email og aktuelle password samt en ny email-adresse og et nytt password.</p>
<p>Hvis kalender-administratoren har gitt offentlig adgang til kalenderen, kan kalenderen ses uten og logge på.</p>
<br></li>
<li id="ae"><h4>Legge til begivenhet</h4>
<p>Begivenheter kan legges til på flere forskellige måter:</p>
<ul style="margin:0 20px">
<li><p>ved og klikke på knappen Legge til begivenhet i navigasjonsbaren</p></li>
<li><p>ved og klikke øverst i cellen for en dag på en års- eller månedskalender</p></li>
<li><p>ved og trykke hen over en del af en dag i en uge- eller dagskalender</p></li>
</ul>
<p>Hver metode vil fremkalle vinduet Begivenhet med en formular, hvor informasjon om begivenheter inntastes. Noen felt i formularen er allerede utfylt, alt etter, hvilken av ovenstående metoder, som ble brukt.</p>
<p>I øverste del av formularen inntastes titel, sted, kategori og en beskrivelse, og muligheten Privat kan velges. Titlen bør være kort og detaljerne plaseres under beskrivelse. Feltene sted og kategori er frivillige. Hvis man velger en kategori, får begivenheten en fargekode i alle kalendere alt etter kategorifargen. Stedet og beskrivelsen vises, når musen føres over begivenheten  i kalenderen. En privat begivenhet er kun synlig for deg selv og ikke for andre.</p>
<p>Internet-adresser lagt til i begivenhetsbeskrivelsen, i formatet [ url | navn ] (for eksempel [www.minside.com | mitt navn]), omdannes automatisk til linker, som kan velges i månedsvisning, kommende begivenheter og annonserings-emails.</p>
<p>I andre halvdel av formularen kan datoer og tidspunkter angies. Hvis Hele dagen velges, vises ingen tidspunkter i kalenderen. Siste dato er frivillig og kan brukes til begivenheter, som går over flere dager. Datoer og tider kan inntastes manuelt eller via dato- og tidsvalgsknapperne. Hvis det ikke føres noen sluttdato, gjentakes begivenheten evig, som er praktisk til bursdager.</p>
<p>I den nederste delen av formularen, med alarm-funksjonen, kan du velge og sende en email-påminnelse til en eller flere email-adresser direkte, hvis "nå" boksen er sjekket, og/eller ett anntall dager før selve datoen for begivenheten. Sendes en email på selve dagen for begivenheten. For begivenheter, som gjentakes sendes en email det valgte antall dager før hver gang begivenheten gjentakes og på selve datoen for hver gjentakelse.</p>
<p>Når alt er udfyldt, tryk på Tilføj begivenhed.</p>
<br></li>
<li><a id="ee"></a><h4>Editere / slette begivenhet</h4>
<p>I hver kalendertype, kan du klikke på en begivenhet for og se, editere eller slette den. Dermed åpnes vinduet Editer begivenhet, der ser du vinduet Legge til begivenhet beskrevet, bortset fra titlen og knappene nederst i vinduet.</p>
<p>Alt etter dine rettigheter, kan du se begivenheter, se/editere/slette dine egne begivenheter eller se/editere/slette alle begivenheter, under andre brukeres begivenheter.</p>
<p>For en beskrivelse av feltet se under Legg til begivenhet. Bemerk at ett klikk på Slett begivenhet straks sletter begivenheten fra kalenderen, <strong>uten å spørre om bekreftelse</strong>.</p>
<p>Sletringen av en begivenhet, som gjentaes sletter alle forekomster av begivenheten, ikke bare den valgte dato.</p>
<br></li>
<li id="co"><h4>Calendar Options</h4>
<p>Clicking the Options button on the navigation bar will open the calendar's Options Panel. On this panel you can select the following via check boxes:</p>
<ul style="margin:0 20px">
<li><p>The calendar view (year, month, week, day, upcoming or changes).</p></li>
<li><p>An event filter based on event owners. Events of one single owner or multiple owners can be selected.</p></li>
<li><p>An event filter based on event categories. Events in one single category or multiple categories can be selected.</p></li>
<li><p>The user interface language.</p></li>
</ul>
<p>Note: The display of the event filter menus and the language menu can be enabled/disabled by the calendar administrator.</p>
<p>After having made your choices in the Options Panel, the Options button in the navigation bar should be clicked again to activate your choices.</p> 
<br></li>
<li id="cv"><h4>Kalendertyper</h4>
<p>I alle typer vil flere detaljer om en begivenhet poppe opp, når musen beveges over den. For private events vil bakgrunns fargen på pop up vinduet forrandres til lys grønn. I typen kommende, vil URLs i beskrivelsesfeltet automatisk bli omdannet til links til den tilhørende websiden.</p>
<p>Events in a category for which the admin has activated one or two check boxes will have one or two check boxes displayed in front of the event title, which can be used to flag events for example as "approved" or "completed". When having sufficient rights, these check boxes can be clicked to check/uncheck them.</p>
<p>Hvis du har tilstrekkelige rettigheter:</p>
<ul style="margin:0 20px">
<li><p>I alle typer, når du klikker på en begivenhet, åpnes vinduet editer for denne begivenhet, hvor du så kan se, editere og slette begivenheten.</p></li>
<li><p>I måned og år kan en ny begivenhet legges til for en bestemt dato ved å klikke øverst i cellen for dagen (linien hvor datoen vises).</p></li>
<li><p>I uke og dag, kan Legge til-vinduet åpnes ved og trekke mus knappen over en del av dagen; feltene dato og tid fylles automatisk med den valgte periode.</p></li>
</ul>
<p>I forandringer, en startdato kan spesifiseres. En liste med alle begivenheter legges til, redigeres eller slettes, da den angivne startdato vises</p>
<p>For og flytte en begivenhet til en ny dato eller tid, lukk Editer-vinduet ved og klikke på begivenhedtn og forrandre på dato og tid. Begivenheter kan ikke trekkes til nye dager eller tider.</p>
<br></li>
<li id="ts"><h4>Text Search</h4>
<p>When clicking the button with the triangle on the right side in the navigation bar, the Text Search page will open. On this page the text search can be defined. The Text Search page contains detailed instructions.</p>
<br></li>
<li id="lo"><h4>Logge ut</h4>
<p>For og logge ut, klikk på Logg ut i navigasjonsbaren. Hvis du lukker kalenderen uten og logge ut, kan det skje, at du ikke blir bedt om og logg på neste gang kalenderen åpnes.</p>
<br></li>
<li id="ca"><h4>Kalenderadministrasjon</h4>
<p>- de følgende funksjoner krever administratorrettigheter -</p>
<p>Når en bruker logger inn med administratorrettigheter, vises en drop-down-menu kaldet Administration i høyre side av navigasjonbaren. I denne meny'en er følgende funksjoner tilgjengelige:</p>
<br>
<h5>a. Innstillinger</h5>
<p>Siden viser de aktuelle kalenderindstillinger, som derefter kan endres. Alle innstillinger forklares på siden Endre kalenderindstillinger. Siden gir en god beskrivelse av alle mulige innstillinger.</p>
<br>
<h5>b. Kategorier</h5>
<p>Når man legger til kategorier med forskjellig farge vil - selv om det ikke er nødvendig - forbedre oversikten over kalenderen. Mulige kategorier er 'ferie', 'avtaler', 'bursdager', 'viktig', etc.</p>
<p>Den opprinelige installasjonen har kun en kategori, som heter 'ingen'. Når du velger Kategorier fra administrationsmenyen, kommer du til en side med en liste med alle kategorier og muligheter for og legge til nye kategorier eller editere/slette eksisterende kategorier.</p>
<p>Når man legger til / editeres begivenheter, kan de definerede kategorier velges i en pull-down-liste. Den rekkefølge, hvor kategorier vises i listen bestemmes med sekvens-feltet.</p>
<p>One or two check marks can be activated, resulting in the calendar in the display of one or two check marks in front of the event title for all events in this category. The user can use these check marks to flag events for example as "approved" or "completed". The fields Text Color and Background define the colors used to display events in the calendar belonging to this category.</p>
<p>Når en kategori slettes, vil begivenheter som tilhører denne kategorien bli overført til kategorien 'ingen'.</p>
<br>
<h5>c. Brukere</h5>
<p>På brukersiden kan administratoren legge til og editere brukere samt deres kalenderrettigheter. To hovedområder kan editeres: brugkrens navn/email/passord og brukerens rettigheter. Mulige rettigheter er: Se, Sende egne, Sende alle og Admin. Det er viktig at bruken har gyldig email-adresse, så brukerne kan mota email-påmindelser om kommende begivenheder.</p>
<p>Via the Settings page, the administrator can enable "user self-registration" and set the access rights for self registered users. When self-registration is enabled, users can register to the calendar via the browser interface.</p> 
<p>Medmindre kalender-administratoren har givet Se-adgang til offentlige brukere, skal brukerne logge på med deres brukernavn eller email og password. Alt etter typen av bruker, kan brukeren få forskjellige adgangsrettigheter.</p>
<br>
<h5>d. Database</h5>
<p>The database page allows the calendar administrator to execute the following fucntions:</p>
<ul>
<li>Check and Repair the database, to find and solve inconsistencies in the database tables</li>
<li>Compact database, to free unused space and to avoid overhead</li>
<li>Backup database, to create a backup file which can be used to recreate the database tables structure and content</li>
</ul>
<p>The first function, Check and Repair database, only needs to be run when the calendar views don't work properly. The second function, Compact database, could be run once a year to clean up the database, and the third function, Backup database, should be run more frequently, depending on the number of calendar updates.</p>
<br>
<h5>e. CSV fil-import</h5>
<p>Denne funktion kan bruges til at importere begivenhedsdata til LuxCal kalenderen fra andre kalendere (f.eks. MS Outlook). Nærmere vejledning findes på CSV import-siden.</p>
<br>
<h5>f. iCal fil-import</h5>
<p>Denne funktion kan bruges til at importere begivenheder fra iCal-filer (filendelse .ics) til LuxCal-kalenderen. Mere vejledning findes på iCal-importsiden. Kun begivenheder, som er kompatible med LuxCal-kalenderen importeres. Andre komponenter, så som: To-Do, Jounal, Fri / optaget, Tidszone og Alarm, ignoreres.</p>
<br>
<h5>g. iCal fil-eksport</h5>
<p>Denne funktion kan bruges til at eksportere LuxCal-begivenheder til iCal-filer (filendelse .ics). Mere vejledning findes på iCal-eksportsiden.</p>
<br>
</li>
<li id="al"><h4>About LuxCal</h4>
<p>Produced by: <b>Roel B.</b>&nbsp;&nbsp;&nbsp;&nbsp;Website and forum: <b><a href="http://www.luxsoft.eu/" target="_blank">www.luxsoft.eu/</a></b></p>
<p>LuxCal is freeware and may be redistributed and/or modified under the terms of the <b><a href="http://www.luxsoft.eu/index.php?pge=gnugpl" target="_blank">GNU General Public License</a></b>.</p>
<br></li>
</ol>
</div>