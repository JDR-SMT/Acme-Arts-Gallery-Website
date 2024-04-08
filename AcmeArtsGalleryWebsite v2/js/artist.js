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

                artists.forEach(function(artist) {                    
                    $("#accordion-artist").append(
                        `<input type="radio" class="btn-check" name="options" id="${artist.artistName}" onclick="document.getElementById('filter').action='gallery_artist.php?id=${artist.artistId}';">
                        <label class="btn" for="${artist.artistName}">${artist.artistName}</label>`
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