<?php
/**
* Avz: CainController
*
*  Dynamic Multi Template/View/Whatever(I dont know called what) Loader.
*
* PHP version 5.3.0 (mine)
*
* @author Anov Siradj (Mayendra Costanov) <anov.siradj22@(gmail|live).com>
* @version 20150809 (initial release)
*
*/

// class ultraController extends Config {
class cainController extends Config {
	public $routeURL;
	public $routeIndex = 0;
	public $routeChain = array();
	public static $routeSubDefault = array();
	public static $routeSubAllow = array();

	private $hasBaseController = false;
	function __construct() {
		// $this->routeIndex = 0;
		// static::$routeBaseAllow[] = static::$routeBaseDefault;
		if (empty($_GET[static::$routeSrc])) {
			$this->routeURL = array(static::$routeBaseAllow[0]);
		} else {
			$n = explode("/", $_GET[static::$routeSrc]);
			$this->routeURL = array_filter($n);
		}
	}
	public function baseView() {
		if ($this->hasBaseController) {
			$this->routeChain[] = $this->routeURL[$this->routeIndex];

			$tpl = static::$tplDir.$this->routeURL[$this->routeIndex].".php";

			e($this->routeIndex,"routeIndex");
			json($this->routeChain,"routeChain");
			json($this->routeURL,"routeURL(baseView)");
			// json(static::$routeBaseAllow,"routeBaseAllow");
			// e($tpl,"baseTPL");
			include($tpl);
		} else {
			$this->errorView();
		}
	}
	public function subView() {
		$oldIndex = $this->routeIndex;
		$this->routeIndex++;
		$index = $this->routeIndex;
		$tplready = false;

		if (!empty(static::$routeSubAllow[$index]) && count(static::$routeSubAllow[$index]) > 0) {
			if ($this->hasRouteURL($index)) {
				if (in_array($this->routeURL[$index],static::$routeSubAllow[$index][$this->routeChain[$oldIndex]])) {
					$this->routeChain[] = $this->routeURL[$index];
					$tplready = true;
				}
			} else {
				$this->routeChain[] = static::$routeSubAllow[$index][$this->routeChain[$oldIndex]][0];
				$tplready = true;
			}
			if ($tplready) {
				$subtpl = static::$tplDir.implode("-",$this->routeChain).".php";
				e($this->routeIndex,"routeIndex");
				json($this->routeChain,"routeChain");
				e($subtpl, "subTPL");
				include($subtpl);
			} else {
				$this->errorView();
			}
		} else {
			$this->errorView();
		}

		// if ($this->hasRouteURL($index)) {
		// 	if (in_array($this->routeURL[$index], static::$routeSubAllow[$index][])) {
		// 		$this->routeChain[] = $this->routeURL[$index];
		// 	}
		// } else {
		// 	$this->routeChain[] = static::$routeSubAllow[$index][0];
		// }


		// if ($index > 1) {
		// 	if ($this->hasRouteURL($index)) {
		// 		$stringIndex = $index--;
		// 		if (in_array($this->routeURL[$index], static::$routeSubAllow[$index][$this->routeURL[$stringIndex]])) {
		// 			echo "[string]";
		// 		}
		// 	}
		// } else {

		// }

		// static::$routeSubAllow[$this->routeIndex][] = static::$routeSubDefault[$this->routeIndex];

		// e($this->routeIndex,"routeIndex");
		// json($this->routeURL,"routeURL(subView)");
		// json($this->routeChain,"routeChain");
		// json(static::$routeSubAllow,"routeSubAllow");
		// -------------
		// $this->routeIndex++;
		// if ($this->hasRouteURL($this->routeIndex++)) {
		// 	if (in_array($this->routeURL[$this->routeIndex++],$this->routeSubAllow[$this->routeIndex++])) {
		// 		echo "[yes]";
		// 	}
		// }
		// ------------
		// if (in_array($this->routeURL[$this->routeIndex++],$this->routeSubAllow[$this->routeIndex++])) {
		// 	$this->routeChain[] = $this->routeURL[$this->routeIndex++];
		// 	$f = implode("-", $this->routeChain);
		// 	include(static::$tplDir.$f.".php");
		// }
	}
	public function Build() {
		if (in_array($this->routeURL[$this->routeIndex], static::$routeBaseAllow)) {
			require(static::$ctrlDir.$this->routeURL[$this->routeIndex].".php");
			$baseCcontroller = new $this->routeURL[$this->routeIndex];
			$this->hasBaseController = true;
		}
		include(static::$tplLayout);
	}
	public function hasRouteURL($i) {
		$b = false;
		if (!empty($this->routeURL[$i])) {
			$b = true;
		}
		return $b;
	}
	public function errorView() {
		if (!empty(static::$routeError)) {
			include(static::$routeError);
		}
	}
}
