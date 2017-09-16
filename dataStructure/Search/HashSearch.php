<?php
/**  
 * 链表
 * 拉链法解决冲突解决Hash冲突: 将所有的相同Hash值的key放在一个链表中
 */
class HashNode{
  public $key;
  public $value;
  public $nextNode;
  public function __construct($key, $value, $nextNode=Null){
    $this->key = $key;
    $this->value = $value;
    $this->nextNode = $nextNode;
  }
}

/**  
 * 哈希表
 */
class hashTable{
    public $collection;
    private $size = 100;

    //初始化哈希表的大小
    public function __construct($size=''){
        $bucketsSize = is_int($size)?$size:$this->size;
        $this->collection = new SplFixedArray($bucketsSize);
    }

    //生成散列值，作为存储数据的位置
    private function _hashAlgorithm($key){
        $length = strlen($key);
        $hashValue = 0;
        for($i=0; $i<$length; $i++) {
            $hashValue += ord($key[$i]);
        }
        return ($hashValue%($this->size));
    }

    //在相应的位置存储对应的值
    public function set($key, $val){
        $index = $this->_hashAlgorithm($key);

        if(isset($this->collection[$index])){
          $newNode = new HashNode($key, $val, $this->collection[$index]);
        }else{
          $newNode = new HashNode($key, $val, null);
        }
        $this->collection[$index] = $newNode;
        return true;
    }

    //根据键生成散列值，进而找到对应的值
    public function get($key){
        $index = $this->_hashAlgorithm($key);
        $current = $this->collection[$index];
        while(!empty($current)){
          if($current->key == $key){
            return $current->value;
          }
          $current = $current->nextNode;
        }
        return NULL;        
    }

    //删除某个值,成功返回1，失败返回0
    public function del($key){
        $index = $this->_hashAlgorithm($key);
        if(isset($this->collection[$index])) {
            unset($this->collection[$index]);
            return 1;
        } else {
            return 0;
        }
    }
}

//简单的测试
$list = new hashTable(200);

//插入数值
$list->set("zero", "zero compare");
$list->set("one", "first test");
$list->set("two", "second test");
$list->set("three", "three test");
$list->set("four", "fouth test");

//输出哈希表
echo "<pre>";
print_r($list->collection);

//获取数据
print_r($list->get("one"));//first test

//返回key的个数(Hash存在数值的个数)
// print_r($list->size());//5

//返回value的序列(Hash存在数值)
// print_r($list->val());

//顺序输出
// $list->sort(3);

//逆序输出
// $list->rev(3);
