// populate gallery
function populateGallery() {
    $.ajax({
        url: "ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "gallery" },
        
        success: function() {

        }
    });
}

$(document).ready(function () {
    // populate details
    $(document).on("click", "#details", function() {
        let paintingId = $(this).data("id");
        
        $.ajax({
            url: "ajax.php",
            type: "GET",
            dataType: "json",
            data: { id: paintingId, action: "details" },
            
            success: function(painting) {
                if (painting) {

                    const details =
                        '';
                }
            }
        });
    });
});