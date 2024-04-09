<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Ben Stafford, Andrew Millett
	Date: 09/04/2024-->

<!--Jack Dylan Rendle-->
<?php
$action = $_REQUEST["action"];

// create painting class object
if (!empty($action)) {
    include '../includes/painting.php';
    $obj = new painting();
}

// gallery action
if ($action == "gallery") {
    $gallery = $obj->gallery();

    // thumbnail must be base64_encoded before json_encoded
    foreach ($gallery as $field => $value) {
        if ($gallery[$field]["paintingThumbnail"]) {
            $gallery[$field]["paintingThumbnail"] = base64_encode($gallery[$field]["paintingThumbnail"]);
        }
    }

    echo json_encode($gallery);
    exit();
}

// detailsName action
if ($action == "detailsName") {
    $paintingId = (!empty($_GET["paintingId"])) ? $_GET["paintingId"] : "";

    if (!empty($paintingId)) {
        $painting = $obj->detailsName($paintingId);

        // image must be base64_encoded before json_encoded
        if ($painting["paintingImage"]) {
            $painting["paintingImage"] = base64_encode($painting["paintingImage"]);
        }

        echo json_encode($painting);
        exit();
    }
}

// detailsId action
if ($action == "detailsId") {
    $paintingId = (!empty($_GET["paintingId"])) ? $_GET["paintingId"] : "";

    if (!empty($paintingId)) {
        $painting = $obj->detailsId($paintingId);

        // image must be base64_encoded before json_encoded
        if ($painting["paintingImage"]) {
            $painting["paintingImage"] = base64_encode($painting["paintingImage"]);
        }

        // thumbnail must be base64_encoded before json_encoded
        if ($painting["paintingThumbnail"]) {
            $painting["paintingThumbnail"] = base64_encode($painting["paintingThumbnail"]);
        }

        echo json_encode($painting);
        exit();
    }
}

// Ben Stafford
// detialsStyleId action
if ($action == "detailsStyleId") {
    $styleId = (!empty($_GET["styleId"])) ? $_GET["styleId"] : "";

    if (!empty($styleId)) {
        $painting = $obj->detailsStyleId($styleId);

        foreach ($painting as $field => $value) {
            if ($painting[$field]["paintingThumbnail"]) {
                $painting[$field]["paintingThumbnail"] = base64_encode($painting[$field]["paintingThumbnail"]);
            }
        }


        echo json_encode($painting);
        exit();
    }
}

// Ben Stafford
// detialsArtistId action
if ($action == "detailsArtistId") {
    $artistId = (!empty($_GET["artistId"])) ? $_GET["artistId"] : "";

    if (!empty($artistId)) {
        $painting = $obj->detailsArtistId($artistId);

        foreach ($painting as $field => $value) {
            if ($painting[$field]["paintingThumbnail"]) {
                $painting[$field]["paintingThumbnail"] = base64_encode($painting[$field]["paintingThumbnail"]);
            }
        }


        echo json_encode($painting);
        exit();
    }
}

// add action
if ($action == "add" && !empty($_POST)) {
    $paintingTitle = $_POST["title"];
    $paintingYear = $_POST["year"];
    $paintingThumbnail = file_get_contents($_FILES["thumbnail"]["tmp_name"]);
    $paintingImage = file_get_contents($_FILES["image"]["tmp_name"]);
    $artistId = $_POST["artist"];
    $mediumId = $_POST["medium"];
    $styleId = $_POST["style"];

    $paintingData = [
        "paintingTitle" => $paintingTitle,
        "paintingYear" => $paintingYear,
        "paintingThumbnail" => $paintingThumbnail,
        "paintingImage" => $paintingImage,
        "artistId" => $artistId,
        "mediumId" => $mediumId,
        "styleId" => $styleId,
    ];

    $paintingId = $obj->add($paintingData);

    if (!empty($paintingId)) {
        $painting = $obj->detailsId($paintingId);

        // image must be base64_encoded before json_encoded
        if ($painting["paintingImage"]) {
            $painting["paintingImage"] = base64_encode($painting["paintingImage"]);
        }

        // thumbnail must be base64_encoded before json_encoded
        if ($painting["paintingThumbnail"]) {
            $painting["paintingThumbnail"] = base64_encode($painting["paintingThumbnail"]);
        }

        echo json_encode($painting);
        exit();
    }
}

// update action
if ($action == "update" && !empty($_POST)) {
    $paintingId = (!empty($_POST["id"])) ? $_POST["id"] : "";
    $paintingTitle = $_POST["title"];
    $paintingYear = $_POST["year"];
    $paintingThumbnail = $_FILES["thumbnail"];
    $paintingImage = $_FILES["image"];
    $artistId = $_POST["artist"];
    $mediumId = $_POST["medium"];
    $styleId = $_POST["style"];

    // thumbnail and image uploaded
    if (!empty($paintingThumbnail["name"]) && !empty($paintingImage["name"])) {
        $paintingThumbnail = file_get_contents($_FILES["thumbnail"]["tmp_name"]);
        $paintingImage = file_get_contents($_FILES["image"]["tmp_name"]);

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
        $paintingThumbnail = file_get_contents($_FILES["thumbnail"]["tmp_name"]);

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
        $paintingImage = file_get_contents($_FILES["image"]["tmp_name"]);

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

    $obj->update($paintingId, $paintingData);

    if (!empty($paintingId)) {
        $painting = $obj->detailsId($paintingId);

        // image must be base64_encoded before json_encoded
        if ($painting["paintingImage"]) {
            $painting["paintingImage"] = base64_encode($painting["paintingImage"]);
        }

        // thumbnail must be base64_encoded before json_encoded
        if ($painting["paintingThumbnail"]) {
            $painting["paintingThumbnail"] = base64_encode($painting["paintingThumbnail"]);
        }

        echo json_encode($painting);
        exit();
    }
}

// Jack Dylan Rendle, Andrew Millett
// delete action
if ($action == "delete") {
    $paintingId = (!empty($_GET["paintingId"])) ? $_GET["paintingId"] : "";

    if (!empty($paintingId)) {
        $deleted = $obj->delete($paintingId);
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
    $paintingTitle = (!empty($_GET["paintingTitle"])) ? $_GET["paintingTitle"] : "";

    if (!empty($paintingTitle)) {
        $painting = $obj->search($paintingTitle);

        // image must be base64_encoded before json_encoded
        if ($painting["paintingImage"]) {
            $painting["paintingImage"] = base64_encode($painting["paintingImage"]);
        }

        echo json_encode($painting);
        exit();
    }
}
