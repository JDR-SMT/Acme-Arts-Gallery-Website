/*Team Name: MRS Tech
	Team Member: Jack Dylan Rendle, Andrew Millett, Ben Stafford
	Date: 04/04/2024*/

$(document).ready(function () {
    // populate paintings
    $.ajax({
        url: "request/user_obj.php",
        type: "GET",
        dataType: "json",
        data: {action: "users" },
        
        success: function(users) { 
            console.log(users);

            if (users) {
                $("#users-table").append(
                    `<thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>BREAKING NEWS</th>
                        <th>MONTHLY NEWS</th>
                    </tr>
                </thead>
                <tbody id="users-table-body">
    
                </tbody>`
                );

                users.forEach(function(user) {
                    $("#users-table-body").append(
                        `<tr>
                            <td>
                                <a id="button-delete" class="btn button-icon-sm" data-id="${user.userId}">
                                    <img class="icon-sm" src="img/delete.png">
                                </a>
                            </td>
                            <td>${user.userId}</td>
                            <td>${user.userName}</td>
                            <td>${user.userEmail}</td>
                            <td>${user.breakingNews}</td>
                            <td>${user.monthlyNews}</td>
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
});

// delete user
$(document).on("click", "#button-delete", function (e) {
    e.preventDefault();

    var id = $(this).data("id");
    
    // popup to confirm deletion
    if (confirm("Delete this User?")) {
        $.ajax({
            url: "request/user_obj.php",
            type: "GET",
            dataType: "json",
            data: { userId: id, action: "delete" },
    
            success: function (result) {
                // if successfully deleted					
                if (result.deleted == 0) {
                    alert("User has been deleted.")
                    window.location.href = "users.php";
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            } 
        });
    }   
});