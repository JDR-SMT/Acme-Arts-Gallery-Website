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
            <div id="paintings-container" class="title-container">
                <div id="paintings-title" class="title">PAINTINGS</div>
                <div id="filter-container">
                    <a id="filter-button" class="btn" href="#offcanvas-filter" data-bs-toggle="offcanvas">
                        <img class="icon" src="Icons/filter.png">
                    </a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>TITLE</th>
                        <th>YEAR</th>
                        <th>MEDIUM</th>
                        <th>STYLE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('config.php');

                    $artistId = $_GET["id"];
                    
                    $sql = "SELECT p.paintingId, p.paintingThumbnail, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
                            FROM paintings p
                            INNER JOIN artists a ON p.artistId = a.artistId
                            INNER JOIN mediums m ON p.mediumId = m.mediumId
                            INNER JOIN styles s ON p.styleId = s.styleId
                            WHERE a.artistId = :artistId";
                    
                    try {
                        $stmt = $conn->prepare("$sql");
                        $stmt->bindParam(":artistId", $artistId, PDO::PARAM_INT);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $row) {
                            echo "<tr>" . 
                            "<td>" . "<a href='view_painting.php?id=".$row['paintingId']."'><img src='Icons/view.png' width='25px'></a>" . "</td>" .
                            "<td>" . "<a href='edit.php?id=".$row['paintingId']."'><img src='Icons/edit.png' width='20'></a>" . "</td>" .
                            "<td>" . "<a href='delete.php?id=".$row['paintingId']."'><img src='Icons/delete.png' width='20px'></a>" . "</td>" .
                            "<td>" . "<img src='data:image/png;base64,".base64_encode($row['paintingThumbnail'])."'width='100px'/>" . "</td>" .
                            "<td>" . $row["paintingTitle"] . "</td>" .
                            "<td>" . $row["paintingYear"] . "</td>" .
                            "<td>" . $row["mediumName"] . "</td>" .
                            "<td>" . $row["styleName"] . "</td>" .
                            "</tr>";
                        }
                    }
                    catch (PDOException $e) {
                        echo "ERROR: " . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php require_once('offcanvas.php'); ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>