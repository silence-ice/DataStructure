<?php
function InsertSort(array &$arr){
    $count = count($arr);
    $recycle_count = 0;
    //数组中第一个元素作为一个已经存在的有序表
    for($i = 1;$i < $count;$i ++){
    	$temp = $arr[$i];//比较字段

    	for($j = $i - 1; $j >= 0 && $arr[$j] > $temp; $j--){
    		$recycle_count ++;
    		//第一次$j为0;比较字段每次和已经排序好的字段进行比较
            $arr[$j + 1] = $arr[$j];
        }
        $arr[$j + 1] = $temp;//第一次$j为-1,插入到正确的位置
    }
    return $recycle_count;//共循环11次
}

$arr = array(9,5,3,4,6,2); 	
InsertSort($arr);
var_dump($arr);

/*
9 5 3 4 6 2
外for one
5 9 3 4 6 2
外for two
5 3 9 4 6 2 (内for one)
3 5 9 4 6 2 (内for two)
外for three
3 5 4 9 6 2
3 4 5 9 6 2
外for four
3 4 5 6 9 2
外for five
3 4 5 6 2 9
3 4 5 2 6 9
3 4 2 5 6 9
3 2 4 5 6 9
2 3 4 5 6 9

all 11次
 */