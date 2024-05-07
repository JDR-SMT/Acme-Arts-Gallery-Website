<?php
//  Team Name: MRS Tech
// 	Team Member: Jack Dylan Rendle, Andrew Millett
// 	Date: 22/04/2024

$action = $_REQUEST["action"];

// create artist class object
if (!empty($action)) {
    include '../includes/artist.php';
    $obj = new artist();
}

// artists action
if ($action == "artists") {
    $artists = $obj->artists();

    // thumbnail must be base64_encoded before json_encoded
    foreach ($artists as $field => $value) {
        if ($artists[$field]["artistThumbnail"]) {
            $artists[$field]["artistThumbnail"] = base64_encode($artists[$field]["artistThumbnail"]);
        }
    }

    echo json_encode($artists);
    exit();
}

if ($action == "filterNationality") {
    $nationalityId = (!empty($_GET["nationalityId"])) ? $_GET["nationalityId"] : "";

    if (!empty($nationalityId)) {
        $artist = $obj->filterNationality($nationalityId);

        foreach ($artist as $field => $value) {
            if ($artist[$field]["artistThumbnail"]) {
                $artist[$field]["artistThumbnail"] = base64_encode($artist[$field]["artistThumbnail"]);
            }
        }

        echo json_encode($artist);
        exit();
    }
}

if ($action == "filterPeriod") {
    $period = (!empty($_GET["period"])) ? $_GET["period"] : "";

    if (!empty($period)) {
        $artist = $obj->filterPeriod($period);

        foreach ($artist as $field => $value) {
            if ($artist[$field]["artistThumbnail"]) {
                $artist[$field]["artistThumbnail"] = base64_encode($artist[$field]["artistThumbnail"]);
            }
        }

        echo json_encode($artist);
        exit();
    }
}

// detailsName action
if ($action == "detailsName") {
    $artistId = (!empty($_GET["artistId"])) ? $_GET["artistId"] : "";

    if (!empty($artistId)) {
        $artist = $obj->detailsName($artistId);

        // image must be base64_encoded before json_encoded
        if ($artist["artistImage"]) {
            $artist["artistImage"] = base64_encode($artist["artistImage"]);
        }

        echo json_encode($artist);
        exit();
    }
}

// detailsId action
if ($action == "detailsId") {
    $artistId = (!empty($_GET["artistId"])) ? $_GET["artistId"] : "";

    if (!empty($artistId)) {
        $artist = $obj->detailsId($artistId);

        // image must be base64_encoded before json_encoded
        if ($artist["artistImage"]) {
            $artist["artistImage"] = base64_encode($artist["artistImage"]);
        }

        // thumbnail must be base64_encoded before json_encoded
        if ($artist["artistThumbnail"]) {
            $artist["artistThumbnail"] = base64_encode($artist["artistThumbnail"]);
        }

        echo json_encode($artist);
        exit();
    }
}

// update action
if ($action == "update" && !empty($_POST)) {
    $artistId = (!empty($_POST["id"])) ? $_POST["id"] : "";
    $artistName = $_POST["name"];
    $artistLifespan = $_POST["lifespan"];
    $artistThumbnail = $_FILES["thumbnail"];
    $artistImage = $_FILES["image"];
    $nationalityId = $_POST["nationality"];

    // thumbnail and image uploaded
    if (!empty($artistThumbnail["name"]) && !empty($artistImage["name"])) {
        $artistThumbnail = file_get_contents($_FILES["thumbnail"]["tmp_name"]);
        $artistImage = file_get_contents($_FILES["image"]["tmp_name"]);

        $artistData = [
            "artistName" => $artistName,
            "artistLifespan" => $artistLifespan,
            "artistThumbnail" => $artistThumbnail,
            "artistImage" => $artistImage,
            "nationalityId" => $nationalityId,
        ];
    }
    // thumbnail uploaded
    else if (!empty($artistThumbnail["name"])) {
        $artistThumbnail = file_get_contents($_FILES["thumbnail"]["tmp_name"]);

        $artistData = [
            "artistName" => $artistName,
            "artistLifespan" => $artistLifespan,
            "artistThumbnail" => $artistThumbnail,
            "nationalityId" => $nationalityId,
        ];
    }
    // image uploaded
    else if (!empty($artistImage["name"])) {
        $artistImage = file_get_contents($_FILES["image"]["tmp_name"]);

        $artistData = [
            "artistName" => $artistName,
            "artistLifespan" => $artistLifespan,
            "artistImage" => $artistImage,
            "nationalityId" => $nationalityId,
        ];
    }
    // no thumbnail or image uploaded
    else {
        $artistData = [
            "artistName" => $artistName,
            "artistLifespan" => $artistLifespan,
            "nationalityId" => $nationalityId,
        ];
    }

    $obj->update($artistId, $artistData);

    if (!empty($artistId)) {
        $artist = $obj->detailsId($artistId);

        // image must be base64_encoded before json_encoded
        if ($artist["artistImage"]) {
            $artist["artistImage"] = base64_encode($artist["artistImage"]);
        }

        // thumbnail must be base64_encoded before json_encoded
        if ($artist["artistThumbnail"]) {
            $artist["artistThumbnail"] = base64_encode($artist["artistThumbnail"]);
        }

        echo json_encode($artist);
        exit();
    }
}

// add action
if ($action == "add" && !empty($_POST)) {
    $artistName = $_POST["name"];
    $artistBirth = $_POST["birth"];
    $artistDeceased = $_POST["deceased"];
    $artistThumbnail = file_get_contents($_FILES["thumbnail"]["tmp_name"]);
    $artistImage = file_get_contents($_FILES["image"]["tmp_name"]);
    $nationalityId = $_POST["nationality"];

    $artistData = [
        "artistName" => $artistName,
        "artistLifespan" => "$artistBirth-$artistDeceased",
        "artistThumbnail" => $artistThumbnail,
        "artistImage" => $artistImage,
        "nationalityId" => $nationalityId,
    ];

    $artistId = $obj->add($artistData);

    if (!empty($artistId)) {
        $artist = $obj->detailsId($artistId);

        // image must be base64_encoded before json_encoded
        if ($artist["artistImage"]) {
            $artist["artistImage"] = base64_encode($artist["artistImage"]);
        }

        // thumbnail must be base64_encoded before json_encoded
        if ($artist["artistThumbnail"]) {
            $artist["artistThumbnail"] = base64_encode($artist["artistThumbnail"]);
        }

        echo json_encode($artist);
        exit();
    }
}

// Andrew Millett
// delete action
if ($action == "delete") {
    $artistId = (!empty($_GET["artistId"])) ? $_GET["artistId"] : "";

    if (!empty($artistId)) {
        $deleted = $obj->delete($artistId);
        if ($deleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}

// artistName action
if ($action == "artistName") {
    $artist = $obj->artistName();
    echo json_encode($artist);
    exit();
}

// search action
if ($action == "search") {
    $artistName = (!empty($_GET["artistName"])) ? $_GET["artistName"] : "";

    if (!empty($artistName)) {
        $artist = $obj->search($artistName);
        echo json_encode($artist);
        exit();
    }
}