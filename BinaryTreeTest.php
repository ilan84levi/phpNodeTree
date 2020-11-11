<?php 

use PHPUnit\Framework\TestCase;

class BinaryTreeTest extends TestCase{


    public function dataTesting(){

        return [
            ['id'=> 2 , 'parent_id'=> 1 , 'value'=> 'david- child 1'],
            ['id'=> 1 , 'parent_id'=> null , 'value'=> 'grandfather- root'],
            ['id'=> 3 , 'parent_id'=> 1 , 'value'=> 'sharon- child 2'],
            ['id'=> 4 , 'parent_id'=> 2 , 'value'=> 'grandchild']
         ];
    }

        // Testing __construct function , $arr and $root
    public function testConstructFunction(){
        $arrEmpty = [];

        // first sending empty array 
        $binaryTreeEmpty = new BinaryTree($arrEmpty);
        
        // get the root when passing empty array we should get null 
        $this->assertEquals(null,$binaryTreeEmpty->getRoot());


        // when passing empty array we should get empty array
        $this->assertEquals([],$binaryTreeEmpty->getArr());

        // sending array of objects to see if we get object
        $arrayOfObjects = $this->dataTesting();
        $binaryTree = new BinaryTree($arrayOfObjects);
        $this->assertIsObject($binaryTree->getRoot());

        //check if we get the array we have set
        $this->assertEquals($arrayOfObjects,$binaryTree->getArr());

    }


    //testing the function analizeArray() 
         /**
     * sending each object to the function and see 
     * if we get object.
     */

    public function testFunctionAnalizeArray(){

        $arr = $this->dataTesting();
        $binaryTree = new BinaryTree($arr);

        //for each element we check if we get object
        foreach ($arr as $element) {
            
             $this->assertIsObject($binaryTree->analizeArray($element));

        }
        
    }

    
    // testing if we get the right parent when we search by id
    public function testWeGetiingTheRightParent(){

        $arr = $this->dataTesting();
        $binaryTree = new BinaryTree($arr);

        //'id'=> 2 , 'parent_id'=> 1 
        $firstObjectInTheArray = $arr[0];

        //'id'=> 1 , 'parent_id'=> null
        $secondElementInTheArray = $arr[1];

        //'id'=> 3 , 'parent_id'=> 1 
        $thirdElementInTheArray = $arr[2];

        $this->assertEquals(null, $binaryTree->getParent(1));
        $this->assertEquals($secondElementInTheArray, $binaryTree->getParent(2));
        $this->assertEquals($secondElementInTheArray, $binaryTree->getParent(3));
        $this->assertEquals($firstObjectInTheArray, $binaryTree->getParent(4));
    }


    // test if we get the correct value
    public function testGetValueFunction(){

        $arr = $this->dataTesting();
        $binaryTree = new BinaryTree($arr);


        //'id'=> 2 , 'parent_id'=> 1 
        $firstObjectInTheArray = $arr[0];

        //'id'=> 1 , 'parent_id'=> null
        $secondElementInTheArray = $arr[1];

        //'id'=> 3 , 'parent_id'=> 1 
        $thirdElementInTheArray = $arr[2];

         //'id'=> 4 , 'parent_id'=> 2
        $fourthElementInTheArray = $arr[3];

        $this->assertEquals($firstObjectInTheArray, $binaryTree->getValue(2));
        $this->assertEquals($secondElementInTheArray, $binaryTree->getValue(1));
        $this->assertEquals($thirdElementInTheArray, $binaryTree->getValue(3));
        $this->assertEquals($fourthElementInTheArray, $binaryTree->getValue(4));

    }


    
    // test if we get the childrens of node element by id 
public function testGetChildrensFunction(){

    $arr = $this->dataTesting();
    $binaryTree = new BinaryTree($arr);

    $jsonThirdElementChildrensPath = "C:\Users\ilan\Desktop\php Node Tree\json\childrens3.json";
    $jsonChildrensPathFirstElement = "C:\Users\ilan\Desktop\php Node Tree\json\childrens1.json";

    $this->assertJsonStringEqualsJsonFile($jsonChildrensPathFirstElement, json_encode($binaryTree->getChildren(2)));

    $this->assertJsonStringEqualsJsonFile($jsonThirdElementChildrensPath, json_encode($binaryTree->getChildren(3)));


         //childrens of element 4
    $thorthElementInTheArray = Array('left' => null , 'right' => null);
    $this->assertEquals($thorthElementInTheArray, $binaryTree->getChildren(4));

         //childrens of element 2 (id :1)
    $secondElementInTheArray = Array('left' => null , 'right' => null); 
    $this->assertEquals($secondElementInTheArray, $binaryTree->getChildren(1));

}


// test we get the root
public function testGetRootFunction(){

    $arr = $this->dataTesting();
    $binaryTree = new BinaryTree($arr);
    $binaryTreeJsonEncode = json_encode($binaryTree->getRoot());


    $jsonGetRootPath = "C:\Users\ilan\Desktop\php Node Tree\json\getRoot.json";

    $this->assertJsonStringEqualsJsonFile($jsonGetRootPath, $binaryTreeJsonEncode);

}

}