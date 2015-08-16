<?php
class utama extends cainController {
	// public static $routeSubAllow = array(1,array("beranda","tentang"));
	function __construct() {
		static::$routeSubAllow[1] = array(__CLASS__=>array("beranda","tentang"));
		static::$routeSubAllow[2] = array("beranda"=>array("profil","keluarga"));
		static::$routeSubAllow[3] = array("profil"=>array("sejarah"));
		// static::$routeSubAllow[2] = array(
		// 	"beranda"=>array(
		// 		"profil",
		// 		"keluarga"
		// 	)
		// );
		// static::$routeSubDefault[1] = "beranda";
		// if ($this->hasRouteURL(1) && in_array($this->routeURL[1],$this->routeSubAllow[1])) {
		// 	echo "[yes]";
		// }
	}
}
