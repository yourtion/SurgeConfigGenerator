<?php
  require 'config.php';
  require 'parse.php';
  
// http://yourserver.com/path/?config=config_name&account=server_account&passwd=password

  $surge_file = $config['surge'][$_GET['config']];
  if(!$surge_file) {
    header($_SERVER['SERVER_PROTOCOL'] . 'config not found', true, 404); 
  }
  $account = $config['server'][$_GET['account']];
  if(!$account) {
    header($_SERVER['SERVER_PROTOCOL'] . 'account not found', true, 404); 
  }
  $password = $_GET['passwd'];
  if(!$password || $password != $account['passwd']) {
    header($_SERVER['SERVER_PROTOCOL'] . 'Internal Server Error', true, 500); 
  }
    
  $surge_content = file_get_contents_curl($surge_file);
  if(!$surge_content) {
    header($_SERVER['SERVER_PROTOCOL'] . 'Internal Server Error !', true, 500); 
  }
  
  $res = parse_config($surge_content,$account);
  if (!res) {
    header($_SERVER['SERVER_PROTOCOL'] . 'Internal Server Error!', true, 500); 
  }
  
  header("Content-type:text/plain; charset=utf-8");
  echo implode("\n" , $res);
?>