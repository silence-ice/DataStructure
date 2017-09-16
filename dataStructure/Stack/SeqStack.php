<?php
/*
 * 顺序堆栈
 */
class Stack{  
    private $top;//堆栈游标
    private $maxSize;//PHP数组无限制大小,是动态内存数组,需要用变量做标记进行限制
    private $stack;//顺序堆栈数组 
  
    //构造方法 
    public function __construct($stack = null, $maxSize = null){ 
        $this->top = -1;
        $this->maxSize = 5;
        $this->stack = array();
    } 

    //入栈  
    public function StackPush($elem){  
        if($this->top >= $this->maxSize-1){  
            echo "栈已满！<br/>";  
            exit;  
        }  
        $this->top++;  
        $this->stack[$this->top] = $elem;  
    }  

    //出栈  
    public function StackPop(){  
        if($this->top == -1){  
            echo "栈是空的！";  
            exit;  
        }  
        $elem = $this->stack[$this->top];  
        unset($this->stack[$this->top]);  
        $this->top--;  
        return $elem;  
    }  

    //获取栈顶元素  
    public function GetStackTop(){  
        if($this->top == -1){  
            echo "栈是空的！";  
            exit;  
        }  
        return $this->stack[$this->top];  
    } 

    //打印栈  
    public function StackShow(){  
        for($i=$this->top; $i>=0; $i--){  
            echo $this->stack[$i]." ";  
        }  
        echo "<br/>";  
    }  
}  
  
$stack = new Stack();  
$stack->StackPush(1);  
$stack->StackPush(2);  
$stack->StackPush(3);  
$stack->StackPush(4);
$stack->StackShow();//4,3,2,1
$stack->StackPop();//4
var_dump($stack->GetStackTop());//3 
$stack->StackShow();//3,2,1