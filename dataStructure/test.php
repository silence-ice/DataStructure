<?php
function fib($n){
	return $res = (2 > $n) ? $n : fib($n-1)+fib($n-2);
}
var_dump(fib(6));