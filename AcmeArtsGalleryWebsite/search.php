<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Acme Arts Gallery</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet">
    </head>
        
    <body>
        <?php require_once('nav.php'); ?>

        <div class="container">
            <div class="title-container title">SEARCH BY PAINTING TITLE</div>

            <div id="search-container" class="container col-6">
                <form action="" method="post">
                    <div class="input-group">
                        <input class="form-control" type="text" name="title">
                        <button class="btn" type="submit"><img class="icon-small" src="Icons/search.png"></button>
                    </div>
                </form>
            </div>

            <?php 
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(isset($_POST['title'])) {
                    require_once('filter_title.php');
                }
            }
            ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>