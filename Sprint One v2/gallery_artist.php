<html lang="en">

<!--Team Name: MRS Tech
	Team Member: Ben Stafford
	Date: 09/04/2024-->

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
    include 'includes/offcanvas.php';
    ?>

    <div class="container-lg">
        <div id="gallery-container" class="title-container">
            <div id="gallery-title" class="title">PAINTINGS</div>
            <div id="filter-container">
                <a class="btn button-icon-md" href="#offcanvas-filter" data-bs-toggle="offcanvas">
                    <img class="icon-md" src="img/filter.png">
                </a>
            </div>
        </div>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>TITLE</th>
                    <th>YEAR</th>
                    <th>MEDIUM</th>
                    <th>STYLE</th>
                </tr>
            </thead>
            <tbody id="gallery-artist-table-body">

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/gallery_artist.js"></script>
</body>

</html>