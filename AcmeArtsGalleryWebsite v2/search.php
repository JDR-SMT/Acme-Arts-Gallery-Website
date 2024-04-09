<html lang="en">

<!--Team Name: MRS Tech
	Team Member: Andrew Millett
	Date: 04/04/2024-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acme Arts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/nav.php'; ?>

    <div class="container">
        <div class="title-container title">SEARCH BY TITLE</div>

        <div id="search-container" style="max-width: 500px;">
            <form id="form-search" method="POST">
                <div class="input-group">
                    <input class="form-control" type="text" id="title" name="title">
                    <button id="search-button" class="btn" type="submit">
					<img class="icon-sm" src="img/search.png">
					</button>
                </div>
            </form>
        </div>

		<div id="details-container" class="container-lg">
            <div id="image">

            </div>

            <div id="table-container">
                <table class="table table-borderless">
                    <tbody id="details-table-body">

                    </tbody>
                </table>

                <div id="two-button-container">
                    <div id="button-edit">

                    </div>
                    <div id="button-delete">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/search.js"></script>
</body>

</html>