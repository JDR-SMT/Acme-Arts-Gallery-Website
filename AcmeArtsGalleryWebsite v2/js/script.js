// populate gallery
function populateGallery() {
    $.ajax({
        url: "ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "gallery" },
        
        success: function(gallery) {
            console.log(gallery);

            if (gallery) {
                let row;

                $.each(gallery, function(index, painting) {
                    $("#galleryTable > tbody").append(
                        `<tr>
                            <td><a id="details-button" class="btn" href="details.php?id=${painting.paintingId}"><img class="icon-small" src="img/details.png"></a></td>
                            <td><a id="update-button" class="btn" href="update.php?id=${painting.paintingId}"><img class="icon-small" src="img/update.png"></a></td>
                            <td><a id="delete-button" class="btn" href="delete.php?id=${painting.paintingId}" onclick="return confirm('Delete this painting?')"><img class="icon-small" src="img/delete.png"></a></td>
                            <td><img src="data:image/png;base64, ${painting.paintingThumbnail}"/></td>
                            <td>${painting.paintingTitle}</td>
                            <td>${painting.paintingYear}</td>
                            <td>${painting.artistName}</td>
                            <td>${painting.mediumName}</td>
                            <td>${painting.styleName}</td>
                        </tr>`);
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

$(document).ready(function () {
    // populate gallery
    populateGallery();
});