<?php
require('connection.php');

function select($conn,$query)
{
    $stmt = $conn->prepare($query);
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

function insertNode($conn,$test,$parent_id,$nodeName)
{
    $stmt2 = $conn->prepare("INSERT INTO node (NodeId, ParentId,NodeName) VALUES (:nodeId, :parentId, :nodeName)");
    $stmt2->bindParam(':nodeId', $test);
    $stmt2->bindParam(':parentId', $parent_id);
    $stmt2->bindParam(':nodeName', $nodeName);
    $stmt2->execute();
}

function editTree(){}
function editNode(){}
function deleteTree(){};
function deleteNode(){};


function selectData($conn,$query,$x){

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $output=array();

    foreach($result as $row){
        array_push($output,"{$row[$x]}");
    }

    return $output;
}



try {

    $query=array( "SELECT NodeName FROM node ORDER BY NodeId",
                    "SELECT Level FROM tree",
                    "SELECT NodeId from node ORDER BY NodeId",
                    "SELECT ParentId from node");

    $allNodeName = selectData($conn,$query[0],"NodeName");
    $levelTree = selectData($conn,$query[1],"Level");
    $allIds = selectData($conn,$query[2],"NodeId");
    $allParentId = selectData($conn,$query[3],"ParentId");



    /*
    $parent_id = selectNodeId($conn);
    $parent_level =  selectLevel($conn);

    $current_level = $parent_level + 1;
*/


}
catch(PDOException $e)
{
    echo "error: " . $e->getMessage();
}



