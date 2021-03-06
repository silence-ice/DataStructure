<?php

header('content-type:text/html;charset=utf-8');

include_once("./StackLinked.class.php");
include_once('./QueueLinked.class.php');

class BTNode{
	public $mLchild = NULL;//左子树"指针"
	public $mRchild = NULL;//右子树“指针”
	public $mData = NULL;//结点数据域
	public $intLeftTag = NULL;//左标志域，为1时表示mLchild“指向”结点左孩子，为2表示“指向”结点直接前驱
	public $intRightTag = NULL;//右标志域，为1时表示mRchild“指向”结点右孩子，为2表示“指向”结点直接后继
}

class BinaryTree{
	public $mRoot;//根结点
	public $mPBTdata = NULL;//根据先序遍历录入的二叉树数据

	/**
     * 构造方法,初始化建立二叉树
     * 根据先序遍历录入的二叉树的数据，一维数组
	 *	每一个元素代表二叉树一个结点值,扩充结点值为''[长度为0的字符串]
     * @return void
     */
	public function __construct($btdata=array()){
		$this->mPBTdata = $btdata;//二叉树数据
		$this->mRoot = NULL;
		$this->getPreorderTraversalCreate($this->mRoot);
	}

	/**
     *按先序遍历方式建立二叉树
     *@param BTNode 二叉树结点，按引用方式传递
     */
	//$bt=new BinaryTree(array('A','B','D','','','E','','G','','','C','F','','',''));
	//&$btnode表示和$this->mRoot进行绑定
	public function getPreorderTraversalCreate(&$btnode){
		$elem = array_shift($this->mPBTdata);
		if ($elem === "") {
			$btnode = NULL;
		}else if($elem === NULL){
			return;
		}else{
			$btnode = new BTNode();
			$btnode->mData = $elem;
			$this->getPreorderTraversalCreate($btnode->mLchild);
			$this->getPreorderTraversalCreate($btnode->mRchild);
		}
	}

	/**
     *判断二叉树是否为空
     * @return boolean 如果二叉树不空返回true,否则返回false
     **/
    public function getIsEmpty(){
    	//确定某个类是否特定的类型，或者是否实现了特定的接口。
        if($this->mRoot instanceof BTNode){
            return false;
        }else{
            return true;
        }
    }

    /**
     *将二叉树置空
     */
    public function setBinaryTreeNull(){
        $this->mRoot=null;
    }

	/**
     *按先序遍历二叉树
     *
     *@param BTNode $rootnode 遍历过程中的根结点
     *@param array $btarr 接收值的数组变量，按引用方式传递
     *@return void
     */
    public function getPreorderTraversal($rootnode,&$btarr){
        if($rootnode!=null){
            $btarr[]=$rootnode->mData;
            $this->getPreorderTraversal($rootnode->mLchild,$btarr);
            $this->getPreorderTraversal($rootnode->mRchild,$btarr);
        }
    }

    /**
     *先序遍历的非递归算法
     * @param BTNode $objRootNode 二叉树根节点
     * @param array $arrBTdata 接收值的数组变量，按引用方式传递
     * @return void
     */
    public function getPreorderTraversalNoRecursion($objRootNode,&$arrBTdata){
        if($objRootNode instanceof BTNode){
            $objNode = $objRootNode;

            $objStack = new StackLinked();
            do{
            	//赋值结点数据
                $arrBTdata[] = $objNode->mData;
                //结点指针指向右子树
                $objRNode = $objNode->mRchild;

                if($objRNode != null){
                    $objStack->getPushStack($objRNode);
                }
    //             echo "<pre>";
				// print_r($objStack);
				// echo "<pre>";
				// die;

                $objNode = $objNode->mLchild;
                // var_dump($objNode);die;
                if($objNode == null){
                    $objStack->getPopStack($objNode);
                }
            }while($objNode != null);
        }else{
            $arrBTdata=array();
        }
    }

