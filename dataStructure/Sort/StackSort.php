<?php
// 交换
function swap(& $a, & $b) {
  $temp = $a;
  $a = $b;
  $b = $temp;
}
 
// 从 $a 的第 $i 个节点开始至 $n 结束 , 递归的将其 ( 包括其子节点 ) 转化为一个小顶堆
function bulidHeap(& $a, $i, $n) {
  // 获取左 / 右节点
  $r = ($l = 2*$i+1)+1;
  $max = $i;
   
  // 如果左子节点大于当前节点 , 那么记录左节点键名
  $i<$n && $l<$n && $a[$i]<$a[$l] && $max = $l;
  // 如果右节点大于刚刚记录的 $max , 那么再次交换
  $i<$n && $r<$n && $a[$max]<$a[$r] && $max = $r;
   
  if($max!==$i && $max<$n){
    swap($a[$i], $a[$max]);
    bulidHeap($a, $max, $n);
  }
}
 
// 堆化数组
function createHeap(& $a) {
  $l = count($a);
  $i = intval($l/2);
  for(; $i>=0; $i--) bulidHeap($a, $i, $l);
}
 
// 堆排序--main
function heapSort($a){
    createHeap($a);
    $c = count($a);
    while($c>0) {
      /* 这是一个大顶堆 , 所以堆顶的节点必须是最大的
         根据此特点 , 每次都将堆顶数据移到最后一位
         然后对剩余数据节点再次建造堆就可以 */
      swap($a[0], $a[--$c]);
      bulidHeap($a, 0, $c);
    }
    return $a;
}

$a = array(50, 10, 90, 30, 70, 40, 80, 60, 20);
echo "<pre>";
print_r($a);
print_r(implode(",", heapSort($a)));// 注意 , $a 是一个数组
// echo intval(9/2);die;