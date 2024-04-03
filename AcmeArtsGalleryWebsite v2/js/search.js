$(document).ready(function() {	
	$("#form-search").submit(function(e) {
		e.preventDefault(); // Prevent default form submission
		
		// Set searchText to the text from the title input
		var searchText = $("#title").val();
		
		$.ajax({		
			url: 'request/painting_obj.php',
			type: 'GET',
			dataType: "json",
			data: { paintingTitle: searchText, action: "search" },
			
			success: function(search){
				console.log(search);
				
				if (search) {
					// Clear exsisting content
					$("#image").empty();
					$("#details-table-body").empty();
					$("#button-edit").empty();
					$("#button-delete").empty();
					
					// Append new content					
					$("#image").append(
						`<img src="data:image/png;base64,${search.paintingImage}" style="max-height:450px; max-width:400px" />`
					);

					$("#details-table-body").append(
						`<tr>
							<th>TITLE</th>
							<td>${search.paintingTitle}</td>
						</tr>
						<tr>
							<th>YEAR</th>
							<td>${search.paintingYear}</td>
						</tr>
						<tr>
							<th>ARTIST</th>
							<td>${search.artistName}</td>
						</tr>
						<tr>
							<th>MEDIUM</th>
							<td>${search.mediumName}</td>
						</tr>
						<tr>
							<th>STYLE</th>
							<td>${search.styleName}</td>
						</tr>`
					);

					$("#button-edit").append(
						`<a class="btn button-icon-sm" href="update.php?id=${search.paintingId}">
							<img class="icon-sm" src="img/update.png">
						</a>`
					);

					$("#button-delete").append(
						`<a id="delete-button" class="btn button-icon-sm" href="#" data-id="${search.paintingId}">
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
	});
	
	// Delete painting
	$(document).on("click", "#button-delete", function (e) {
		e.preventDefault();
	
	var id = $(this).data("id");
	
	// Popup to confirm deletion
    if (confirm("Delete this painting?")) {
		$.ajax({
			url: "request/painting_obj.php",
			type: "GET",
			dataType: "json",
			data: { paintingId: id, action: "deleteSelected" },
	  
			success: function (deleteSelected) {
				// If successfully deleted
				if (deleteSelected.deleted == 0) {
					if(confirm("Painting has been deleted")) {
						window.location.href = "gallery.php";
					}
				}
			},
		    error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
		  },
		});
	}    
	});
});