<?php
//echo readfile("http://blog.bill.com/bills_20/rss.xml");
//$post_data = $HTTP_RAW_POST_DATA;

$post = file_get_contents('php://input');
$header[] = "Content-type:text/xml";

//$header[] = "Content-type:text/xml\r\n";
$header[] = "Content-length: ".strlen($post);

$ch = curl_init($_GET['url']);

//$ch = curl_init();
//curl_setopt($ch, CURLURL, "http://blog.bill.com/bills_20/rss.xml");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

if(strlen($post>0)){
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
}


$response = curl_exec($ch);
$response_headers = curl_getinfo($ch);

if(curl_errno($ch)){
  print curl_error($ch);
 } else { 
      curl_close($ch);
	  header('Content-type:text/xml');
          //header('Content-type:'. $response_headers['content-type']);
	  print $response;
}

?>
