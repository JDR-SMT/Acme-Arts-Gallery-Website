<?php
$action = $_REQUEST["action"];

// create painting class object
if (!empty($action)) {
    include 'includes/painting.php';
    $obj = new painting();
}

// gallery action
if ($action == "gallery") {
    $gallery = $obj->gallery();

    // thumbnail must be base64_encoded before json_encoded
    foreach ($gallery as $field => $value) {
        if ($gallery[$field]['paintingThumbnail']) {
            $gallery[$field]['paintingThumbnail'] = base64_encode($gallery[$field]['paintingThumbnail']);
        }
    }

    echo json_encode($gallery);
    exit();
}

// details action
if ($action == "details") {
    $paintingId = (!empty($_GET["paintingId"])) ? $_GET["paintingId"] : "";

    if (!empty($paintingId)) {
        $painting = $obj->details("paintingId", $paintingId);

        // image must be base64_encoded before json_encoded
        foreach ($gallery as $field => $value) {
            if ($gallery[$field]['paintingImage']) {
                $gallery[$field]['paintingImage'] = base64_encode($gallery[$field]['paintingImage']);
            }
        }

        echo json_encode($painting);
        exit();
    }
}

// add or update action
if ($action == "add" || $action == "update" && !empty($_POST)) {
    $paintingId = (!empty($_POST["paintingId"])) ? $_POST["paintingId"] : "";
    $paintingTitle = $_POST["title"];
    $paintingYear = $_POST["year"];
    $paintingThumbnail = $_FILES["thumbnail"];
    $paintingImage = $_FILES["image"];
    $artistId = $_POST["artist"];
    $mediumId = $_POST["medium"];
    $styleId = $_POST["style"];

    // thumbnail and image uploaded
    if (!empty($paintingThumbnail["name"]) && !empty($paintingImage["name"])) {
        $paintingThumbnail = fopen($_FILES["thumbnail"]["tmp_name"], "rb");
        $paintingImage = fopen($_FILES["image"]["tmp_name"], "rb");

        $paintingData = [
            "paintingTitle" => $paintingTitle,
            "paintingYear" => $paintingYear,
            "paintingThumbnail" => $paintingThumbnail,
            "paintingImage" => $paintingImage,
            "artistId" => $artistId,
            "mediumId" => $mediumId,
            "styleId" => $styleId,
        ];
    }
    // thumbnail uploaded
    else if (!empty($paintingThumbnail["name"])) {
        $paintingThumbnail = fopen($_FILES["thumbnail"]["tmp_name"], "rb");

        $paintingData = [
            "paintingTitle" => $paintingTitle,
            "paintingYear" => $paintingYear,
            "paintingThumbnail" => $paintingThumbnail,
            "artistId" => $artistId,
            "mediumId" => $mediumId,
            "styleId" => $styleId,
        ];
    }
    // image uploaded
    else if (!empty($paintingImage["name"])) {
        $paintingImage = fopen($_FILES["image"]["tmp_name"], "rb");

        $paintingData = [
            "paintingTitle" => $paintingTitle,
            "paintingYear" => $paintingYear,
            "paintingImage" => $paintingImage,
            "artistId" => $artistId,
            "mediumId" => $mediumId,
            "styleId" => $styleId,
        ];
    }
    // no thumbnail or image uploaded
    else {
        $paintingData = [
            "paintingTitle" => $paintingTitle,
            "paintingYear" => $paintingYear,
            "artistId" => $artistId,
            "mediumId" => $mediumId,
            "styleId" => $styleId,
        ];
    }

    // if a paintingId was passed update the existing painting, else add a new painting
    if ($paintingId) {
        $obj->update($paintingId, $paintingData);
    } else {
        $obj->add($paintingData);
    }
}

// delete action
if ($action == "delete") {
    $paintingId = (!empty($_GET["paintingId"])) ? $_GET["paintingId"] : "";

    if (!empty($paintingId)) {
        $obj->delete($paintingId);
    }
}

// search action
if ($action == "search") {
    $paintingTitle = (!empty($_GET["paintingTitle"])) ? $_GET["paintingTitle"] : "";

    if (!empty($paintingTitle)) {
        $obj->search($paintingTitle);
    }
}
