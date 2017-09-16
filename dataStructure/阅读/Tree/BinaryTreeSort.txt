<?php
/**  
 * 二叉树的定义
 */
class BinaryTree {
    public $key = NULL;      //  当前节点的值
    public $left = NULL;     //  左子树
    public $right = NULL;    //  右子树
    /**      
    *以指定的值构造二叉树，并指定左右子树      *
    * @param mixed $key 节点的值.
    * @param mixed $left 左子树节点.
    * @param mixed $right 右子树节点.
    */
    public function __construct( $key = NULL, $left = NULL, $right = NULL) {
        $this->key = $key;
        if ($key === NULL) {//$key为NULL子树肯定也为NULL
            $this->left = NULL;
            $this->right = NULL;
        }else{
            $this->left = ($left === NULL) ? NULL : new BinaryTree($left);
            $this->right = ($right === NULL) ? NULL : new BinaryTree($right);
        }
    }
 
    /**
     * 析构方法.
     */
    public function __destruct() {
        $this->key = NULL;
        $this->left = NULL;
        $this->right = NULL;
    }
 
    /**
    * 清空二叉树.
    **/
    public function purge () {
        $this->key = NULL;
        $this->left = NULL;
        $this->right = NULL;
    }
 
    /**
     * 测试当前节点是否是叶节点.
     * @return boolean 如果节点非空并且有两个空的子树时为真，否则为假.
     */
    public function isLeaf() {
        return !$this->isEmpty() &&
            $this->left->isEmpty() &&
            $this->right->isEmpty();
    }
 
    /**
     * 测试节点是否为空
     *
     * @return boolean 如果节点为空返回真，否则为假.
     */
    public function isEmpty() {
        return $this->key === NULL;
    }
 
    /**
     * Key getter.
     */
    public function getKey() {
        if ($this->isEmpty()) {
            echo "key is empty!";
            exit;
        }
        return $this->key;
    }
 
    /**
     * 给节点指定Key值,节点必须为空
     */
    public function attachKey($obj) {
        if (!$this->isEmpty()){
            echo "key is no empty!";
            exit;
        }
        $this->key = $obj;
        $this->left = NULL;
        $this->right = NULL;
        // $this->left = new BinaryTree();
        // $this->right = new BinaryTree();
    }
 
    /**
     * 删除key值，使得节点为空.
     */
    public function detachKey() {
        if (!$this->isLeaf()){
            echo "非叶子结点不能删除！";
            exit;
        }
        $result = $this->key;
        $this->key = NULL;
        $this->left = NULL;
        $this->right = NULL;
        return $result;
    }
 
    /**
     * 返回左子树
     * @return object BinaryTree 当前节点的左子树.
     */
    public function getLeft() {
        if ($this->isEmpty()){
            echo "sonLeftTree is empty!";
            exit;
        }
        return $this->left;
    }
 
    /**
     * 给当前结点添加左子树
     *
     * @param object BinaryTree $t 给当前节点添加的子树.
     */
    public function attachLeft(BinaryTree $t) {
        if ($this->isEmpty() || !$this->left->isEmpty()){
           echo "sonRightTree is no empty!";
           exit;
        }
        $this->left = $t;
        return $t;
    }
 
    /**
     * 删除左子树
     *
     * @return object BinaryTree  返回删除的左子树.
     */
    public function detachLeft() {
        if ($this->isEmpty()){
            echo "sonLeftTree is empty!";
            exit;
        }
        $result = $this->left;
        $this->left = new BinaryTree();
        return $result;
    }
 
    /**
     * 返回当前节点的右子树
     *
     * @return object BinaryTree 当前节点的右子树.
     */
    public function getRight() {
        if ($this->isEmpty()){
            echo "sonRightTree is empty!";
            exit;
        }
        return $this->right;
    }
 
    /**
     * 给当前节点添加右子树
     *
     * @param object BinaryTree $t 需要添加的右子树.
     */
    public function attachRight(BinaryTree $t) {
        if ($this->isEmpty() || !$this->right->isEmpty()){
           echo "sonRightTree is no empty!";
           exit; 
        }
        $this->right = $t;
        return $t;
    }
 
    /**
     * 删除右子树，并返回此右子树
     * @return object BinaryTree 删除的右子树.
     */
    public function detachRight() {
        if ($this->isEmpty ()){
            echo "sonRightTree is empty!";
            exit;
        }
        $result = $this->right;
        $this->right = new BinaryTree();
        return $result;
    }
 
    /**
     * 先序遍历
     */
    public function preorderTraversal() {
        if ($this->isEmpty()) {
            return ;
        }
        echo ' ', $this->getKey();
        $this->getLeft()->preorderTraversal();
        $this->getRight()->preorderTraversal();
    }
    /**
     * 中序遍历
     */
    public function inorderTraversal() {
        if ($this->isEmpty()) {
            return ;
        }
        $this->getLeft()->preorderTraversal();
        echo ' ', $this->getKey();
        $this->getRight()->preorderTraversal();
    }
 
