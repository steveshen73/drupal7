<?php
//sanity check
if (!defined('LCC')) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //lounch via script only
?>
<table class="evtForm">
	<col width='80px'/><col width='100px'/><col width='110px'/><col/>
	<tr>
		<td><?php echo $xx['evt_title'];?>:</td>
		<?php
				$eColor = ($col or $bco) ? " style=\"color:".$col."; background:".$bco.";\"" : "";
				echo '<td colspan="3"><span'.$eColor.'>'.$tit."</span></td>\n";
		?>
	</tr>
	<tr>
		<td><?php echo $xx['evt_venue'];?>:</td>
		<td colspan="3"><?php echo $ven; ?></td>
	</tr>
	<tr>
		<td><?php echo $xx['evt_category'];?>:</td>
		<td><?php echo $cnm; ?></td>
		<td colspan="2"><?php echo ($pri ? $xx['evt_private_event'] : ''); ?></td>
	</tr>
	<tr>
	<td><?php echo $xx['evt_description']; ?>:</td>
	<td colspan="3"><?php echo $desHtml; ?></td>
	</tr>
	<tr><td colspan="4"><hr></td></tr>
	<tr>
		<td><?php echo $xx['evt_date_time'];?>:</td>
		<td colspan="3">
		<?php
		echo $sda.' '.($ald ? $xx['evt_all_day'] : $sti);
		if ($eda or $eti) { echo ' -'; }
		if ($eda) { echo ' '.$eda; }
		if ($eti) { echo ' '.$eti; }
		?>
		</td>
	</tr>
<?php
if ($r_t) {
	echo '<tr><td colspan="4">'.$repTxt."<br></td></tr>\n";
}
if ($not != "" and ($privs > 2 or ($privs == 2 and $uid == $_SESSION['uid']))) { //has rights to see email list
	echo '<tr><td colspan="4"><hr></td></tr>'."\n";
	echo "<tr>\n";
	echo '<td>'.$xx['evt_notify'].":</td>\n";
	echo '<td colspan="3">'.$not.' '.$xx['evt_days_before_event']."</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo '<td colspan="4">'.$nml."</td>\n";
	echo "</tr>\n";
}
if ($set['showAdEd']) {
	echo '<tr><td colspan="4"><hr></td></tr>'."\n";
	echo '<tr><td colspan="4">'.$xx['evt_added'].': '.IDtoDD($ada).' '.$xx['by'].' '.$own;
	if ($mda and $edr) { echo ' - '.$xx['evt_edited'].": ".IDtoDD($mda).' '.$xx['by'].' '.$edr; }
	echo "</td>\n</tr>\n";
}
?>
</table>

<?php
echo '<div class="floatC">'."\n".'<button onClick="javascript:self.close()">'.$xx["evt_close"]."</button>\n</div>\n";
?>
