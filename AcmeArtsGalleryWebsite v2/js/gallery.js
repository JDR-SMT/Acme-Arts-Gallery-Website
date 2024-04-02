$(document).ready(function () {
    // populate gallery
        $.ajax({
        url: "request/painting_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "gallery" },
        
        success: function(gallery) { 
            console.log(gallery);

            if (gallery) {
                gallery.forEach(function(painting) {
                    $("#gallery-table-body").append(
                        `<tr>
                            <td id="three-button-container">
                                <a class="btn button-icon-sm" href="details.php?id=${painting.paintingId}">
                                    <img class="icon-sm" src="img/details.png">
                                </a>
                                <a class="btn button-icon-sm" href="update.php?id=${painting.paintingId}">
                                    <img class="icon-sm" src="img/update.png">
                                </a>
                                <a class="btn button-icon-sm" href="delete.php?id=${painting.paintingId}" onclick="return confirm('Delete this painting?')">
                                    <img class="icon-sm" src="img/delete.png">
                                </a>
                            </td>
                            <td><img src="data:image/png;base64, ${painting.paintingThumbnail}" style="width:100px" /></td>
                            <td>${painting.paintingTitle}</td>
                            <td>${painting.paintingYear}</td>
                            <td>${painting.artistName}</td>
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
});