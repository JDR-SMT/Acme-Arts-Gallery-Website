/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Andrew Millett
	Date: 04/04/2024*/

$(document).ready(function() {	

	//search painting
	$("#painting-search").submit(function(e) {
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
				window.location.href = `painting_details.php?id=${search.paintingId}`
				}
			},	
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			}
		});		
	});

	//search artist
	$("#artist-search").submit(function(e) {
		e.preventDefault(); // Prevent default form submission
		
		// Set searchText to the text from the name input
		var searchText = $("#name").val();
		
		$.ajax({		
			url: 'request/artist_obj.php',
			type: 'GET',
			dataType: "json",
			data: { artistName: searchText, action: "search" },
			
			success: function(search){
				console.log(search);
				
				if (search) {
				window.location.href = `artist_details.php?id=${search.artistId}`
				}
			},	
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			}
		});		
	});

});