    /**
     *中序遍历二叉树
     *
     *@param BTNode $objRootNode 过程中的根节点
     *@param array $arrBTdata 接收值的数组变量,按引用方式传递
     *@return void
     */
    public function getInorderTraversal($objRootNode,&$arrBTdata){
        if($objRootNode!=null){
            $this->getInorderTraversal($objRootNode->mLchild,$arrBTdata);
            $arrBTdata[]=$objRootNode->mData;
            $this->getInorderTraversal($objRootNode->mRchild,$arrBTdata);
        }
    }
    /**
     *中序遍历的非递归算法
     *
     *@param BTNode $objRootNode 二叉树根结点
     *@param array $arrBTdata 接收值的数组变量，按引用方式传递
     *@return void
     */
    public function getInorderTraversalNoRecursion($objRootNode,&$arrBTdata){
        if($objRootNode instanceof BTNode){
            $objNode=$objRootNode;
            $objStack=new StackLinked();
            //中序遍历左子树及访问根节点
            do{
                while($objNode!=null){
                    $objStack->getPushStack($objNode);
                    $objNode=$objNode->mLchild;
                }
                $objStack->getPopStack($objNode);
                $arrBTdata[]=$objNode->mData;
                $objNode=$objNode->mRchild;
            }while(!$objStack->getIsEmpty());
            //中序遍历右子树
            do{
                while($objNode!=null){
                    $objStack->getPushStack($objNode);
                    $objNode=$objNode->mLchild;
                }
                $objStack->getPopStack($objNode);
                $arrBTdata[]=$objNode->mData;
                $objNode=$objNode->mRchild;
            }while(!$objStack->getIsEmpty());
        }else{
            $arrBTdata=array();
        }
    }

    /**
     *后序遍历二叉树
     *
     *@param BTNode $objRootNode  遍历过程中的根结点
     *@param array $arrBTdata 接收值的数组变量，引用方式传递
     *@return void
     */
    public function getPostorderTraversal($objRootNode,&$arrBTdata){
        if($objRootNode!=null){
            $this->getPostorderTraversal($objRootNode->mLchild,$arrBTdata);
            $this->getPostorderTraversal($objRootNode->mRchild,$arrBTdata);
            $arrBTdata[]=$objRootNode->mData;
        }
    }
    /**
     *后序遍历非递归算法
     *
    BTNode $objRootNode 二叉树根节点
    array $arrBTdata 接收值的数组变量，按引用方式传递
    void
     */
    public function getPostorderTraversalNoRecursion($objRootNode,&$arrBTdata){
        if($objRootNode instanceof BTNode){
            $objNode=$objRootNode;
            $objStack=new StackLinked();
            $objTagStack=new StackLinked();
            $tag=1;
            do{
                while($objNode!=null){
                    $objStack->getPushStack($objNode);
                    $objTagStack->getPushStack(1);
                    $objNode=$objNode->mLchild;
                }
                $objTagStack->getPopStack($tag);
                $objTagStack->getPushStack($tag);
                if($tag == 1){
                    $objStack->getPopStack($objNode);
                    $objStack->getPushStack($objNode);
                    $objNode=$objNode->mRchild;
                    $objTagStack->getPopStack($tag);
                    $objTagStack->getPushStack(2);
 
                }else{
                    $objStack->getPopStack($objNode);
                    $arrBTdata[]=$objNode->mData;
                    $objTagStack->getPopStack($tag);
                    $objNode=null;
                }
            }while(!$objStack->getIsEmpty());
        }else{
            $arrBTdata=array();
        }
    }

    /**
     *层次遍历二叉树
     *
     *@param BTNode $objRootNode二叉树根节点
     *@param array $arrBTdata 接收值的数组变量，按引用方式传递
     *@return void
     */
    public function getLevelorderTraversal($objRootNode,&$arrBTdata){
        if($objRootNode instanceof BTNode){
            $objNode=$objRootNode;
            $objQueue=new QueueLinked();
            $objQueue->getInsertElem($objNode);
            while(!$objQueue->getIsEmpty()){
                $objQueue->getDeleteElem($objNode);
                $arrBTdata[]=$objNode->mData;
                if($objNode->mLchild != null){
                    $objQueue->getInsertElem($objNode->mLchild);
                }
                if($objNode->mRchild != null){
                    $objQueue->getInsertElem($objNode->mRchild);
                }
            }
        }else{
            $arrBTdata=array();
        }
    }

