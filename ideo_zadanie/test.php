<?php


$servername = "localhost";
$username = "root";
$password = "";


try {
    $conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";


    $stmt = $conn->prepare("SELECT NodeId FROM node WHERE NodeName='Tatry'");
    $stmt->execute();

    $parent_id = $stmt->fetch()[0];

    $stmt = $conn->prepare("SELECT Level FROM tree WHERE NodeId = 2" );
    $stmt->execute();

    $parent_level = $stmt->fetch()[0];

    echo "p_id:";
    echo ($parent_id);
    echo " p_level: ";
    echo ($parent_level);

    $test = 4;
    $current_level = $parent_level + 1;

    echo " c_level: ";
    echo ($current_level);

    $stmt1 = $conn->prepare("INSERT INTO tree (NodeId, ParentId,Level) VALUES (:nodeId, :parentId, :level)");
    $stmt1->bindParam(':nodeId', $test);
    $stmt1->bindParam(':parentId', $parent_id);
    $stmt1->bindParam(':level', $current_level);

    $test2 = "Tatry polskie";

    $stmt2 = $conn->prepare("INSERT INTO node (NodeId, ParentId,NodeName) VALUES (:nodeId, :parentId, :nodeName)");
    $stmt2->bindParam(':nodeId', $test);
    $stmt2->bindParam(':parentId', $parent_id);
    $stmt2->bindParam(':nodeName', $test2 );

    $stmt1->execute();
    $stmt2->execute();

}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}


$conn = null;


