<?php
/**
 * 快速排序-1
 * 使用PHP来快速实现快速排序
 * http://www.114390.com/article/48008.htm
 */
function quick_sort($arr){
    //判断参数是否是一个数组
    if(!is_array($arr)) return false;

    $length = count($arr);

    //递归出口:数组长度为1，直接返回数组
    if($length<=1) return $arr;

    //数组元素有多个,则定义两个空数组
    $left = $right = array();

    //使用for循环进行遍历，把第一个元素当做比较的对象
    for($i=1;$i<$length;$i++){
        if($arr[$i]<$arr[0]){
            $left[]=$arr[$i];
        }else{
            $right[]=$arr[$i];
        }
    }

    //递归调用
    $left=quick_sort($left);
    $right=quick_sort($right);

    //将所有的结果合并
    return array_merge($left,array($arr[0]),$right);
}   

// $arr=array(6,3,8,6,4,2,9,5,1);
// var_dump(quick_sort($arr));


/**
 * 快速排序-2
 * 使用快速排序定义进行实现
 */
function quick_sort_swap(&$array, $low, $high) {
    if($high <= $low) return;
    $pivot = Partition($array, $low, $high);
    quick_sort_swap($array, $low, $pivot - 1);
    quick_sort_swap($array, $pivot+1, $high);
}

function Partition(&$array, $low, $high){
    //枢轴定义
    $pivotkey = $array[$low];

    while($low < $high) {
        while($low < $high && $array[$high] >= $pivotkey){
            $high--;
        }

        $temp = $array[$low];
        $array[$low] = $array[$high];
        $array[$high]= $temp;
       
        while($low < $high && $array[$low] <= $pivotkey){
            $low++;
        }

        $temp = $array[$low];
        $array[$low] = $array[$high];
        $array[$high]= $temp;
    }

    return $low;
}

$arr=array(6,3,8,6,4,2,9,5,1);
quick_sort_swap($arr, 0, 8);
var_dump($arr);
