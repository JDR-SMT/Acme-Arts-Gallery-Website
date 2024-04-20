<?php
//  Team Name: MRS Tech
// 	Team Member: Benjamin Stafford
// 	Date: 19/04/2024

$action = $_REQUEST["action"];

// create nationality class object
if (!empty($action)) {
    include '../includes/lifespan.php';
    $obj = new lifespan();
}

// lifespans action
if ($action == "lifespans") {
    $lifespan = $obj->lifespan();
    echo json_encode($lifespan);
    exit();
}
