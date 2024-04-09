/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 02/04/2024*/

$(document).ready(function () {
    // populate mediums
    $.ajax({
        url: "request/medium_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "mediums" },

        success: function (mediums) {
            console.log(mediums);

            if (mediums) {
                mediums.forEach(function(medium) {
                    $("#input-medium").append(
                        `<option value="${medium.mediumId}">${medium.mediumName}</option>`
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