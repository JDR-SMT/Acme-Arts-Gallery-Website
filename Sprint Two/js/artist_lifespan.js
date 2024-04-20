/*Team Name: MRS Tech
	Team Member: Benjamin Stafford
	Date: 19/04/2024*/

$(document).ready(function () {
    // populate lifespans
    $.ajax({
        url: "request/lifespan_obj.php",
        type: "GET",
        dataType: "json",
        data: { action: "lifespans" },

        success: function (lifespans) {
            console.log(lifespans);

            if (lifespans) {


                //get the centuries from the list of lifespans
                var uniquePeriods = [];

                lifespans.forEach(function(artist) {

                    var period = parseInt(artist.artistLifespan.substring(0,2)) + 1;

                    console.log(uniquePeriods)

                    //does period exist inside list?
                    if (!uniquePeriods.includes(period)) {
                        //if not add it
                        uniquePeriods.push(period);
                    }
                });

                //sort
                uniquePeriods.sort(function(a, b) {
                    return a - b;
                });

                //display
                uniquePeriods.forEach(function(period) {
                    $("#accordion-lifespan").append(
                        `<input type="radio" class="btn-check" name="options" id="${period}" onclick="document.getElementById('filter').action='artist_lifespan.php?id=${period}';">
                        <label class="btn" for="${period}">${period}th Century</label>`
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