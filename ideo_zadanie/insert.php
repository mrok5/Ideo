<?php
require 'test.php';

$nodeName=$_POST['name'];
$parentId=$_POST['parent_id'];

//$parentId=3;

$q1 = "INSERT INTO tree (NodeId, ParentId,Level) VALUES (:nodeId, :parentId, :level)";
$q2 = "INSERT INTO node (NodeId, ParentId,NodeName) VALUES (:nodeId, :parentId, :nodeName)";
$q3 = "SELECT Level FROM tree WHERE NodeId = $parentId";
$q4 = "SELECT NodeId from node GROUP BY NodeId DESC";

try{
    $currentLevel = selectData($conn, $q3, "Level")[0]+1;
    $newId = selectData($conn, $q4, "NodeId")[0]+1;

    //insert($conn,$newId,$parentId,':nodeName',$nodeName,$q1);
    //insert($conn,$newId,$parentId,':level',$currentLevel,$q2);
    insertTree($conn,$newId,$parentId,$currentLevel,$q1);
    insertNode($conn,$newId,$parentId,$nodeName,$q2);


} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}

/*
function insert($conn, $node_id, $parent_id,$x_name, $x, $query)
{
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nodeId', $node_id);
    $stmt->bindParam(':parentId', $parent_id);
    $stmt->bindParam($x_name, $x);
    $stmt->execute();
}
*/

function insertTree($conn, $node_id, $parent_id, $current_level,$query)
{
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nodeId', $node_id);
    $stmt->bindParam(':parentId', $parent_id);
    $stmt->bindParam(':level', $current_level);
    $stmt->execute();
}

function insertNode($conn, $node_id, $parent_id, $nodeName,$query)
{
    $stmt2 = $conn->prepare($query);
    $stmt2->bindParam(':nodeId', $node_id);
    $stmt2->bindParam(':parentId', $parent_id);
    $stmt2->bindParam(':nodeName', $nodeName);
    $stmt2->execute();
}
