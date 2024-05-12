<html lang="en">

<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Andrew Millett
	Date: 12/05/2024-->

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
        <div class="title-container title">ADMIN LOGIN</div>

        <div class="container" style="max-width: 400px;">
            <form id="form-login" method="POST" enctype="multipart/form-data">
                <div class="input-group input-group-username">
                    <label class="form-label" for="input-username">USERNAME</label>
                    <input class="form-control form-control-sm" type="text" id="input-username" name="username" required>
                </div>
                <div class="input-group">
                    <label class="form-label" for="input-password">PASSWORD</label>
                    <input class="form-control form-control-sm" type="password" id="input-password" name="password" required>
                </div>
                <div class="input-group">
                    <input id="input-id" type="hidden" name="id">
                    <input type="hidden" name="action" value="login">
                    <button id="login-button" class="btn input-button" type="submit">
                        <div class="button-text">LOGIN</div>
                        <img class="icon-md" src="img/arrow.png" alt="Login Button">
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/admin.js"></script>
</body>

</html>