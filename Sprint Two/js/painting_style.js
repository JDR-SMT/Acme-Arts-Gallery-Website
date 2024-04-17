/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Ben Stafford
	Date: 09/04/2024*/

$(document).ready(function () {
    $.ajax({
        url: "request/style_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "styles" },

        success: function (styles) {
            console.log(styles);

            if (styles) {
                // populate add and update dropdowns
                styles.forEach(function(style) {
                    $("#input-style").append(
                        `<option value="${style.styleId}">${style.styleName}</option>`
                    );
					
					// Ben Stafford
                    // populate filter options
					$("#accordion-style").append(
                        `<input type="radio" class="btn-check" name="options" id="${style.styleName}" onclick="document.getElementById('filter').action='gallery_style.php?id=${style.styleId}';">
                        <label class="btn" for="${style.styleName}">${style.styleName}</label>`
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