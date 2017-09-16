<?php
/**
 * 数组冒泡排序(从小到大)-1
 */
function bubble_arr1($arr){
	$arrLen = count($arr);
	for ($i=0; $i <$arrLen; $i++) { 
		for ($j=$arrLen-1; $j > $i; $j--) { 
			if ($arr[$j] < $arr[$j-1]) {
				$tmp = $arr[$j-1];
				$arr[$j-1] = $arr[$j];
				$arr[$j] = $tmp;
			}
		}

	}
	return $arr;
}
$test_arr = array("1","2","3","8","15","23","4");
$bubble1_start = microtime(true);
$result = bubble_arr1($test_arr);
$bubble1_end = microtime(true);
var_dump($result, $bubble1_end-$bubble1_start);//0.00013589859008789

/**
 * 改进数组冒泡排序-2
 * 如果没有发生比较表示原数组已经正确排序过了！
 */
function bubble_arr2($arr){
	$arrLen = count($arr);
	if ($arrLen == 0) { return $arr; }

	for ($i=0; $i <$arrLen; $i++) { 
		$exchange = FALSE;
		for ($j=$arrLen-1; $j > $i; $j--) { 
			if ($arr[$j] < $arr[$j-1]) {
				$tmp = $arr[$j-1];
				$arr[$j-1] = $arr[$j];
				$arr[$j] = $tmp;
				$exchange = true;
			}
		}

		if ($exchange == false) { return $arr; }
	}
	return $arr;
}
$bubble2_start = microtime(true);
$result2 = bubble_arr2($test_arr);
$bubble2_end = microtime(true);
var_dump($result2, $bubble2_end-$bubble2_start);//0.00010991096496582

function bubble_arr22($arr){
	$arrLen = count($arr) - 1;
	$flag = true;

	while ($flag) {
		$flag = false;

		for ($i=$arrLen; $i > 0 ; $i--) { 
			// var_dump($i);
			// var_dump($arr[$i], $arr[$i-1]);
			if ($arr[$i] < $arr[$i-1]) {
				$tmp = $arr[$i-1];
				$arr[$i-1] = $arr[$i];
				$arr[$i] = $tmp;
				$flag = true;
			}
		}

		$arrLen--;
	}
	return $arr;
}

$bubble2_start = microtime(true);
$result3 = bubble_arr22($test_arr);
$bubble2_end = microtime(true);
var_dump($result3, $bubble2_end-$bubble2_start);//0.00010991096496582

/**
 * 改进数组冒泡排序-3
 *   如果有100个数的数组，仅前面10个无序，后面90个都已排好序且都大于前面10个数字,
 *   那么在第一趟遍历后，最后发生交换的位置必定小于10，且这个位置之后的数据必定已经有序了，
 *   记录下这位置，第二次只要从数 组头部遍历到这个位置就可以了。 
 */
function bubble_arr3($arr){
	$arrLen = count($arr) - 1;
	$flag = $arrLen-1;

	while ($flag > 0) {
		$k = $flag;
		$flag = -1;

		for ($i=$k; $i > 0 ; $i--) { 
			if ($arr[$i] < $arr[$i-1]) {
				$tmp = $arr[$i-1];
				$arr[$i-1] = $arr[$i];
				$arr[$i] = $tmp;

				$flag = $i;
			}
		}

	}
	return $arr;
}

$bubble3_start = microtime(true);
$result3 = bubble_arr3($test_arr);
$bubble3_end = microtime(true);
var_dump($result3, $bubble3_end-$bubble3_start);//0.00010991096496582