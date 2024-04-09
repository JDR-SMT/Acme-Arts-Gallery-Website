<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acme Arts Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <?php require_once('nav.php'); ?>

    <?php
    require_once('config.php');

    $paintingId = $_GET["id"];

    $sql = "SELECT p.paintingId, p.paintingImage, p.paintingThumbnail, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
                        FROM paintings p
                        INNER JOIN artists a ON p.artistId = a.artistId
                        INNER JOIN mediums m ON p.mediumId = m.mediumId
                        INNER JOIN styles s ON p.styleId = s.styleId
                        WHERE p.paintingId = :paintingId";

    try {
        $stmt = $conn->prepare("$sql");
        $stmt->bindParam(":paintingId", $paintingId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
    ?>

    <div class="container-lg">
        <div class="title-container title">UPDATE AN EXISTING PAINTING</div>

        <div>
            <div>
                <div>
                    <img id="image" src="data:image/png;base64,<?= base64_encode($result['paintingImage']) ?>" style="width:400px" />
                </div>
                <div>
                    <img id="image" src="data:image/png;base64,<?= base64_encode($result['paintingImage']) ?>" style="width:100px" />
                </div>
            </div>

            <div class="container" style="max-width:500px">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <label class="form-label" for="input-title">TITLE</label>
                        <input class="form-control" type="text" id="input-title" name="title" value="<?= $result["paintingTitle"] ?>">
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-year">YEAR</label>
                        <input class="form-control" type="text" id="input-year" name="year" value="<?= $result["paintingYear"] ?>">
                    </div>
                    <div class="input-group">
                        <?php
                        require('config.php');

                        $sql = "SELECT a.artistId, a.artistName FROM artists a";

                        try {
                            $stmt = $conn->prepare("$sql");
                            $stmt->execute();
                            $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo "ERROR: " . $e->getMessage();
                        }
                        ?>
                        <label class="form-label" for="input-artist">ARTIST</label>
                        <select class="form-select" id="input-artist" name="artist">
                            <?php foreach ($artists as $row) {
                                if ($result["artistName"] == $row["artistName"]) {
                                    echo "<option value='" . $row['artistId'] . "' selected>" . $row['artistName'] . "</option>";
                                } else {
                                    echo "<option value='" . $row['artistId'] . "'>" . $row['artistName'] . "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <?php
                        require('config.php');

                        $sql = "SELECT m.mediumId, m.mediumName FROM mediums m";

                        try {
                            $stmt = $conn->prepare("$sql");
                            $stmt->execute();
                            $mediums = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo "ERROR: " . $e->getMessage();
                        }
                        ?>
                        <label class="form-label" for="input-medium">MEDIUM</label>
                        <select class="form-select" id="input-medium" name="medium">
                            <?php foreach ($mediums as $row) {
                                if ($result["mediumName"] == $row["mediumName"]) {
                                    echo "<option value='" . $row['mediumId'] . "' selected>" . $row['mediumName'] . "</option>";
                                } else {
                                    echo "<option value='" . $row['mediumId'] . "'>" . $row['mediumName'] . "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <?php
                        require('config.php');

                        $sql = "SELECT s.styleId, s.styleName FROM styles s";

                        try {
                            $stmt = $conn->prepare("$sql");
                            $stmt->execute();
                            $styles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo "ERROR: " . $e->getMessage();
                        }
                        ?>
                        <label class="form-label" for="input-style">STYLE</label>
                        <select class="form-select" id="input-style" name="style">
                            <?php foreach ($styles as $row) {
                                if ($result["styleName"] == $row["styleName"]) {
                                    echo "<option value='" . $row['styleId'] . "' selected>" . $row['styleName'] . "</option>";
                                } else {
                                    echo "<option value='" . $row['styleId'] . "'>" . $row['styleName'] . "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-thumbnail">THUMBNAIL</label>
                        <input class="form-control" type="file" id="input-thumbnail" name="thumbnail">
                        <div class="input-group-text" for="input-image"><img class="icon-small" src="Icons/folder.png">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-image">IMAGE</label>
                        <input class="form-control" type="file" id="input-image" name="image">
                        <div class="input-group-text" for="input-image"><img class="icon-small" src="Icons/folder.png">
                        </div>
                    </div>
                    <div class="input-group">
                        <button id="apply-button" class="btn" type="submit">
                            <div class="button-text">APPLY</div>
                            <img class="icon" src="Icons/arrow.png">
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once('edit.php');
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>