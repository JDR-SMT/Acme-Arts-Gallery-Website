<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acme Arts Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/nav.php'; ?>

    <div class="container-lg">
        <div class="title-container title">PAINTING DETAILS</div>

        <div id="details-container" class="container-lg">
            <div id="image">

            </div>

            <div id="table-container">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>TITLE</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>YEAR</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ARTIST</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>MEDIUM</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>STYLE</th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <div id="button-container">
                    <div id="button-edit">

                    </div>
                    <div id="button-delete">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>