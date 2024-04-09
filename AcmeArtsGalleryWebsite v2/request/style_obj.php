<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 02/04/2024-->

<?php
$action = $_REQUEST["action"];

// create style class object
if (!empty($action)) {
    include '../includes/style.php';
    $obj = new style();
}

// styles action
if ($action == "styles") {
    $style = $obj->styles();
    echo json_encode($style);
    exit();
}
