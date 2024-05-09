/*Team Name: MRS Tech
	Team Member: Ben Stafford
	Date: 09/04/2024*/

    $(document).ready(function () {
        // Subscribe button click event
        $("#subscribe-button").click(function(event) {
            event.preventDefault();

            subscribe();
        });
    
        // Remove account button click event
        $("#remove-button").click(function(event) {
            event.preventDefault();

            var email = $("#input-email").val(); // Get the email from the form

            if (confirm("Remove this account?")) {
                removeAccount(email);
            }
        });
    
        function subscribe() {
            var formData = new FormData($("#form-newsletter")[0]);

            var breakingChecked = $("#input-breaking").is(":checked") ? 1 : 0;
            var monthlyChecked = $("#input-monthly").is(":checked") ? 1 : 0;

            formData.set("breaking", breakingChecked);
            formData.set("monthly", monthlyChecked);
            formData.set("active", 1)


            $.ajax({
                url: "request/user_obj.php",
                type: "POST",
                dataType: "json",
                data: formData,
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
                    for (var pair of formData.entries()) {
                        console.log(pair[0]+ ', ' + pair[1]); 
                    }
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }

        function removeAccount(email) {

        }
    });
    