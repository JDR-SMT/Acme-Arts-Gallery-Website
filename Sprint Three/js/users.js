/*Team Name: MRS Tech
	Team Member: Ben Stafford
	Date: 09/05/2024*/

$(document).ready(function () {
    $("#subscribe-button").click(function(event) {
        event.preventDefault();
        $.ajax({
            url: "request/user_obj.php",
            type: "POST",
            dataType: "json",
            data: new FormData($("#form-newsletter")[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response) {
                    alert("Subscription successful");
                    window.location.href = "index.php";
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    $("#remove-button").click(function(event) {
        event.preventDefault();
        var email = $("#input-email").val();
        $.ajax({
            url: "request/user_obj.php",
            type: "POST",
            dataType: "json",
            data: { email: email, action: "remove" },
            success: function (response) {
                console.log(response);
                if (response) {
                    alert("Account removed successfully");
                    window.location.href = "index.php";
                } else {
                    alert("Error removing account");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
});
    