    /**
     * 后序遍历
     */
    public function postorderTraversal() {
        if ($this->isEmpty()) {
            return ;
        }
        $this->getLeft()->preorderTraversal();
        $this->getRight()->preorderTraversal();
        echo ' ', $this->getKey();
    }
}
##############################################################
// $tree = new BinaryTree();
// $tree->attachKey("5");//填充key时会自动将左右子树扩张
// var_dump($tree->getKey());//5
// $tree->detachKey();//删除key
// var_dump($tree);

##############################################################
// $tree2 = new BinaryTree("2", NULL, "3");
// $tree2->getRight();//右子树不为空
// $tree2->detachRight();//删除右子树
// $tree2->attachRight(new BinaryTree("5", NULL, NULL));
// var_dump($tree2);
// $tree2->purge();
// var_dump($tree2);

##############################################################


/**
 * 二叉排序树的PHP实现
 */
class BST extends BinaryTree {
    /**
     * 构造空的二叉排序树
     */
    public function __construct() {
        parent::__construct(NULL, NULL, NULL);
    }
 
    /**
     * 析构
     */
    public function __destruct() {
        parent::__destruct();
    }
 
    /**
     * 测试二叉排序树中是否包含参数所指定的值
     *
     * @param mixed $obj 查找的值.
     * @return boolean True 如果存在于二叉排序树中则返回真，否则为假期
     */
    public function contains($obj) {
        if ($this->isEmpty())
            return false;
        $diff = $this->compare($obj);
        if ($diff == 0) {
            return true;
        }elseif ($diff < 0)             
            return $this->getLeft()->contains($obj);
        else
            return $this->getRight()->contains($obj);
    }
 
    /**
     * 查找二叉排序树中参数所指定的值的位置
     *
     * @param mixed $obj 查找的值.
     * @return boolean True 如果存在则返回包含此值的对象，否则为NULL
     */
    public function find($obj) {
        if ($this->isEmpty())
            return NULL;
        $diff = $this->compare($obj);
        if ($diff == 0)
            return $this->getKey();
        elseif ($diff < 0)             
            return $this->getLeft()->find($obj);
        else
            return $this->getRight()->find($obj);
    }
 
    /**
     * 返回二叉排序树中的最小值
     * @return mixed 如果存在则返回最小值，否则返回NULL
     */
    public function findMin() {
        if ($this->isEmpty ())
            return NULL;
        elseif ($this->getLeft()->isEmpty())
            return $this->getKey();
        else
            return $this->getLeft()->findMin();
    }
 
    /**
     * 返回二叉排序树中的最大值
     * @return mixed 如果存在则返回最大值，否则返回NULL
     */
    public function findMax() {
        if ($this->isEmpty ())
            return NULL;
        elseif ($this->getRight()->isEmpty())
            return $this->getKey();
        else
            return $this->getRight()->findMax();
    }
 
    /**
     * 给二叉排序树插入指定值
     *
     * @param mixed $obj 需要插入的值.
     * 如果指定的值在树中存在，则返回错误
     */
    // array(50, 3, 10, 60, 100, 56, 78)
    public function insert($obj) {
        if ($this->isEmpty()) {
            $this->attachKey($obj);
        } else {
            $diff = $this->compare($obj);
            if ($diff == 0)
                die('argu error');
            if ($diff < 0)
                $this->getLeft()->insert($obj);
            else
                $this->getRight()->insert($obj);
        }
        // $this->balance();
    }
 
    /**
     * 从二叉排序树中删除指定的值
     *
     * @param mixed $obj 需要删除的值.
     */
    public function delete($obj) {
        if ($this->isEmpty ())
            die();
 
        $diff = $this->compare($obj);
        if ($diff == 0) {
            if (!$this->getLeft()->isEmpty()) {
                $max = $this->getLeft()->findMax();
                $this->key = $max;
                $this->getLeft()->delete($max);
            }
            elseif (!$this->getRight()->isEmpty()) {
                $min = $this->getRight()->findMin();
                $this->key = $min;
                $this->getRight()->delete($min);
            } else
                $this->detachKey();
        } else if ($diff < 0){
            $this->getLeft()->delete($obj);
        } else {
            $this->getRight()->delete($obj);
        }
        // $this->balance();
    }
 
    public function compare($obj) {
        return $obj - $this->getKey();
    }
 
    /**
     * 给节点指定Key值,节点必须为空    
     */
    public function attachKey($obj) {
        if (!$this->isEmpty())
            return false;
        $this->key = $obj;
        $this->left = new BST();
        $this->right = new BST();
    }
 
    /**
     * Main program.
     *
     * @param array $args Command-line arguments.
     * @return integer Zero on success; non-zero on failure.
     */
    public static function main($args) {
        printf("BinarySearchTree main program.\n");
        $root = new BST();
        foreach ($args as $row) {
            $root->insert($row);
        }
        return $root;
    }
}
 
$root = BST::main(array(50, 3, 10, 5, 60, 100, 56, 78));
echo "<pre>";
print_r($root);
echo "<pre>";
var_dump($root->findMax());
$root->delete(100);
var_dump($root->findMax());
echo "<pre>";
print_r($root);
echo "<pre>";
die;
