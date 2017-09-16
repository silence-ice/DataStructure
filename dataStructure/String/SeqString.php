<?php
/**
 * 顺序串
 * 1)php数组模拟
 * 2)无内存空间说法
 * 3)数组索引只存一个长度为1的字符
 */
class SeqString{
	public $curSize;
	public $maxSize;
	public $seqArr;

	public function __construct($arr, $maxSize){
		$this->seqArr = $arr;
		$this->curSize = $this->getStringLength($arr);//当前元素个数
		if ($this->curSize > $maxSize) {
			echo "current size length > max size length";
			exit;
		}else{

		}
		$this->maxSize = ($this->curSize <= $maxSize) ? 
						$maxSize : 
						die("current size length > max size length");
	}

	//获取串长度方法
	public function getStringLength($strArr){
		$count = 0;
		if (empty($strArr)) {
			return 0;
		}else{
			while (1) {
				if (isset($strArr[$count])) {
					$count ++;
					continue;
				}else{
					break;
				}
			}
			return $count;
		}
	}

	//获取串长度
	public function getCurSize(){
		return $this->curSize;
	}

	//在$pos位置插入数据
	public function insertSeqString($pos, $data){
		if (empty($pos) || empty($data)) {
			echo "参数不能为空！";
			exit;
		}

		if(strlen($data) != 1){
			echo "只能插入字符长度为1的元素";
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
	public function DeleteSeqString($pos){
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

	//删除$pos到$length下的数据
	public function DeleteSubSeqString($pos, $length){
		if ($this->curSize == 0) {
			echo "没有可以删除的元素！";
			exit;
		}
		if (!isset($pos) || $pos < 0 || $pos > $this->curSize) {
			echo "参数不能为空或删除位置越界！";
			exit;
		}
		if($length <= 0){
			echo "length 需要是正整数。";
			exit;
		}

		$remainLength = $this->curSize - $pos;//剩余长度

		$length = ($length > $remainLength) ? $remainLength : $length;
		// if ($length > $remainLength) {
		// 	$length = $remainLength;
		// }

		//从$pos+1到curSize+1逐个往前移
		for ($i=$pos; $i < $this->curSize ; $i++) { 
			if (!isset($this->seqArr[$i+$length])) {
				unset($this->seqArr[$i]);
				continue;
			}
			$this->seqArr[$i] = $this->seqArr[$i+$length];
		}

		$this->curSize = $this->curSize - $length;
		return "success";
	}

	//字符串反转
	public function reverseSeqString(){
		if ($this->curSize == 0) {
			echo "string length is zero!";
			exit;
		}
		
		$str = $this->getSeqString();//获取字符串
		// $str = "你好啊";
	    if (preg_match("/([\x80-\xff][\x40-\xfe])/", $str, $match)) {
	        //包含汉字
	        $strLen = mb_strlen($str);
			$newStr = "";
			for ($i=$strLen-1; $i >= 0; $i--) {  
				/*
				 * mb_substr( $str, $start, $length, $encoding ) 
				 * $str，需要截断的字符串 
				 * $start，截断开始处，起始处为0 
				 * $length，要截取的字数 
				 * $encoding，网页编码，如utf-8,GB2312,GBK 
				 */
				$newStr = $newStr.mb_substr($str, $i, 1, "utf-8");
			}
			return $newStr;
	    } else {
	    	//不包含汉字
	    	$strLen = strlen($str);
			$newStr = "";
			for ($i=$strLen-1; $i >= 0; $i--) { 
				$newStr = $newStr.$str[$i];
			}
			return $newStr;	
	    }
	}

	// 字符串比较
	public function StringCompare($str2){
		if (!isset($str2)) {
			return "no isset $str2!";
		}

		$str1 = $this->getSeqString();//获取字符串

		$strLen1 = strlen($str1);
		$strLen2 = strlen($str2);

		//选取比较短的长度进行匹配
		$cmpLen = ($strLen1 > $strLen2) ? $strLen2 : $strLen1;

		for ($i=0; $i < $cmpLen; $i++) { 
			if (ord($str1[$i]) > ord($str2[$i])) {
				return 1;
			}else if (ord($str1[$i]) < ord($str2[$i])) {
				return -1;
			}else{
				continue;
			}
		}

		if ($strLen1 == $strLen2) {
			return 0;
		}else if ($strLen1 > $strLen2) {
			return 1;
		}else{
			return -1;
		}
	}

	//字串匹配 Brute-Force
	public function FindSubString($subStr, $start){
		$mainLen = $this->curSize;//8
		$subLen = $this->getStringLength($subStr);//3
		$i = $start;
		$j = 0;
		// var_dump($this->seqArr, $subStr, $mainLen, $subLen);die;
		while ($i < $mainLen && $j < $subLen) {
			if (isset($subStr[$j])) {
				if ($this->seqArr[$i] == $subStr[$j]) {
					$i++;
					$j++;
				}else{
					$j = 0;
					$i = $i-$j+1;
				}
			}else{
				break;
			}
		}

		if ($j == $subLen) {
			return $i-$subLen;//匹配的开始索引
		}else{
			return -1;
		}
	}

	//获取$pos下的数据
	public function getSingleSeqString($pos){
		if ($pos < 0 || $pos > $this->curSize) {
			echo "插入位置越界！";
			exit;
		}

		return $this->seqArr[$pos];
	}

	//获取$pos后长度为length的数据
	public function getSubSeqString($pos, $length){
		if ($pos < 0 || $pos > $this->curSize) {
			echo "插入位置越界！";
			exit;
		}

		if($length <= 0){
			echo "length 需要是正整数。";
			exit;
		}

		$remainLength = $this->curSize - $pos;//剩余长度
		$subStr = "";

		if ($length > $remainLength) {
			$length = $remainLength;
		}

		for ($i=0; $i < $length; $i++) { 
			$subStr .= $this->seqArr[$pos+$i];
		}

		return $subStr;
	}

	//获取整个串
	public function getSeqString(){
		$str = "";
		for ($i=0; $i < $this->curSize ; $i++) { 
			$str .= $this->seqArr[$i];
		}
		return $str;
	}
}

$initStr = "HuangBin";
$arr = array("H","a","n","g","B","n");
$SeqString = new SeqString($arr, 10);
var_dump($SeqString->getCurSize());//6
var_dump($SeqString->getSeqString());
var_dump($SeqString->insertSeqString("1","u"));
var_dump($SeqString->insertSeqString("2","u"));
var_dump($SeqString->insertSeqString("7","i"));
var_dump($SeqString->seqArr);

var_dump($SeqString->DeleteSeqString("2"));//6
var_dump($SeqString->seqArr);

var_dump($SeqString->getSingleSeqString("2"));//a
var_dump($SeqString->getSubSeqString(2,3));

// $SeqString->DeleteSubSeqString(2, 3);
// var_dump($SeqString->seqArr);

var_dump($SeqString->reverseSeqString());
var_dump($SeqString->StringCompare("HuangBin1"));

$arr1 = array("B","i","n");
var_dump($SeqString->FindSubString($arr1, 2));
die;