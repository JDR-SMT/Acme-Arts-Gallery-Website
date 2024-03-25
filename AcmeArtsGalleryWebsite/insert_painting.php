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
            <div class="title-container title">ADD A NEW PAINTING</div>

            <div class="container col-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <label class="form-label" for="input-title">TITLE</label>
                        <input class="form-control" type="text" id="input-title" name="title" required>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-year">YEAR</label>
                        <input class="form-control" type="text" id="input-year" name="year" required>
                    </div>
                    <div class="input-group">
                        <?php
                        require('config.php');

                        $sql = "SELECT a.artistId, a.artistName FROM artists a";

                        try {
                            $stmt = $conn->prepare("$sql");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }
                        catch (PDOException $e) {
                            echo "ERROR: " . $e->getMessage();
                        }
                        ?>
                        <label class="form-label" for="input-artist">ARTIST</label>
                        <select class="form-select" id="input-artist" name="artist" required>
                            <option></option>
                            <?php foreach ($result as $row): ?>
                                <option value="<?=$row["artistId"]?>"><?=$row["artistName"]?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <?php
                        require('config.php');

                        $sql = "SELECT m.mediumId, m.mediumName FROM mediums m";

                        try {
                            $stmt = $conn->prepare("$sql");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }
                        catch (PDOException $e) {
                            echo "ERROR: " . $e->getMessage();
                        }
                        ?>
                        <label class="form-label" for="input-medium">MEDIUM</label>
                        <select class="form-select" id="input-medium" name="medium" required>
                            <option></option>
                            <?php foreach ($result as $row): ?>
                                <option value="<?=$row["mediumId"]?>"><?=$row["mediumName"]?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <?php
                        require('config.php');

                        $sql = "SELECT s.styleId, s.styleName FROM styles s";

                        try {
                            $stmt = $conn->prepare("$sql");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }
                        catch (PDOException $e) {
                            echo "ERROR: " . $e->getMessage();
                        }
                        ?>
                        <label class="form-label" for="input-style">STYLE</label>
                        <select class="form-select" id="input-style" name="style" required>
                            <option></option>
                            <?php foreach ($result as $row): ?>
                                <option value="<?=$row["styleId"]?>"><?=$row["styleName"]?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-thumbnail">THUMBNAIL</label>
                        <input class="form-control" type="file" id="input-thumbnail" name="thumbnail" required>
                        <div class="input-group-text" for="input-image"><img class="icon-small" src="Icons/folder.png"></div>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-image">IMAGE</label>
                        <input class="form-control" type="file" id="input-image" name="image" required>
                        <div class="input-group-text" for="input-image"><img class="icon-small" src="Icons/folder.png"></div>
                    </div>
                    <div class="input-group">
                        <button id="apply-button" class="btn" type="submit">
                            <div class="button-text">APPLY</div>
                            <img class="icon" src="Icons/arrow.png">
                        </button>
                    </div>
                </form>
            </div>

            <?php 
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once('insert.php');
            }
            ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>