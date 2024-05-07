/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Ben Stafford, Andrew Millett
	Date: 22/04/2024*/

$(document).ready(function () {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);

    var filter = urlParams.get('filter');
    var id = urlParams.get('id');

    // populate artists
    if (filter == "period") {
        $.ajax({
            url: "request/artist_obj.php",
            type: "GET",
            dataType: "json",
            data: {period: id, action: "filterPeriod" },
            
            success: function(artists) { 
                console.log(artists);

                if (artists) {
                    $("#artists-table").append(
                        `<thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>NAME</th>
                            <th>LIFESPAN</th>
                            <th>NATIONALITY</th>
                        </tr>
                    </thead>
                    <tbody id="artists-table-body">

                    </tbody>`
                    );

                    artists.forEach(function(artist) {
                        $("#artists-table-body").append(
                            `<tr>
                            <td id="three-button-container">
                                <a class="btn button-icon-sm" href="artist_details.php?id=${artist.artistId}">
                                    <img class="icon-sm" src="img/details.png">
                                </a>
                                <a class="btn button-icon-sm" href="artist_update.php?id=${artist.artistId}">
                                    <img class="icon-sm" src="img/update.png">
                                </a>
                                <a id="button-delete" class="btn button-icon-sm" data-id="${artist.artistId}">
                                    <img class="icon-sm" src="img/delete.png">
                                </a>
                            </td>
                            <td><img src="data:image/png;base64, ${artist.artistThumbnail}" style="width:100px" /></td>
                            <td>${artist.artistName}</td>
                            <td>${artist.artistLifespan}</td>
                            <td>${artist.nationalityName}</td>
                        </tr>`
                        );
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    } else if (filter == "nationality") {
        $.ajax({
            url: "request/artist_obj.php",
            type: "GET",
            dataType: "json",
            data: {nationalityId: id, action: "filterNationality" },
            
            success: function(artists) { 
                console.log(artists);
    
                if (artists) {
                    $("#artists-table").append(
                        `<thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>NAME</th>
                            <th>LIFESPAN</th>
                            <th>NATIONALITY</th>
                        </tr>
                    </thead>
                    <tbody id="artists-table-body">
        
                    </tbody>`
                    );
    
                    artists.forEach(function(artist) {
                        $("#artists-table-body").append(
                            `<tr>
                                <td id="three-button-container">
                                    <a class="btn button-icon-sm" href="artist_details.php?id=${artist.artistId}">
                                        <img class="icon-sm" src="img/details.png">
                                    </a>
                                    <a class="btn button-icon-sm" href="artist_update.php?id=${artist.artistId}">
                                        <img class="icon-sm" src="img/update.png">
                                    </a>
                                    <a id="button-delete" class="btn button-icon-sm" data-id="${artist.artistId}">
                                        <img class="icon-sm" src="img/delete.png">
                                    </a>
                                </td>
                                <td><img src="data:image/png;base64, ${artist.artistThumbnail}" style="width:100px" /></td>
                                <td>${artist.artistName}</td>
                                <td>${artist.artistLifespan}</td>
                                <td>${artist.nationalityName}</td>
                            </tr>`
                        );
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    } else {
        $.ajax({
            url: "request/artist_obj.php",
            type: "GET",
            dataType: "json",
            data: { action: "artists" },
            
            success: function(artists) { 
                console.log(artists);
    
                if (artists) {
    
                    $("#artists-table").append(
                        `<thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>NAME</th>
                            <th>LIFESPAN</th>
                            <th>NATIONALITY</th>
                        </tr>
                    </thead>
                    <tbody id="artists-table-body">
        
                    </tbody>`
                    );
    
                    artists.forEach(function(artist) {
                        $("#artists-table-body").append(
                            `<tr>
                                <td id="three-button-container">
                                    <a class="btn button-icon-sm" href="artist_details.php?id=${artist.artistId}">
                                        <img class="icon-sm" src="img/details.png">
                                    </a>
                                    <a class="btn button-icon-sm" href="artist_update.php?id=${artist.artistId}">
                                        <img class="icon-sm" src="img/update.png">
                                    </a>
                                    <a id="button-delete" class="btn button-icon-sm" data-id="${artist.artistId}">
                                        <img class="icon-sm" src="img/delete.png">
                                    </a>
                                </td>
                                <td><img src="data:image/png;base64, ${artist.artistThumbnail}" style="width:100px" /></td>
                                <td>${artist.artistName}</td>
                                <td>${artist.artistLifespan}</td>
                                <td>${artist.nationalityName}</td>
                            </tr>`
                        );
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
	
	// Andrew Millett
	// delete artist
	$(document).on("click", "#button-delete", function (e) {
		e.preventDefault();
	
        var id = $(this).data("id");
        
        // popup to confirm deletion
        if (confirm("Delete this Artist?")) {
            $.ajax({
                url: "request/artist_obj.php",
                type: "GET",
                dataType: "json",
                data: { artistId: id, action: "delete" },
        
                success: function (result) {
                    // if successfully deleted					
                    if (result.deleted == 0) {
                        alert("Artist has been deleted.")
						window.location.href = "artists.php";
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                } 
            });
        }   
	});
});