/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 17/04/2024*/

$(document).ready(function () {
    // get id from url
    var id = document.URL.substring(document.URL.lastIndexOf('?')+4);

    // populate update with details
    $.ajax({
        url: "request/artist_obj.php",
        type: "GET",
        dataType: "json",
        data: { artistId: id, action: "detailsId" },

        success: function (details) {
            console.log(details);

            if (details) {
                $("#image").html(
                    `<img src="data:image/png;base64,${details.artistImage}" style="max-height:300px; max-width:400px" />`
                );

                $("#thumbnail").html(
                    `<img src="data:image/png;base64,${details.artistThumbnail}" style="max-height:100px; max-width:100px" />`
                );

                $("#input-name").val(details.artistName);
                $("#input-lifespan").val(details.artistLifespan);
                $("#input-nationality").val(details.nationalityId);
                $("#input-id").val(details.artistId);               
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
		
		if (confirm("Update this artist?")){
			$.ajax({
				url: "request/artist_obj.php",
				type: "POST",
				dataType: "json",
				data: new FormData(this),
				processData: false,
				contentType: false,

				success: function (response) {
					console.log(response);

					if (response) {
						alert("Artist has been updated.")
						window.location.href = `artist_details.php?id=${id}`;          
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