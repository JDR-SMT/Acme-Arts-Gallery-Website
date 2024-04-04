$(document).ready(function () {
    // get id from url
    var id = document.URL.substring(document.URL.lastIndexOf('?')+4);

    // populate details
    $.ajax({
        url: "request/painting_obj.php",
        type: "GET",
        dataType: "json",
        data: { paintingId: id, action: "detailsName" },

        success: function (details) {
            console.log(details);

            if (details) {
                $("#image").html(
                    `<img src="data:image/png;base64,${details.paintingImage}" style="max-height:450px; max-width:400px" />`
                );

                $("#details-table-body").html(
                    `<tr>
                        <th>TITLE</th>
                        <td>${details.paintingTitle}</td>
                    </tr>
                    <tr>
                        <th>YEAR</th>
                        <td>${details.paintingYear}</td>
                    </tr>
                    <tr>
                        <th>ARTIST</th>
                        <td>${details.artistName}</td>
                    </tr>
                    <tr>
                        <th>MEDIUM</th>
                        <td>${details.mediumName}</td>
                    </tr>
                    <tr>
                        <th>STYLE</th>
                        <td>${details.styleName}</td>
                    </tr>`
                );

                $("#button-edit").html(
                    `<a class="btn button-icon-sm" href="update.php?id=${details.paintingId}">
                        <img class="icon-sm" src="img/update.png">
                    </a>`
                );

                $("#button-delete").html(
                    `<a class="btn button-icon-sm" href="#" data-id="${details.paintingId}">
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
	
	// delete painting
	$(document).on("click", "#button-delete", function (e) {
		e.preventDefault();

        // popup to confirm deletion
        if (confirm("Delete this painting?")) {
            $.ajax({
                url: "request/painting_obj.php",
                type: "GET",
                dataType: "json",
                data: { paintingId: id, action: "delete" },
        
                success: function (result) {
                    // if successfully deleted
                    if (result.deleted == 0) {
                        alert("Painting has been deleted.");
                        window.location.href = "gallery.php";
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