/*Team Name: MRS Tech
	Team Member: Ben Stafford
	Date: 09/05/2024*/

$(document).ready(function () {
    $(document).on("submit", "#form-newsletter", function(event) {
        event.preventDefault();

        var buttonId = $(document.activeElement).attr('id');

        // if subscribe button was pressed
        if (buttonId === "subscribe-button") {
            $.ajax({
                url: "request/user_obj.php",
                type: "POST",
                dataType: "json",
                data: new FormData(this),
                processData: false,
                contentType: false,
                
                success: function (response) {
                    console.log(response);
                    if (response) {
                        alert("Subscription successful");
                        window.location.href = `index.php`;
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });

            //if remove button was pressed
        } else if (buttonId === "remove-button") {

            var email = $("#email").val();

            $.ajax({
                url: "request/user_obj.php",
                type: "POST",
                dataType: "json",
                data: {email: email, action: "remove" },
                processData: false,
                contentType: false,
                
                success: function (response) {
                    console.log(response);
                    if (response) {
                        alert("Account removed successfully");
                        window.location.href = `index.php`;
                    }
                    else
                    {
                        alert(response);
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
    