<?php
//error_reporting(0);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");
header('Content-type: application/json');


require_once __DIR__."/config.php";
require_once __DIR__."/app/router/routes.php";
require_once __DIR__."/app/core/Core.php";

spl_autoload_register(function($file) { 
  if (file_exists(__DIR__."/app/models/$file.php")) { require_once __DIR__."/app/models/$file.php"; } 
  else if (file_exists(__DIR__."/app/utils/$file.php")) { require_once __DIR__."/app/utils/$file.php"; } 
  else if (file_exists(__DIR__."/app/services/$file.php")) { require_once __DIR__."/app/services/$file.php"; } 
});

$core = new Core($routes);
$core->run();
