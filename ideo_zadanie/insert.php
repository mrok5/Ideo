<?php
require('connection.php');

$nodeName=$_POST['name'];
$parentId=$_POST['parent_id'];


echo "from php file:" . $nodeName;

try{
    insertNode($conn,5,$parentId,$nodeName);
    insertTree($conn, 5, $parentId, 2);
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}

function insertTree($conn, $node_id, $parent_id, $current_level)
{
    $stmt = $conn->prepare("INSERT INTO tree (NodeId, ParentId,Level) VALUES (:nodeId, :parentId, :level)");
    $stmt->bindParam(':nodeId', $node_id);
    $stmt->bindParam(':parentId', $parent_id);
    $stmt->bindParam(':level', $current_level);
    $stmt->execute();
}

function insertNode($conn, $node_id, $parent_id, $nodeName)
{
    $stmt2 = $conn->prepare("INSERT INTO node (NodeId, ParentId,NodeName) VALUES (:nodeId, :parentId, :nodeName)");
    $stmt2->bindParam(':nodeId', $node_id);
    $stmt2->bindParam(':parentId', $parent_id);
    $stmt2->bindParam(':nodeName', $nodeName);
    $stmt2->execute();
}