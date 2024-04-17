/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 17/04/2024*/

$(document).ready(function () {
    // populate nationalities
    $.ajax({
        url: "request/nationality_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "nationalities" },

        success: function (nationalities) {
            console.log(nationalities);

            if (nationalities) {
                nationalities.forEach(function(nationality) {
                    $("#input-nationality").append(
                        `<option value="${nationality.nationalityId}">${nationality.nationalityName}</option>`
                    );
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
});