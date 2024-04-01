$(document).ready(function () {
    // populate details
    $.ajax({
        url: "request/artist_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "artists" },

        success: function (artists) {
            console.log(artists);

            if (artists) {
                artists.forEach(function(artist) {
                    $("#input-artist").append(
                        `<option value="${artist.artistId}">${artist.artistName}</option>`
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