/*Team Name: MRS Tech
	Team Member: Ben Stafford
	Date: 09/04/2024*/

$(document).ready(function () {
        // post update
        $(document).on("submit", "#form-add", function(event) {
            event.preventDefault();
    
            
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
						alert("artist has been added.")
                        window.location.href = `artist_details.php?id=${id}`;          
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
});