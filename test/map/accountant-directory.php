<?php

//Function used to get JSON data from data service
function get_url( $url,  $javascript_loop = 0, $timeout = 5 )
{
    $url = str_replace( "&amp;", "&", urldecode(trim($url)) );

    $cookie = tempnam ("/tmp", "CURLCOOKIE");
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_ENCODING, "" );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
    $content = curl_exec( $ch );
    $response = curl_getinfo( $ch );
    curl_close ( $ch );

    if ($response['http_code'] == 301 || $response['http_code'] == 302)
    {
        ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");

        if ( $headers = get_headers($response['url']) )
        {
            foreach( $headers as $value )
            {
                if ( substr( strtolower($value), 0, 9 ) == "location:" )
                    return get_url( trim( substr( $value, 9, strlen($value) ) ) );
            }
        }
    }

    if (    ( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) &&
        $javascript_loop < 5
    )
    {
        return get_url( $value[1], $javascript_loop+1 );
    }
    else
    {
        return array( $content, $response );
    }
}

function nice_url($url) {
    if(!(strpos($url, "http://") === 0)) {
        $url = "http://$url";
    }

    return $url;
}

//Default params - Look for query data.  Passing service an empty string for location returns ALL records.  Empty string for page is equivalent to page 1
$numPerPage = 9;
$location = $_GET["loc"];
$pageNum = ($_GET["page"]=="")?1:$_GET["page"];

//Get JSON data
$string = get_url("https://api.bill.com/api/v2/ui/DirectoryListing.json?numPerPage=".$numPerPage."&location=".$location."&index=".(($pageNum-1)*$numPerPage));
//UTF-8 encode then parse data as PHP Array
$json = json_decode(utf8_encode($string[0]),true,9);

//Draw Navigation

 print'<form method="post" id="caseFilter">';
 print'  State:';
 print'  <select onChange="window.location.href = window.location.pathname + \'?loc=\'+this.value;" id="state" name="state">';
 print'    <option value="">All</option>';
 print'    <option value="AL"'.(($location === "AL")?' selected="selected"':'').'>Alabama</option>';
 print'    <option value="AK"'.(($location === "AK")?' selected="selected"':'').'>Alaska</option>';
 print'    <option value="AZ"'.(($location === "AZ")?' selected="selected"':'').'>Arizona</option>';
 print'    <option value="AR"'.(($location === "AR")?' selected="selected"':'').'>Arkansas</option>';
 print'    <option value="CA"'.(($location === "CA")?' selected="selected"':'').'>California</option>';
 print'    <option value="CO"'.(($location === "CO")?' selected="selected"':'').'>Colorado</option>';
 print'    <option value="CT"'.(($location === "CT")?' selected="selected"':'').'>Connecticut</option>';
 print'    <option value="DE"'.(($location === "DE")?' selected="selected"':'').'>Delaware</option>';
 print'    <option value="DC"'.(($location === "DC")?' selected="selected"':'').'>District Of Columbia</option>';
 print'    <option value="FL"'.(($location === "FL")?' selected="selected"':'').'>Florida</option>';
 print'    <option value="GA"'.(($location === "GA")?' selected="selected"':'').'>Georgia</option>';
 print'    <option value="HI"'.(($location === "HI")?' selected="selected"':'').'>Hawaii</option>';
 print'    <option value="ID"'.(($location === "ID")?' selected="selected"':'').'>Idaho</option>';
 print'    <option value="IL"'.(($location === "IL")?' selected="selected"':'').'>Illinois</option>';
 print'    <option value="IN"'.(($location === "IN")?' selected="selected"':'').'>Indiana</option>';
 print'    <option value="IA"'.(($location === "IA")?' selected="selected"':'').'>Iowa</option>';
 print'    <option value="KS"'.(($location === "KS")?' selected="selected"':'').'>Kansas</option>';
 print'    <option value="KY"'.(($location === "KY")?' selected="selected"':'').'>Kentucky</option>';
 print'    <option value="LA"'.(($location === "LA")?' selected="selected"':'').'>Louisiana</option>';
 print'    <option value="ME"'.(($location === "ME")?' selected="selected"':'').'>Maine</option>';
 print'    <option value="MD"'.(($location === "MD")?' selected="selected"':'').'>Maryland</option>';
 print'    <option value="MA"'.(($location === "MA")?' selected="selected"':'').'>Massachusetts</option>';
 print'    <option value="MI"'.(($location === "MI")?' selected="selected"':'').'>Michigan</option>';
 print'    <option value="MN"'.(($location === "MN")?' selected="selected"':'').'>Minnesota</option>';
 print'    <option value="MS"'.(($location === "MS")?' selected="selected"':'').'>Mississippi</option>';
 print'    <option value="MO"'.(($location === "MO")?' selected="selected"':'').'>Missouri</option>';
 print'    <option value="MT"'.(($location === "MT")?' selected="selected"':'').'>Montana</option>';
 print'    <option value="NE"'.(($location === "NE")?' selected="selected"':'').'>Nebraska</option>';
 print'    <option value="NV"'.(($location === "NV")?' selected="selected"':'').'>Nevada</option>';
 print'    <option value="NH"'.(($location === "NH")?' selected="selected"':'').'>New Hampshire</option>';
 print'    <option value="NJ"'.(($location === "NJ")?' selected="selected"':'').'>New Jersey</option>';
 print'    <option value="NM"'.(($location === "NM")?' selected="selected"':'').'>New Mexico</option>';
 print'    <option value="NY"'.(($location === "NY")?' selected="selected"':'').'>New York</option>';
 print'    <option value="NC"'.(($location === "NC")?' selected="selected"':'').'>North Carolina</option>';
 print'    <option value="ND"'.(($location === "ND")?' selected="selected"':'').'>North Dakota</option>';
 print'    <option value="OH"'.(($location === "OH")?' selected="selected"':'').'>Ohio</option>';
 print'    <option value="OK"'.(($location === "OK")?' selected="selected"':'').'>Oklahoma</option>';
 print'    <option value="OR"'.(($location === "OR")?' selected="selected"':'').'>Oregon</option>';
 print'    <option value="PA"'.(($location === "PA")?' selected="selected"':'').'>Pennsylvania</option>';
 print'    <option value="RI"'.(($location === "RI")?' selected="selected"':'').'>Rhode Island</option>';
 print'    <option value="SC"'.(($location === "SC")?' selected="selected"':'').'>South Carolina</option>';
 print'    <option value="SD"'.(($location === "SD")?' selected="selected"':'').'>South Dakota</option>';
 print'    <option value="TN"'.(($location === "TN")?' selected="selected"':'').'>Tennessee</option>';
 print'    <option value="TX"'.(($location === "TX")?' selected="selected"':'').'>Texas</option>';
 print'    <option value="UT"'.(($location === "UT")?' selected="selected"':'').'>Utah</option>';
 print'    <option value="VT"'.(($location === "VT")?' selected="selected"':'').'>Vermont</option>';
 print'    <option value="VA"'.(($location === "VA")?' selected="selected"':'').'>Virginia</option>';
 print'    <option value="WA"'.(($location === "WA")?' selected="selected"':'').'>Washington</option>';
 print'    <option value="WV"'.(($location === "WV")?' selected="selected"':'').'>West Virginia</option>';
 print'    <option value="WI"'.(($location === "WI")?' selected="selected"':'').'>Wisconsin</option>';
 print'    <option value="WY"'.(($location === "WY")?' selected="selected"':'').'>Wyoming</option>';
 print'  </select>';
 print'</form>';


