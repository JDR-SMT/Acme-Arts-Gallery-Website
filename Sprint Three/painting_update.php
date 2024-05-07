<html lang="en">

<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 02/04/2024-->

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
        <div class="title-container title">UPDATE PAINTING</div>

        <div id="update-container">
            <div>
                <div id="image">

                </div>
                <div id="thumbnail">

                </div>
            </div>

            <div id="form-container" class="container" style="max-width:500px">
                <form id="form-update" method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                        <label class="form-label" for="input-title">TITLE</label>
                        <input class="form-control form-control-sm" type="text" id="input-title" name="title">
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-year">YEAR</label>
                        <input class="form-control form-control-sm" type="text" id="input-year" name="year">
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-artist">ARTIST</label>
                        <select class="form-select form-select-sm" id="input-artist" name="artist">

                        </select>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-medium">MEDIUM</label>
                        <select class="form-select form-select-sm" id="input-medium" name="medium">

                        </select>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-style">STYLE</label>
                        <select class="form-select form-select-sm" id="input-style" name="style">

                        </select>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-thumbnail">THUMBNAIL</label>
                        <input class="form-control form-control-sm" type="file" id="input-thumbnail" name="thumbnail">
                        <div class="input-group-text" for="input-image"><img class="icon-xs" src="img/folder.png">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-image">IMAGE</label>
                        <input class="form-control form-control-sm" type="file" id="input-image" name="image">
                        <div class="input-group-text" for="input-image"><img class="icon-xs" src="img/folder.png">
                        </div>
                    </div>
                    <div class="input-group">
                        <input id="input-id" type="hidden" name="id">
                        <input type="hidden" name="action" value="update">
                        <button id="update-button" class="btn input-button" type="submit">
                            <div class="button-text">UPDATE</div>
                            <img class="icon-md" src="img/arrow.png">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/painting_update.js"></script>
    <script src="js/painting_artist.js"></script>
    <script src="js/painting_medium.js"></script>
    <script src="js/painting_style.js"></script>
</body>

</html>