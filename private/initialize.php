<?php
ob_start();//output buffering is start

//__FILE returns current path to file
//dirname() returns tye path to the parent directory

define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

//define("WWW_ROOT", '/globe_bank/public');
$public_end=strpos($_SERVER['SCRIPT_NAME'],'/public')+7;
$doc_root=substr($_SERVER['SCRIPT_NAME'],0, $public_end);
define("WWW_ROOT",$doc_root);

require_once('functions.php');
require_once('database.php');
require_once('query_functions.php');
require_once ('validation_function.php');
$db=db_connect();
$errors=[];
?>