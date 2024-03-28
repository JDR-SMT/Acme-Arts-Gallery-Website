<?php
require_once('config.php');

$paintingId = $_GET["id"];

$sql = "DELETE FROM paintings p WHERE p.paintingId = :paintingId";

try {
    $stmt = $conn->prepare("$sql");
    $stmt->bindParam(":paintingId", $paintingId, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
?>