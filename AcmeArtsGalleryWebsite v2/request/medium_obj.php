<?php
$action = $_REQUEST["action"];

// create medium class object
if (!empty($action)) {
    include '../includes/medium.php';
    $obj = new medium();
}

// mediums action
if ($action == "mediums") {
    $medium = $obj->mediums();
    echo json_encode($medium);
    exit();
}
