<?php
abstract class Config {
	public static $baseURL = "http://localhost/rantai/";
	public static $tplDir = "app/template/";
	public static $tplLayout = "app/layout.php";
	public static $ctrlDir = "app/controller/";
	public static $routeSrc = "rantairouting";
	// public static $routeBaseDefault = "utama";
	public static $routeBaseAllow = array("utama","portofolio","catatan");
	public static $routeError = "app/template/other/error.php";
	// public $mainRoute = array(
	// 	"utama",
	// 	"keluarga"
	// );
}

function json($v,$t = "Array") {
	echo $t.": ".json_encode($v)."\n";
}
function e($v,$t = "String") {
	echo $t.": ".$v."\n";
}
