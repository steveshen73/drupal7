<?php 

  require 'api_cache/api_cache.php';

  $cache_file = 'twitter.json';
  $api_call = 'http://search.twitter.com/search.json?q=nodeJS&lang=en';
  //$api_call = 'http://api.twitter.com/1/statuses/user_timeline/billcom.json?count=5&include_rts=true&include_entities=true';
  $cache_for = 5; // cache results for five minute

  $api_cache = new API_cache ($api_call, $cache_for, $cache_file);
  if (!$res = $api_cache->get_api_cache())
    $res = '{"error": "Could not load cache"}';

  ob_start();
  echo $res;
  //$json_body = ob_get_clean();
  $json_body = ob_get_flush();

  header ('Content-Type: application/json');
  header ('Content-length: ' . strlen($json_body));
  header ("Expires: " . $api_cache->get_expires_datetime());
  echo $json_body;
