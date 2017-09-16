<?php
/**
 * 非递归二叉树遍历
 * http://www.cnblogs.com/zemliu/archive/2012/09/24/2700878.html
 */
class Node {
    public $value;
    public $left;
    public $right;
}

//前序遍历，访问根节点->遍历子左树->遍历右左树
function preorder($root){
    $stack = array();
    array_push($stack, $root);//复制一份$root,$root[0]为真实二叉树

    while(!empty($stack)){
        $center_node = array_pop($stack);//第一次循环：$center_node为真实二叉树，$stack为空

        echo $center_node->value.' ';
        
        if($center_node->right != null) {
           array_push($stack, $center_node->right);//复制一份$root
        }

        if($center_node->left != null) {
           array_push($stack, $center_node->left);
        }
    }
}

//中序遍历，遍历子左树->访问根节点->遍历右右树
function inorder($root){
    $stack = array();
    $center_node = $root;//真实二叉树
    while (!empty($stack) || $center_node != null) {
         while ($center_node != null) {
             array_push($stack, $center_node);
             $center_node = $center_node->left;
         }

         $center_node = array_pop($stack);
         echo $center_node->value . " ";

         $center_node = $center_node->right;
     }
}

//后序遍历，遍历子左树->访问子右树->遍历根节点
function postorder($root){
        $pushstack = array();
        $visitstack = array();
        array_push($pushstack, $root);
 
        while (!empty($pushstack)) {
            $center_node = array_pop($pushstack);
            array_push($visitstack, $center_node);
            if ($center_node->left != null) {
                array_push($pushstack, $center_node->left);
            }
            if ($center_node->right != null) {
                array_push($pushstack, $center_node->right);
            }
        }
 
        while (!empty($visitstack)) {
            $center_node = array_pop($visitstack);
            echo $center_node->value. " ";
        }
}

/*
Array
(
    [0] => Node Object
        (
            [value] => A
            [left] => Node Object
                (
                    [value] => B
                    [left] => Node Object
                        (
                            [value] => D
                            [left] => 
                            [right] => 
                        )

                    [right] => 
                )

            [right] => Node Object
                (
                    [value] => C
                    [left] => Node Object
                        (
                            [value] => E
                            [left] => 
                            [right] => 
                        )

                    [right] => Node Object
                        (
                            [value] => F
                            [left] => 
                            [right] => 
                        )

                )

        )

)
 */
//创建$a如上图所示的二叉树
$a = new Node();
$b = new Node();
$c = new Node();
$d = new Node();
$e = new Node();
$f = new Node();
$a->value = 'A';
$b->value = 'B';
$c->value = 'C';
$d->value = 'D';
$e->value = 'E';
$f->value = 'F';
$a->left = $b;
$a->right = $c;
$b->left = $d;
$c->left = $e;
$c->right = $f;

//前序遍历
preorder($a);  //结果是：A B D C E F
inorder($a);  //结果是： D B A E C F
postorder($a); //结果是:  D B E F C A

