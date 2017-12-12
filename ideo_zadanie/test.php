<?php
require('connection.php');

function selectNodeId($conn)
{
    $stmt = $conn->prepare("SELECT NodeId FROM node WHERE NodeName='Tatry'");
    $stmt->execute();

    return $stmt->fetch()[0];
}

function selectLevel($conn)
{
    $stmt = $conn->prepare("SELECT Level FROM tree WHERE NodeId = 2");
    $stmt->execute();
    return $stmt->fetch()[0];
}

function insertTree($conn,$test,$parent_id,$current_level)
{
    $stmt = $conn->prepare("INSERT INTO tree (NodeId, ParentId,Level) VALUES (:nodeId, :parentId, :level)");
    $stmt->bindParam(':nodeId', $test);
    $stmt->bindParam(':parentId', $parent_id);
    $stmt->bindParam(':level', $current_level);
    $stmt->execute();
}

function insertNode($conn,$test,$parent_id,$test2)
{
    $stmt2 = $conn->prepare("INSERT INTO node (NodeId, ParentId,NodeName) VALUES (:nodeId, :parentId, :nodeName)");
    $stmt2->bindParam(':nodeId', $test);
    $stmt2->bindParam(':parentId', $parent_id);
    $stmt2->bindParam(':nodeName', $test2);
    $stmt2->execute();
}

function editTree(){}
function editNode(){}
function deleteTree(){};
function deleteNode(){};

function selectAllNodes($conn){

    $stmt = $conn->prepare("SELECT * FROM node");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $output=array();

    foreach($result as $row){
        array_push($output,"{$row['NodeName']}");
    }

    return $output;
}

function selectLevelTree($conn){

    $stmt = $conn->prepare("SELECT * FROM tree");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $output=array();

    foreach($result as $row){
        array_push($output,"{$row['Level']}");
    }

    return $output;
}

function selectParentId($conn){
    $stmt = $conn->prepare("SELECT ParentId FROM node");
    $stmt->execute();
    $result = $stmt->fetchAll();

    $output=array();

    foreach($result as $row){
        array_push($output,"{$row['ParentId']}");
    }

    return $output;
}

function selectIds($conn){
    $stmt = $conn->prepare("SELECT NodeId FROM node");
    $stmt->execute();
    $result = $stmt->fetchAll();

    $output=array();

    foreach($result as $row){
        array_push($output,"{$row['NodeId']}");
    }

    return $output;
}

function selectNodeName($conn){
    $stmt = $conn->prepare("SELECT NodeName FROM node GROUP BY NodeId");
    $stmt->execute();
    $result = $stmt->fetchAll();

    $output=array();

    foreach($result as $row){
        array_push($output,"{$row['NodeName']}");
    }

    return $output;

}

try {

    $allNode = selectAllNodes($conn);
     //echo  var_dump($allNode);
    $levelTree = selectLevelTree($conn);
   // echo  var_dump($allTree);
    $allIds = selectIds($conn);
    $allParentId = selectParentId($conn);
    //echo var_dump($allIds);

    $allNodeName = selectNodeName($conn);

/*
    echo "<ul><li>";
    echo $allNode[0];
    echo ":";
    echo $allTree[0];
    echo "<ul>";
   for($i=1; $i < sizeof($allNode); $i++){
        echo "<li id = $allIds[$i] >";
       // echo $allIds[$i];

       if($allTree[$i-1] = $allTree[$i]-1) {
           echo "<ul>";
           echo $allNode[$i];
           echo ":";
           echo $allTree[$i];

           echo "</ul>";
       }else{
           echo $allNode[$i];
           echo ":";
           echo $allTree[$i];
       }
    }

    echo "</ul></li></ul>";

*/
    $parent_id = selectNodeId($conn);
    $parent_level =  selectLevel($conn);

   // echo "p_id:";
   // echo ($parent_id);
   // echo " p_level: ";
   // echo ($parent_level);

    $test = 4;
    $current_level = $parent_level + 1;

   // echo " c_level: ";
   // echo ($current_level);


    $test2 = "Tatry polskie";

}
catch(PDOException $e)
{
    echo "error: " . $e->getMessage();
}



