/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Ben Stafford
	Date: 09/04/2024*/

$(document).ready(function () {
    $.ajax({
        url: "request/artist_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "artistName" },

        success: function (artists) {
            console.log(artists);

            if (artists) {
                artists.forEach(function(artist) {
                    // populate add and update dropdowns
                    $("#input-artist").append(
                        `<option value="${artist.artistId}">${artist.artistName}</option>`
                    );
					
					// Ben Stafford
                    // populate filter options
					$("#accordion-artist").append(
                        `<input type="radio" class="btn-check" name="options" id="${artist.artistName}" onclick="document.getElementById('filter').action='paintings.php?filter=artist&id=${artist.artistId}';">
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