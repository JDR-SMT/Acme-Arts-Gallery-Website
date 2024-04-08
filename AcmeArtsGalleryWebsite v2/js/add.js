$(document).ready(function () {
        // post update
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
                        window.location.href = `details.php?id=${id}`;          
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
});