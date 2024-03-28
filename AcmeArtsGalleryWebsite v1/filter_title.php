<div id="view-container" class="container-lg">
    <?php
    require_once('config.php');

    $paintingTitle = $_POST["title"]; // name of search input

    $sql = "SELECT p.paintingId, p.paintingImage, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
            FROM paintings p
            INNER JOIN artists a ON p.artistId = a.artistId
            INNER JOIN mediums m ON p.mediumId = m.mediumId
            INNER JOIN styles s ON p.styleId = s.styleId
            WHERE p.paintingTitle = :paintingTitle";

    try {
        $stmt = $conn->prepare("$sql");
        $stmt->bindParam(":paintingTitle", $paintingTitle, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
    ?>

    <img id="image" src="data:image/png;base64,<?=base64_encode($result['paintingImage'])?>" style="max-height:400px"/>

    <div id="table-container">
        <table class="table table-borderless">
            <tbody>
            <?php
                echo 
                "<tr><th>TITLE</th><td>".$result["paintingTitle"]."</td></tr>".
                "<tr><th>YEAR</th><td>".$result["paintingYear"]."</td></tr>".
                "<tr><th>ARTIST</th><td>".$result["artistName"]."</td></tr>". 
                "<tr><th>MEDIUM</th><td>".$result["mediumName"]."</td></tr>".
                "<tr><th>STYLE</th><td>".$result["styleName"]."</td></tr>";
            ?>
            </tbody>
        </table>

        <div id="button-container">
            <div class="button-edit">
                <a href="edit_painting.php?id=<?=$result['paintingId']?>"><img class="icon-small" src="Icons/edit.png"></a>
            </div>
            <div class="button-delete">
                <a href="delete_painting.php?id=<?=$result['paintingId']?>" onclick="return confirm('Delete this painting?')"><img class="icon-small" src="Icons/delete.png"></a>
            </div>
        </div>
    </div>
</div>