<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 02/04/2024-->

<?php
$action = $_REQUEST["action"];

// create artist class object
if (!empty($action)) {
    include '../includes/artist.php';
    $obj = new artist();
}

// artists action
if ($action == "artists") {
    $artist = $obj->artists();
    echo json_encode($artist);
    exit();
}
