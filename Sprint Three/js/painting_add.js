/*Team Name: MRS Tech
	Team Member: Ben Stafford, Jack Dylan Rendle
	Date: 22/04/2024*/

$(document).ready(function () {
    // post add
    $(document).on("submit", "#form-add", function(event) {
        event.preventDefault();

        $.ajax({
            url: "request/painting_obj.php",
            type: "POST",
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,

            success: function (response) {
                console.log(response);

                if (response) {
                    alert("Painting has been added.")
                    // Jack Dylan Rendle
                    window.location.href = `painting_details.php?id=${response.paintingId}`;          
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
});