<?php
/**
 * 二分法查找--递归【有序表查找】
 */
function binary_search_recursion($arr, $low, $hight, $target){
	if ($low <= $hight) {
		$mid = intval(($low+$hight)/2);

		if ($target == $arr[$mid]) {
			return $mid;
		}else if ($target > $arr[$mid]) {
			return bin_sch($arr, $mid+1, $hight, $target);
		}else{
			return bin_sch($arr, $low, $mid-1, $target);
		}

		return false;		
	}
}

$arr = array("1","2","3","4","5","6","7");
$result = binary_search_recursion($arr, 0 , count($arr), "4");
var_dump($result);

/**
 * 二分法查找--非递归【有序表查找】
 */
function binary_search($arr, $target){
	$low = 0;
	$hight = count($arr)-1;

	while ($low <= $hight) {
		$mid = intval(($low+$hight)/2);

		if ($target < $arr[$mid]) {
			$hight = $mid-1;
		}else if ($target > $arr[$mid]) {
			$low = $mid+1;
		}else{
			return $mid;
		}			
	}
	return false;
}
$result = binary_search($arr, "4");
var_dump($result);