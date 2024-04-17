<?php
//  Team Name: MRS Tech
// 	Team Member: Jack Dylan Rendle
// 	Date: 17/04/2024

$action = $_REQUEST["action"];

// create nationality class object
if (!empty($action)) {
    include '../includes/nationality.php';
    $obj = new nationality();
}

// nationalities action
if ($action == "nationalities") {
    $nationality = $obj->nationalities();
    echo json_encode($nationality);
    exit();
}