    /**
     *求二叉树叶子结点的个数
     *
     *@param BTNode $objRootNode 二叉树根节点
     *@return int 参数传递错误返回-1
     **/
    public function getLeafNodeCount($objRootNode){
        if($objRootNode instanceof BTNode){
            $intLeafNodeCount=0;
            $objNode=$objRootNode;
            $objStack=new StackLinked();
            do{
                if($objNode->mLchild == null && $objNode->mRchild == null){
                    $intLeafNodeCount++;
                }
                $objRNode=$objNode->mRchild;
                if($objRNode != null){
                    $objStack->getPushStack($objRNode);
                }
                $objNode=$objNode->mLchild;
                if($objNode == null){
                    $objStack->getPopStack($objNode);
                }
            }while($objNode != null);
            return $intLeafNodeCount;
        }else{
            return -1;
        }
    }

    /**
     *求二叉树的深度
     *
     *@param BTNode $objRootNode 二叉树根节点
     *@return int 参数传递错误返回-1
     */
    public function getBinaryTreeDepth($objRootNode){
        if($objRootNode instanceof BTNode){
            $objNode=$objRootNode;
            $objQueue=new QueueLinked();
            $intBinaryTreeDepth=0;
            $objQueue->getInsertElem($objNode);
            $objLevel=$objNode;
            while(!$objQueue->getIsEmpty()){
                $objQueue->getDeleteElem($objNode);
                if($objNode->mLchild != null){
                    $objQueue->getInsertElem($objNode->mLchild);
                }
                if($objNode->mRchild != null){
                    $objQueue->getInsertElem($objNode->mRchild);
                }
                if($objLevel == $objNode){
                    $intBinaryTreeDepth++;
                    $objLevel=@$objQueue->mRear->mElem;
                }
            }
            return $intBinaryTreeDepth;
        }else{
            return -1;
        }
    }

}

echo "<pre>";
$bt=new BinaryTree(array('A','B','D','','','E','','G','','','C','F','','',''));
echo "二叉树结构：\r\n";
print_r($bt);

$btarr = array();
echo "先序递归遍历二叉树：\r\n";
$bt->getPreorderTraversal($bt->mRoot,$btarr);
print_r($btarr);

echo "先序非递归遍历二叉树：\r\n";
$arrBTdata=array();
$bt->getPreorderTraversalNoRecursion($bt->mRoot,$arrBTdata);
var_dump($arrBTdata);

echo "中序递归遍历二叉树：\r\n";
$arrBTdata=array();
$bt->getInorderTraversal($bt->mRoot,$arrBTdata);
var_dump($arrBTdata);


echo "中序非递归遍历二叉树：\r\n";
$arrBTdata=array();
$bt->getInorderTraversalNoRecursion($bt->mRoot,$arrBTdata);
var_dump($arrBTdata);

echo "后序递归遍历二叉树：\r\n";
$arrBTdata=array();
$bt->getPostorderTraversal($bt->mRoot,$arrBTdata);
var_dump($arrBTdata);

echo "后序非递归遍历二叉树:\r\n";
$arrBTdata=array();
$bt->getPostorderTraversalNoRecursion($bt->mRoot,$arrBTdata);
var_dump($arrBTdata);

echo "按层次遍历二叉树：\r\n";
$arrBTdata=array();
$bt->getLevelorderTraversal($bt->mRoot,$arrBTdata);
var_dump($arrBTdata);

echo "叶子结点的个数为：".$bt->getLeafNodeCount($bt->mRoot);
echo "\r\n";

echo "二叉树深度为:".$bt->getBinaryTreeDepth($bt->mRoot);
echo "\r\n";

echo "判断二叉树是否为空：";
var_dump($bt->getIsEmpty());

echo "将二叉树置空后：";
$bt->setBinaryTreeNull();
var_dump($bt);

echo "</pre>";
