<?php
/**
  * 单链表
  */ 
header("Content-Type: text/html; charset=UTF-8");
class node { 
    public $id; //节点id 
    public $name; //节点名称 
    public $next; //下一节点指针 
   
    public function __construct($id, $name){ 
        $this->id = $id; 
        $this->name = $name; 
        $this->next = null; 
    } 
}

/*
 * 循环单链表
 */
class singelCycleLinkList{ 
    private $header; //链表头节点 
    
    //构造方法 
    public function __construct(){ 
        $this->header = (object)array(); 
        //环形链表尾指针指向自己,递归实现循环单链表结构
        $this->header->next = $this->header; 
    } 

    //获取链表长度   
    public function getLinkLength(){   
        $i = 0;   
        $cur = $this->header;   
        while ( $cur->next != $this->header ) {   
            $i ++;   
            $cur = $cur->next;   
        }   
        return $i;   
    }   
  
    //判断链表是否为空  
    public function isEmpty(){  
        $cur = $this->header;
        // print_r($cur);die;
        return $cur->next == $this->header;  
    }  
  
    //清空链表  
    public function clear(){  
        //重构一次构造函数
        $this->header = (object)array();
        $this->header->next = $this->header; 
    } 
    
    //添加环形链表节点数据 
    public function addLink($node){ 
        $current = $this->header; 
        $falg = false; 
        while ( $current->next != $this->header ) { 
            //找出适合的位置,比如插入3应该输出2的next位置
            if ($current->next->id > $node->id) { 
                $falg = true; 
                break; 
            } 
            $current = $current->next; 
        } 
        if ($falg) { 
            $node->next = $current->next; 
            $current->next = $node; 
        } else { //头结点等于尾结点
            $node->next = $this->header; 
            $current->next = $node; 
        } 
    } 
    
    //获取环形链表数据 
    public function getLinkList(){ 
        $current = $this->header; 
        $str = ''; 
        //既是当$this->header != $this->header->next时,即头结点=尾结点
        while ( $current->next != $this->header ) { 
            $str .= 'id:' . $current->next->id . '   name:' . $current->next->name . "<br>"; 
            $current = $current->next; 
        } 
        return $str; 
    } 

    public function delLink($node){ 
        $current = $this->header; 
        $flag = false; 
        while ( $current->next != $this->header ) { 
            if ($current->next->id == $node->id) { 
                $flag = true; 
                break; 
            } 
            $current = $current->next; 
        } 
        if ($flag) { 
            $current->next = $current->next->next; 
        } else { 
            echo "未找到该节点！<br>"; 
        } 
    } 
}
// die;
$node1 = new node (1, '唐三藏');
$node2 = new node (2, '孙悟空');
$node3 = new node (3, '白龙马');
$lists = new singelCycleLinkList(); 
var_dump($lists->isEmpty());//true
$lists->addLink($node1);
$lists->addLink($node2);
$lists->addLink($node3);
$lists->delLink($node2);
echo "<pre>";
print_r($lists);
var_dump($lists->getLinkList());
var_dump($lists->getLinkLength());
var_dump($lists->isEmpty());//false
$lists->clear();
var_dump($lists->getLinkList());
echo "<pre>";
// var_dump($lists->getLinkList(new node (5, '唐三藏')));
