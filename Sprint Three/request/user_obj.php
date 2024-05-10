<?php
//  Team Name: MRS Tech
// 	Team Member: Benjamin Stafford, Andrew Millett
// 	Date: 10/05/2024

$action = $_REQUEST["action"];

// create user class object
if (!empty($action)) {
    include '../includes/user.php';
    $obj = new user();
}

// users action
if ($action == "users") {
    $users = $obj->users();
    echo json_encode($users);
    exit();
}

// inactiveUsers action
if ($action == "inactiveUsers") {
    $users = $obj->inactiveUsers();
    echo json_encode($users);
    exit();
}

// subscribe action
if ($action == "subscribe" && !empty($_POST)) {
    $userName = $_POST["name"];
    $userEmail = $_POST["email"];
    $userBreakingNews = isset($_POST['breaking']) ? 1 : 0;
    $userMonthlyNews = isset($_POST['monthly']) ? 1 : 0;

    $userData = [
        "userName" => $userName,
        "userEmail" => $userEmail,
        "userBreakingNews" => $userBreakingNews,
        "userMonthlyNews" => $userMonthlyNews,
        "userActive" => 1
    ];

    $userId = $obj->subscribe($userData);
    echo json_encode($userId);
    exit();
}

// remove action
if ($action == "remove") {
    $userEmail = $_POST["email"];

    if (!empty($userEmail)) {
        $remove = $obj->remove($userEmail);

        if ($remove) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }

        echo json_encode($message);
        exit();
    }
}

// delete action
if ($action == "delete") {
    $userId = (!empty($_GET["userId"])) ? $_GET["userId"] : "";

    if (!empty($userId)) {
        $deleted = $obj->delete($userId);

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
