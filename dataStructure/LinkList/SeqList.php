<?php
/**
 * 简述：创建顺序表类，使用线性表中的顺序表存储结构。
 * 方案：
 * 	1)线性表概念：
 * 		1>特点：除第一个和最后一个数据元素外，每个数据元素都只有一个前驱和后继数据元素。
 * 		2>操作特点：可以在任意位置插入和删除一个数据元素。
 * 		3>线性表存储建构：顺序存储结构和链式存储结构。其中链式存储包括单链表、循环单链表、循环双向链表
 * 	2)实现顺序存储结构可以用数组进行代替。
 * 	3)数组把线性表的数据元素存储在连续的地址空间的内存单元中,这样线性表中逻辑上的相邻数据在物理存储地
 * 	  址上也相邻.
 *
 * 此方法的优缺点：
 *  优点：算法简单，空间单元利用率高
 *  缺点：预先确定数据元素最大个数，并且进行插入和删除操作时需要移动较多的数据元素
 */
class SeqList{
	private $curSize;
	private $seqArr;

	public function __construct($arr){
		$this->seqArr = $arr;
		$this->curSize = count($arr);//当前元素个数
	}

	//获取顺序表长度
	public function getCurSize(){
		return $this->curSize;
	}

	//在$pos位置插入数据
	public function insertSeqList($pos, $data){
		if (empty($pos) || empty($data)) {
			echo "参数不能为空！";
			exit;
		}

		if ($pos < 0 || $pos > $this->curSize) {
			echo "插入位置越界！";
			exit;
		}

		//从curSize-1到i逐个往后移
		for($i=$this->curSize; $i>$pos; $i--){
			$this->seqArr[$i] = $this->seqArr[$i-1];
		}

		$this->seqArr[$pos] = $data;
		$this->curSize++;

		return true;
	}

	//删除$pos下的数据
	public function DeleteSeqList($pos){
		if ($this->curSize == 0) {
			echo "没有可以删除的元素！";
			exit;
		}
		if (!isset($pos) || $pos < 0 || $pos > $this->curSize) {
			echo "参数不能为空或删除位置越界！";
			exit;
		}

		$result = $this->seqArr[$pos];

		//从$pos+1到curSize+1逐个往前移
		for ($i=$pos; $i < $this->curSize ; $i++) { 
			if (!isset($this->seqArr[$i+1])) {
				unset($this->seqArr[$i]);
				break;
			}
			$this->seqArr[$i] = $this->seqArr[$i+1];
		}
		$this->curSize--;

		return $result;
	}

	//获取$pos下的数据
	public function getSingleSeqList($pos){
		if ($pos < 0 || $pos > $this->curSize) {
			echo "插入位置越界！";
			exit;
		}

		return $this->seqArr[$pos];
	}

	//获取整个顺序表
	public function getSeqList(){
		return $this->seqArr;
	}
}

$arr = array("1","2","3","4","5");
$seqList = new SeqList($arr);
var_dump($seqList->getCurSize());//0
var_dump($seqList->getSeqList());
var_dump($seqList->insertSeqList("2","6"));//true
var_dump($seqList->getSeqList());
var_dump($seqList->DeleteSeqList("2"));//6
var_dump($seqList->getSeqList());
var_dump($seqList->getSingleSeqList("2"));//3