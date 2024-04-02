<div id="offcanvas-filter" class="offcanvas offcanvas-end" tabindex="-1">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filter</h5>
        <a id="clear-all-link" href="#">Clear All</a>
        <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion accordion-flush">
            <div class="accordion-item">
                <h6 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-styles">
                        <h6 id="filter-title">FILTER BY STYLE</h6>
                    </button>
                </h6>
                <div id="collapse-styles" class="accordion-collapse collapse" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        <div class="list-group list-group-flush">
                            <?php
                            require('config.php');

                            $sql = "SELECT s.styleId, s.styleName FROM styles s";

                            try {
                                $stmt = $conn->prepare("$sql");
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                echo "ERROR: " . $e->getMessage();
                            }
                            ?>

                            <?php foreach ($result as $row) : ?>
                                <a class="list-group-item list-group-item-action" href="filter_style.php?id=<?= $row['styleId'] ?>">
                                    <?= $row['styleName'] ?>
                                </a>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion accordion-flush">
            <div class="accordion-item">
                <h6 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-artists">
                        <h6 id="filter-title">FILTER BY ARTIST</h6>
                    </button>
                </h6>
                <div id="collapse-artists" class="accordion-collapse collapse" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        <div class="list-group list-group-flush">
                            <?php
                            require('config.php');

                            $sql = "SELECT a.artistId, a.artistName FROM artists a";

                            try {
                                $stmt = $conn->prepare("$sql");
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                echo "ERROR: " . $e->getMessage();
                            }
                            ?>

                            <?php foreach ($result as $row) : ?>
                                <a class="list-group-item list-group-item-action" href="filter_artist.php?id=<?= $row['artistId'] ?>">
                                    <?= $row['artistName'] ?>
                                </a>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a id="apply-button" class="btn" href="#">
            <div class="button-text">APPLY</div>
            <img class="icon" src="img/arrow.png">
        </a>
    </div>
</div>