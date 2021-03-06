<?php
/**
 * 顺序查找算法
 * @param  [type] $arr 
 */
function Sequential_Search($arr, $key){
	$count = count($arr);
	for ($i=0; $i < $count; $i++) { 
		if ($arr[$i] == $key) {
			return $i;
		}
	}
	return 0;
}

$arr = array("a","b","c","d","e","f");
$res = Sequential_Search($arr, "c");
var_dump($res);

/**
 * 顺序查找算法改进
 * 减少for循环中i和n的比较
 * @param  [type] $arr 
 */
function Sequential_Search2($arr, $key){
	$count = count($arr);
	$init = 0;
	$arr[] = $key;
	while ($arr[$init] != $key) {
		$init++;
	}

	return $init = ($init == $count) ? -1 : $init;
}
$arr = array("a","b","c","d","e","f");
$res = Sequential_Search2($arr, "j");
var_dump($res);