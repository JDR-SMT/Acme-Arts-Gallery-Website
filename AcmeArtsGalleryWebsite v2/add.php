<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acme Arts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/nav.php'; ?>

    <div class="container-lg">
        <div class="title-container title">ADD A PAINTING</div>

        <div class="container" style="max-width: 500px;">
            <form method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <label class="form-label" for="input-title">TITLE</label>
                    <input class="form-control form-control-sm" type="text" id="input-title" name="title" required>
                </div>
                <div class="input-group">
                    <label class="form-label" for="input-year">YEAR</label>
                    <input class="form-control form-control-sm" type="text" id="input-year" name="year" required>
                </div>
                <div class="input-group">
                    <label class="form-label" for="input-artist">ARTIST</label>
                    <select class="form-select form-select-sm" id="input-artist" name="artist" required>

                    </select>
                </div>
                <div class="input-group">
                    <label class="form-label" for="input-medium">MEDIUM</label>
                    <select class="form-select form-select-sm" id="input-medium" name="medium" required>

                    </select>
                </div>
                <div class="input-group">
                    <label class="form-label" for="input-style">STYLE</label>
                    <select class="form-select form-select-sm" id="input-style" name="style" required>

                    </select>
                </div>
                <div class="input-group">
                    <label class="form-label" for="input-thumbnail">THUMBNAIL</label>
                    <input class="form-control form-control-sm" type="file" id="input-thumbnail" name="thumbnail" required>
                    <div class="input-group-text" for="input-image"><img class="icon-xs" src="img/folder.png"></div>
                </div>
                <div class="input-group">
                    <label class="form-label" for="input-image">IMAGE</label>
                    <input class="form-control form-control-sm" type="file" id="input-image" name="image" required>
                    <div class="input-group-text" for="input-image"><img class="icon-xs" src="img/folder.png"></div>
                </div>
                <div class="input-group">
                    <button id="add-button" class="btn" type="submit">
                        <div class="button-text">ADD</div>
                        <img class="icon-md" src="img/arrow.png">
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- insert script files -->
</body>

</html>