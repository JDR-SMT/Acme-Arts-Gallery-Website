<?php
require_once('config.php');

$paintingId = $_GET["id"];
$paintingTitle = $_POST["title"];
$paintingYear = $_POST["year"];
$paintingThumbnail = fopen($_FILES["thumbnail"]["tmp_name"], "rb");
$paintingImage = fopen($_FILES["image"]["tmp_name"], "rb");
$artistId = $_POST["artist"];
$mediumId = $_POST["medium"];
$styleId = $_POST["style"];

$sql = "UPDATE paintings 
        SET paintingTitle = :paintingTitle, 
            paintingYear = :paintingYear, 
            paintingThumbnail = :paintingThumbnail, 
            paintingImage = :paintingImage, 
            artistId = :artistId, 
            mediumId = :mediumId, 
            styleId = :styleId
        WHERE paintingId = :paintingId";

try {
    // if (!$_FILES["thumbnail"]["tmp_name"]) {
    //     $stmt = $conn->prepare("$sqlNoThumbnail");
    // } else if (!$_FILES["image"]["tmp_name"]) {
    //     $stmt = $conn->prepare("$sqlNoImage");
    // } else {
    //     $stmt = $conn->prepare("$sqlAll");
    // }

    $stmt->bindParam(":paintingId", $paintingId);
    $stmt->bindParam(":paintingTitle", $paintingTitle, PDO::PARAM_STR);
    $stmt->bindParam(":paintingYear", $paintingYear, PDO::PARAM_STR);
    $stmt->bindParam(":paintingThumbnail", $paintingThumbnail, PDO::PARAM_LOB);
    $stmt->bindParam(":paintingImage", $paintingImage, PDO::PARAM_LOB);
    $stmt->bindParam(":artistId", $artistId, PDO::PARAM_STR);
    $stmt->bindParam(":mediumId", $mediumId, PDO::PARAM_STR);
    $stmt->bindParam(":styleId", $styleId, PDO::PARAM_STR);
    $stmt->execute();
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
