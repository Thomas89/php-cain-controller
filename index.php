<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("lib/Config.php");
// require("lib/Ultra.php");
require("lib/Cain.php");

// $ultra = new ultraController;
$ultra = new cainController;
$ultra->Build();
