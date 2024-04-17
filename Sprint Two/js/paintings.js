/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Andrew Millett
	Date: 04/04/2024*/

$(document).ready(function () {
    // populate paintings
        $.ajax({
        url: "request/painting_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "paintings" },
        
        success: function(paintings) { 
            console.log(paintings);

            if (paintings) {
                paintings.forEach(function(painting) {
                    $("#paintings-table-body").append(
                        `<tr>
                            <td id="three-button-container">
                                <a class="btn button-icon-sm" href="painting_details.php?id=${painting.paintingId}">
                                    <img class="icon-sm" src="img/details.png">
                                </a>
                                <a class="btn button-icon-sm" href="painting_update.php?id=${painting.paintingId}">
                                    <img class="icon-sm" src="img/update.png">
                                </a>
                                <a id="button-delete" class="btn button-icon-sm" data-id="${painting.paintingId}">
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
	
	// Andrew Millett
	// delete painting
	$(document).on("click", "#button-delete", function (e) {
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
					// Jack Dylan Rendle
                    if (result.deleted == 0) {
                        alert("Painting has been deleted.")
						window.location.href = "paintings.php";
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