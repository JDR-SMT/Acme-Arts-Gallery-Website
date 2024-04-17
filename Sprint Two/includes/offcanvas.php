<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Ben Stafford
	Date: 17/04/2024-->

<div id="offcanvas-filter" class="offcanvas offcanvas-end" tabindex="-1">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filter</h5>
        <a id="clear-all-link" href="paintings.php">Clear All</a>
        <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
    </div>

    <!--Ben Stafford-->
    <div class="offcanvas-body">
        <form id="filter" action="" method="POST">
            <div class="accordion accordion-flush" id="accordion">
                <div class="accordion-item">
                    <h6 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-styles">
                            <h6 id="filter-title">FILTER BY STYLE</h6>
                        </button>
                    </h6>
                    <div id="collapse-styles" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <div class="list-group list-group-flush" id="accordion-style">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h6 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-artists">
                            <h6 id="filter-title">FILTER BY ARTIST</h6>
                        </button>
                    </h6>
                    <div id="collapse-artists" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <div class="list-group list-group-flush" id="accordion-artist">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <a id="apply-button" class="btn" onClick="javascript:document.getElementById('filter').submit()">
            <div class=" button-text">
                APPLY
            </div>
            <img class="icon-md" src="img/arrow.png">
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/painting_style.js"></script>
    <script src="js/painting_artist.js"></script>
</div>