/*Team Name: MRS Tech
	Team Member: Andrew Millett
	Date: 22/04/2024*/

$(document).ready(function () {
    // get id from url
    var id = document.URL.substring(document.URL.lastIndexOf('?')+4);

    // populate details
    $.ajax({
        url: "request/artist_obj.php",
        type: "GET",
        dataType: "json",
        data: { artistId: id, action: "detailsName" },

        success: function (details) {
            console.log(details);

            if (details) {
                $("#image").html(
                    `<img src="data:image/png;base64,${details.artistImage}" style="max-height:450px; max-width:400px" />`
                );

                $("#details-table-body").html(
                    `<tr>
                        <th>NAME</th>
                        <td>${details.artistName}</td>
                    </tr>
                    <tr>
                        <th>LIFESPAN</th>
                        <td>${details.artistLifespan}</td>
                    </tr>
                    <tr>
                        <th>NATIONALITY</th>
                        <td>${details.nationalityName}</td>
                    </tr>`
                );

                $("#button-edit").html(
                    `<a class="btn button-icon-sm" href="artist_update.php?id=${details.artistId}">
                        <img class="icon-sm" src="img/update.png">
                    </a>`
                );

                $("#button-delete").html(
                    `<a class="btn button-icon-sm" data-id="${details.artistId}">
                        <img class="icon-sm" src="img/delete.png">
                    </a>`
                );
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
	
	// Andrew Millett
	// delete artist
	$(document).on("click", "#button-delete", function (e) {
		e.preventDefault();

        // popup to confirm deletion
        if (confirm("Delete this Artist?")) {
            $.ajax({
                url: "request/artist_obj.php",
                type: "GET",
                dataType: "json",
                data: { artistId: id, action: "delete" },
        
                success: function (result) {
                    // if successfully deleted					
                    if (result.deleted == 0) {
                        alert("Artist has been deleted.");
                        window.location.href = "artists.php";
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