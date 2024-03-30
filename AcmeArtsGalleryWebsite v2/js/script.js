// populate gallery
function populateGallery() {
    $.ajax({
        url: "ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "gallery" },
        
        success: function(gallery) {
            if (gallery) {
                console.log(gallery);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

$(document).ready(function () {
    // populate gallery
    populateGallery();
});