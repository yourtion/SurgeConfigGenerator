<?php
  require 'config.php';
  require 'parse.php';

  $surge_file = $config['surge'][$_GET['config']] ? : array_values($config['surge'])[0];
  if(!$surge_file) {
    return header($_SERVER['SERVER_PROTOCOL'] . 'config not found', true, 404);  
  }

  $account = $config['server'][$_GET['account']] ? : array_values($config['server'])[0];
  if(!$account) {
    return header($_SERVER['SERVER_PROTOCOL'] . 'account not found', true, 404); 
  }

  $password = $_GET['passwd'];
  if(!$password || $password != $account['passwd']) {
    return header($_SERVER['SERVER_PROTOCOL'] . 'Internal Server Error', true, 500); 
  }
    
  $surge_content = file_get_contents_curl($surge_file);
  if(!$surge_content) {
    return header($_SERVER['SERVER_PROTOCOL'] . 'Internal Server Error !', true, 500); 
  }
  
  $res = parse_config($surge_content,$account);
  if (!res) {
    return header($_SERVER['SERVER_PROTOCOL'] . 'Internal Server Error!', true, 500); 
  }
  
  header("Content-type:text/plain; charset=utf-8");
  echo implode("\n" , $res);
?>