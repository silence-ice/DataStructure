<?php
/**
  * 单链表
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
class singelLinkList{
    public $header; //链表头节点,使用public用于打印显示
   
    //构造方法 
    public function __construct($id = null, $name = null){ 
        $this->header = new node ( $id, $name, null ); 
    } 

    //获取链表长度   
    public function getLinkLength() {   
        $i = 0;   
        $cur = $this->header;   
        while ( $cur->next != null ) {   
            $i ++;   
            $cur = $cur->next;   
        }   
        return $i;   
    }   
  
    //判断链表是否为空  
    public function isEmpty(){  
        $cur = $this->header;
        // print_r($cur);die;
        return $cur == null;  
    }  
  
    //清空链表  
    public function clear(){  
        $this->header = null;//删除原有对象
        $this->header = new node ( null, null, null ); //new新对象
    } 

    //查看链表
    public function showLink(){
        $cur = $this->header;
        while ($cur->next) {
            echo $cur->next->id,'###',$cur->next->name,'<br />';
            $cur = $cur->next;
        }
        echo '<hr />';
    }

    //头插入结点(头插法)
    public function unshiftLink($node){
        //1)头结点的next指向新结点的next
        //2)头结点的next指向新结点
        $cur = $this->header;
        $node->next = $cur->next;
        $cur->next  = $node;
        return $this->header;
    }

    //尾插入结点(尾插法)
    public function pushLink($node){
        //指针或引用在传值时，都会改变原有的内容
        $cur = $this->header;
        while (NULL != $cur->next) {
            $cur = $cur->next;
        }
        $cur->next  = $node;
        return $this->header;
    }

    //顺序插入结点
    public function insertLink($node){
        if (empty($node)) {
            echo "node is empty!";
            exit;
        }

        $cur = $this->header;
        //从第一个next开始,循环下去
        while (NULL != $cur->next) {
            if ($cur->next->id > $node->id) {
                break;
            }
            //如果没有则插到尾结点
            $cur = $cur->next;
        }
        $node->next = $cur->next;
        $cur->next  = $node;
        // var_dump($node->next, $cur->next);die;
        return $this->header;
    }

    //获取结点name值
    public function getLinkName($node){
        if (empty($node)) {
            echo "node is empty!";
            exit;
        }

        $cur = $this->header;
        $link_tag = false;
        while (NULL != $cur->next) {
            if ($cur->next->id == $node->id) {
                $link_tag = true;
                break;
            }
            $cur = $cur->next;
        }

        if (!$link_tag) {
            return "no exist!";
        }
        return  $cur->next->name;   
    }

    //修改结点name值
    public function editLinkName($node){
        $cur = $this->header;
        while (NULL != $cur->next) {
            if ($cur->next->id == $node->id) {
                break;
            }
            $cur = $cur->next;
        }
        $cur->next->name = $node->name;
        return $this->header;      
    }

    //取出某元素结点
    public function deleteLink($node){
        $cur = $this->header;
        while (NULL != $cur->next) {
            if ($cur->next == $node) {
                break;
            }
            $cur = $cur->next;//不会对$front有影响
        }

        $cur->next = $node->next;;//进行指针引用(next),对$front产生影响
        return $this->header;
    }
}

$lists = new singelLinkList();
$node1 = new node(1, '唐三藏');
// var_dump($node1);
$lists->pushLink($node1);
// var_dump($lists->header);die;

###########################################1

$node19 = new node(19, '牛魔王');
$lists->pushLink($node19);
$node19->name = '牛大师';//指针在传值时，都会改变原有的内容
// var_dump($lists->header);die;

###########################################2

// $lists->showLink();
// die;

###########################################3

$node2 = new node(2, '孙悟空');
$lists->insertLink($node2);
// echo "<pre>";
// print_r($lists->header);
// echo "<pre>";
// $lists->showLink();
// die;

###########################################4

$node3 = new node(5, '白龙马');
$lists->pushLink($node3);
// $lists->showLink();die;

###########################################5

$node4 = new node(3, '猪八戒');
$lists->insertLink($node4);
// $lists->showLink();

$node5 = new node(4, '沙和尚');
$lists->insertLink($node5);
// $lists->showLink();die;
###########################################6

$node4->name = '猪悟能';//指针在传值时会改变内容,所以singelLinkList::editLinkName没有必要
unset($node4);
$node4 = new node(3, '猪悟能1');
// $lists->showLink();
$lists->editLinkName($node4);
// $lists->showLink();die;

###########################################7

$lists->deleteLink($node1);
// $lists->showLink();
$node1->name = "唐唐";
// print_r($lists->getLinkLength());//5
// echo "<pre>";
// print_r($node1);
// echo "<pre>";
// die;
###########################################8
// var_dump($lists->getLinkName($node5));//沙和尚
// var_dump($lists->isEmpty());//false
$lists->showLink();
$node100 = new node(100, "佛祖");
// $lists->unshiftLink($node100);
// $lists->clear();
$lists->showLink();

###########################################9
