<?php
require 'test.php';

$array = array(
    $allIds,
    $levelTree,
    $allParentId,
    $allNodeName
);

echo json_encode($array);