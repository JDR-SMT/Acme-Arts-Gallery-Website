$(document).ready(function () {
    // populate styles
    $.ajax({
        url: "request/style_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "styles" },

        success: function (styles) {
            console.log(styles);

            if (styles) {
                styles.forEach(function(style) {
                    $("#input-style").append(
                        `<option value="${style.styleId}">${style.styleName}</option>`
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