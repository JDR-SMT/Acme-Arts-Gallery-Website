<html lang="en">

<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 07/05/2024-->

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
        <div class="title-container title">NEWSLETTER</div>

        <div class="container" style="max-width: 400px;">
            <form id="form-newsletter" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label class="form-label" for="input-name">NAME</label>
                    <input class="form-control form-control-sm" type="text" id="input-name" name="name" required>
                </div>
                <div class="input-group">
                    <label class="form-label" for="input-email">EMAIL</label>
                    <input class="form-control form-control-sm" type="text" id="input-email" name="email" required>
                </div>
                <div class="input-group">
                    <input class="form-check-input" type="checkbox" id="input-breaking" name="breaking">
                    <label class="form-check-label" for="input-breaking">BREAKING NEWSLETTER</label>
                </div>
                <div class="input-group">
                    <input class="form-check-input" type="checkbox" id="input-monthly" name="monthly">
                    <label class="form-check-label" for="input-monthly">MONTHLY NEWSLETTER</label>
                </div>
                <div class="input-group">
					<input id="input-id" type="hidden" name="id">
                    <input type="hidden" name="action" value="subscribe">
                    <button id="subscribe-button" class="btn input-button" type="submit">
                        <div class="button-text">SUBSCRIBE</div>
                        <img class="icon-md" src="img/arrow.png">
                    </button>
                    <button id="remove-button" class="btn input-button" type="submit">
                        <div class="button-text">REMOVE ACCOUNT</div>
                        <img class="icon-md" src="img/arrow.png">
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/users.js"></script>
</body>

</html>