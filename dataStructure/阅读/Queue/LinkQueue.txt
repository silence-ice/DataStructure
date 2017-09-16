<?php
/*
 * 链式队列【无头节点】
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
 * 单链表【无头节点】
 */
class singleLinkQueue{
    public $front; //头队列
    public $rear; // 尾队列
    private $curSize;

    //构造方法 
    public function __construct(){ 
        $this->front = null; 
        $this->rear = null;
        $this->curSize = 0;
    } 

    //获取链表长度   
    public function getQueueLength() {   
        return $this->curSize;   
    }   
  
    //判断链表是否为空  
    public function isQueueEmpty(){  
        return $this->curSize == 0;  
    }  

    //查看链表
    public function showQueueLink(){
        if (empty($this->front)) {
            echo "Queue is empty";
            exit;
        }

        $cur = $this->front;
        while ($cur) {
            echo $cur->id,'###',$cur->name,'<br />';
            $cur = $cur->next;
        }
        echo '<hr />';
    }

    //入列
    public function pushLink($node){
        if (empty($node)) {
            echo "node is empty!";
            exit;
        }

        //若队头指针为空则指向新结点
        if (empty($this->front)) {
            $this->front = $node;
            $this->rear = $node;
        }else{
            $cur = $this->rear;
            $cur->next = $node;
            $this->rear = $node;
        }

        $this->curSize++;
        return "success";
    }

    //出列
    public function popLink(){
        if ($this->curSize == 0) {
            echo "Queue is empty!";
            exit;
        }

        $cur = $this->front;
        $cur = null;
        $result = $cur->name;
        $this->front = $cur->next;

        $this->curSize--;
        return $result;        
    }
}

$lists = new singleLinkQueue();
$node1 = new node(1, '唐三藏');
$lists->pushLink($node1);
// var_dump($lists->front);die;

###########################################1

$node19 = new node(19, '牛魔王');
$lists->pushLink($node19);
// var_dump($lists->rear);
// var_dump($lists->front);die;

$node2 = new node(2, '孙悟空');
$lists->pushLink($node2);
echo "<pre>";
print_r($lists->front);
echo "<pre>";
// $lists->showQueueLink();die;

###########################################4
var_dump($lists->popLink());
echo "<pre>";
print_r($lists->front);
echo "<pre>";
$lists->showQueueLink();die;
