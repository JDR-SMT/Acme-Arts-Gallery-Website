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

    <?php echo "<img src='data:image/png;base64,".base64_encode($result['paintingImage'])."' style='max-height:400px'/>"; ?>

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
                <?php echo "<a href='edit.php?id=".$result['paintingId']."'><img src='Icons/edit.png' width='20'></a>" ?>
            </div>
            <div class="button-delete">
                <?php echo "<a href='delete.php?id=".$result['paintingId']."'><img src='Icons/delete.png' width='20px'></a>" ?>
            </div>
        </div>
    </div>
</div>