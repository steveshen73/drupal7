<?php
/*
= Footer for bill.com event calendar pages - Normal =
open source , modified by Steve Shen, Bill.com
*/
?>
</div>
<footer class="noPrint">
<?php
echo '<span class="floatR"><a href="http://www.bill.com" target="_blank"><span title="V'.Bill.'">C</span>heck with  <span class="footLB">Bill</span><span class="footLR">.com</span></a></span>'."\n";
if ($privs > 0 and $set['rssFeed']) {
	echo '<span  class="floatL"><a href="'.$set['calendarUrl'].'rssfeed.php" title="RSS feeds" target="_blank">RSS</a></span>'."\n";
}
?>
</footer>
</body>
</html>
