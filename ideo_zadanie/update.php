<?php

require 'test.php';

$nodeName=$_POST['name'];
$nodeId=$_POST['node_id'];


try{

    editData($conn,$nodeId,$nodeName);


} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}