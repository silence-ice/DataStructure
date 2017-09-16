#串☞KMP算法
***

###代码示例
	
	<?php
	/*
	 * 可参考阮一峰的KMP算法教程
	 * http://www.ruanyifeng.com/blog/2013/05/Knuth–Morris–Pratt_algorithm.html
	 */  
	$next = array(0);  
	$Tstring = "ababxbababcadfdsssabcdabdrwgewwrabABABAAABA";  
	$Pstring = "ABABAAABA";  
	  
	printf("String is: %s\n", $Tstring);  
	echo "<br>";  
	printf("You find string is: %s\n", $Pstring);  
	echo "<br>";  
	  
	kmp($Tstring, $Pstring, $next); // 计算部分匹配表和字符串匹配算法  
	
	function makeNext($Pstring, &$next){  
	    $m = strlen($Pstring);//$Pstring = ABABAAABA;
	    $next[0] = 0;//第一个必定为0
	    for ($q = 1, $k = 0; $q < $m; $q++){  
	        while($k > 0 && $Pstring[$q] != $Pstring[$k]) {
	            //$k=3, $q=5 $next[5] = $next[$k-1]==1;
	            //$k=3, $q=6 $next[5] = $next[$k-1]==1;
	            $k = $next[$k-1];  
	        } 
	        //首先找到第一个匹配的,再开始上面的循环
	        if ($Pstring[$q] == $Pstring[$k]){ 
	            $k++;  
	            //$k=0,$q=2 $next[2] = 1;
	            //$k=1,$q=3 $next[3] = 2;
	            //$k=2,$q=4 $next[4] = 3;
	        }  
	        $next[$q] = $k;  
	    }  
	    printf("The next table is:\n");  
	    for ($i = 0; $i < strlen($Pstring); ++$i) {  
	        printf("%d ", $next[$i]);  
	    }  
	    echo "<br>";  
	}  
	
	function kmp($Tstring, $Pstring, &$next){  
	    $n = strlen($Tstring); // 字符串  
	    $m = strlen($Pstring);  
	    makeNext($Pstring,$next); // 计算模式匹配表  
	  
	    for ($i = 0, $q = 0; $i < $n; ++$i){  
	        while($q > 0 && $Pstring[$q] != $Tstring[$i]){
	            $q = $next[$q-1];  
	        }  
	        if ($Pstring[$q] == $Tstring[$i]){  
	            $q++;  
	        }  
	        if ($q == $m){  
	            printf("Pattern occurs with shift:%d ",($i - $m + 1));  
	            printf(" You find string is:%s\n", $Pstring);  
	            echo "<br>";  
	        }  
	    }  
	}  
	
