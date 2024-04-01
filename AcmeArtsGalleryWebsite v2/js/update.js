$(document).ready(function () {
    // get id from url
    var id = document.URL.substring(document.URL.lastIndexOf('?')+4);

    // populate update with details
    $.ajax({
        url: "request/painting_obj.php",
        type: "GET",
        dataType: "json",
        data: { paintingId: id, action: "detailsId" },

        success: function (details) {
            console.log(details);

            if (details) {
                $("#image").append(
                    `<img src="data:image/png;base64,${details.paintingImage}" style="max-height:350px; max-width:400px" />`
                );

                $("#thumbnail").append(
                    `<img src="data:image/png;base64,${details.paintingThumbnail}" style="max-height:100px; max-width:100px" />`
                );

                $("#input-title").val(details.paintingTitle);
                $("#input-year").val(details.paintingYear);
                $("#input-artist").val(details.artistId);               
                $("#input-medium").val(details.mediumId);
                $("#input-style").val(details.styleId);
                $("#input-id").val(details.paintingId);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });

    // post update
    $(document).on("submit", "#form-update", function(event) {
        event.preventDefault();

        $.ajax({
            url: "request/painting_obj.php",
            type: "POST",
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,

            success: function (response) {
                console.log(response);

                if (response) {
                    window.location.href = `details.php?id=${id}`;          
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
});