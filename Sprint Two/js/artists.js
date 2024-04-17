/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 17/04/2024*/

$(document).ready(function () {
    // populate artists
        $.ajax({
        url: "request/artist_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "artists" },
        
        success: function(artists) { 
            console.log(artists);

            if (artists) {
                artists.forEach(function(artist) {
                    $("#artists-table-body").append(
                        `<tr>
                            <td id="three-button-container">
                                <a class="btn button-icon-sm" href="artist_details.php?id=${artist.artistId}">
                                    <img class="icon-sm" src="img/details.png">
                                </a>
                                <a class="btn button-icon-sm" href="artist_update.php?id=${artist.artistId}">
                                    <img class="icon-sm" src="img/update.png">
                                </a>
                                <a id="button-delete" class="btn button-icon-sm" data-id="${artist.artistId}">
                                    <img class="icon-sm" src="img/delete.png">
                                </a>
                            </td>
                            <td><img src="data:image/png;base64, ${artist.artistThumbnail}" style="width:100px" /></td>
                            <td>${artist.artistName}</td>
                            <td>${artist.artistLifespan}</td>
                            <td>${artist.nationalityName}</td>
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