<?php
require('connection.php');

function select($conn, $query)
{
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->fetch()[0];
}


function editData($conn,$node_id,$nodeName)
{
    $stmt = $conn->prepare("UPDATE node SET NodeName=? WHERE NodeId=?");
    $stmt->bindValue(1, $nodeName, PDO::PARAM_STR);
    $stmt->bindValue(2, $node_id, PDO::PARAM_INT);
    $stmt->execute();
}


function deleteData($conn,$node_id,$table)
{
    $stmt = $conn->prepare("DELETE FROM $table WHERE NodeId=$node_id");
    $stmt->execute();
}



function selectData($conn, $query, $x)
{
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $output = array();

    foreach ($result as $row) {
        array_push($output, $row[$x]);
    }

    return $output;
}


try {

    $query = array(
                "SELECT NodeName FROM node ORDER BY NodeId",
                "SELECT Level FROM tree",
                "SELECT NodeId from node ORDER BY NodeId",
                "SELECT ParentId from node");

    $allNodeName = selectData($conn, $query[0], "NodeName");
    $levelTree = selectData($conn, $query[1], "Level");
    $allIds = selectData($conn, $query[2], "NodeId");
    $allParentId = selectData($conn, $query[3], "ParentId");


    /*
    $parent_id = selectNodeId($conn);
    $parent_level =  selectLevel($conn);

    $current_level = $parent_level + 1;
*/


} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}



