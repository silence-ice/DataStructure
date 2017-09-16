<?php
/**
 * 希尔排序
 * @param  [type] $arr 
 * @return [type] $newArr 
 * 希尔排序为什么会那么牛那么快，能够证明吗？
 *  作者：冒泡
 *  链接：https://www.zhihu.com/question/24637339/answer/84079774
 *  来源：知乎
 *  著作权归作者所有，转载请联系作者获得授权。
 */
function HillSort(array &$arr){
    $count = count($arr);

    for ($gap = $count/2; $gap > 0 ; $gap=intval(($gap/2))) {//步长循环 
        for ($i = 0; $i < $gap; $i++) { //一步长内组循环
            for ($j = $i + $gap; $j < $count ; $j= $j + $gap) { 
                if ($arr[$j] < $arr[$j-$gap]) {
                    $temp = $arr[$j];
                    $k = $j-$gap;

                    while ($k >= 0 && $arr[$k] > $temp) {
                        $arr[$k + $gap] = $arr[$k];
                        $k = $k - $gap;
                    }

                    $arr[$k + $gap] = $temp;
                }
            }
        }

        //下面错误就是少了个等于号，while ($k >= 0 && $arr[$k] > $temp)
        //找了一下午
        // for ($i = 0; $i < $gap; $i++) {
        //     for ($j = $i + $gap; $j < $count ; $j= $j + $gap) {
        //         if ($arr[$j] < $arr[$j-$gap]) {
        //             $temp = $arr[$j];
        //             $k = $j-$gap;
        //             while ($k > 0 && $arr[$k]>$temp) {
        //                 $arr[$k + $gap] = $arr[$k];
        //                 $k = $k - $gap;
        //             }
        //             $arr[$k + $gap] = $temp;
        //         }
        //     }
        // }

    }
}

$arr = array(49,38,65,97,26,13,27,49,55,4); 	
HillSort($arr);
var_dump($arr);

