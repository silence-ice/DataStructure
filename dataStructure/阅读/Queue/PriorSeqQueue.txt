<?php 
/**
 * 顺序优先级队列(非循环)
 * 优先级队列的出队操作不是把队头出列，而是把队列的最高优先级的元素出列。
 *
 */
class PriorSeqQueue{
    private $SqArr;
    private $front;//指向队头元素
    private $rear;//如果队列不为空，则指向队尾元素的下一个位置
 
    //对变量进行初始化
    public function __construct(){
        $this->SqArr=array();
        $this->front=0;
        $this->rear=0;
    }
 
    //销毁队列
    public function DestroyQueue(){
        $this->SqArr=null;
        $this->front=0;
        $this->rear=0;
    }
 
    //清空队列
    public function ClearQueue(){
        $this->SqArr=array();
        $this->front=0;
        $this->rear=0;
    }
 
    //判断队列是否为空
    public function QueueEmpty(){
        if($this->front==$this->rear){
            return 'Null';
        }else{
            return 'No Null';
        }
    }
 
    //队列的长度
    public function QueueLenghth(){
        return $this->rear-$this->front;
    }
 
    //入队
    public function EnQueue($elem){
        $this->SqArr[$this->rear++]=$elem;
    }
 
    //出队
    public function DeQueue(){
        if($this->front==$this->rear){
            return 'Queue is Empty';
        }
        //找二维数组中prior最小并出队
        $minQueue = $this->SqArr[$this->front]['prior'];//队头优先级
        $minIndex = 0;//队头下标索引,一直为0
        $cur = $this->front;

        //这里使用$cur = $this->front;但$cur++时,front并没有加是因为$this->front不是对象而是整型
        for($i=$cur++; $i<$this->rear; $i++){
            if ($this->SqArr[$i]['prior'] < $minQueue) {
                $minQueue = $this->SqArr[$i]['prior'];
                $minIndex = $i;
            }
        }
        // var_dump($minQueue, $minIndex);die;

        //将移出目标之后的元素向前移动一位
        for ($i=$minIndex+1; $i < $this->rear; $i++) { 
            $this->SqArr[$i-1] = $this->SqArr[$i];
        }

        $this->rear--;
        return 'OK';
    }
 
    //遍历队列元素
    public function QueueTraverse(){
        $arr=array();
        for($i=$this->front;$i<$this->rear;$i++){
            $arr[]=$this->SqArr[$i];
        }
        return $arr;
        // return $this->SqArr;
    }
}
$arr1 = array(
    "prior" => 3,
    "name" => '孙悟空'
    );
$arr2 = array(
    "prior" => 4,
    "name" => '猪悟能'
    );
$arr3 = array(
    "prior" => 19,
    "name" => '唐僧'
    );
$arr4 = array(
    "prior" => 2,
    "name" => '白龙马'
    );
$arr5 = array(
    "prior" => 20,
    "name" => '白骨精'
    );
$link = new PriorSeqQueue();
$link->EnQueue($arr1);
$link->EnQueue($arr4);
$link->EnQueue($arr3);
$link->EnQueue($arr2);
$link->EnQueue($arr5);
var_dump($link->QueueTraverse());
$link->DeQueue();
var_dump($link->QueueTraverse());
