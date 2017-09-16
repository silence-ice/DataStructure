<?php
/**
 * 简单选择排序(小到大)
 * @param  [type] $arr 
 * @return [type] $newArr 
 */
function simpleSelectionSort($arr) { 
    $arrLength = count($arr); 
    for($i=0; $i<$arrLength; $i++) { 
        $k = $i; 
        for($j = $i+1; $j < $arrLength; $j++) { 
           if($arr[$j] < $arr[$k]) {
               $k = $j; 
           }
        } 
        if($k != $i) { 
            $temp = $arr[$i]; 
            $arr[$i] = $arr[$k]; 
            $arr[$k] = $temp; 
        } 
    } 
    return $arr; 
} 

$result = simpleSelectionSort(array("5","2","1","8","15","23","3"));
var_dump($result);