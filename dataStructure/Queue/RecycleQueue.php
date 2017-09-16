<?php
/**
 * 循环顺序队列
 */
class SqQueue3{
    const ARR_MAX=6;
    private $SqArr;
    private $front;
    private $rear;
 
    //初始化队列
    public function __construct(){
        $this->SqArr=array();
        $this->front=0;
        $this->rear=0;
    }
 
    //销毁队列
    public function DestroyQueue(){
        $this->SqArr=null;
        $this->front=$this->rear=0;
    }
 
    //清空队列
    public function ClearQueue(){
        $this->SqArr=array();
        $this->front=$this->rear=0;
    }
 
    //队列是否为空
    public function QueueEmpty(){
        if($this->front==$this->rear){
            return '队列为空！';
        }else{
            return '队列不为空！';
        }
    }
 
    //队列的长度
    public function QueueLength(){
        return ($this->rear - $this->front + self::ARR_MAX) % self::ARR_MAX;
    }
 
    //取得队头元素
    public function GetHead(){
        if($this->rear==$this->front){
            return '队列为空！';
        }
        return $this->SqArr[$this->front];
    }
 
    //从队尾掺入元素
    public function EnQueue($elem){
        $tail=($this->rear + 1)%self::ARR_MAX;
        //如果此值等于头元素说明队列已满.
        //当key到了19时候,+1之后再%20刚好等于$this->front,只能输出19个
        if($tail == $this->front){
            return '队列已满！';
        }
        $this->SqArr[$this->rear]=$elem;
        $this->rear=($this->rear+1)%self::ARR_MAX;
        return 'OK';
    }
 
    //从队头删除元素
    public function DeQueue(){
        if($this->rear==$this->front){
            return '队列为空！';
        }
        unset($this->SqArr[$this->front]);//删除arr[$front]所在的值
        $this->front=($this->front + 1)%self::ARR_MAX;
        return 'OK';
    }
 
    //遍历队元素
    // public function QueueTraverse(){
    //     $arr=array();
    //     for($i=0;$i<self::ARR_MAX;$i++){
    //         if(isset($this->SqArr[$i])){
    //             $arr[]=$this->SqArr[$i];
    //         }
    //     }
    //     return $arr;
    // }
    // //或者
    public function QueueTraverse2(){
        $arr=array();
        $i=$this->front;
        while($i != $this->rear){
            if (isset($this->SqArr[$i])) {
                $arr[]=$this->SqArr[$i];
            }
            $i=($i+1)%self::ARR_MAX;
        }
        return $arr;
    }
}
$link = new SqQueue3();
var_dump($link->QueueLength());
$link->EnQueue("1");
$link->EnQueue("2");
$link->EnQueue("3");
var_dump($link->EnQueue("4"));//返回ERROR
var_dump($link->QueueLength());//3
var_dump($link->QueueTraverse2());

$link->DeQueue();
// $link->DeQueue();
$link->EnQueue("20");//OK
var_dump($link->EnQueue("21"));//OK
var_dump($link->QueueTraverse2());
var_dump($link->QueueLength());//3