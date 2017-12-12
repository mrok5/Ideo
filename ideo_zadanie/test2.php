<?php
require 'test.php';

sort($allIds);

$array = array(
    $allIds,
    $levelTree,
    $allParentId,
    $allNodeName
);

echo json_encode($array);