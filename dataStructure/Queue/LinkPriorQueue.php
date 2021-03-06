<?php
/*
 * 链式优先级队列【无头节点】
 */
header("Content-Type: text/html; charset=UTF-8");
/*
 * 创建链表节点
 */   
class node{   
    public $id; //节点id,id最小出队
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
    private $maxQueue;//队列优先级最大值
    private $queueArr;//队列优先级数组

    //构造方法 
    public function __construct(){ 
        $this->front = null; 
        $this->rear = null;
        $this->maxQueue = null;
        $this->queueArr = array();
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

        //赋值优先级maxQueue
        $this->queueArr[] = $node->id;
        $this->maxQueue = max($this->queueArr);
        $this->curSize++;
        return "success";
    }

    //出列
    public function popLink(){
        if ($this->curSize == 0) {
            echo "Queue is empty!";
            exit;
        }
        //找出$maxQueue,已被$this->maxQueue代替
        // $cur = $this->front;
        // $maxQueue = $cur->id;//队头优先级

        // for ($i=0; $i < $this->curSize; $i++) { 
        //     if (!empty($cur->next)) {
        //         $maxQueue = min($maxQueue, $cur->next->id);
        //         $cur = $cur->next;                
        //     }
        // }
        
        //移除优先级最高的并对其后续元素前移一位.
        $cur = $this->front;
        if ($cur->id == $this->maxQueue) {
            $this->front = $cur->next;
            return $cur->name;
        }else{
            for ($i=0; $i < $this->curSize-1; $i++) { 
                if ($cur->next->id == $this->maxQueue) {
                    $result = $cur->next->name;
                    break;
                }
                $cur = $cur->next; //不会对$front有影响
            }

            $cur->next = $cur->next->next;//进行指针引用(next),对$front产生影响
        }
        //删除优先级数组中指定值
        unset($this->queueArr[array_search($this->maxQueue, $this->queueArr)]);

        //重新取最高优先级的值
        $this->maxQueue = max($this->queueArr);

        $this->curSize--;
        return $result;        
    }
}

$lists = new singleLinkQueue();
$node1 = new node(5, "猪无能");
$lists->pushLink($node1);
$node6 = new node(6, "白龙马");
$lists->pushLink($node6);
// var_dump($lists->front);die;

###########################################1

$node19 = new node(9, "唐僧");
$lists->pushLink($node19);
// var_dump($lists->rear);
// var_dump($lists->front);die;

$node2 = new node(10, '孙悟空');
$node3 = new node(3, '沙僧');
$node4 = new node(4, '牛魔王');
$lists->pushLink($node2);
$lists->pushLink($node3);
$lists->pushLink($node4);
echo "<pre>";
print_r($lists->front);
echo "<pre>";
$lists->showQueueLink();

###########################################4
var_dump($lists->popLink());
// var_dump($lists->popLink());
echo "<pre>";
print_r($lists->front);
echo "<pre>";
$lists->showQueueLink();die;
