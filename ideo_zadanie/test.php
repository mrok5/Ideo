<?php
require('connection.php');

try {

    function selectNodeId($conn)
    {
        $stmt = $conn->prepare("SELECT NodeId FROM node WHERE NodeName='Tatry'");
        $stmt->execute();

        return $stmt->fetch()[0];
    }
    $parent_id = selectNodeId($conn);

    function selectLevel($conn)
    {
        $stmt = $conn->prepare("SELECT Level FROM tree WHERE NodeId = 2");
        $stmt->execute();
        return $stmt->fetch()[0];
    }
    $parent_level =  selectLevel($conn);

    echo "p_id:";
    echo ($parent_id);
    echo " p_level: ";
    echo ($parent_level);

    $test = 4;
    $current_level = $parent_level + 1;

    echo " c_level: ";
    echo ($current_level);

    function insertTree($conn,$test,$parent_id,$current_level)
    {
        $stmt = $conn->prepare("INSERT INTO tree (NodeId, ParentId,Level) VALUES (:nodeId, :parentId, :level)");
        $stmt->bindParam(':nodeId', $test);
        $stmt->bindParam(':parentId', $parent_id);
        $stmt->bindParam(':level', $current_level);
        $stmt->execute();
    }
    $test2 = "Tatry polskie";

    function insertNode($conn,$test,$parent_id,$test2)
    {
        $stmt2 = $conn->prepare("INSERT INTO node (NodeId, ParentId,NodeName) VALUES (:nodeId, :parentId, :nodeName)");
        $stmt2->bindParam(':nodeId', $test);
        $stmt2->bindParam(':parentId', $parent_id);
        $stmt2->bindParam(':nodeName', $test2);
        $stmt2->execute();
    }

}
catch(PDOException $e)
{
    echo "error: " . $e->getMessage();
}



