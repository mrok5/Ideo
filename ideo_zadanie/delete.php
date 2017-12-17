<?php

require 'test.php';


$nodeId=$_POST['node_id'];

try{
    deleteData($conn,$nodeId,"node");
    deleteData($conn,$nodeId,"tree");


} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}