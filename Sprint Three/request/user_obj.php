<?php
//  Team Name: MRS Tech
// 	Team Member: Benjamin Stafford
// 	Date: 22/04/2024

$action = $_REQUEST["action"];

// create user class object
if (!empty($action)) {
    include '../includes/user.php';
    $obj = new user();
}

// users action
if ($action == "users") {
    $user = $obj->users();
    echo json_encode($users);
    exit();
}

// add action
if ($action == "add" && !empty($_POST)) {
    $userName = $_POST["name"];
    $userEmail = $_POST["email"];
    $userBreakingNews = $_POST["breaking"];
    $userMonthlyNews = $_POST["monthly"];
    $userActive = $_POST["active"];
      

    $userData = [
        "userName" => $userName,
        "userEmail" => $userEmail,
        "userBreakingNews" => $userBreakingNews,
        "userMonthlyNews" => $userMonthlyNews,
        "userActive" => $userActive
    ];

    $userId = $obj->add($userData);
    echo json_encode($userId);
    exit();
}

// delete action
if ($action == "delete") {
    $userEmail = (!empty($_GET["userEmail"])) ? $_GET["userEmail"] : "";

    if (!empty($userEmail)) {
        $deleted = $obj->delete($userEmail);
        if ($deleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}

// search action
if ($action == "search") {
    $userName = (!empty($_GET["userName"])) ? $_GET["userName"] : "";

    if (!empty($userName)) {
        $user = $obj->search($userName);
        echo json_encode($user);
        exit();
    }
}