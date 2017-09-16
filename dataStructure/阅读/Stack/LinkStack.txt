<?php
/*
 * 链式堆栈
 */
header("Content-Type: text/html; charset=UTF-8");
/*
 * 创建链表节点
 */   
class node{   
    public $id; //节点id   
    public $name; //节点名称   
     
    public function __construct($id, $name){   
        $this->id = $id;   
        $this->name = $name;   
        $this->next = null;   
    }   
}  

/*
 * 单链表
 */
class singelLinkStack{
    public $header; //链表头节点,使用public用于打印显示
    private $top;
    private $curSize;

    //构造方法 
    public function __construct($id = null, $name = null){ 
        $this->header = new node ( $id, $name, null ); 
        $this->top = $this->header;
        $this->curSize = 0;
    } 

    //获取链表长度   
    public function getLinkLength() {   
        return $this->curSize;   
    }   
  
    //判断链表是否为空  
    public function isStackEmpty(){  
        return $this->curSize == 0;  
    }  

    //查看链表
    public function showStackLink(){
        $cur = $this->header;
        while ($cur->next) {
            echo $cur->next->id,'###',$cur->next->name,'<br />';
            $cur = $cur->next;
        }
        echo '<hr />';
    }

    //入栈
    public function pushStack($node){
        if (empty($node)) {
            echo "node is empty!";
            exit;
        }

        $cur = $this->top;
        $node->next = $cur->next;
        $cur->next = $node;

        $this->curSize++;
        return "success";
    }

    //出栈
    public function popStack(){
        if ($this->curSize == 0) {
            echo "Stack is empty!";
            exit;
        }

        $cur = $this->top;
        $result = $cur->next->name;
        $cur->next = $cur->next->next;
        $this->curSize--;
        return $result;        
    }
}

$lists = new singelLinkStack();
$node1 = new node(1, '唐三藏');
$lists->pushStack($node1);
// var_dump($lists->header);die;

###########################################1

$node19 = new node(19, '牛魔王');
$lists->pushStack($node19);
// var_dump($lists->header);die;

$node2 = new node(2, '孙悟空');
$lists->pushStack($node2);
echo "<pre>";
print_r($lists->header);
echo "<pre>";
$lists->showStackLink();

###########################################4
var_dump($lists->popStack());
echo "<pre>";
print_r($lists->header);
echo "<pre>";
$lists->showStackLink();die;
