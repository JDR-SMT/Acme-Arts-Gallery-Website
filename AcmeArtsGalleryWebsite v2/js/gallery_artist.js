$(document).ready(function () {

    // get id from url
    var urlParams = new URLSearchParams(window.location.search);
    var idString = urlParams.get('id');
    var id = parseInt(idString, 10);
    
    console.log(id);

// populate gallery

$.ajax({
    url: "request/painting_obj.php",
    type: "GET",
    dataType: "json",
    data: { artistId: id, action: "detailsArtistId" },
    
    success: function(details) { 
        console.log(details);
        if (details) {
            details.forEach(function(painting) {
            $("#gallery-artist-table-body").append(
                `<tr>
                    <td id="three-button-container">
                        <a class="btn button-icon-sm" href="details.php?id=${painting.paintingId}">
                            <img class="icon-sm" src="img/details.png">
                        </a>
                        <a class="btn button-icon-sm" href="update.php?id=${painting.paintingId}">
                            <img class="icon-sm" src="img/update.png">
                        </a>
                        <a id="delete-button" class="btn button-icon-sm" href="#" data-id="${painting.paintingId}">
                            <img class="icon-sm" src="img/delete.png">
                        </a>
                    </td>
                    <td><img src="data:image/png;base64, ${painting.paintingThumbnail}" style="width:100px" /></td>
                    <td>${painting.paintingTitle}</td>
                    <td>${painting.paintingYear}</td>
                    <td>${painting.mediumName}</td>
                    <td>${painting.styleName}</td>
                </tr>`
            );
        });
    }
    },
    error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
});

    // delete painting
$(document).on("click", "#delete-button", function (e) {
    e.preventDefault();

    var id = $(this).data("id");
    
    // popup to confirm deletion
    if (confirm("Delete this painting?")) {
        $.ajax({
            url: "request/painting_obj.php",
            type: "GET",
            dataType: "json",
            data: { paintingId: id, action: "delete" },
    
            success: function (result) {
                // if successfully deleted
                if (result.deleted == 0) {
                    if(alert("Painting has been deleted.")) {
                        window.location.href = "gallery_style.php";
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            } 
        });
    }    
});
});