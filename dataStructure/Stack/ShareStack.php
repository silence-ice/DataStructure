<?php
/*
 * 共享堆栈
 */
class Stack{  
    private $top;//堆栈游标
    private $maxSize;//PHP数组无限制大小,是动态内存数组,需要用变量做标记进行限制
    private $stack;//顺序堆栈数组 
  
    //构造方法 
    public function __construct($stack = null, $maxSize = null){ 
        $this->maxSize = 11;
        $this->top1 = -1;
        $this->top2 = $this->maxSize;
        $this->stack = array();
    } 

    //入栈  
    public function StackPush($stackNumber, $elem){  
        if($this->top1+1 == $this->top2){  
            echo "栈已满！<br/>";  
            exit;  
        }

        if ($stackNumber == 1) {
            $this->top1++;  
            $this->stack[$this->top1] = $elem; 
        }

        if ($stackNumber == 2) {
            $this->top2--;  
            $this->stack[$this->top2] = $elem;
        } 
    }  

    //出栈  
    public function StackPop($stackNumber){  
        if ($stackNumber == 1) {
            if ($this->top1 == -1) {
                echo "栈是空的！";  
                exit;
            }
            $elem = $this->stack[$this->top1];  
            unset($this->stack[$this->top1]);  
            $this->top1--;  
            return $elem;
        }

        if ($stackNumber == 2) {
            if ($this->top1 == $this->maxSize) {
                echo "栈是空的！";  
                exit;
            }
            $elem = $this->stack[$this->top2];  
            unset($this->stack[$this->top2]);  
            $this->top2++;  
            return $elem;
        }  
    }  

    //打印栈  
    public function StackShow(){  
        //输出top1
        for($i=$this->top1; $i>=0; $i--){  
            echo "arr[".$i."]：".$this->stack[$i]." ";  
        }  
        echo "<br/>";
        //输出top2  
        for($i=$this->top2; $i<$this->maxSize; $i++){  
            echo "arr[".$i."]：".$this->stack[$i]." ";  
        } 
        echo "<br/>"; 
    }  
}  
  
$stack = new Stack();  
$stack->StackPush(1, 1);  
$stack->StackPush(1, 2);  
$stack->StackPush(2, 3);  
$stack->StackPush(2, 4);
$stack->StackShow();
$stack->StackPop(2);//删除堆栈2的栈顶
$stack->StackShow();