<?php

interface ITree {

    public function getRoot();

    public function getParent(int $node_id);

    public function getChildren(int $node_id): array;

    public function getValue(int $node_id);
}

class Node {

    public $data = null;
    public $left = null;
    public $right = null;

    public function __construct($data) {
        $this->data = $data;
    }

}

class BinaryTree implements ITree {

    protected $root = null;
    protected $arr = [];

    public function __construct($arr) {
        $this->setRoot($this->root);
        $this->setArr($arr);
    }

// Getters / Setters: 

    public function setRoot($root) {
        if ($root !== null) {
            $this->root = $root;
        }
        return null;
    }

    public function getRoot() {
        return $this->root;
    }

    public function setArr($arr) {
        if ($arr !== null) {
            $this->arr = $arr;
            foreach ($arr as $element) {
                $this->analizeArray($element);
            }
        }
        return false;
    }

    public function getArr(){
        return $this->arr;
    }

    public function analizeArray($element) {

        $newNode = new Node($element);
        $current = $this->getRoot();

        if ($this->getRoot() === null) {

            $this->setRoot($newNode);

            return $this;
        }

        $elementId = json_encode($element['id']);



        while (true) {
            $currentId = json_encode($current->data['id']);

// if the array id less than current array (root), than element GO LEFT
            if ($elementId < $currentId) {

// if there is no left node make this element the LEFT NODE
                if ($current->left === null) {

                    $current->left = $newNode;

                    return $this;
                }

                $current = $current->left;

// if there is no Right node make this element the RIGHT NODE
            } else {
                if ($current->right === null) {

                    $current->right = $newNode;

                    return $this;
                }

                $current = $current->right;
            }
        }
    }

    public function getParent(int $node_id) {

        if ($this->root === null) {
            return false;
        }

        $current = $this->root;

        $found = false;
        while ($current && !$found) {
            if ($node_id < $current->data['id']) {
                $current = $current->left;
            } else if ($node_id > $current->data['id']) {
                $current = $current->right;
            } else {
                $found = true;
            }
        }

        if (!$found) {
            echo "Tis Node ID is not in the Tree";
        } else {
            $parentId = $current->data['parent_id'];
            if ($parentId === null) {
                return null;
            }
            $parent = $this->getValue($parentId);
            return $parent;
        }
    }

    public function getChildren(int $node_id): array {
        if ($this->root === null) {
            return false;
        }
        $current = $this->root;
        $found = false;
        while ($current && !$found) {
            if ($node_id < $current->data['id']) {
                $current = $current->left;
            } else if ($node_id > $current->data['id']) {
                $current = $current->right;
            } else {
                $found = true;
            }
        }


        $LeftAndRight = ["left" => $current->left, "right" => $current->right];
        if (!$found)
            echo "the value is not in the Tree";
        return $LeftAndRight;
    }

    public function getValue(int $node_id) {
        if ($this->root === null) {
            return false;
        }
        $current = $this->root;
        $found = false;
        while ($current && !$found) {
            if ($node_id < $current->data['id']) {
                $current = $current->left;
            } else if ($node_id > $current->data['id']) {
                $current = $current->right;
            } else {
                $found = true;
            }
        }

        if (!$found)
            echo "the value is not in the list";
        return $current->data;
    }
    
    public function firstRootValue($param) {
        return $this->root[0];
    }

}

