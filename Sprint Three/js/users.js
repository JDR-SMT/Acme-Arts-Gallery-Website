/*Team Name: MRS Tech
	Team Member: Ben Stafford
	Date: 10/05/2024*/

$(document).ready(function () {
    $("#subscribe-button").click(function(e) {
        e.preventDefault();

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
                    alert("Account has been created.");
                    window.location.href = "index.php";
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    $("#remove-button").click(function(e) {
        e.preventDefault();
        var email = $("#input-email").val();

        $.ajax({
            url: "request/user_obj.php",
            type: "POST",
            dataType: "json",
            data: { email: email, action: "remove" },

            success: function (response) {
                console.log(response);
                
				/* If we were to send an actual email, this might be what the code would look like:
				
				$.ajax({
                    url: "send_email_to_admin.php",
                    type: "POST",
                    data: { admin email },
                    success: function () {
                        alert("Account removal request sent.");
                        window.location.href = "index.php";*/
                if (response) {
                    alert("Account removal request sent.");
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
    