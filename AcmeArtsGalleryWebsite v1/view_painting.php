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

    <div class="container-lg">
        <div class="title-container title">VIEW AN EXISTING PAINTING</div>

        <div id="view-container" class="container-lg">
            <?php
            require_once('config.php');

            $paintingId = $_GET["id"];

            $sql = "SELECT p.paintingId, p.paintingImage, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
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

            <img id="image" src="data:image/png;base64,<?= base64_encode($result['paintingImage']) ?>" style="max-height:450px" />

            <div id="table-container">
                <table class="table table-borderless">
                    <tbody>
                        <?php
                        echo
                        "<tr><th>TITLE</th><td>" . $result["paintingTitle"] . "</td></tr>" .
                            "<tr><th>YEAR</th><td>" . $result["paintingYear"] . "</td></tr>" .
                            "<tr><th>ARTIST</th><td>" . $result["artistName"] . "</td></tr>" .
                            "<tr><th>MEDIUM</th><td>" . $result["mediumName"] . "</td></tr>" .
                            "<tr><th>STYLE</th><td>" . $result["styleName"] . "</td></tr>";
                        ?>
                    </tbody>
                </table>

                <div id="button-container">
                    <div class="button-edit">
                        <a href="edit_painting.php?id=<?= $result['paintingId'] ?>"><img class="icon-small" src="Icons/edit.png"></a>
                    </div>
                    <div class="button-delete">
                        <a href="delete_painting.php?id=<?= $result['paintingId'] ?>" onclick="return confirm('Delete this painting?')"><img class="icon-small" src="Icons/delete.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>