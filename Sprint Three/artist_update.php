<html lang="en">

<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 17/04/2024-->

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
        <div class="title-container title">UPDATE ARTIST</div>

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
                        <label class="form-label" for="input-name">NAME</label>
                        <input class="form-control form-control-sm" type="text" id="input-name" name="name">
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-lifespan">LIFESPAN</label>
                        <input class="form-control form-control-sm" type="text" id="input-lifespan" name="lifespan">
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="input-nationality">NATIONALITY</label>
                        <select class="form-select form-select-sm" id="input-nationality" name="nationality">

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
                        <button id="update-button" class="btn" type="submit">
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
    <script src="js/artist_update.js"></script>
    <script src="js/artist_nationality.js"></script>
</body>

</html>