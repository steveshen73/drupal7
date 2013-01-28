<?php
//$json = readfile("https://api.bill.com/api/v2/ui/DirectoryView.json");
//echo readfile("http://blog.bill.com/bills_20/rss.xml");
//var_dump($json);

//$string = file_get_contents("accountant.json");//reading a json file as a string

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
    /*-- Status 301 means that the resource (page) is moved permanently to a new location. The client/browser should not attempt to request the original location but use the new location from now on.
    Status 302 means that the resource is temporarily located somewhere else, and the client/browser should continue requesting the original url.
    ---*/
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

$string = get_url("https://api.bill.com/api/v2/ui/DirectoryListing.json");

$json = json_decode(utf8_encode($string[0]),true,9);
/*--
echo "<pre>";
print_r($json);
echo "</pre>";--*/
//echo $string.directories.name;


echo "<pre>";
print_r($string);
echo "</pre>";


$json_a=json_decode($string,true); //convert json file to an array , using true as a second parameter

//echo "<pre>";
//var_dump($json_a);
//echo "</pre>";



?>
