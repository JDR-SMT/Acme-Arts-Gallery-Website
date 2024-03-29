<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acme Arts Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'includes/nav.php';
    include 'includes/offcanvas.php';
    ?>

    <div class="container-lg">
        <div id="paintings-container" class="title-container">
            <div id="paintings-title" class="title">PAINTINGS</div>
            <div id="filter-container">
                <a id="filter-button" class="btn" href="#offcanvas-filter" data-bs-toggle="offcanvas">
                    <img class="icon" src="img/filter.png">
                </a>
            </div>
        </div>
        <table id="galleryTable" class="table table-borderless">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>TITLE</th>
                    <th>YEAR</th>
                    <th>ARTIST</th>
                    <th>MEDIUM</th>
                    <th>STYLE</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>