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
    <?php
    include 'includes/nav.php';
    include 'includes/artist_offcanvas.php';
    ?>

    <div class="container-lg">
        <div id="gallery-container" class="title-container">
            <div id="add-container">
                <a class="btn button-icon-md" href="artist_add.php">
                    <img class="icon-md" src="img/add.png">
                </a>
            </div>
            <div class="title">ARTISTS</div>
            <div id="filter-container">
                <a class="btn button-icon-md" href="#offcanvas-filter" data-bs-toggle="offcanvas">
                    <img class="icon-md" src="img/filter.png">
                </a>
            </div>
        </div>
        <table class="table table-borderless" id="artists-table">

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/artists.js"></script>
</body>

</html>