function certified_template($since){
    return "<div class='verified'>Bill.com Certified<br/>Using Bill.com since ".$since."</div>";
}

$numResp = $json[response_data][total];
if ($numResp > 0) {
	print " | ";
	if ($pageNum > 1) {
		print "<A href='?loc=".$location."&page=".($pageNum-1)."'>Prev</a> | ";
	}
	
	$pageMore = max(3, 7 - $pageNum);
	$pageLess = max(3, 7 - min(4,(ceil($numResp/$numPerPage) - $pageNum)));
	
	for ($i = max(1,($pageNum-$pageLess)); $i <= min(ceil($numResp/$numPerPage),($pageNum+$pageMore)); $i++) {  //This is drawing 3 before and 3 after current page instead of all pages.  Also minimum of 7 listed
		if ($i != $pageNum) {
			print "<a href='?loc=".$location."&page=".$i."'>".$i."</a>"." | ";
		} else {
			print "$i | ";
		}
	}
	
	if(($pageNum < ceil($numResp/$numPerPage) - 3) && (ceil($numResp/$numPerPage) > 5))  {
		print " ... <a href='?loc=".$location."&page=".ceil($numResp/$numPerPage)."'>".ceil($numResp/$numPerPage)."</a>"." | ";
	}
	
	if ($pageNum < ceil($numResp/$numPerPage)) {
		print "<A href='?loc=".$location."&page=".($pageNum+1)."'>Next</a> | ";
	}




	//Iterate through the returned items
	print "<div id='caseGrid'>";
	$directories = $json['response_data']['directories'];
	foreach ($directories as $accountant) {
		$url = nice_url($accountant['companyUrl']);
		$acctDetail = get_url("https://api.bill.com/api/v2/ui/DirectoryView.json?mktExtId=".$accountant['mktExtId']);
		//UTF-8 encode then parse data as PHP Array
		$jsonDetail = json_decode(utf8_encode($acctDetail[0]),true,9);
		
		print "<div class='grid accounting'>";
			if($accountant['logoUrl'] != "") print "<div class='imgBlock'><img src='".$accountant['logoUrl']."'/></div>";
			
			print "<div class='desc'>";
			if($accountant['addressCity'] != "" && $accountant['addressState'] != "") {
				print $accountant['addressCity'].", ".$accountant['addressState']."<br/>";
			} else {
				print $accountant['addressCity'].$accountant['addressState']."<br/>";
			}
			print $jsonDetail['response_data']['companyPhone']."<br/>";
			if($jsonDetail['response_data']['companyEmail'] != null) {
			print "<a href='mailto:".$jsonDetail['response_data']['companyEmail']."' class='arrow'>Email</a><br/>";
			}
			if($accountant['companyUrl'] != "")  print "<a href='".$url."' class='arrow'>Visit Website</a>";
			print "</div>";
			print "<div class='text'>";
				print "<h3>".$accountant['name']."</h3>";
				print "<p>".$accountant['description']."</p>";
				if($accountant['bdcCertified']) print certified_template($accountant['useSince']);
			print "</div>";
		print "</div>";
	}
	print "</div>";
} else {
	print "<br/><br/><b>Sorry, no results found.</b><br/><br/><br/><br/><br/>";
}

?>


