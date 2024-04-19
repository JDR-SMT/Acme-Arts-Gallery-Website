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

        			// Ben Stafford
                    // populate filter options
					$("#accordion-nationality").append(
                        `<input type="radio" class="btn-check" name="options" id="${nationality.nationalityName}" onclick="document.getElementById('filter').action='artist_nationality.php?id=${nationality.nationalityId}';">
                        <label class="btn" for="${nationality.nationalityName}">${nationality.nationalityName}</label>`
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